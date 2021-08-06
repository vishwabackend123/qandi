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
//dd($overallAnalytics);
        curl_close($curl);
        $overallAnalytics = json_decode($overallAnalytics);

        $dailyReport = json_decode($overallAnalytics->daily_report);
        $weeklyReport = json_decode($overallAnalytics->weekly_report);
        $monthlyReport = json_decode($overallAnalytics->monthlyReport);

        $date1 = [];
        $correctTime1 = [];
        $incorrectTime1 = [];
        foreach ($dailyReport as $val) {
            array_push($date1, date('d-m', strtotime($val->date)));
            array_push($correctTime1, 23);
            array_push($incorrectTime1, 10);
        }
        $date1 = json_encode($date1);
        $correctTime1 = json_encode($correctTime1);
        $incorrectTime1 = json_encode($incorrectTime1);

        $date2 = [];
        $correctTime2 = [];
        $incorrectTime2 = [];
        foreach ($weeklyReport as $val) {
            array_push($date2, date('d-m', strtotime($val->date)));
            array_push($correctTime2, 23);
            array_push($incorrectTime2, 10);
        }
        $date2 = json_encode($date2);
        $correctTime2 = json_encode($correctTime2);
        $incorrectTime2 = json_encode($incorrectTime2);

        $date3 = [];
        $correctTime3 = [];
        $incorrectTime3 = [];
        foreach ($monthlyReport as $val) {
            array_push($date3, date('d-m', strtotime($val->date)));
            array_push($correctTime3, 23);
            array_push($incorrectTime3, 10);
        }
        $date3 = json_encode($date3);
        $correctTime3 = json_encode($correctTime3);
        $incorrectTime3 = json_encode($incorrectTime3);

        return view('afterlogin.Analytics.overall_analytics', compact('date1','correctTime1','incorrectTime1','date2','correctTime2','incorrectTime2','date3','correctTime3','incorrectTime3', 'corrent_score_per', 'score', 'inprogress', 'progress', 'others', 'subjectData', 'user_subjects'));
    }

    public function export_analytics(Request $request)
    {

        return view('afterlogin.Analytics.export_analytics');
    }
}
