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

class TestSeriesController extends Controller
{
    //
    use CommonTrait;
    /**
     * getting Testseries list function
     *
     * @param Request $request
     * @return void
     */
    public function series_list(Request $request)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $live_series = [];
        $open_series = [];

        $api_URL = Config::get('constants.API_NEW_URL');
        $curl_url = $api_URL . 'api/testSeries-list/' . $exam_id . '/' . $user_id;
        $curl = curl_init();

        curl_setopt_array($curl, array(

            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response_json = curl_exec($curl);

        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $aResponse = json_decode($response_json);
        $status = isset($aResponse->success) ? json_decode($aResponse->success) : false;


        if ($status == true) {
            $open_series = isset($aResponse->test_series_open) ? json_decode($aResponse->test_series_open) : [];
            $live_series = isset($aResponse->test_series_live) ? json_decode($aResponse->test_series_live) : [];
            //dd($live_series);
            return view('afterlogin.TestSeries.serieslist', compact('live_series', 'open_series'));
        } else {

            return view('afterlogin.TestSeries.serieslist', compact('live_series', 'open_series'));
        }
    }

    /**
     * gettins selected series details and start exam function
     *
     * @param Request $request
     * @return void
     */
    public function test_series_exam(Request $request)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        if (Redis::exists('custom_answer_time_' . $user_id)) {
            Redis::del(Redis::keys('custom_answer_time_' . $user_id));
        }

        $exam_name = isset($request->series_name) ? $request->series_name : '';
        $exam_name = isset($request->series_name) ? $exam_name . '(Test Series)' : '';
        $series_id = isset($request->series_id) ? $request->series_id : '';
        $series_type = isset($request->series_type) ? $request->series_type : '';
        $exam_fulltime = isset($request->time_allowed) ? $request->time_allowed : '';
        $questions_count = isset($request->questions_count) ? $request->questions_count : '';
        $exam_mode = isset($request->exam_mode) ? $request->exam_mode : '';

        if (!empty($series_id)) {


            $curl_url = "";
            $curl = curl_init();
            $api_URL = Config::get('constants.API_NEW_URL');

            $curl_url = $api_URL . 'api/testSeries-questions/' . $exam_id . '/' . $series_id;

            curl_setopt_array($curl, array(

                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",

                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            ));

            $response_json = curl_exec($curl);

            // $response_json = str_replace('NaN', '""', $response_json);
            // $response_json = stripslashes(html_entity_decode($response_json));

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $responsedata = (object)json_decode($response_json, true);

            $status = isset($responsedata->success) ? $responsedata->success : false;

            if ($status == true) {

                $aQuestions_list = isset($responsedata->questions) ? $responsedata->questions : [];
            } else {
                $aQuestions_list = [];

                return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
            }


            if (!empty($aQuestions_list)) {
                $redis_set = 'True';


                $collection = collect($aQuestions_list)->sortBy('subt_id');
                $grouped = $collection->groupBy('subt_id');
                $subject_ids = $collection->pluck('subt_id');
                $subject_list = $subject_ids->unique()->values()->all();


                $redis_subjects = $this->redis_subjects();
                $cSubjects = collect($redis_subjects);
                $aTargets = [];
                $filtered_subject = $cSubjects->whereIn('id', $subject_list)->all();
                foreach ($filtered_subject as $sub) {
                    $count_arr = $collection->where('subt_id', $sub->id)->all();
                    $sub->count = count($count_arr);
                    $aTargets[] = $sub->subject_name;
                }

                $allQuestions = $collection->keyBy('question_id')->sortBy('question_id');
                $aQuestions_list =  $allQuestions->all();

                $allQuestionDetails = $this->allCustomQlist($user_id, $allQuestions->all(), $redis_set);
                $keys = $allQuestions->keys('question_id')->all();

                $question_data = (object)current($allQuestions->all());
                $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
                $activesub_id = isset($question_data->subt_id) ? $question_data->subt_id : '';
                $nextquestion_data = (object)next($aQuestions_list);

                $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
                $prev_qid = '';



                if (isset($question_data) && !empty($question_data)) {
                    //$publicPath = url('/') . '/public/images/questions/';
                    $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
                    $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
                    $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
                    $qs_id = $question_data->question_id;
                    $option_ques = str_replace("'", '"', $question_data->question_options);

                    $tempdata = json_decode($option_ques, true);
                    $opArr = [];
                    if (isset($tempdata) && is_array($tempdata)) {
                        foreach ($tempdata as $key => $option) {
                            $option = str_replace('/public/images/questions/', $publicPath, $option);
                            $opArr[$key] = $option;
                        }
                    }
                    $optionArray = $this->shuffle_assoc($opArr);
                    $option_data = $optionArray;
                } else {
                    $option_data[] = '';
                }

                /* set redis for save exam question response */
                $retrive_array = $retrive_time_array = $retrive_time_sec = $answer_swap_cnt = [];
                $redis_data = [
                    'given_ans' => $retrive_array,
                    'taken_time' => $retrive_time_array,
                    'taken_time_sec' => $retrive_time_sec,
                    'answer_swap_cnt' => $answer_swap_cnt,
                    'questions_count' => $questions_count,
                    'all_questions_id' => $keys,
                    'full_time' => $exam_fulltime
                ];
                // Push Value in Redis
                Redis::set('custom_answer_time_' . $user_id, json_encode($redis_data));
                $tagrets = implode(', ', $aTargets);
                $test_type = 'Test-Series';
                $exam_type = 'TS';

                return view('afterlogin.ExamViews.exam', compact('question_data', 'tagrets', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'filtered_subject', 'activesub_id', 'exam_name', 'test_type', 'exam_type', 'exam_mode', 'series_id'));
            } else {
                return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
            }
        } else {
            return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
        }
    }

    function shuffle_assoc($list)
    {
        if (!is_array($list)) {
            return $list;
        }

        $keys = array_keys($list);
        shuffle($keys);
        $random = array();
        foreach ($keys as $key) {
            $random[$key] = $list[$key];
        }
        return $random;
    }


    public function allCustomQlist($user_id, $question_data, $redis_set)
    {
        if (!empty($user_id) &&  !empty($question_data)) {
            $cacheKey = 'CustomQuestion:all:' . $user_id;
            if (Redis::exists($cacheKey)) {
                if ($redis_set == 'True') {
                    Redis::del($cacheKey);
                }
            }
            if ($data = Redis::get($cacheKey)) {
                return json_decode($data);
            }
            $data = collect($question_data);
            Redis::set($cacheKey, $data);
            return $data->all();
        }
        return [];
    }
}
