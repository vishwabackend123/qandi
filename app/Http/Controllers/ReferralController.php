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

class ReferralController extends Controller
{
    //
    use CommonTrait;

    public function store_referral_friend(Request $request)
    {

        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $referrals = (isset($request->refer_emails) && !empty($request->refer_emails)) ? $request->refer_emails : '';

        $inputjson = [
            "student_id" => $user_id,
            "exam_id" => $exam_id,
            "email" => $referrals,
        ];
        $request = json_encode($inputjson);

        $api_URL = env('API_URL');
        $curl_url = $api_URL . 'api/insert-referr-student';

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
            return json_encode(array('success' => false, 'message' => 'Email already referred'));
        }
    }

    public function referral_signup($referral_code)
    {
        $api_URL = env('API_URL');
        $curl_url = $api_URL . 'api/get-referr-student/' . $referral_code;
        $curl = curl_init();

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

        $response = curl_exec($curl);

        curl_close($curl);
        $refDecode =  json_decode($response);
        $referral_email = isset($refDecode[0]->referral_email) ? $refDecode[0]->referral_email : '';
        if (isset($referral_email) && !empty($referral_email)) {
            return view('auth.register', compact('referral_email'));
        } else {
            return abort(404);
        }
    }
}
