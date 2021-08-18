<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use App\Models\UserAnalytics;
use App\Models\StudentPreference;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\CommonTrait;

class PlannerController extends Controller
{
    //
    use CommonTrait;

    public function addPlanner(Request $request)
    {

        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $range = isset($request->weekrange) ? $request->weekrange : '';
        $start_date = isset($request->start_date) ? $request->start_date : '';
        $end_date = isset($request->end_date) ? $request->end_date : '';
        $chapters = isset($request->chapters) ? json_encode($request->chapters) : '';


        $request = [
            "student_id" => $user_id,
            "exam_id" => $exam_id,
            "subject_id" => 1,
            "chapter_id" => $chapters,
            "date_from" => $start_date,
            "date_to" => $end_date
        ];

        $request_json = json_encode($request);

        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/student-planner';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request_json,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",

            ),
        ));
        $response_json = curl_exec($curl);

        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpcode == 200 || $httpcode == 201) {

            return $response_json;
        } else {
            return $err;
        }
    }


    public function weeklyExams(Request $request)
    {
        # code...
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/student-planner-current-week/' . $user_id;


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
        if ($httpcode == 200 || $httpcode == 201) {
            $response = json_decode($response_json);
            $planner = isset($response->result) ? $response->result : [];
        } else {
            $planner = [];
        }

        //  dd($planner);
        return view('afterlogin.weekly_planner', compact('planner'));
    }



    public function plannerExam($chapter_id = null, Request $request)
    {
        $filtered_subject = [];

        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        if (Redis::exists('custom_answer_time')) {
            Redis::del(Redis::keys('custom_answer_time'));
        }


        $question_count = isset($request->question_count) ? $request->question_count : 30;
        $subject_id = isset($request->subject_id) ? $request->subject_id : 0;
        $chapter_id = isset($request->chapter_id) ? $request->chapter_id : 0;

        $select_topic = isset($request->topics) ? (explode(",", $request->topics)) : [];
        //dd($select_topic);

        $inputjson['student_id'] = $user_id; //30776; //(string);
        $inputjson['exam_id'] = (string)$exam_id;
        $inputjson['chapter_id'] = (string)$chapter_id;


        $request = json_encode($inputjson);


        $curl_url = "";
        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/planner-question-selection';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",

            ),
        ));
        $response_json = curl_exec($curl);
        $response_json = str_replace('NaN', '""', $response_json);

        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);


        if ($httpcode == 200 || $httpcode == 201) {
            $responsedata = json_decode($response_json);

            if (!empty($responsedata)) {
                $aQuestions_list = isset($responsedata->questions_list) ? $responsedata->questions_list : [];
                $exam_fulltime = $responsedata->time_allowed;
                $questions_count = count($aQuestions_list);
            } else {
                return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
            }
        } else {
            $aQuestions_list = [];
            $questions_count = 0;
            $exam_fulltime = 0;
            return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
        }

        $redis_set = 'True';

        $collection = collect($aQuestions_list)->sortBy('subject_id');
        $grouped = $collection->groupBy('subject_id');
        $subject_ids = $collection->pluck('subject_id');
        $subject_list = $subject_ids->unique()->values()->all();

        $redis_subjects = $this->redis_subjects();
        $cSubjects = collect($redis_subjects);

        $filtered_subject = $cSubjects->whereIn('id', $subject_list)->all();


        $allQuestions = $collection->keyBy('question_id')->sortBy('question_id');

        $allQuestionDetails = $this->allCustomQlist($user_id, $allQuestions->all(), $redis_set);
        $keys = $allQuestions->keys('question_id')->all();


        $question_data = (object)current($aQuestions_list);
        $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
        $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
        $nextquestion_data = (object)next($aQuestions_list);

        $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
        $prev_qid = '';



        if (isset($question_data) && !empty($question_data)) {
            $publicPath = url('/') . '/public/images/questions/';
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
        $retrive_array = $retrive_time_array = $answer_swap_cnt = [];
        $redis_data = [
            'given_ans' => $retrive_array,
            'taken_time' => $retrive_time_array,
            'answer_swap_cnt' => $answer_swap_cnt,
            'questions_count' => $questions_count,
            'all_questions_id' => $keys,
            'full_time' => $exam_fulltime,
        ];

        // Push Value in Redis
        Redis::set('custom_answer_time', json_encode($redis_data));

        return view('afterlogin.ExamCustom.exam', compact('question_data', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'filtered_subject', 'activesub_id'));
    }
}
