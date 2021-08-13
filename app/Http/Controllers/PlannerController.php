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
}
