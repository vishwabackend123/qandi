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
use Illuminate\Support\Facades\Log;

use App\Http\Traits\CommonTrait;

class AnalyticsController extends Controller
{
    //
    use CommonTrait;


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function overall_analytics($active_id = '', Request $request)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            //get user exam subjects
            $user_subjects = $this->redis_subjects();

            $api_URL = env('API_URL');

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_URL . 'api/analytics/overall-analytics-score/' . $user_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);
            $mockTestScoreCurr = 0;
            $mockTestScorePre = 0;
            $lastscore = $progress = 0;
            $otherScorePre = 100;
            $subProf = [];
            if (isset($response->success) && $response->success === true) :
                $mockTestScoreCurr = $response->test_score[0]->result_percentage ?? 0;
                $mockTestScorePre = $response->test_score[1]->result_percentage ?? 0;
                $lastscore = ($mockTestScoreCurr >= $mockTestScorePre) ? $mockTestScorePre : $mockTestScoreCurr;
                $progress = ($mockTestScoreCurr >= $mockTestScorePre) ? ($mockTestScoreCurr - $mockTestScorePre) : 0;
                $subProf = json_decode($response->subject_proficiency);
                $otherScorePre = $otherScorePre - ($mockTestScoreCurr + $mockTestScorePre);
            endif;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_URL . 'api/analytics/overall-analytics-graph/' . $user_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $overallAnalytics = json_decode($response);
            $dailyReport = (isset($overallAnalytics->daily_report) && !empty($overallAnalytics->daily_report)) ? json_decode($overallAnalytics->daily_report) : [];
            $weeklyReport = (isset($overallAnalytics->weekly_report) && !empty($overallAnalytics->weekly_report)) ? json_decode($overallAnalytics->weekly_report) : [];
            $monthlyReport = (isset($overallAnalytics->monthlyReport) && !empty($overallAnalytics->monthlyReport)) ? json_decode($overallAnalytics->monthlyReport) : [];

            $date1 = [];
            $correctTime1 = [];
            $incorrectTime1 = [];
            foreach ($dailyReport as $val) {
                array_push($date1, date('j M', strtotime($val->date)));
                $parsed = number_format($val->time_spent_on_correct_ques, 3);
                array_push($correctTime1, round((float)$parsed, 2));
                /* $parsed = date_parse($val->time_spent_on_incorrect_ques);
                $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $inparsed = number_format($val->time_spent_on_incorrect_ques, 3);
                array_push($incorrectTime1, round((float)$inparsed, 2));
            }
            $date1 = json_encode($date1);
            $correctTime1 = json_encode($correctTime1);
            $incorrectTime1 = json_encode($incorrectTime1);

            $date2 = [];
            $correctTime2 = [];
            $incorrectTime2 = [];
            foreach ($weeklyReport as $val) {

                //array_push($date2, date('j M', strtotime($val->date)));
                array_push($date2, $val->date);
                /*  $parsed = date_parse($val->time_spent_on_correct_ques);
                $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $parsed = number_format($val->time_spent_on_correct_ques, 3);
                array_push($correctTime2, round((float)$parsed, 2));
                /*  $parsed = date_parse($val->time_spent_on_incorrect_ques);
                $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $inparsed = number_format($val->time_spent_on_incorrect_ques, 3);
                array_push($incorrectTime2, round((float)$inparsed, 2));
            }
            $date2 = json_encode($date2);
            $correctTime2 = json_encode($correctTime2);
            $incorrectTime2 = json_encode($incorrectTime2);

            $date3 = [];
            $correctTime3 = [];
            $incorrectTime3 = [];
            foreach ($monthlyReport as $val) {
                array_push($date3, date('M', strtotime($val->date)));
                /* $parsed = date_parse($val->time_spent_on_correct_ques);
                $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $parsed = number_format($val->time_spent_on_correct_ques, 3);
                array_push($correctTime3, round((float)$parsed, 2));
                /*  $parsed = date_parse($val->time_spent_on_incorrect_ques);
                $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $inparsed = number_format($val->time_spent_on_incorrect_ques, 3);
                array_push($incorrectTime3, round((float)$inparsed, 2));
            }
            $date3 = json_encode($date3);
            $correctTime3 = json_encode($correctTime3);
            $incorrectTime3 = json_encode($incorrectTime3);


            $correctAns1 = [];
            $incorrectAns1 = [];
            foreach ($dailyReport as $val) {
                array_push($correctAns1, $val->correct_ans);
                array_push($incorrectAns1, $val->incorrect_ans);
            }

            $correctAns1 = json_encode($correctAns1);

            $incorrectAns1 = json_encode($incorrectAns1);

            $correctAns2 = [];
            $incorrectAns2 = [];
            foreach ($weeklyReport as $val) {
                array_push($correctAns2, $val->correct_ans);
                array_push($incorrectAns2, $val->incorrect_ans);
            }
            $correctAns2 = json_encode($correctAns2);
            $incorrectAns2 = json_encode($incorrectAns2);

            $correctAns3 = [];
            $incorrectAns3 = [];
            foreach ($monthlyReport as $val) {
                array_push($correctAns3, $val->correct_ans);
                array_push($incorrectAns3, $val->incorrect_ans);
            }
            $correctAns3 = json_encode($correctAns3);
            $incorrectAns3 = json_encode($incorrectAns3);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_URL . 'api/analytics/overall-analytics-accuracy-timetaken/' . $user_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);
            $accuracy = json_decode($response->accuracy);
            $timeSpent = json_decode($response->time_taken);
            $day = [];
            $classAcc = [];
            $stuAcc = [];
            foreach ($accuracy as $val) {
                array_push($day, $val->dateDay);
                array_push($classAcc, round($val->class_accuracy, 2));
                array_push($stuAcc, round($val->student_accuracy, 2));
            }
            $day = json_encode($day);
            $classAcc = json_encode($classAcc);
            $stuAcc = json_encode($stuAcc);

            $days = [];
            $classAccuracy = [];
            $stuAccuracy = [];
            foreach ($timeSpent as $val) {
                array_push($days, $val->dateDay);
                array_push($classAccuracy, round($val->class_time_taken, 2));
                array_push($stuAccuracy, round($val->student_time_taken, 2));
            }
            $days = json_encode($days);
            $classAccuracy = json_encode($classAccuracy);
            $stuAccuracy = json_encode($stuAccuracy);
            $subject = "";
            $topicList = [];
            return view('afterlogin.Analytics.overall_analytics', compact(
                'active_id',
                'user_subjects',
                'mockTestScoreCurr',
                'mockTestScorePre',
                'lastscore',
                'progress',
                'subProf',
                'date1',
                'date2',
                'date3',
                'days',
                'correctTime1',
                'incorrectTime1',
                'correctTime2',
                'incorrectTime2',
                'correctTime3',
                'incorrectTime3',
                'correctAns1',
                'incorrectAns1',
                'correctAns2',
                'incorrectAns2',
                'correctAns3',
                'incorrectAns3',
                'classAccuracy',
                'stuAccuracy',
                'day',
                'classAcc',
                'stuAcc',
                'subject',
                'topicList',
                'otherScorePre'
            ));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function export_analytics(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            //get user exam subjects
            $user_subjects = $this->redis_subjects();
            $sub_count = (isset($user_subjects) && !empty($user_subjects)) ? count($user_subjects) : 1;

            $api_URL = env('API_URL');

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_URL . 'api/analytics/overall-analytics-score/' . $user_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);
            $mockTestScoreCurr = 0;
            $mockTestScorePre = 0;
            $subProf = [];
            $otherScorePre = 100;
            if ($response->success === true) :
                $mockTestScoreCurr = $response->test_score[0]->result_percentage ?? 0;
                $mockTestScorePre = $response->test_score[1]->result_percentage ?? 0;
                $subProf = json_decode($response->subject_proficiency);
                $otherScorePre = $otherScorePre - ($mockTestScoreCurr + $mockTestScorePre);
            endif;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_URL . 'api/analytics/overall-analytics-graph/' . $user_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $overallAnalytics = json_decode($response);

            $dailyReport = (isset($overallAnalytics->daily_report) && !empty($overallAnalytics->daily_report)) ? json_decode($overallAnalytics->daily_report) : [];
            $weeklyReport = (isset($overallAnalytics->weekly_report) && !empty($overallAnalytics->weekly_report)) ? json_decode($overallAnalytics->weekly_report) : [];
            $monthlyReport = (isset($overallAnalytics->monthlyReport) && !empty($overallAnalytics->monthlyReport)) ? json_decode($overallAnalytics->monthlyReport) : [];

            $date1 = [];
            $correctTime1 = [];
            $incorrectTime1 = [];
            foreach ($dailyReport as $val) {
                array_push($date1, date('j M', strtotime($val->date)));
                $parsed = number_format($val->time_spent_on_correct_ques, 3);
                array_push($correctTime1, round((float)$parsed, 2));
                /* $parsed = date_parse($val->time_spent_on_incorrect_ques);
                $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $inparsed = number_format($val->time_spent_on_incorrect_ques, 3);
                array_push($incorrectTime1, round((float)$inparsed, 2));
            }
            $date1 = json_encode($date1);
            $correctTime1 = json_encode($correctTime1);
            $incorrectTime1 = json_encode($incorrectTime1);

            $date2 = [];
            $correctTime2 = [];
            $incorrectTime2 = [];
            foreach ($weeklyReport as $val) {
                //array_push($date2, date('j M', strtotime($val->date)));
                array_push($date2, $val->date);
                /*  $parsed = date_parse($val->time_spent_on_correct_ques);
                $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $parsed = number_format($val->time_spent_on_correct_ques, 3);
                array_push($correctTime2, (float)$parsed);
                /*  $parsed = date_parse($val->time_spent_on_incorrect_ques);
                $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $inparsed = number_format($val->time_spent_on_incorrect_ques, 3);
                array_push($incorrectTime2, (float)$inparsed);
            }
            $date2 = json_encode($date2);
            $correctTime2 = json_encode($correctTime2);
            $incorrectTime2 = json_encode($incorrectTime2);

            $date3 = [];
            $correctTime3 = [];
            $incorrectTime3 = [];
            foreach ($monthlyReport as $val) {
                array_push($date3, date('M', strtotime($val->date)));
                /* $parsed = date_parse($val->time_spent_on_correct_ques);
                $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $parsed = number_format($val->time_spent_on_correct_ques, 3);
                array_push($correctTime3, (float)$parsed);
                /*  $parsed = date_parse($val->time_spent_on_incorrect_ques);
                $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $inparsed = number_format($val->time_spent_on_incorrect_ques, 3);
                array_push($incorrectTime3, (float)$inparsed);
            }
            $date3 = json_encode($date3);
            $correctTime3 = json_encode($correctTime3);
            $incorrectTime3 = json_encode($incorrectTime3);


            $correctAns1 = [];
            $incorrectAns1 = [];
            foreach ($dailyReport as $val) {
                array_push($correctAns1, $val->correct_ans);
                array_push($incorrectAns1, $val->incorrect_ans);
            }

            $correctAns1 = json_encode($correctAns1);

            $incorrectAns1 = json_encode($incorrectAns1);

            $correctAns2 = [];
            $incorrectAns2 = [];
            foreach ($weeklyReport as $val) {
                array_push($correctAns2, $val->correct_ans);
                array_push($incorrectAns2, $val->incorrect_ans);
            }
            $correctAns2 = json_encode($correctAns2);
            $incorrectAns2 = json_encode($incorrectAns2);

            $correctAns3 = [];
            $incorrectAns3 = [];
            foreach ($monthlyReport as $val) {
                array_push($correctAns3, $val->correct_ans);
                array_push($incorrectAns3, $val->incorrect_ans);
            }
            $correctAns3 = json_encode($correctAns3);
            $incorrectAns3 = json_encode($incorrectAns3);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_URL . 'api/analytics/overall-analytics-accuracy-timetaken/' . $user_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);
            $accuracy = json_decode($response->accuracy);
            $timeSpent = json_decode($response->time_taken);
            $day = [];
            $classAcc = [];
            $stuAcc = [];
            foreach ($accuracy as $val) {
                array_push($day, $val->dateDay);
                array_push($classAcc, round($val->class_accuracy, 2));
                array_push($stuAcc, round($val->student_accuracy, 2));
            }
            $day = json_encode($day);
            $classAcc = json_encode($classAcc);
            $stuAcc = json_encode($stuAcc);

            $days = [];
            $classAccuracy = [];
            $stuAccuracy = [];
            foreach ($timeSpent as $val) {
                array_push($days, $val->dateDay);
                array_push($classAccuracy, round($val->class_time_taken, 2));
                array_push($stuAccuracy, round($val->student_time_taken));
            }
            $days = json_encode($days);
            $classAccuracy = json_encode($classAccuracy);
            $stuAccuracy = json_encode($stuAccuracy);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_URL . 'api/analytics/export-analytics-extra/' . $user_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $overallAnalytics = json_decode($response);
            $unitProf = $overallAnalytics->unit_proficiency;
            $unitProf = collect(array_values($unitProf));
            $subProf_collection = collect($subProf);
            $overall_prof_perc = $subProf_collection->sum('score') / $sub_count;


            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_myq_url = $api_URL . 'api/myqtoday?student_id=' . $user_id . '&exam_id=' . $exam_id;
            curl_setopt_array($curl, array(

                CURLOPT_URL => $curl_myq_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
            ));

            $response_myq_json = curl_exec($curl);
            $response_myq = json_decode($response_myq_json, true);

            $corrent_score_per = isset($response_myq['MyQToday Score']) && !empty($response_myq['MyQToday Score']) ? $response_myq['MyQToday Score'] : 0;
            $corrent_score_per = (int) $corrent_score_per;
            $myqScore = isset($corrent_score_per) ? $corrent_score_per : 0;
            $myqOther = 100 - ($myqScore);

            return view('afterlogin.Analytics.export_analytics', compact(
                'overallAnalytics',
                'days',
                'classAccuracy',
                'stuAccuracy',
                'day',
                'classAcc',
                'stuAcc',
                'subProf',
                'unitProf',
                'overall_prof_perc',
                'correctAns1',
                'incorrectAns1',
                'correctAns2',
                'incorrectAns2',
                'correctAns3',
                'incorrectAns3',
                'date1',
                'correctTime1',
                'incorrectTime1',
                'date2',
                'correctTime2',
                'incorrectTime2',
                'date3',
                'correctTime3',
                'incorrectTime3',
                'mockTestScoreCurr',
                'mockTestScorePre',
                'user_subjects',
                'otherScorePre',
                'myqScore',
                'myqOther'
            ));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function nextTab(Request $request, $sub_id)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $api_URL = env('API_URL');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_URL . 'api/analytics/subject-wise-analytics-score/' . $user_id . '/' . $sub_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $subAnalytics = json_decode($response);

            $subProf = isset($subAnalytics->topic_wise_result) ? $subAnalytics->topic_wise_result : [];
            $skillPer = isset($subAnalytics->skill_percentage) ? $subAnalytics->skill_percentage : [];
            $subScore = isset($subAnalytics->subject_score) ? $subAnalytics->subject_score : [];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_URL . 'api/analytics/subject-wise-analytics-graph/' . $user_id . '/' . $sub_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $subAnalytics = json_decode($response);
            $dailyReport = $subAnalytics->daily_report;
            $weeklyReport = $subAnalytics->weekly_report;
            $monthlyReport = $subAnalytics->monthlyReport;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_URL . 'api/analytics/subject-wise-analytics-accuracy/' . $user_id . '/' . $sub_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $subAnalytics = json_decode($response);
            $accuracy = $subAnalytics->accuracy;
            $timeSpent = $subAnalytics->time_taken;

            $date1 = [];
            $correctTime1 = [];
            $incorrectTime1 = [];
            foreach ($dailyReport as $val) {
                array_push($date1, date('j M', strtotime($val->date)));
                $parsed = number_format($val->time_spent_on_correct_ques, 3);
                //$correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
                array_push($correctTime1, round((float)$parsed, 2));
                $incparsed = number_format($val->time_spent_on_incorrect_ques, 3);
                //$incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
                array_push($incorrectTime1, round((float)$incparsed, 2));
            }
            $date1 = json_encode($date1);
            $correctTime1 = json_encode($correctTime1);
            $incorrectTime1 = json_encode($incorrectTime1);


            $date2 = [];
            $correctTime2 = [];
            $incorrectTime2 = [];
            foreach ($weeklyReport as $val) {
                /* array_push($date2, date('j M', strtotime($val->date))); */
                array_push($date2, $val->date);
                /* $parsed = date_parse($val->time_spent_on_correct_ques);
                $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $parsed = number_format($val->time_spent_on_correct_ques, 3);
                array_push($correctTime2, round((float)$parsed, 2));
                /* $parsed = date_parse($val->time_spent_on_incorrect_ques);
                $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $incparsed = number_format($val->time_spent_on_incorrect_ques, 3);
                array_push($incorrectTime2, round((float)$incparsed, 2));
            }
            $date2 = json_encode($date2);
            $correctTime2 = json_encode($correctTime2);
            $incorrectTime2 = json_encode($incorrectTime2);

            $date3 = [];
            $correctTime3 = [];
            $incorrectTime3 = [];
            foreach ($monthlyReport as $val) {
                array_push($date3, date('M', strtotime($val->date)));
                /*  $parsed = date_parse($val->time_spent_on_correct_ques);
                $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $parsed = number_format($val->time_spent_on_correct_ques, 3);
                array_push($correctTime3, round((float)$parsed, 2));
                /* $parsed = date_parse($val->time_spent_on_incorrect_ques);
                $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']; */
                $incparsed = number_format($val->time_spent_on_incorrect_ques, 3);
                array_push($incorrectTime3, round((float)$incparsed, 2));
            }
            $date3 = json_encode($date3);
            $correctTime3 = json_encode($correctTime3);
            $incorrectTime3 = json_encode($incorrectTime3);


            $correctAns1 = [];
            $incorrectAns1 = [];
            foreach ($dailyReport as $val) {
                array_push($correctAns1, round($val->correct_ans, 2));
                array_push($incorrectAns1, round($val->incorrect_ans, 2));
            }
            $correctAns1 = json_encode($correctAns1);
            $incorrectAns1 = json_encode($incorrectAns1);

            $correctAns2 = [];
            $incorrectAns2 = [];
            foreach ($weeklyReport as $val) {
                array_push($correctAns2, round($val->correct_ans, 2));
                array_push($incorrectAns2, round($val->incorrect_ans, 2));
            }
            $correctAns2 = json_encode($correctAns2);
            $incorrectAns2 = json_encode($incorrectAns2);

            $correctAns3 = [];
            $incorrectAns3 = [];
            foreach ($monthlyReport as $val) {
                array_push($correctAns3, round($val->correct_ans, 2));
                array_push($incorrectAns3, round($val->incorrect_ans, 2));
            }
            $correctAns3 = json_encode($correctAns3);
            $incorrectAns3 = json_encode($incorrectAns3);

            $day = [];
            $classAcc = [];
            $stuAcc = [];
            foreach ($accuracy as $val) {
                array_push($day, $val->dateDay);
                array_push($classAcc, round($val->class_accuracy, 2));
                array_push($stuAcc, round($val->student_accuracy, 2));
            }
            $day = json_encode($day);
            $classAcc = json_encode($classAcc);
            $stuAcc = json_encode($stuAcc);

            $days = [];
            $classAccuracy = [];
            $stuAccuracy = [];
            foreach ($timeSpent as $val) {
                array_push($days, $val->dateDay);
                array_push($classAccuracy, round($val->class_time_taken, 2));
                array_push($stuAccuracy, round($val->student_time_taken, 2));
            }
            $days = json_encode($days);
            $classAccuracy = json_encode($classAccuracy);
            $stuAccuracy = json_encode($stuAccuracy);


            return view('afterlogin.Analytics.subject_wise_analytics', compact(
                'subScore',
                'day',
                'classAcc',
                'stuAcc',
                'days',
                'classAccuracy',
                'stuAccuracy',
                'skillPer',
                'subProf',
                'correctAns1',
                'incorrectAns1',
                'correctAns2',
                'incorrectAns2',
                'correctAns3',
                'incorrectAns3',
                'date1',
                'correctTime1',
                'incorrectTime1',
                'date2',
                'correctTime2',
                'incorrectTime2',
                'date3',
                'correctTime3',
                'incorrectTime3',
                'sub_id'
            ));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }


    public function tutorials_session()
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $api_url = env('API_URL') . 'api/upcoming-tutorial/' . $exam_id . '/' . $user_id;

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
            $aResponse = json_decode($response_json);
            $res_status = isset($aResponse->success) ? $aResponse->success : true;


            if ($res_status == true) {
                $data = (isset($aResponse->tutorial_list[0]) && !empty($aResponse->tutorial_list[0])) ? $aResponse->tutorial_list[0] : [];
            } else {
                $data = [];
            }

            return view('afterlogin.Analytics.ajax_tutorials', compact('data'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /***
     * tutorial signup
     *
     *  */

    public function tutorials_signup($tutorial_id)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $inputjson = [];
            $inputjson['student_id'] = (int)$user_id;
            $inputjson['tutorial_id'] = (int)$tutorial_id;
            $inputjson['registered_on'] = date('Y-m-d');

            $request = json_encode($inputjson);

            $api_url = env('API_URL') . 'api/student-register-tutorial';

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 120,
                CURLOPT_TIMEOUT => 120,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request,
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            ));

            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            return $response_json;
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }



    public function topicAnalyticsList($sub_id)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $user_subjects = json_decode(json_encode($this->redis_subjects(), true));
            $id = array_search($sub_id, array_column($user_subjects, 'id'));
            if ($id >= 1) {
                $subject = $user_subjects[$id]->subject_name;
            } else {
                $subject = $user_subjects[0]->subject_name;
            }

            $api_url = env('API_URL') . 'api/topics-by-subject-id/' . $user_id . '/'  . $sub_id;

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
            $aResponse = json_decode($response_json, true);
            $topicList = isset($aResponse['response']) && !empty($aResponse['response']) ? $aResponse['response'] : [];
            $html = view('afterlogin.Analytics.topics_analytics', compact('sub_id', 'subject', 'topicList'))->render();

            return response()->json([
                'status' => true,
                'html' => $html,
                'message' => 'Coupon code applied successfully.',
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
