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


class BookmarkController extends Controller
{
    //
    /**
     * method for call api and store question as bookmark
     *  */

    public function addbookmark(Request $request)
    {

        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;
        $subject_id = isset($request->subject_id) ? $request->subject_id : 0;
        $question_id = isset($request->question_id) ? $request->question_id : 0;

        $inputjson['subject_id'] = (int)$subject_id;
        $inputjson['student_id'] = (int)$user_id; //30776; //(string);
        $inputjson['exam_id'] = (int)$exam_id;
        $inputjson['question_id'] = (int)$question_id;

        $request = json_encode($inputjson);



        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/bookmark-questions';

        $curl = curl_init();
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
