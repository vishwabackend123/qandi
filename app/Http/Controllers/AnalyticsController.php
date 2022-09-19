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

/**
 * AnalyticsController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 */
class AnalyticsController extends Controller
{
    use CommonTrait;


    /**
     * Undocumented function
     *
     * @param  Request $request   recieve the body request data
     * @param $active_id get active input id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function overallAnalytics(Request $request)
    {
        $active_id = "";
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            //get user exam subjects
            $user_subjects = $this->redis_subjects();

            $api_URL = env('API_URL');

            $curl = curl_init();
            $curl_option = array(
                CURLOPT_URL => $api_URL . 'api/analytics/overall-analytics-score/' . $user_id . '?test_type=Assessment',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);
            $mockTestScoreCurr = 0;
            $mockTestScorePre = 0;
            $lastscore = $progress = 0;
            $otherScorePre = 100;
            $subProf = [];
            if (isset($response->success) && $response->success === true) {
                $mockTestScoreCurr = $response->test_score[0]->result_percentage ?? 0;
                $mockTestScorePre = $response->test_score[1]->result_percentage ?? 0;
                $lastscore = ($mockTestScoreCurr >= $mockTestScorePre) ? $mockTestScorePre : $mockTestScoreCurr;
                $progress = ($mockTestScoreCurr >= $mockTestScorePre) ? ($mockTestScoreCurr - $mockTestScorePre) : 0;
                $subProf = json_decode($response->subject_proficiency);
                $otherScorePre = $otherScorePre - ($mockTestScoreCurr + $mockTestScorePre);
            }

            $curl = curl_init();
            $curl_option = array(
                CURLOPT_URL => $api_URL . 'api/analytics/overall-analytics-graph/' . $user_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

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
            $curl_option = array(
                CURLOPT_URL => $api_URL . 'api/analytics/overall-analytics-accuracy-timetaken/' . $user_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

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
            $chapterList = [];
            $chapter_name = "";
            $header_title = "Analytics";
            return view('afterlogin.Analytics.overall_analytics', compact('active_id', 'user_subjects', 'mockTestScoreCurr', 'mockTestScorePre', 'lastscore', 'progress', 'subProf', 'date1', 'date2', 'date3', 'days', 'correctTime1', 'incorrectTime1', 'correctTime2', 'incorrectTime2', 'correctTime3', 'incorrectTime3', 'correctAns1', 'incorrectAns1', 'correctAns2', 'incorrectAns2', 'correctAns3', 'incorrectAns3', 'classAccuracy', 'stuAccuracy', 'day', 'classAcc', 'stuAcc', 'subject', 'topicList', 'otherScorePre', 'chapterList', 'chapter_name', 'header_title'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * This function use for net subject wise data
     *
     * @param Request $request receive request type
     * @param $sub_id  subject id
     *
     * @return void
     */
    public function nextTab(Request $request, $sub_id)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $api_URL = env('API_URL');
            $curl = curl_init();
            $curl_option = array(
                CURLOPT_URL => $api_URL . 'api/analytics/subject-wise-analytics-score/' . $user_id . '/' . $sub_id . '?test_type=Assessment',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $response = curl_exec($curl);

            curl_close($curl);
            $subAnalytics = json_decode($response);

            //$subProf = isset($subAnalytics->topic_wise_result) ? $subAnalytics->topic_wise_result : [];
            $subProf = isset($subAnalytics->chapter_wise_result) ? $subAnalytics->chapter_wise_result : [];
            $skillPer = isset($subAnalytics->skill_percentage) ? $subAnalytics->skill_percentage : [];
            $subScore = isset($subAnalytics->subject_score) ? $subAnalytics->subject_score : [];

            $curl = curl_init();
            $curl_option = array(
                CURLOPT_URL => $api_URL . 'api/analytics/subject-wise-analytics-graph/' . $user_id . '/' . $sub_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $response = curl_exec($curl);

            curl_close($curl);
            $subAnalytics = json_decode($response);

            $dailyReport = (isset($subAnalytics->daily_report) && !empty($subAnalytics->daily_report)) ? $subAnalytics->daily_report : [];
            $weeklyReport = (isset($subAnalytics->weekly_report) && !empty($subAnalytics->weekly_report)) ? $subAnalytics->weekly_report : [];
            $monthlyReport = (isset($subAnalytics->monthlyReport) && !empty($subAnalytics->monthlyReport)) ? $subAnalytics->monthlyReport : [];


            $curl = curl_init();
            $curl_option = array(
                CURLOPT_URL => $api_URL . 'api/analytics/subject-wise-analytics-accuracy/' . $user_id . '/' . $sub_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

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


            return view('afterlogin.Analytics.subject_wise_analytics', compact('subScore', 'day', 'classAcc', 'stuAcc', 'days', 'classAccuracy', 'stuAccuracy', 'skillPer', 'subProf', 'correctAns1', 'incorrectAns1', 'correctAns2', 'incorrectAns2', 'correctAns3', 'incorrectAns3', 'date1', 'correctTime1', 'incorrectTime1', 'date2', 'correctTime2', 'incorrectTime2', 'date3', 'correctTime3', 'incorrectTime3', 'sub_id'));
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }
    /**
     * This function use for net subject wise data
     *
     * @return void
     */
    public function tutorialsSession()
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $api_url = env('API_URL') . 'api/upcoming-tutorial/' . $exam_id . '/' . $user_id;

            $curl = curl_init();
            $curl_option = array(
                CURLOPT_URL => $api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

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

    /**
     * This function use for net subject wise data
     *
     * @param $tutorial_id this is tutorial id
     *
     * @return void
     */
    public function tutorialsSignup($tutorial_id)
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
            $curl_option =  array(
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
                    "content-type: application/json",
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            return $response_json;
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Get topic analytics list
     *
     * @param $sub_id  this is subjet  id
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function topicAnalyticsList($sub_id, Request $request)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $api_url = env('API_URL') . 'api/topics-by-chapter-id/' . $user_id . '/'  . $sub_id;

            $curl = curl_init();
            $curl_option =  array(
                CURLOPT_URL => $api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $aResponse = json_decode($response_json, true);
            $topicList = isset($aResponse['response']) && !empty($aResponse['response']) ? $aResponse['response'] : [];
            $html = view('afterlogin.Analytics.topics_analytics', compact('sub_id', 'topicList'))->render();

            return response()->json(['status' => true, 'html' => $html, 'message' => 'Coupon code applied successfully.']);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * This function use for get chapter level data
     *
     * @param $sub_id this is subjet  id
     *
     * @return void
     */
    public function chapterAnalyticsList($sub_id)
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

            $api_url = env('API_URL') . 'api/chapters/' . $user_id . '/'  . $sub_id;

            $curl = curl_init();
            $curl_option = array(
                CURLOPT_URL => $api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $aResponse = json_decode($response_json, true);
            $chapterList = isset($aResponse['response']) && !empty($aResponse['response']) ? $aResponse['response'] : [];
            $html = view('afterlogin.Analytics.chapter_analytics', compact('sub_id', 'subject', 'chapterList'))->render();

            return response()->json(['status' => true, 'html' => $html, 'message' => 'Coupon code applied successfully.']);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    public function overallProgressGraph($exam_type)
    {
        $userData = Session::get('user_data');
        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $user_subjects = $this->redis_subjects();
        $api_URL = env('API_URL');
        $curl = curl_init();
        $curl_option = array(
            CURLOPT_URL => $api_URL . 'api/analytics/overall-analytics-score/' . $user_id . '?test_type=' . $exam_type,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->getAccessToken()
            ),
        );
        curl_setopt_array($curl, $curl_option);

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        $mockTestScoreCurr = 0;
        $mockTestScorePre = 0;
        if (isset($response->success) && $response->success === true) {
            $mockTestScoreCurr = $response->test_score[0]->result_percentage ?? 0;
            $mockTestScorePre = $response->test_score[1]->result_percentage ?? 0;
        }
        $responseData['current_score'] = $mockTestScoreCurr;
        $responseData['previous_score'] = $mockTestScorePre;
        return json_encode($responseData);
    }
    public function subjectProgressGraph($subject_id, $exam_type)
    {
        $userData = Session::get('user_data');
        $user_id = $userData->id;
        $api_URL = env('API_URL');
        $curl = curl_init();
        $curl_option = array(
            CURLOPT_URL => $api_URL . 'api/analytics/subject-wise-analytics-score/' . $user_id . '/' . $subject_id . '?test_type=' . $exam_type,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->getAccessToken()
            ),
        );
        curl_setopt_array($curl, $curl_option);

        $response = curl_exec($curl);

        curl_close($curl);
        $subAnalytics = json_decode($response);
        $subScore = isset($subAnalytics->subject_score) ? $subAnalytics->subject_score : [];
        $preSocre = isset($subScore[1]->score) ? $subScore[1]->score : 0;
        $currSocre = isset($subScore[0]->score) ? $subScore[0]->score : 0;
        $responseData['currSocre'] = $currSocre;
        $responseData['preSocre'] = $preSocre;
        return json_encode($responseData);
    }
}
