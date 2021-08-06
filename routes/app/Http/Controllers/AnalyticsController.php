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

        return view('afterlogin.Analytics.overall_analytics', compact('corrent_score_per', 'score', 'inprogress', 'progress', 'others', 'subjectData', 'user_subjects'));
    }

    public function export_analytics(Request $request)
    {

        return view('afterlogin.Analytics.export_analytics');
    }
}
