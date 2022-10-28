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
use Mixpanel;

/**
 * ReviewController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 * */
class ReviewController extends Controller
{
    use CommonTrait;
    /**
     * Review
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function review(Request $request)
    {
        return view('afterlogin.ExamCustom.review');
    }
    /**
     * Get Review
     *
     * @param mixed $result_id result id
     * @param mixed $pageName  page name
     *
     * @return void
     */
    public function getReview($result_id, $pageName = "",  $type_name = null)
    {
        try {
            if ($type_name) {
                $type_name = base64_decode($type_name);
            }
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $cacheKey = 'exam_review:' . $result_id;
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
                $curl_option = array(
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
                        "Authorization: Bearer " . $this->getAccessToken()

                    ),
                );
                curl_setopt_array($curl, $curl_option);

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

                $test_name = isset($result_response->test_name) ? $result_response->test_name : '';
                $collection = collect($result_response->all_question);
                $subject_ids = $collection->pluck('subject_id');

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

                if (isset($result_response->all_question)) {
                    $i = 1;
                    foreach ($result_response->all_question as $key => $value) {
                        $result_response->all_question[$key]->quest_id = $i;
                        $i++;
                    }
                }

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

                $tempdata = (array)json_decode($question_data->question_options);
                $opArr = [];
                if (isset($tempdata) && is_array($tempdata)) {
                    foreach ($tempdata as $key => $option) {
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



                //if (Session::has('exam_name')) {
                if ($pageName == 'attempted') {
                    $exam_name = !empty($type_name) ? $type_name : '';

                    // Mixpanel Started
                    if($userData->grade_id == '1'){
                        $grade = 'JEE';
                       }elseif($userData->grade_id == '2'){
                        $grade = 'NEET';
                       }else{
                        $grade = 'NA';
                       }
       
                       /*mixpanel*/
                       $Mixpanel_key_id = env('MIXPANEL_KEY');
                       $mp = Mixpanel::getInstance($Mixpanel_key_id);
			
                       
                       // track an event
                       $mp->track("Custom Exam Attempted-clicked to review button", array(
                       'distinct_id' => $userData->id,
                       '$city' => $userData->city,
                       '$phone' => $userData->mobile,
                       '$email' => $userData->email,
                       'email verified' => $userData->email_verified,
                       'Course' => $grade,
                       'exam type' => $type_name
       
                       )); 
       
                       // create/update a profile for user id
                       $mp->people->set($userData->id, array(
                           'distinct_id' => $userData->id,
                           '$city' => $userData->city,
                           '$phone' => $userData->mobile,
                           '$email' => $userData->email,
                           'email verified' => $userData->email_verified,
                           'Course' => $grade,
                           'exam type' => $type_name
                       ));
                    // Mixpanel Event Ended


                } else {
                    if (Redis::exists('exam_name' . $user_id)) {
                        //$exam_name = Session::get('exam_name');
                        $cacheKey = 'exam_name' . $user_id;
                        $exam_name = Redis::get($cacheKey);
                    } else {
                        $exam_name = '';
                    }
                }

                // Mixpanel Started 
                if($userData->grade_id == '1'){
                    $grade = 'JEE';
                   }elseif($userData->grade_id == '2'){
                    $grade = 'NEET';
                   }else{
                    $grade = 'NA';
                   }
   
                   /*mixpanel*/
                   $Mixpanel_key_id = env('MIXPANEL_KEY');
                   $mp = Mixpanel::getInstance($Mixpanel_key_id);
			
                   
                   // track an event
                   $mp->track($type_name." - clicked to review button", array(
                   'distinct_id' => $userData->id,
                   '$city' => $userData->city,
                   '$email' => $userData->email,
                   'email verified' => $userData->email_verified,
                   'Course' => $grade,
                   'exam type' => $type_name,
                   )); 
   
                   // create/update a profile for user id
                   $mp->people->set($userData->id, array(
                       'distinct_id'       => $userData->id,
                       '$city' => $userData->city,
                       '$phone' => $userData->mobile,
                       '$email' => $userData->email,
                       'email verified' => $userData->email_verified,
                       'Course' => $grade,
                       'exam type' => $type_name,
                   ));
                  
                // Mixpanel Event Ended


                $exam_name = (isset($test_name) && !empty($test_name)) ? $test_name : $exam_name;

                $all_question_array = $this->array_group(json_decode(json_encode($all_question_list), true), 'subject_id');

                return view('afterlogin.ExamsReview.exam_review', compact('question_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'all_question_list', 'attempt_opt', 'correct_ans', 'answerKeys', 'filtered_subject', 'activesub_id', 'exam_name', 'all_question_array', 'result_id'));
            } else {
                if ($pageName == 'attempted') {
                    // return Redirect::back()->withErrors(['Data does not exist for this result id.']);
                    return redirect()->back()->withErrors(['errors' => 'Data does not exist for this result id.']);
                } else {
                    return redirect()->route('dashboard');
                }
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return Redirect::back()->withErrors(['There is some error  for this result id.']);
        }
    }
    /**
     * Next review question
     *
     * @param mixed $question_id question id
     *
     * @return void
     */
    public function nextReviewQuestion($question_id, Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $result_id = isset($request->result_id) ? $request->result_id : '';
            $cacheKey = 'exam_review:' . $result_id;
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



            //return view('afterlogin.ExamsReview.next_review_question', compact('question_data', 'attempt_opt', 'qNo', 'correct_ans', 'answerKeys', 'activeq_id'));

            $webView = view('afterlogin.ExamsReview.next_review_question', compact('question_data', 'attempt_opt', 'qNo', 'correct_ans', 'answerKeys', 'activeq_id'))->render();

            $mobView = view('afterlogin.ExamsReview.next_review_question_mobile', compact('question_data', 'attempt_opt', 'qNo', 'correct_ans', 'answerKeys', 'activeq_id'))->render();

            return response(array('status' => 'success', 'webView' => $webView, 'mobView' => $mobView));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Ajax review next subject question
     *
     * @param mixed   $subject_id subject id
     * @param Request $request    recieve the body request data
     *
     * @return void
     */
    public function ajaxReviewNextSubjectQuestion($subject_id, Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $result_id = isset($request->result_id) ? $request->result_id : '';

            $cacheKey = 'exam_review:' . $result_id;
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


            //   return view('afterlogin.ExamsReview.next_review_question', compact('question_data', 'attempt_opt', 'qNo', 'correct_ans', 'answerKeys', 'activeq_id'));
            $webView = view('afterlogin.ExamsReview.next_review_question', compact('question_data', 'attempt_opt', 'qNo', 'correct_ans', 'answerKeys', 'activeq_id'))->render();

            $mobView = view('afterlogin.ExamsReview.next_review_question_mobile', compact('question_data', 'attempt_opt', 'qNo', 'correct_ans', 'answerKeys', 'activeq_id'))->render();

            return response(array('status' => 'success', 'webView' => $webView, 'mobView' => $mobView));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Filter review question
     *
     * @param mixed $filter_by filter by
     *
     * @return void
     */
    public function filterReviewQuestion($filter_by, Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $result_id = isset($request->result_id) ? $request->result_id : '';
            $cacheKey = 'exam_review:' . $result_id;

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
                    $aQuestionslist = $aQuestionslist->sortBy([['attempt_status', $filter_by]]);
                    $filtered =   $aQuestionslist->filter(function ($value, $filter_by) {
                        return $value;
                    });

                    $all_question_list = $filtered->sortBy('seq')->all();
                } else {
                    $all_question_list = $aQuestionslist->sortBy('seq')->all();
                }
            }
            return view('afterlogin.ExamCustom.review_question_filter', compact('all_question_list'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    public function array_group(array $data, $by_column)
    {
        $result = [];
        foreach ($data as $item) {
            $column = $item[$by_column];
            unset($item[$by_column]);
            $result[$column][] = $item;
        }
        return $result;
    }
}
