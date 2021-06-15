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

class ReviewController extends Controller
{
    //

    public function review(Request $request)
    {
        return view('afterlogin.ExamCustom.review');
    }

    /* creating review with api */

    public function getReview($result_id)
    {

        $user_data = Auth::user();
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;


        if (!empty($result_id)) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                //CURLOPT_URL => config('constants.API_php_URL_local')."get_review/$result_id", //local
                CURLOPT_URL => "http://44.235.5.77/api/get_review/$result_id", //live
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


        $result_response = $response->response ?? [];


        $question_data = [];
        $attempt_opt = [];

        if (isset($result_response->all_question) && !empty($result_response->all_question)) {

            $all_data = collect($result_response->all_question);
            $all_ids = $result_response->question_ids;
            $all_question_list = $result_response->all_question;

            $collection = collect($all_question_list);
            $allQuestions = $collection->keyBy('question_id');
            $keys = $allQuestions->keys('question_id')->all();


            $first = $result_response->first;

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

            $cacheKey = 'exam_review:' . $user_id;
            if (Redis::exists($cacheKey)) {
                Redis::del(Redis::keys($cacheKey));
            }
            Redis::set($cacheKey, json_encode($result_response));

            $question_data = $all_data->where('question_id', $first)->first();
            $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
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
            $publicPath = url('/') . '/public/images/questions/';
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
            }
            $tempdata = (array)json_decode($question_data->question_options);
            $opArr = [];
            if (isset($tempdata) && is_array($tempdata)) {
                foreach ($tempdata as $key => $option) {

                    if ((strpos($option, $word1) !== false)) {
                        $option = str_replace($word1, $publicPath, $option);
                    } elseif ((strpos($option, $word2) !== false)) {
                        $option = str_replace($word2, $publicPath, $option);
                    }

                    $opArr[$key] = $option;
                }
            }
            $question_data->question_options = json_encode($opArr);

            $correct_ans = isset($question_data->answers) ? json_decode($question_data->answers) : '';

            if (isset($correct_ans)) {
                foreach ($correct_ans as $ankey => $anoption) {


                    if ((strpos($anoption, $word1) !== false)) {
                        $anoption = str_replace($word1, $publicPath, $anoption);
                    } elseif ((strpos($anoption, $word2) !== false)) {
                        $anoption = str_replace($word2, $publicPath, $anoption);
                    }

                    $correct_ans->$ankey = $anoption;
                }
            }

            $answerKeys = array_keys((array)$correct_ans);




            return view('afterlogin.ExamCustom.review', compact('question_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'all_question_list', 'attempt_opt', 'correct_ans', 'answerKeys'));
        } else {
            return Redirect::back();
        }
    }


    public function next_review_question($question_id)
    {

        $user_data = Auth::user();
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;
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


            $all_data = collect($result_response->all_question);

            $allQuestions = $all_data->keyBy('question_id');
            $allQuestionsArr = $all_data->all();
            $allkeys = $allQuestions->keys('question_id')->all();



            $first = $result_response->first;

            $key = array_search($question_id, array_column($allQuestionsArr, 'question_id'));

            $qNo = $key + 1;
            $nextKey = $key + 1;
            $nextKey = $nextKey % count($result_response->all_question);
            if ($key > 0) { // Key would become 0
                $prevKey = $key - 1;
            } else {
                $prevKey = $key;
            }

            $next_qid = $allkeys[$nextKey];

            $prev_qid = $allkeys[$prevKey];
            $last_qid = end($allkeys);

            $question_data = $all_data->where('question_id', $question_id)->first();
            $q_id = $question_data->question_id;
            $activeq_id = $question_data->question_id;
            $question = $question_data->question;
            $reference_text = $question_data->reference_text;
            $explanation = $question_data->explanation;
            $attempt_opt = isset($question_data->option_id) ? (array)json_decode($question_data->option_id) : [];

            $question_id_array[] = $q_id;
            $publicPath = url('/') . '/public/images/questions/';
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
            }
            $tempdata = (array)json_decode($question_data->question_options);
            $opArr = [];
            if (isset($tempdata) && is_array($tempdata)) {
                foreach ($tempdata as $key => $option) {

                    if ((strpos($option, $word1) !== false)) {
                        $option = str_replace($word1, $publicPath, $option);
                    } else if ((strpos($option, $word2) !== false)) {
                        $option = str_replace($word2, $publicPath, $option);
                    }
                    $opArr[$key] = $option;
                }
            }
        }
        $question_data->question_options = json_encode($opArr);


        $correct_ans = isset($question_data->answers) ? json_decode($question_data->answers) : '';

        if (isset($correct_ans)) {
            foreach ($correct_ans as $ankey => $anoption) {


                if ((strpos($anoption, $word1) !== false)) {
                    $anoption = str_replace($word1, $publicPath, $anoption);
                } elseif ((strpos($anoption, $word2) !== false)) {
                    $anoption = str_replace($word2, $publicPath, $anoption);
                }

                $correct_ans->$ankey = $anoption;
            }
        }
        $answerKeys = array_keys((array)$correct_ans);
        //dd($attempt_opt);

        return view('afterlogin.ExamCustom.next_review_question', compact('question_data', 'attempt_opt', 'qNo', 'correct_ans', 'answerKeys', 'activeq_id', 'next_qid', 'prev_qid'));
    }
}
