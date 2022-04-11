<?php

namespace App\Http\Controllers;

use App\Models\StudentUsers;

use CURLFile;
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
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;
use AWS;

class HomeController extends Controller
{
    //
    use CommonTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $user_subjects = $this->redis_subjects();

            $uSubjects = [];
            $subCollection = collect($user_subjects);
            $uSubjects = $subCollection->pluck('id')->toArray();

            $preferences = $this->redis_Preference();

            $student_stage_at_sgnup = (isset($preferences->student_stage_at_sgnup) && !empty($preferences->student_stage_at_sgnup)) ? $preferences->student_stage_at_sgnup : '';

            $student_rating = (isset($preferences->subjects_rating) && !empty($preferences->subjects_rating)) ? $preferences->subjects_rating : '';

            $prof_asst_test = (isset($preferences->prof_asst_test) && !empty($preferences->prof_asst_test)) ? $preferences->prof_asst_test : '';

            if ($student_stage_at_sgnup == 0) {
                return redirect()->route('studentstandfor');
            }

            $subscription_yn = (isset($preferences->subscription_yn) && !empty($preferences->subscription_yn)) ? $preferences->subscription_yn : '';
            $trial_expired_yn = (isset($preferences->trial_expired_yn) && !empty($preferences->trial_expired_yn)) ? $preferences->trial_expired_yn : '';
            $today_date = Carbon::now();

            $expiry_date = (isset($preferences->subscription_expiry_date) && !empty($preferences->subscription_expiry_date)) ? $preferences->subscription_expiry_date : '';

            $date_difference = $today_date->diffInDays($expiry_date, false);


            if ($date_difference > 0) {
                //not expired
                $suscription_status = 2;
            } elseif ($date_difference < 0) {
                //expired
                $suscription_status = 0;
            } else {
                //expire today
                $suscription_status = 1;
            }

            if (($suscription_status == 0 && $subscription_yn == 'N') || empty($expiry_date)) {

                return redirect()->route('subscriptions');
            }

            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/studentDashboard/analytics/' . $user_id;

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

            $score_json = curl_exec($curl);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode == 200 || $httpcode == 201) {
                $scoreResponse = json_decode($score_json, true);
                $response_json = str_replace('NaN', '""', $scoreResponse);

                $scoreResponse = json_decode($response_json, true);

                $scoreData = isset($scoreResponse['test_score']) ? ($scoreResponse['test_score']) : '';
                $subjectData = isset($scoreResponse['subject_proficiency']) ? $scoreResponse['subject_proficiency'] : '';
                $trendResponse = isset($scoreResponse['marks_trend']) ? ($scoreResponse['marks_trend']) : '';
            } else {
                $scoreData = [];
                $subjectData = [];
                $trendResponse = [];
            }


            if (empty($subjectData)) {
                foreach ($user_subjects as $key => $sub) {
                    $sub->total_questions = 0;
                    $sub->correct_ans = 0;
                    $sub->score = 0;

                    $subjectData[$key] = (array)$sub;
                }
            }




            $curl = curl_init();
            $api_URL = env('API_URL');

            $curl_url = $api_URL . 'api/student-planner-current-week/' . $user_id;

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
            $response = json_decode($response_json);
            $response_status = isset($response->success) ? $response->success : false;

            if ($response_status != false) {
                $planner_list = isset($response->result) ? $response->result : [];
                $cPlanner = collect($planner_list);
                $sorted_list = $cPlanner->sortBy('test_completed_yn', SORT_NATURAL);
                $planner = $sorted_list->values()->all();
                $plucked = $cPlanner->pluck('subject_id');
                $planner_subject = $plucked->all();
            } else {
                $planner = $planner_subject = [];
            }
            if (!Session::has('referal_code')) {
                $curl = curl_init();
                $api_URL = env('API_URL');
                $curl_ref_url = $api_URL . 'api/get-refer-link/' . $user_id;

                curl_setopt_array($curl, array(

                    CURLOPT_URL => $curl_ref_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                ));

                $response_json = curl_exec($curl);
                $ref_response = json_decode($response_json, true);
                $refer_code = isset($ref_response['referral_code']) && !empty($ref_response['referral_code']) ? $ref_response['referral_code'] : "";
                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
                Session::put('referal_link', env('APP_URL') . 'referral/' . $refer_code);
                Session::put('referal_code', $refer_code);
            }
            //progress journey
            $ideal = [];
            $your_place = [];
            $progress_cat = [];
            if (Session::has('ideal')) {
                $ideal = Session::get('ideal');
                $your_place = Session::get('your_place');
                $progress_cat = Session::get('progress_cat');
            } else {
                $curl = curl_init();
                $api_URL = env('API_URL');
                $curl_prog_url = $api_URL . 'api/studentDashboard/student_progress_journey/' . $user_id;
                curl_setopt_array($curl, array(

                    CURLOPT_URL => $curl_prog_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                ));

                $response_preg_json = curl_exec($curl);
                $response_prog = json_decode($response_preg_json, true);
                if (isset($response_prog['response']['student_progress']) && !empty($response_prog['response']['student_progress'])) {
                    $i = 1;
                    foreach ($response_prog['response']['student_progress'] as $progData) {
                        array_push($ideal, $progData['week_index']);
                        array_push($your_place, $progData['chapter_count']);
                        $week = "W" . $i;
                        array_push($progress_cat, $week);
                        $i++;
                    }
                    Session::put('ideal', $ideal);
                    Session::put('your_place', $your_place);
                    Session::put('progress_cat', $progress_cat);
                }
            }
            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_myq_url = $api_URL . 'api/myqtoday?student_id=' . $user_id . '&exam_id=' . $exam_id;
            curl_setopt_array($curl, array(

                CURLOPT_URL => $curl_myq_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
            ));

            $response_myq_json = curl_exec($curl);
            $response_myq = json_decode($response_myq_json, true);
            $corrent_score_per = isset($response_myq['MyQToday Score']) && !empty($response_myq['MyQToday Score']) ? $response_myq['MyQToday Score'] : 0;
            $corrent_score_per = (int) $corrent_score_per;
            $score = isset($corrent_score_per) ? $corrent_score_per : 0;
            $progress =  0;
            $inprogress = 0;
            $others = 100 - ($score);

            if (empty(array_diff($planner_subject, $uSubjects))) {
                $subjectPlanner_miss = true;
            } else {
                $subjectPlanner_miss = false;
            }


            return view('afterlogin.dashboard', compact('corrent_score_per', 'score', 'inprogress', 'progress', 'others', 'subjectData', 'trendResponse', 'planner', 'student_rating', 'prof_asst_test', 'ideal', 'your_place', 'progress_cat', 'trial_expired_yn', 'date_difference', 'subjectPlanner_miss', 'planner_subject', 'user_subjects'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function student_stand(Request $request)
    {
        return view('signup_poststatus');
    }

    public function store_stand_value(Request $request)
    {
        try {
            $data = $request->all();
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $stand_value = $request->input('user_stand_value');

            if ($stand_value) {

                $request = ['student_id' => (int)$user_id, 'student_stage_at_sgnup' => (int)$stand_value,];
                $request_json = json_encode($request);

                $api_URL = env('API_URL');
                $curl_url = $api_URL . 'api/stage-at-signUp';

                $curl = curl_init();
                curl_setopt_array($curl, array(
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
                ));
                $response_json = curl_exec($curl);

                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                if ($httpcode != 200 && $httpcode != 201) {
                    $status = false;
                } else {

                    $aResponse = json_decode($response_json);
                    $status = isset($aResponse->success) ? $aResponse->success : '';
                }
                if ($status == true) {
                    return redirect()->route('dashboard');
                } else {

                    return redirect()
                        ->back();
                }
            } else {
                return redirect()
                    ->back();
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function dailyWelcomeUpdates(Request $request)
    {
        try {
            $data = $request->all();
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;

            $storeddata = $request->input('storeddata');

            if (isset($storeddata) && !empty($storeddata)) {
                $rating = $storeddata;

                $request_rating = ['student_id' => (int)$user_id, 'subjects_rating' => json_encode($rating),];

                $request_json = json_encode($request_rating);

                $api_URL = env('API_URL');
                $curl_url = $api_URL . 'api/subject-rating';

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
                        "accept: application/json",
                        "content-type: application/json"
                    ),
                ));
                $response_json = curl_exec($curl);

                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
            }

            return "success";
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function editProfile(Request $request)
    {
        try {
            $data = $request->all();
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $user_name = $request->username;

            $useremailexists = StudentUsers::where('email', $request->useremail)
                ->where('id', '!=', $user_id)->exists();
            $mobileexists = StudentUsers::where('mobile', $request->user_mobile)
                ->where('id', '!=', $user_id)->exists();
            //echo "<pre>"; print_r($mobileexists); die;
            //$exists = StudentUsers::where('email', $request->useremail)->exists();
            $request = ["id" => $user_id, "first_name" => $request->firstname, "last_name" => $request->lastname, "user_name" => $request->username, "email" => $request->useremail, "mobile" => $request->user_mobile, "city" => $request->city, "state" => $request->state, "country" => $request->country];

            $request_json = json_encode($request);
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/update-users';

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
                    "accept: application/json",
                    "content-type: application/json"
                ),
            ));
            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if ($useremailexists == 1) {
                $response['success'] = false;
                $response['error'] = "";
                $response['message'] = "email id or mobile number already exist";
                return json_encode($response);
            } else if ($mobileexists == 1) {
                $response['success'] = false;
                $response['error'] = "";
                $response['message'] = "email id or mobile number already exist";
                return json_encode($response);
            }
            if ($httpcode != 200 && $httpcode != 201) {
                $response['success'] = false;
                $response['error'] = "";
                return json_encode($response);
            } else {
                $response = json_decode($response_json);

                $sessionData = Session::get('user_data');
                $sessionData->first_name = $response->user_info->first_name;
                $sessionData->user_name = $response->user_info->user_name;
                $sessionData->last_name = $response->user_info->last_name;
                $sessionData->email = $response->user_info->email;
                $sessionData->mobile = $response->user_info->mobile;
                $sessionData->city = $response->user_info->city;
                $sessionData->state = $response->user_info->state;
                $sessionData->country = $response->user_info->country;

                Session::put('user_data', $sessionData);

                return json_encode($response);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function editProfileImage(Request $request)
    {
        try {

            $postData = $request->only('file-input');
            $file = $postData['file-input'];

            // Build the input for validation
            $fileArray = array(
                'image' => $file
            );

            // Tell the validator that this file should be an image
            $rules = array(
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:5120'
                // max 5120kb

            );

            // Now pass the input and rules into the validator
            $validator = Validator::make($fileArray, $rules);

            // Check to see if validation fails or passes
            if ($validator->fails()) {
                // Redirect or return json to frontend with a helpful message to inform the user
                // that the provided file was not an adequate type
                return response(json_encode(['error' => $validator->errors()
                    ->getMessages(), 'success' => false]));
            } else {
                // Store the File Now
                $userData = Session::get('user_data');

                $user_id = $userData->id;
                $exam_id = $userData->grade_id;
                $file = $request->file('file-input');
                $file_name = $file->getClientOriginalName();
                if ($request->hasfile('file-input')) {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => env('API_URL') . 'api/update-profile-picture',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'file' => new CURLFILE($file),
                            'student_id' => $user_id,
                            'file_extension' => $file_name
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $aResponse = json_decode($response);

                    if (isset($aResponse->success) && $aResponse->success == true) {

                        $sessionData = Session::get('user_data');
                        $sessionData->user_profile_img = $aResponse->filename;
                        Session::put('user_data', $sessionData);
                        echo $response;
                    } else {

                        echo $response;
                    }
                }
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function saveFcmToken(Request $request)
    {
        try {

            $data = $request->all();
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $fcm_token = isset($request->fcm_token) ? $request->fcm_token : '';
            $request = ["token" => $fcm_token, "user_id" => $user_id,];

            $request_json = json_encode($request);

            $api_URL = env('API_URL');

            $curl_url = $api_URL . 'api/update_student_token';

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
                    "accept: application/json",
                    "content-type: application/json"
                ),
            ));
            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            return response()->json('Success');
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function searchFriendWithKeyWord(Request $request)
    {
        try {

            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $class_id = $userData->grade_id;
            $reqData = $request->all();
            $searchText = $reqData['search_text'];

            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/search-friend/' . $class_id . '/' . $searchText;
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
            $aResponse = json_decode($response);

            $status = isset($aResponse->success) ? $aResponse->success : false;

            if ($status != false) {

                $resp_list = isset($aResponse->response) ? $aResponse->response : [];
                $collection = collect($resp_list);

                $sorted = $collection->sortBy(function ($value, $key) {

                    return $value->user_rank;
                });
                $search_list = $sorted->values();

                $response_rtn = [];
                $response_rtn['success'] = $status;
                $response_rtn['response'] = $search_list;
            } else {
                $resp_list = [];
                $response_rtn = [];
            }
            return json_encode($response_rtn);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function clearAllNotifications()
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/clear-notifications/' . $user_id;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return Redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function refreshNotification(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;

            $api_URL = env('API_URL');

            $curl = curl_init();
            $curl_url = $api_URL . 'api/notification-history/' . $user_id;
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
            $aResponse = json_decode($response);
            if (isset($aResponse->success) && $aResponse->success == true) {
                $notifications = $aResponse->response;
            } else {
                $notifications = [];
            }

            return view('afterlogin.ajax_notification', compact('notifications'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     *
     */
    public function dailytask()
    {
        return view('afterlogin.dashboard_dailytask');
    }

    public function myQMatrix()
    {
        return view('afterlogin.dashboard_myqmatrix');
    }
}
