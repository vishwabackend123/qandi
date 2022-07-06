<?php

namespace App\Http\Controllers;

use App\Models\StudentUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

/**
 * StudentSignInController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 * */
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
     * Index
     *
     * @return void
     */
    public function index()
    {
        //return view('home');
    }

    /**
     * Send otp login
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function sendotplogin(Request $request)
    {
        try {
            $postData = $request->all();
            $email_or_mobile = isset($postData['mobile']) ? (string)$postData['mobile'] : '';

            /*  $exists = StudentUsers::where('mobile', $mobile)->exists();
             if (isset($mobile) && !empty($mobile) && $exists == true) { */

            $request = ['mobile' => $email_or_mobile];

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/Otp/' . $email_or_mobile;

            $curl = curl_init();
            $curl_option = array(

                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $aResponse = json_decode($response_json);

            if ($aResponse->success != true) {
                $msg = $aResponse->message;
                $response = ["message" => $msg, "error" => $err, "success" => false,];
                return json_encode($response);
            } else {
                $msg = $aResponse->message;
                $login_otp = $aResponse->otp;
                Session::put('OTP', $login_otp);

                $timestamp = $_SERVER["REQUEST_TIME"];
                Session::put('OTP_time', $timestamp);

                if (env('STUDENT_ENV') == 'prod') {
                    $response = ["message" => "otp sent successfully on registered number", "success" => true,];
                    return json_encode($response);
                } else {
                    return $response_json;
                }
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Verify otp login
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function verifyotplogin(Request $request)
    {
        try {
            $data = $request->all();

            $enteredOtp = (int)$request->input('login_otp');
            $enteredMobile = (string)$request->input('login_mobile');

            $session_otp = Session::get('OTP');

            $timestamp = $_SERVER["REQUEST_TIME"];
            $session_otp_time = Session::get('OTP_time');

            if (($timestamp - $session_otp_time) < 180) {
                $request = ['email_or_mobile' => $enteredMobile, 'otp' => $enteredOtp];

                $request_json = json_encode($request);

                $api_URL = env('API_URL');
                $curl_url = $api_URL . 'api/studentlogin';

                $curl = curl_init();
                $curl_option = array(
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
                );
                curl_setopt_array($curl, $curl_option);

                $response_json = curl_exec($curl);

                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
                $aResponse = json_decode($response_json);
                $success = isset($aResponse->success) ? $aResponse->success : false;

                if ($success == false) {
                    $response = ["message" => "You have entered a wrong OTP. Please try again", "error" => $err, "success" => false, "status" => 400,];
                    return json_encode($response);
                } else {
                    $aResponse = json_decode($response_json);
                    $user_data = isset($aResponse->result[0]) ? $aResponse->result[0] : [];

                    if (Auth::loginUsingId($user_data->id)) {
                        $user_Data = Auth::user();
                        Session::put('user_data', $user_Data);

                        $response['status'] = 200;

                        return json_encode($response);
                    } else {
                        $response['status'] = 400;
                        $response['error'] = "Authentication failed please try again.";
                        return json_encode($response);
                    }
                }
            } else {
                $response = ["message" => "OTP expired. Please. try again.", "error" => "OTP expired. Please. try again.", "success" => false, "status" => 400,];
                return json_encode($response);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Send otp signup
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function sendotpsignup(Request $request)
    {
        try {
            $postData = $request->all();

            $mobile = isset($postData['mobile']) ? $postData['mobile'] : '';
            $emailid = isset($postData['email']) ? $postData['email'] : '';

            $request = ['email' => $emailid, 'mobile' => (int)$mobile,];
            $request_json = json_encode($request);

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/register-otp';

            $curl = curl_init();
            $curl_option = array(
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
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode == 200 || $httpcode == 201) {
                $aResponse = json_decode($response_json);

                $reg_otp = isset($aResponse->mobile_otp) ? $aResponse->mobile_otp : '';

                Session::put('OTP', $reg_otp);
                $timestamp = $_SERVER["REQUEST_TIME"];
                Session::put('OTP_time', $timestamp);

                if (env('STUDENT_ENV') == 'prod') {
                    $response = ["message" => "otp sent successfully on registered number", "success" => true,];
                    return json_encode($response);
                } else {
                    return $response_json;
                }
            } else {
                $response = ["message" => "email or mobile already exist!!", "error" => $err, "success" => false, "status" => 400,];
                return json_encode($response);

                //return $response_json;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Verify Otp Register
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function verifyOtpRegister(Request $request)
    {
        try {
            $data = $request->all();


            $reg_otp = $request->input('reg_otp');
            $email_add = $request->input('email_add');
            $mobile_num = $request->input('mobile_num');
            $user_name = $request->input('user_name');
            $location = $request->input('location');
            $exam_id = $request->input('exam_id');
            $stage_at_signup = $request->input('stage_at_signup');

            $reg_otp_value = (int)implode('', $reg_otp);

            /*   if (Session::has('OTP')) {
                $session_otp = Session::get('OTP');
            } else {
                $session_otp = null;
            }
            $timestamp = $_SERVER["REQUEST_TIME"];
            $session_otp_time = Session::get('OTP_time'); */

            /*  if (($timestamp - $session_otp_time) < 600) {
                if ($session_otp == $reg_otp_value) {
                    $request->session()
                        ->forget('OTP'); */
            $request = [
                'user_name' => $user_name,
                'email' => $email_add,
                'mobile' => (int)$mobile_num,
                'grade_id' => (int)$exam_id,
                'city' => $location,
                'otp' => (int)$reg_otp_value,
                'stage_at_signup' => (int)$stage_at_signup
            ];

            $request_json = json_encode($request);

            $api_URL = env('API_URL');
            /*    $curl_url = $api_URL . 'api/student-signup'; */
            $curl_url = $api_URL . 'api/signup';

            $curl = curl_init();
            $curl_option = array(
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
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);
            //dd($response_json);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);

            $success = isset($aResponse->success) ? $aResponse->success : false;

            if ($success == false) {
                $errmsg = isset($aResponse->message) ? $aResponse->message : "Something wrong please try again.";

                $response = [

                    "error" => $err, "msg" => $errmsg, "success" => false, "status" => 400,
                ];

                return json_encode($response);
            } else {
                $succ_msg = isset($aResponse->message) ? $aResponse->message : '';
                $student_id = isset($aResponse->student_id) ? $aResponse->student_id : '';
                // $updateStudentStage = $this->updateStudentStage($stage_at_signup, $student_id);
                if (Auth::loginUsingId($student_id)) {
                    $response['status'] = 200;
                    $response['student_id'] = $student_id;
                    $response['user_name'] = ucwords($user_name);
                    $response['mobile'] = $mobile_num;
                    $response['message'] = $succ_msg;
                    //  $response['redirect_url'] = url('dashboard');
                    $user_Data = Auth::user();
                    Session::put('user_data', $user_Data);

                    return json_encode($response);
                } else {
                    $response['status'] = 400;
                    $response['error'] = "Authentication failed please try again.";
                    $response['msg'] = "Authentication failed please try again.";
                    return json_encode($response);
                }
            }
            /* } else {
                    $response['status'] = 400;
                    $response['error'] = "Invalid OTP entered.";
                    return json_encode($response);
                } */
            /* } else {
                $response['status'] = 400;
                $response['error'] = "OTP expired. Please. try again.";
                return json_encode($response);
            } */
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Country List
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function countryList(Request $request)
    {
        try {
            $data = $request->all();

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/get-country';

            $curl = curl_init();
            $curl_option = array(

                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);
            $success = isset($aResponse->success) ? $aResponse->success : false;
            $country_list = isset($aResponse->response) ? $aResponse->response : false;

            if ($success == false) {
                $response = ["error" => $err, "success" => false, "status" => 400,];
                return json_encode($response);
            } else {
                return json_encode($country_list);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * State List
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function stateList(Request $request)
    {
        try {
            $data = $request->all();
            $country = isset($data['country']) ? $data['country'] : '';
            $search = isset($data['search_text']) ? $data['search_text'] : '';

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/get-state/' . $country;

            $curl = curl_init();
            $curl_option = array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);

            $success = isset($aResponse->success) ? $aResponse->success : false;
            $state_list = isset($aResponse->response) ? $aResponse->response : false;

            /* if (!empty($search)) {
            $state_list = $this->Search($search, $state_list);
            } */

            sort($state_list);
            $sOption = '';
            if ($success == false) {
                $response = ["error" => $err, "success" => false,];
                return json_encode($response);
            } else {
                $sOption .= '<div class="countryscroll"><input type="input" name="search" id="myInputState" onkeyup="searchState()" /><ul id="myStateList">';

                foreach ($state_list as $keyaState => $oState) {
                    $sOption .= '<li onClick="selectState(`' . $oState . '`)">' . $oState . '</li>';
                }
                //return json_encode($country_list);
                $sOption .= '</ul></div>';
                $response = ["success" => true, "response" => $sOption,];
                return json_encode($response);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * City List
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function cityList(Request $request)
    {
        try {
            $data = $request->all();
            $state = isset($data['state']) ? $data['state'] : '';
            $search = isset($data['search_text']) ? $data['search_text'] : '';

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/get-cities/' . $state;

            $curl_url = str_replace(" ", '%20', $curl_url);

            $curl = curl_init();
            $curl_option = array(

                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);
            $success = isset($aResponse->success) ? $aResponse->success : false;
            $city_list = isset($aResponse->response) ? $aResponse->response : false;

            sort($city_list);
            $sOption = '';
            if ($success == false) {
                $response = ["error" => $err, "success" => false,];
                return json_encode($response);
            } else {
                Redis::set('city_list', json_encode($city_list));
                $sOption .= '<div class="countryscroll"><input type="input" name="search" id="myInput" onkeyup="searchCity()" autocomplete="off" autofocus/><ul id="myMenu">';

                foreach ($city_list as $kCity => $oCity) {
                    $sOption .= '<li onClick="selectCity(`' . $oCity . '`)">' . $oCity . '</li>';
                }
                //return json_encode($country_list);
                $sOption .= '</ul></div>';
                $response = ["success" => true, "response" => $sOption,];
                return json_encode($response);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Search
     *
     * @param mixed $search search data
     * @param mixed $array  filter array
     *
     * @return void
     */
    public function search($search, $array)
    {
        try {
            $search = strtolower($search);
            $r_array = [];
            foreach ($array as $aVal) {
                $val = strtolower($aVal);

                /* if (strstr($val, $value)) {
                array_push($r_array, $aVal);
                } */
                if (strpos($val, $search) !== false) {
                    array_push($r_array, $aVal);
                }
            }
            return $r_array;
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Signup Address
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function signupAddress(Request $request)
    {
        try {
            $data = $request->all();
            $lead_exam_id = '';
            $trail_sub = '';
            $mx_Grade_id = '';
            if (isset($data['exam_id']) && !empty(isset($data['exam_id']))) {
                $lead_exam_id = $data['exam_id'];
            }
            if (isset($data['trail']) && !empty(isset($data['trail']))) {
                $trail_sub = $data['trail'];
            }
            if (isset($data['mx_Grade_id']) && !empty(isset($data['mx_Grade_id']))) {
                $mx_Grade_id = $data['mx_Grade_id'];
            }
            $student_id = $request->input('student_id');
            $city = $request->input('city');
            $state = $request->input('state');
            $country = $request->input('country');
            $state = isset($state) && !empty($state) ? $state : "";

            $request = ['id' => $student_id, "city" => $city, "state" => $state, "country" => $country,];

            $request_json = json_encode($request);

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/update-address';

            $curl = curl_init();
            $curl_option = array(
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
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);
            $success = isset($aResponse->success) ? $aResponse->success : false;
            if (isset($data['refer_code']) && !empty(isset($data['refer_code']))) {
                $exam_id = 1;
                $inputjson = ["student_id" => $student_id, "exam_id" => $exam_id, "email" => $data['refer_email'], "student_refer_by" => $data['refer_code'],];
                $request = json_encode($inputjson);

                $api_URL = env('API_URL');
                $curl_url = $api_URL . 'api/insert-referr-student';

                $curl = curl_init();
                $curl_option = array(
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
                );
                curl_setopt_array($curl, $curl_option);

                $response_json = curl_exec($curl);
                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
                if ($httpcode == 400 || $httpcode == 422) {
                    return json_encode(array('success' => false, 'message' => $httpcode));
                }
            }
            if ($success == false) {
                return json_encode($aResponse);
            } else {
                $sessionData = Session::get('user_data');
                $sessionData->city = $city;
                $sessionData->state = $state;
                $sessionData->lead_exam_id = $lead_exam_id;
                $sessionData->trail_sub = $trail_sub;
                $sessionData->mx_Grade_id = $mx_Grade_id;
                Session::put('user_data', $sessionData);
                $aResponse->redirect_url = url('dashboard');
                return json_encode($aResponse);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Search City
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function searchCity(Request $request)
    {
        try {
            $data = $request->all();
            $search = isset($data['search_text']) ? $data['search_text'] : '';
            $city_list = json_decode(Redis::get('city_list'), true);
            if ($search) {
                $result = array_filter($city_list, function ($item) use ($search) {
                    if (stripos($item, $search) !== false) {
                        return true;
                    }
                    return false;
                });
                $result = $this->customeSort($result, $search);
            } else {
                $result = $city_list;
                sort($result);
            }

            $sOption = '';
            foreach ($result as $kCity => $oCity) {
                $sOption .= '<li onClick="selectCity(`' . $oCity . '`)">' . $oCity . '</li>';
            }
            $response = ["success" => true, "response" => $sOption,];
            return json_encode($response);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Custome Sort
     *
     * @param mixed $arrayData array data for sort
     * @param mixed $search    search value
     *
     * @return void
     */
    public function customeSort($arrayData, $search)
    {
        $match_array = array();
        $not_match = array();
        foreach ($arrayData as $key => $value) {
            $char_len = strlen($search);
            if (strtolower(substr($value, 0, $char_len)) === strtolower($search)) {
                $match_array[] = $value;
            } else {
                $not_match[] = $value;
            }
        }
        return array_merge($match_array, $not_match);
    }


    /**
     * sent OTP on given mobile
     *
     * @param mixed $arrayData array data for sort
     * @param mixed $search    search value
     *
     * @return void
     */
    public function sentMobileOtp($mobile, Request $request)
    {
        try {

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/mobile-otp/' . $mobile;

            $curl = curl_init();
            $curl_option = array(

                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);
            $success = isset($aResponse->success) ? $aResponse->success : false;

            if ($success == true) {
                $aResponse = json_decode($response_json);
                $reg_otp = isset($aResponse->otp) ? $aResponse->otp : '';

                Session::put('OTP', $reg_otp);
                $timestamp = $_SERVER["REQUEST_TIME"];
                Session::put('OTP_time', $timestamp);

                if (env('STUDENT_ENV') == 'prod') {
                    $response = ["message" => "Otp sent successfully on mobile number", "success" => true,];
                    return json_encode($response);
                } else {
                    return $response_json;
                }
            } else {
                $response = ["message" => "Mobile number already exist!!", "error" => $err, "success" => false, "status" => 400,];
                return json_encode($response);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }





    /**
     * Updated City List
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function newCityList(Request $request)
    {
        try {
            $data = $request->all();
            $state = isset($data['state']) ? $data['state'] : '';
            $search = isset($data['search_text']) ? $data['search_text'] : 'ab';

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/get-address?searchString=' . $search;

            $curl_url = str_replace(" ", '%20', $curl_url);

            $curl = curl_init();
            $curl_option = array(

                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            );
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);

            $success = isset($aResponse->success) ? $aResponse->success : false;
            $city_list = isset($aResponse->response) ? $aResponse->response : false;

            sort($city_list);
            $sOption = [];
            if ($success == false) {
                $response = ["error" => $err, "success" => false,];
                return json_encode($response);
            } else {
                Redis::set('city_list', json_encode($city_list));
                foreach ($city_list as $kCity => $oCity) {
                    $arr["id"] = $oCity;
                    $arr["text"] = $oCity;
                    array_push($sOption, $arr);
                }
                $response = ["success" => true, "response" => $sOption];

                return json_encode($response);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }




    /***
     *  */
    public function updateStudentStage($stage, $student_id)
    {
        try {
            $request = ['student_id' => (int)$student_id, 'student_stage_at_sgnup' => (int)$stage];
            $request_json = json_encode($request);

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/stage-at-signUp';
            $curl = curl_init();
            $curl_option = array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => $request_json,
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "content-type: application/json"
                ),
            );
            curl_setopt_array($curl, $curl_option);
            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $aResponse = json_decode($response_json);
            $status = isset($aResponse->success) ? $aResponse->success : '';

            return  $status;
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
