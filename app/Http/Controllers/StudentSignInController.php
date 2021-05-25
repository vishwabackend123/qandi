<?php

namespace App\Http\Controllers;

use App\Models\StudentUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
        $mobile = isset($postData['mobile']) ? $postData['mobile'] : '';
        $exists = StudentUsers::where('mobile', $mobile)->exists();

        if (isset($mobile) && !empty($mobile) && $exists == true) {
            $request = [
                'mobile' => $mobile
            ];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                /* CURLOPT_URL => 'http://44.235.5.77/api/authotp', */
                CURLOPT_URL => "http://44.235.5.77:8080/MobileOtp/" . $mobile,
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

            if ($httpcode != 200) {
                $response = [
                    "message" => "Mobile no. is invalid or not registered with us!",
                    "error" => $err,
                    "success" => false,
                ];
                return json_encode($response);
            } else {
                $aResponse = json_decode($response_json);
                $login_otp = $aResponse->mobile_otp;

                Session::put('OTP', $login_otp);

                return $response_json;
            }
        } else {

            $response = [
                "message" => "Mobile no. is invalid or not registered with us!",
                "success" => false,
            ];
            return json_encode($response);
        }
    }


    public function verifyotplogin(Request $request)
    {
        $data = $request->all();

        $enteredOtp = $request->input('login_otp');
        $enteredMobile = $request->input('login_mobile');

        $OTP = $request->session()->get('OTP');
        //dd($enteredOtp);
        if ($OTP == $enteredOtp) {
            //Removing Session variable
            Session::forget('OTP');

            $user = StudentUsers::where('mobile', $enteredMobile)->first();

            Session::put('user_data', $user);
            if (Auth::loginUsingId($user->id)) {

                $response['status'] = 200;
                $response['message'] = "Your Logged in.";
                $response['redirect_url'] = url('home');

                return json_encode($response);
            } else {
                $response['status'] = 400;
                $response['error'] = "Authentication failed please try again.";
                return json_encode($response);
            }
        } else {
            $response['status'] = 400;
            $response['error'] = "OTP does not match.";
            return json_encode($response);
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
        $exists = StudentUsers::where('mobile', $mobile)->exists();

        $reg_otp = 12345; /* only for testing */
        Session::put('OTP', $reg_otp);/* only for testing */

        if (isset($mobile) && !empty($mobile) && $exists == false) {

            $curl = curl_init();
            curl_setopt_array($curl, array(
                /* CURLOPT_URL => 'http://44.235.5.77/api/authotp', */
                CURLOPT_URL => "http://44.235.5.77:8080/MobileOtp/" . $mobile,
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

            if ($httpcode != 200) {
                $response = [
                    "message" => "Something wrong please try again !!",
                    "error" => $err,
                    "success" => false,
                ];
                return json_encode($response);
            } else {
                $aResponse = json_decode($response_json);
                $reg_otp = $aResponse->mobile_otp;

                Session::put('OTP', $reg_otp);

                return $response_json;
            }
        } else {

            $response = [
                "message" => "Mobile no. already registered with us!",
                "success" => false,
            ];
            return json_encode($response);
        }
    }



    public function verifyOtpRegister(Request $request)
    {
        $data = $request->all();

        $reg_otp = $request->input('reg_otp');
        $email_add = $request->input('email_add');
        $mobile_num = $request->input('mobile_num');
        $user_name = $request->input('user_name');

        $OTP = $request->session()->get('OTP');

        if ($OTP == $reg_otp) {
            //Removing Session variable
            //Session::forget('OTP');
            $response['status'] = 200;
            $response['message'] = "Registration successful";

            $insert = [
                'first_name' => $user_name,
                'last_name' => '',
                'email' => $email_add,
                'mobile' => $mobile_num,
                'grade_id' => 1,
            ];

            $create = StudentUsers::create($insert);

            return json_encode($response);
        } else {
            $response['status'] = 400;
            $response['error'] = "OTP does not match.";
            return json_encode($response);
        }
    }
}
