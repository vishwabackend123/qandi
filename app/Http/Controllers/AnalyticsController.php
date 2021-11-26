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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function overall_analytics($active_id = '', Request $request)
    {

        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        //get user exam subjects
        $user_subjects = $this->redis_subjects();


        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/analytics/overall-analytics/' . $user_id;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
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
        $res_status = isset($overallAnalytics->success) ? $overallAnalytics->success : false;

        if ($res_status == true) :
            $scoreData = isset($overallAnalytics->test_score) ? $overallAnalytics->test_score : [];

            $dailyReport = json_decode($overallAnalytics->daily_report);
            $weeklyReport = json_decode($overallAnalytics->weekly_report);
            $monthlyReport = json_decode($overallAnalytics->monthlyReport);
            $subProf = json_decode($overallAnalytics->subject_proficiency);
            $accuracy = json_decode($overallAnalytics->accuracy);
            $timeSpent = json_decode($overallAnalytics->time_taken);



            $previous_score_per = $corrent_score_per = $diff_score_per = 0;
            if (isset($scoreData) && !empty($scoreData)) {
                $corrent_score_per = isset($scoreData[0]->result_percentage) ? $scoreData[0]->result_percentage : 0;
                $previous_score_per = isset($scoreData[1]->result_percentage) ? $scoreData[1]->result_percentage : 0;
                $diff_score_per = $corrent_score_per - $previous_score_per;
            }

            $scoreArray = [];
            if ($diff_score_per >= 0) {
                $score = isset($previous_score_per) ? $previous_score_per : 0;
                $progress = isset($diff_score_per) ? $diff_score_per : 0;
                $inprogress = 0;
                $others = 100 - ($score + $progress);

                $scoreArray['score'] = $score;
                $scoreArray['progress'] = $progress;
                $scoreArray['inprogress'] = $inprogress;
                $scoreArray['others'] = $others;
            } else {
                $score = isset($corrent_score_per) ? $corrent_score_per : 0;
                $inprogress = isset($diff_score_per) ? $diff_score_per : 0;
                $progress = 0;
                $others = 100 - ($score + $progress);

                $scoreArray['score'] = $score;
                $scoreArray['progress'] = $progress;
                $scoreArray['inprogress'] = $inprogress;
                $scoreArray['others'] = $others;
            }



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


            return view('afterlogin.Analytics.overall_analytics', compact(
                'active_id',
                'days',
                'classAccuracy',
                'stuAccuracy',
                'day',
                'classAcc',
                'stuAcc',
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
                'corrent_score_per',
                'score',
                'inprogress',
                'progress',
                'others',
                'scoreArray',
                'user_subjects'
            ));
        else :
            return redirect()->route('dashboard')->with('error', 'Please appear in exam before checking analytics.');
        //return redirect-route('')->with('error', 'Please appear in exam before checking analytics. ');
        endif;
    }

    public function export_analytics(Request $request)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        //get user exam subjects
        $user_subjects = $this->redis_subjects();



        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/analytics/overall-analytics/' . $user_id;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
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
        $res_status = isset($overallAnalytics->success) ? $overallAnalytics->success : false;



        if ($res_status == true) :
            $scoreData = isset($overallAnalytics->test_score) ? $overallAnalytics->test_score : [];



            $dailyReport = json_decode($overallAnalytics->daily_report);
            $weeklyReport = json_decode($overallAnalytics->weekly_report);
            $monthlyReport = json_decode($overallAnalytics->monthlyReport);
            $subProf = json_decode($overallAnalytics->subject_proficiency);
            $unitProf = $overallAnalytics->unit_proficiency;
            $unitProf = collect(array_values($unitProf));



            $subProf_collection = collect($subProf);
            $overall_prof_perc = $subProf_collection->sum('score');
            $accuracy = json_decode($overallAnalytics->accuracy);
            $timeSpent = json_decode($overallAnalytics->time_taken);


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
                'corrent_score_per',
                'score',
                'inprogress',
                'progress',
                'others',
                'user_subjects'
            ));
        else :
            return back()->with('error', 'Please appear in exam before checking analytics. ');
        endif;
    }

    public function nextTab(Request $request, $sub_id)
    {
        $scoreArray = isset($request->scoreArray) ? $request->scoreArray : [];
        $userData = Session::get('user_data');

        $user_id = $userData->id;

        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_URL . "api/analytics/subject-wise-analytics/$user_id/$sub_id",
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
        $subProf = $subAnalytics->topic_wise_result;
        $skillPer = $subAnalytics->skill_percentage;
        $accuracy = $subAnalytics->accuracy;
        $timeSpent = $subAnalytics->time_taken;
        $subScore = $subAnalytics->subject_score;

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
            'scoreArray'
        ));
    }


    public function tutorials_session()
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        $api_url = Config::get('constants.API_NEW_URL') . 'api/upcoming-tutorial/' . $exam_id . '/' . $user_id;

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
    }

    /***
     * tutorial signup
     * 
     *  */

    public function tutorials_signup($tutorial_id)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        $inputjson = [];
        $inputjson['student_id'] = (int)$user_id;
        $inputjson['tutorial_id'] = (int)$tutorial_id;
        $inputjson['registered_on'] = date('Y-m-d');

        $request = json_encode($inputjson);

        $api_url = Config::get('constants.API_NEW_URL') . 'api/student-register-tutorial';

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
    }
}
