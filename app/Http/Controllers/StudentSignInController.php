<?php

namespace App\Http\Controllers;

use App\Models\StudentUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


use Illuminate\Support\Facades\Validator;

class StudentSignInController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function sendotplogin(Request $request)
    {
        $postData = $request->all();
        $email_or_mobile = isset($postData['mobile']) ? (string)$postData['mobile'] : '';

        /*  $exists = StudentUsers::where('mobile', $mobile)->exists();
        if (isset($mobile) && !empty($mobile) && $exists == true) { */

        $request = [
            'mobile' => $email_or_mobile
        ];

        $api_URL = Config::get('constants.API_NEW_URL');
        $curl_url = $api_URL . 'api/Otp/' . $email_or_mobile;

        $curl = curl_init();
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
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $aResponse = json_decode($response_json);

        if ($aResponse->success != 'true') {
            $response = [
                "message" => "Email or Mobile no. not registered with us!",
                "error" => $err,
                "success" => false,
            ];
            return json_encode($response);
        } else {

            $login_otp = $aResponse->otp;

            Session::put('OTP', $login_otp);

            return $response_json;
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function verifyotplogin(Request $request)
    {
        $data = $request->all();

        $enteredOtp = (int)$request->input('login_otp');
        $enteredMobile = (string)$request->input('login_mobile');

        $request = [
            'email_or_mobile' => $enteredMobile,
            'otp' => $enteredOtp
        ];

        $request_json = json_encode($request);

        $api_URL = Config::get('constants.API_NEW_URL');
        $curl_url = $api_URL . 'api/studentlogin';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request_json,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response_json = curl_exec($curl);

        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $aResponse = json_decode($response_json);
        $success = isset($aResponse->success) ? $aResponse->success : false;

        if ($success == false) {
            $response = [
                "message" => "User mobile number or otp not matched !!",
                "error" => $err,
                "success" => false,
                "status" => 400,
            ];
            return json_encode($response);
        } else {
            $aResponse = json_decode($response_json);

            $user_data = isset($aResponse->result[0]) ? $aResponse->result[0] : [];


            Session::put('user_data', $user_data);
            if (Auth::loginUsingId($user_data->id)) {

                $response['status'] = 200;

                return json_encode($response);
            } else {
                $response['status'] = 400;
                $response['error'] = "Authentication failed please try again.";
                return json_encode($response);
            }
        }
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function sendotpsignup(Request $request)
    {
        $postData = $request->all();


        $mobile = isset($postData['mobile']) ? $postData['mobile'] : '';
        $emailid = isset($postData['email']) ? $postData['email'] : '';

        $request = [
            'email' => $emailid,
            'mobile' => (int)$mobile,
        ];
        $request_json = json_encode($request);

        $api_URL = Config::get('constants.API_NEW_URL');
        $curl_url = $api_URL . 'api/register-otp';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request_json,
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
            $aResponse = json_decode($response_json);

            $reg_otp = isset($aResponse->mobile_otp) ? $aResponse->mobile_otp : '';

            Session::put('OTP', $reg_otp);

            return $response_json;
        } else {
            $response = [
                "message" => "email or mobile already exist!!",
                "error" => $err,
                "success" => false,
                "status" => 400,
            ];
            return json_encode($response);

            //return $response_json;
        }
    }



    public function verifyOtpRegister(Request $request)
    {
        $data = $request->all();

        $reg_otp = $request->input('reg_otp');
        $email_add = $request->input('email_add');
        $mobile_num = $request->input('mobile_num');
        $user_name = $request->input('user_name');


        $request = [
            'user_name' => $user_name,
            'email' => $email_add,
            'mobile' => (int)$mobile_num,
        ];


        $request_json = json_encode($request);


        $api_URL = Config::get('constants.API_NEW_URL');
        $curl_url = $api_URL . 'api/student-signup';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request_json,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));


        $response_json = curl_exec($curl);


        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $aResponse = json_decode($response_json);
        $success = isset($aResponse->success) ? $aResponse->success : false;

        if ($success == false) {
            $response = [

                "error" => $err,
                "success" => false,
                "status" => 400,
            ];
            return json_encode($response);
        } else {

            $succ_msg = isset($aResponse->message) ? $aResponse->message : '';
            $student_id = isset($aResponse->studentID) ? $aResponse->studentID : [];


            if (Auth::loginUsingId($student_id)) {
                $response['status'] = 200;
                $response['message'] = "Registration successful";
                $response['redirect_url'] = url('dashboard');

                return json_encode($response);
            } else {
                $response['status'] = 400;
                $response['error'] = "Authentication failed please try again.";
                return json_encode($response);
            }
        }
    }
}
