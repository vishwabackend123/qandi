<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    //
    use CommonTrait;

    public function review(Request $request)
    {
        return view('afterlogin.ExamCustom.review');
    }

    /* creating review with api */

    public function getReview($result_id)
    {

        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $cacheKey = 'exam_review:' . $user_id;
            if (Redis::exists($cacheKey)) {
                Redis::del(Redis::keys($cacheKey));
            }
            /*  if (Redis::exists('review_question:' . $user_id)) {
                Redis::del(Redis::keys('review_question:' . $user_id));
            } */

            if (!empty($result_id)) {
                $curl = curl_init();
                $api_URL = env('API_URL');

                $curl_url = $api_URL . 'api/question-reviews/' . $result_id;
                curl_setopt_array($curl, array(
                    //CURLOPT_URL => config('constants.API_php_URL_local') . "get_review/" . $result_id, //local
                    CURLOPT_URL =>  $curl_url, //live
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",

                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/json",

                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                if (isset($response) && !empty($response)) :
                    $response = json_decode($response);
                endif;
            }

            $result_response = $response ?? [];

            $question_data = [];
            $attempt_opt = [];

            if (isset($result_response->all_question) && !empty($result_response->all_question)) {


                $collection = collect($result_response->all_question);


                // $grouped = $collection->groupBy('subject_id');
                $subject_ids = $collection->pluck('subject_id');

                /* if (count($grouped) > 1) {
                    $aQuestionslist = $collection->sortBy('subject_id');
                } else {
                    $aQuestionslist = $collection->sortBy('question_id');
                } */
                $aQuestionslist = $collection;
                $subject_list = $subject_ids->unique()->values()->all();

                $redis_subjects = $this->redis_subjects();
                $cSubjects = collect($redis_subjects);

                $filtered_subject = $cSubjects->whereIn('id', $subject_list)->all();
                $all_data = collect($result_response->all_question);

                $all_question_list = $aQuestionslist->all();




                $collection = collect($all_question_list);

                $allQuestions = $aQuestionslist->keyBy('question_id');
                $keys = $allQuestions->keys('question_id')->all();

                //$first = $result_response->first;
                $first = isset($keys[0]) ? $keys[0] : $result_response->first;


                $key = array_search($first, array_column($result_response->all_question, 'question_id'));
                $qNo = $key + 1;
                $nextKey = $key + 1;
                $nextKey = $nextKey % count($result_response->all_question);
                if ($key > 0) { // Key would become 0
                    $prevKey = $key - 1;
                } else {
                    $prevKey = $key;
                }

                $word1 = "/public/images/questions/";
                $word2 = "public/images/questions/";




                Redis::set($cacheKey, json_encode($result_response));

                $question_data = $all_data->where('question_id', $first)->first();
                $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
                $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
                $activeChapt_id = isset($question_data->chapter_id) ? $question_data->chapter_id : '';
                $template_type = isset($question_data->template_type) ? $question_data->template_type : '';

                $chapter_list = $this->redis_chapter_list($activesub_id);
                $collection_chpater = collect($chapter_list);
                $filter = $collection_chpater->where('chapter_id', $activeChapt_id)->first();
                $chapter_name = isset($filter->chapter_name) ? $filter->chapter_name : '';

                $question_data->chapter_name = $chapter_name;


                $nextquestion_data = next($all_question_list);
                $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
                $prev_qid = '';


                $q_id = $question_data->question_id;
                $question = $question_data->question;
                $reference_text = $question_data->reference_text;
                $explanation = $question_data->explanation;
                $correct_answer = $question_data->answers;
                $attempt_opt = isset($question_data->option_id) ? (array)json_decode($question_data->option_id) : [];

                $question_id_array[] = $q_id;
                //$publicPath = url('/') . '/public/images/questions/';
                /*  $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
                if ((strpos($question, $word1) !== false)) {
                    $question_data->question = str_replace($word1, $publicPath, $question_data->question);
                } elseif ((strpos($question, $word2) !== false)) {
                    $question_data->question = str_replace($word2, $publicPath, $question_data->question);
                }
                if ((strpos($reference_text, $word1) !== false)) {
                    $question_data->reference_text = str_replace($word1, $publicPath, $question_data->reference_text);
                } elseif ((strpos($reference_text, $word2) !== false)) {
                    $question_data->reference_text = str_replace($word2, $publicPath, $question_data->reference_text);
                }
                if ((strpos($explanation, $word1) !== false)) {
                    $question_data->explanation = str_replace($word1, $publicPath, $question_data->explanation);
                } elseif ((strpos($explanation, $word2) !== false)) {
                    $question_data->explanation = str_replace($word2, $publicPath, $question_data->explanation);
                } */
                $tempdata = (array)json_decode($question_data->question_options);
                $opArr = [];
                if (isset($tempdata) && is_array($tempdata)) {
                    foreach ($tempdata as $key => $option) {

                        /* if ((strpos($option, $word1) !== false)) {
                            $option = str_replace($word1, $publicPath, $option);
                        } elseif ((strpos($option, $word2) !== false)) {
                            $option = str_replace($word2, $publicPath, $option);
                        } */

                        $opArr[$key] = $option;
                    }
                }
                $question_data->question_options = json_encode($opArr);
                if ($template_type == 1 || $template_type == 2) {
                    $attempt_opt = isset($question_data->option_id) ? (array)json_decode($question_data->option_id) : [];
                    $correct_ans = isset($question_data->answers) ? json_decode($question_data->answers) : '';

                    if (isset($correct_ans)) {
                        foreach ($correct_ans as $ankey => $anoption) {

                            $correct_ans->$ankey = $anoption;
                        }
                    }

                    $answerKeys = array_keys((array)$correct_ans);
                } elseif ($template_type == 11) {
                    $attempt_opt = isset($question_data->option_id) ? (array)json_decode($question_data->option_id) : [];
                    $correct_ans = isset($question_data->answers) ? json_decode($question_data->answers) : '';
                    $answerKeys = 0;
                }



                if (Session::has('exam_name')) {
                    $exam_name = Session::get('exam_name');
                } else {
                    $exam_name = '';
                }

                return view('afterlogin.ExamCustom.review', compact('question_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'all_question_list', 'attempt_opt', 'correct_ans', 'answerKeys', 'filtered_subject', 'activesub_id', 'exam_name'));
            } else {
                return redirect()->route('dashboard');
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }


    public function next_review_question($question_id)
    {

        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $cacheKey = 'exam_review:' . $user_id;
            $redis_result = Redis::get($cacheKey);

            if (isset($redis_result) && !empty($redis_result)) :
                $response = json_decode($redis_result);
            endif;

            $result_response = $response;
            $question_data = [];
            $attempt_opt = [];
            $word1 = "/public/images/questions/";
            $word2 = "public/images/questions/";

            if (isset($result_response->all_question) && !empty($result_response->all_question)) {


                $collection = collect($result_response->all_question);

                $aDefault_seq = collect($result_response->all_question);

                $allQuestions = $collection->keyBy('question_id');

                $allkeys = $allQuestions->keys('question_id')->all();

                $grouped = $collection->groupBy('subject_id');
                $subject_ids = $collection->pluck('subject_id');


                $all_data = $collection;

                $sq = 1;

                foreach ($all_data as $key => $list) {
                    $list->seq = $sq;
                    $sq++;
                }

                $question_data = $all_data->where('question_id', $question_id)->first();

                $qNo = $question_data->seq;
                $q_id = $question_data->question_id;
                $activeq_id = $question_data->question_id;
                $question = $question_data->question;
                $reference_text = $question_data->reference_text;
                $explanation = $question_data->explanation;


                $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
                $activeChapt_id = isset($question_data->chapter_id) ? $question_data->chapter_id : '';
                $template_type = isset($question_data->template_type) ? $question_data->template_type : '';
                $chapter_list = $this->redis_chapter_list($activesub_id);
                $collection_chpater = collect($chapter_list);
                $filter = $collection_chpater->where('chapter_id', $activeChapt_id)->first();
                $chapter_name = isset($filter->chapter_name) ? $filter->chapter_name : '';


                $question_data->chapter_name = $chapter_name;


                $question_id_array[] = $q_id;

                $tempdata = (array)json_decode($question_data->question_options);
                $opArr = [];
                if (isset($tempdata) && is_array($tempdata)) {
                    foreach ($tempdata as $key => $option) {

                        $opArr[$key] = $option;
                    }
                }
            }


            $question_data->question_options = json_encode($opArr);

            if ($template_type == 1 || $template_type == 2) {
                $attempt_opt = isset($question_data->option_id) ? (array)json_decode($question_data->option_id) : [];
                $correct_ans = isset($question_data->answers) ? json_decode($question_data->answers) : '';

                if (isset($correct_ans)) {
                    foreach ($correct_ans as $ankey => $anoption) {

                        $correct_ans->$ankey = $anoption;
                    }
                }

                $answerKeys = array_keys((array)$correct_ans);
            } elseif ($template_type == 11) {
                $attempt_opt = isset($question_data->option_id) ? (array)json_decode($question_data->option_id) : [];
                $correct_ans = isset($question_data->answers) ? json_decode($question_data->answers) : '';
                $answerKeys = 0;
            }



            return view('afterlogin.ExamCustom.next_review_question', compact('question_data', 'attempt_opt', 'qNo', 'correct_ans', 'answerKeys', 'activeq_id'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function ajax_review_next_subject_question($subject_id, Request $request)
    {

        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $cacheKey = 'exam_review:' . $user_id;
            $redis_result = Redis::get($cacheKey);

            if ($data = Redis::get($cacheKey)) {
                $subject_list = json_decode($data);
            }

            if (isset($redis_result) && !empty($redis_result)) :
                $response = json_decode($redis_result);
            endif;

            $result_response = $response;
            $question_data = [];
            $attempt_opt = [];
            $word1 = "/public/images/questions/";
            $word2 = "public/images/questions/";

            if (isset($result_response->all_question) && !empty($result_response->all_question)) {

                $aDefault_seq = collect($result_response->all_question);
                $all_data = collect($result_response->all_question);
                // $all_data = $all_data->sortBy('subject_id');

                $allQuestions = $all_data->keyBy('question_id');
                $filtered = $all_data->where('subject_id', $subject_id);
                $first = $filtered->first();
                $question_id = $first->question_id;
                $allQuestionsArr = $all_data->all();
                $allkeys = $allQuestions->keys('question_id')->all();

                $sq = 1;

                foreach ($all_data as $key => $list) {
                    $list->seq = $sq;
                    $sq++;
                }


                $question_data = $all_data->where('question_id', $question_id)->first();
                $qNo = $question_data->seq;
                $q_id = $question_data->question_id;
                $activeq_id = $question_data->question_id;
                $question = $question_data->question;
                $reference_text = $question_data->reference_text;
                $explanation = $question_data->explanation;


                $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
                $activeChapt_id = isset($question_data->chapter_id) ? $question_data->chapter_id : '';
                $template_type = isset($question_data->template_type) ? $question_data->template_type : '';
                $chapter_list = $this->redis_chapter_list($activesub_id);
                $collection_chpater = collect($chapter_list);
                $filter = $collection_chpater->where('chapter_id', $activeChapt_id)->first();
                $chapter_name = isset($filter->chapter_name) ? $filter->chapter_name : '';


                $question_data->chapter_name = $chapter_name;

                $question_id_array[] = $q_id;
                //$publicPath = url('/') . '/public/images/questions/';
                /* $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
                if ((strpos($question, $word1) !== false)) {
                    $question_data->question = str_replace($word1, $publicPath, $question_data->question);
                } elseif ((strpos($question, $word2) !== false)) {
                    $question_data->question = str_replace($word2, $publicPath, $question_data->question);
                }
                if ((strpos($reference_text, $word1) !== false)) {
                    $question_data->reference_text = str_replace($word1, $publicPath, $question_data->reference_text);
                } elseif ((strpos($reference_text, $word2) !== false)) {
                    $question_data->reference_text = str_replace($word2, $publicPath, $question_data->reference_text);
                }
                if ((strpos($explanation, $word1) !== false)) {
                    $question_data->explanation = str_replace($word1, $publicPath, $question_data->explanation);
                } elseif ((strpos($explanation, $word2) !== false)) {
                    $question_data->explanation = str_replace($word2, $publicPath, $question_data->explanation);
                } */
                $tempdata = (array)json_decode($question_data->question_options);
                $opArr = [];
                if (isset($tempdata) && is_array($tempdata)) {
                    foreach ($tempdata as $key => $option) {

                        /*  if ((strpos($option, $word1) !== false)) {
                            $option = str_replace($word1, $publicPath, $option);
                        } else if ((strpos($option, $word2) !== false)) {
                            $option = str_replace($word2, $publicPath, $option);
                        } */
                        $opArr[$key] = $option;
                    }
                }
            }
            $question_data->question_options = json_encode($opArr);




            if ($template_type == 1 || $template_type == 2) {
                $attempt_opt = isset($question_data->option_id) ? (array)json_decode($question_data->option_id) : [];
                $correct_ans = isset($question_data->answers) ? json_decode($question_data->answers) : '';

                if (isset($correct_ans)) {
                    foreach ($correct_ans as $ankey => $anoption) {

                        $correct_ans->$ankey = $anoption;
                    }
                }

                $answerKeys = array_keys((array)$correct_ans);
            } elseif ($template_type == 11) {
                $attempt_opt = isset($question_data->option_id) ? (array)json_decode($question_data->option_id) : [];
                $correct_ans = isset($question_data->answers) ? json_decode($question_data->answers) : '';
                $answerKeys = 0;
            }


            return view('afterlogin.ExamCustom.next_review_question', compact('question_data', 'attempt_opt', 'qNo', 'correct_ans', 'answerKeys', 'activeq_id'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }


    public function filter_review_question($filter_by)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $cacheKey = 'exam_review:' . $user_id;

            //$cacheKey = 'review_question:';
            $redis_result = Redis::get($cacheKey);

            if (isset($redis_result) && !empty($redis_result)) :
                $response = json_decode($redis_result);
            endif;


            $result_response = $response;
            $all_question_list = [];
            if (isset($result_response->all_question) && !empty($result_response->all_question)) {


                $collection = collect($result_response->all_question);
                $grouped = $collection->groupBy('subject_id');

                /* if (count($grouped) > 1) {
                    $aQuestionslist = $collection->sortBy('subject_id');
                } else {
                    $aQuestionslist = $collection->sortBy('question_id');
                } */
                $aQuestionslist = $collection;
                $afterSort = $aQuestionslist;

                $i = 1;
                foreach ($afterSort as $key => $list) {
                    $list->seq = $i;
                    $i++;
                }



                if ($filter_by != 'all') {
                    $aQuestionslist = $afterSort->where('attempt_status', $filter_by);
                    $aQuestionslist = $aQuestionslist->sortBy([
                        ['attempt_status', $filter_by]
                    ]);
                    $filtered =   $aQuestionslist->filter(function ($value, $filter_by) {
                        return $value;
                    });

                    $all_question_list = $filtered->sortBy('seq')->all();
                    /* if ($filter_by == "Correct") {
                        $statusPriorities = ["Correct", "Incorrect", "Unanswered", ""];
                    } elseif ($filter_by == "Incorrect") {
                        $statusPriorities = ["Incorrect", "Correct", "Unanswered", ""];
                    } elseif ($filter_by == "Unanswered") {
                        $statusPriorities = ["Unanswered", "Incorrect", "Correct",  ""];
                    }

                    $all_question_list =  $aQuestionslist->sortBy(function ($order) use ($statusPriorities) {

                        return array_search($order->attempt_status, $statusPriorities);
                    })->values()->all(); */
                } else {

                    $all_question_list = $aQuestionslist->sortBy('seq')->all();
                }
            }



            return view('afterlogin.ExamCustom.review_question_filter', compact('all_question_list'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
