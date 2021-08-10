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

class AnalyticsController extends Controller
{
    //
    use CommonTrait;


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function overall_analytics(Request $request)
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        //get user exam subjects
        $user_subjects = $this->redis_subjects();

        //over all analysis data
        $api_url = Config::get('constants.API_NEW_URL') . 'api/studentDashboard/analytics/' . $user_id;


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

        if ($httpcode == 200 || $httpcode == 201) {
            $scoreResponse = json_decode($response_json);
            // dd($scoreResponse);
            $scoreData = isset($scoreResponse->test_score) ? ($scoreResponse->test_score) : '';
            $subjectData = isset($scoreResponse->subject_proficiency) ? ($scoreResponse->subject_proficiency) : '';
            $trendResponse = isset($scoreResponse->marks_trend) ? ($scoreResponse->marks_trend) : '';
        } else {
            $scoreData = [];
            $subjectData = [];
            $trendResponse = [];
        }

        $previous_score_per = $corrent_score_per = $diff_score_per = 0;
        if (isset($scoreData) && !empty($scoreData)) {
            $corrent_score_per = isset($scoreData[0]->result_percentage) ? $scoreData[0]->result_percentage : 0;
            $previous_score_per = isset($scoreData[1]->result_percentage) ? $scoreData[1]->result_percentage : 0;
            $diff_score_per = $corrent_score_per - $previous_score_per;
        }

        if ($diff_score_per >= 0) {
            $score = isset($previous_score_per) ? $previous_score_per : 0;
            $progress = isset($diff_score_per) ? $diff_score_per : 0;
            $inprogress = 0;
            $others = 100 - ($score + $progress);
        } else {
            $score = isset($corrent_score_per) ? $corrent_score_per : 0;
            $inprogress = isset($diff_score_per) ? $diff_score_per : 0;
            $progress = 0;
            $others = 100 - ($score + $progress);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.uniqtoday.com/api/analytics/overall-analytics/30782',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $overallAnalytics = curl_exec($curl);
        curl_close($curl);
        $overallAnalytics = json_decode($overallAnalytics);

        $dailyReport = json_decode($overallAnalytics[0]->daily_report);
        $weeklyReport = json_decode($overallAnalytics[0]->weekly_report);
        $monthlyReport = json_decode($overallAnalytics[0]->monthlyReport);
        $subProf = json_decode($overallAnalytics[0]->subject_proficiency);
        $accuracy = json_decode($overallAnalytics[0]->accuracy);
        $timeSpent = json_decode($overallAnalytics[0]->time_taken);

        $date1 = [];
        $correctTime1 = [];
        $incorrectTime1 = [];
        foreach ($dailyReport as $val) {
            array_push($date1, date('d-m', strtotime($val->date)));
            $parsed = date_parse($val->time_spent_on_correct_ques);
            $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($correctTime1, $correctTimeSeconds);
            $parsed = date_parse($val->time_spent_on_incorrect_ques);
            $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($incorrectTime1, $incorrectTimeSeconds);
        }
        $date1 = json_encode($date1);
        $correctTime1 = json_encode($correctTime1);
        $incorrectTime1 = json_encode($incorrectTime1);

        $date2 = [];
        $correctTime2 = [];
        $incorrectTime2 = [];
        foreach ($weeklyReport as $val) {
            array_push($date2, date('d-m', strtotime($val->date)));
            $parsed = date_parse($val->time_spent_on_correct_ques);
            $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($correctTime2, $correctTimeSeconds);
            $parsed = date_parse($val->time_spent_on_incorrect_ques);
            $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($incorrectTime2, $incorrectTimeSeconds);
        }
        $date2 = json_encode($date2);
        $correctTime2 = json_encode($correctTime2);
        $incorrectTime2 = json_encode($incorrectTime2);

        $date3 = [];
        $correctTime3 = [];
        $incorrectTime3 = [];
        foreach ($monthlyReport as $val) {
            array_push($date3, date('d-m', strtotime($val->date)));
            $parsed = date_parse($val->time_spent_on_correct_ques);
            $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($correctTime3, $correctTimeSeconds);
            $parsed = date_parse($val->time_spent_on_incorrect_ques);
            $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($incorrectTime3, $incorrectTimeSeconds);
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

        $day = [];
        $classAcc = [];
        $stuAcc = [];
        foreach ($accuracy as $val) {
            array_push($day, $val->dateDay);
            array_push($classAcc, $val->class_accuracy);
            array_push($stuAcc, $val->student_accuracy);
        }
        $day = json_encode($day);
        $classAcc = json_encode($classAcc);
        $stuAcc = json_encode($stuAcc);

        $days = [];
        $classAccuracy = [];
        $stuAccuracy = [];
        foreach ($timeSpent as $val) {
            array_push($days, $val->dateDay);
            array_push($classAccuracy, $val->class_time_taken);
            array_push($stuAccuracy, $val->student_time_taken);
        }
        $days = json_encode($days);
        $classAccuracy = json_encode($classAccuracy);
        $stuAccuracy = json_encode($stuAccuracy);

        return view('afterlogin.Analytics.overall_analytics', compact('days', 'classAccuracy', 'stuAccuracy', 'day','classAcc','stuAcc', 'subProf', 'correctAns1', 'incorrectAns1', 'correctAns2', 'incorrectAns2', 'correctAns3', 'incorrectAns3',
            'date1', 'correctTime1', 'incorrectTime1', 'date2', 'correctTime2', 'incorrectTime2', 'date3', 'correctTime3', 'incorrectTime3',
            'corrent_score_per', 'score', 'inprogress', 'progress', 'others', 'subjectData', 'user_subjects'));
    }

    public function export_analytics(Request $request)
    {

        return view('afterlogin.Analytics.export_analytics');
    }

    public function nextTab($sub_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.uniqtoday.com/api/analytics/subject-wise-analytics/31071/$sub_id",
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

        $dailyReport = json_decode($subAnalytics[0]->daily_report);
        $weeklyReport = json_decode($subAnalytics[0]->weekly_report);
        $monthlyReport = json_decode($subAnalytics[0]->monthlyReport);
        $subProf = $subAnalytics[0]->topic_wise_result;
        $skillPer = $subAnalytics[0]->skill_percentage;
        $accuracy = json_decode($subAnalytics[0]->accuracy);
        $timeSpent = json_decode($subAnalytics[0]->time_taken);
        $subScore = $subAnalytics[0]->subject_score;

        $date1 = [];
        $correctTime1 = [];
        $incorrectTime1 = [];
        foreach ($dailyReport as $val) {
            array_push($date1, date('d-m', strtotime($val->date)));
            $parsed = date_parse($val->time_spent_on_correct_ques);
            $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($correctTime1, $correctTimeSeconds);
            $parsed = date_parse($val->time_spent_on_incorrect_ques);
            $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($incorrectTime1, $incorrectTimeSeconds);
        }
        $date1 = json_encode($date1);
        $correctTime1 = json_encode($correctTime1);
        $incorrectTime1 = json_encode($incorrectTime1);

        $date2 = [];
        $correctTime2 = [];
        $incorrectTime2 = [];
        foreach ($weeklyReport as $val) {
            array_push($date2, date('d-m', strtotime($val->date)));
            $parsed = date_parse($val->time_spent_on_correct_ques);
            $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($correctTime2, $correctTimeSeconds);
            $parsed = date_parse($val->time_spent_on_incorrect_ques);
            $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($incorrectTime2, $incorrectTimeSeconds);
        }
        $date2 = json_encode($date2);
        $correctTime2 = json_encode($correctTime2);
        $incorrectTime2 = json_encode($incorrectTime2);

        $date3 = [];
        $correctTime3 = [];
        $incorrectTime3 = [];
        foreach ($monthlyReport as $val) {
            array_push($date3, date('d-m', strtotime($val->date)));
            $parsed = date_parse($val->time_spent_on_correct_ques);
            $correctTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($correctTime3, $correctTimeSeconds);
            $parsed = date_parse($val->time_spent_on_incorrect_ques);
            $incorrectTimeSeconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
            array_push($incorrectTime3, $incorrectTimeSeconds);
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

        $day = [];
        $classAcc = [];
        $stuAcc = [];
        foreach ($accuracy as $val) {
            array_push($day, $val->dateDay);
            array_push($classAcc, $val->class_accuracy);
            array_push($stuAcc, $val->student_accuracy);
        }
        $day = json_encode($day);
        $classAcc = json_encode($classAcc);
        $stuAcc = json_encode($stuAcc);

        $days = [];
        $classAccuracy = [];
        $stuAccuracy = [];
        foreach ($timeSpent as $val) {
            array_push($days, $val->dateDay);
            array_push($classAccuracy, $val->class_time_taken);
            array_push($stuAccuracy, $val->student_time_taken);
        }
        $days = json_encode($days);
        $classAccuracy = json_encode($classAccuracy);
        $stuAccuracy = json_encode($stuAccuracy);
//dd($subScore);
        return view('afterlogin.Analytics.subject_wise_analytics', compact('subScore', 'day', 'classAcc', 'stuAcc', 'days', 'classAccuracy', 'stuAccuracy', 'skillPer', 'subProf', 'correctAns1', 'incorrectAns1', 'correctAns2', 'incorrectAns2', 'correctAns3', 'incorrectAns3',
            'date1', 'correctTime1', 'incorrectTime1', 'date2', 'correctTime2', 'incorrectTime2', 'date3', 'correctTime3', 'incorrectTime3'));
    }
}
