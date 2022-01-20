<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserAnalytics;
use App\Models\StudentPreference;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\CommonTrait;


class LiveExamController extends Controller
{
    //
    use CommonTrait;
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function exam_login(Request $request)
    {

        return view('afterlogin.LiveExam.exam_login');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function live_exam_list(Request $request)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        $api_url = env('API_URL') . 'api/live-exam/live-exam-schedule/' . $exam_id . '/' . $user_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
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

        $aResponse = (array)json_decode($response_json);
        $status = isset($aResponse['sucess']) ? $aResponse['sucess'] : false;

        if ($status == true) {
            $schedule_list = isset($aResponse['upcomming-live-exam']) ? $aResponse['upcomming-live-exam'] : [];
            $completed_list = isset($aResponse['completed-live-exam']) ? $aResponse['completed-live-exam'] : [];
        } else {
            $schedule_list = [];
            $completed_list = [];
        }



        return view('afterlogin.LiveExam.live_exam_list', compact('schedule_list', 'completed_list'));
    }


    public function live_exam(Request $request, $schedule_id)
    {
        $filtered_subject = [];
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $live_exam_id = $schedule_id;

        if (Redis::exists('custom_answer_time_' . $user_id)) {
            Redis::del(Redis::keys('custom_answer_time_' . $user_id));
        }

        $exam_name = 'Live Exam';


        $exam_fulltime = 5400;
        $exam_ques_count = 90;

        $inputjson['exam_id'] = $exam_id;
        $inputjson['count'] = 90;

        $request = json_encode($inputjson);

        $curl_url = "";
        $curl = curl_init();
        $api_URL = env('API_URL');

        $curl_url = $api_URL . 'api/live-exam/live-exam-web/' . $schedule_id;

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
        $response_json = str_replace('NaN', '""', $response_json);

        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpcode == 200) {
            $responsedata = json_decode($response_json);

            $aQuestions_list = $responsedata->questions_list;

            // $exam_fulltime = $responsedata->time_allowed;

            $questions_count = count($aQuestions_list);
            $exam_fulltime = $questions_count;
        } else {
            $aQuestions_list = [];
            $questions_count = 0;
            $exam_fulltime = 0;
            return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
        }

        $redis_set = 'True';

        $exam_fulltime = (isset($exam_fulltime) && !empty($exam_fulltime)) ? $exam_fulltime : $questions_count  * 60;

        $collection = collect($aQuestions_list);

        $aQuestionslist = $collection->sortBy('subject_id');

        $subject_ids = $collection->pluck('subject_id');
        $subject_list = $subject_ids->unique()->values()->all();

        $redis_subjects = $this->redis_subjects();
        $cSubjects = collect($redis_subjects);
        $aTargets = [];
        $filtered_subject = $cSubjects->whereIn('id', $subject_list)->all();
        foreach ($filtered_subject as $sub) {
            $count_arr = $collection->where('subject_id', $sub->id)->all();
            $sub->count = count($count_arr);
            $aTargets[] = $sub->subject_name;
        }

        $allQuestions = $aQuestionslist->countBy('question_id');
        $allQuestions = $aQuestionslist->keyBy('question_id');
        $aQuestions_list = $aQuestionslist->values()->all();

        $allQuestionDetails = $this->allCustomQlist($user_id, $allQuestions->all(), $redis_set);
        $keys = $allQuestions->keys('question_id')->all();


        $question_data = current($aQuestions_list);
        $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
        $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
        $nextquestion_data = next($aQuestions_list);
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
            //$optionArray = $this->shuffle_assoc($opArr);
            $optionArray = $opArr;
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
            'full_time' => $exam_fulltime,
        ];

        // Push Value in Redis
        Redis::set('custom_answer_time_' . $user_id, json_encode($redis_data));

        $tagrets = implode(', ', $aTargets);

        return view('afterlogin.LiveExam.live_exam', compact('live_exam_id', 'filtered_subject', 'tagrets', 'question_data', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'exam_ques_count', 'exam_name', 'activesub_id'));



        //return view('afterlogin.ExamViews.exam', compact('exam_name', 'exam_fulltime', 'exam_ques_count'));
    }



    /* live exam result */
    public function live_exam_result($result_id)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $curl_url = "";
        $curl = curl_init();
        $api_URL = env('API_URL');

        $curl_url = $api_URL . 'api/result-analytics/' . $user_id . '/' . $exam_id . '/' . $result_id;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 120,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response_json = curl_exec($curl);


        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpcode == 200 || $httpcode == 201) {
            $response_data = (json_decode($response_json));
            $response = isset($response_data->response) ? $response_data->response : [];

            return view('afterlogin.LiveExam.live_result_analysis', compact('response'));
        } else {

            return redirect()->back();
        }
    }
}
