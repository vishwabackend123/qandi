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

        $user_data = Auth::user();
        $user_id = Auth::user()->id;
        $grade_id = Auth::user()->grade_id;
        $user_subjects = $this->redis_subjects();
        $preferences = $this->redis_Preference();

        $student_stage_at_sgnup = (isset($preferences->student_stage_at_sgnup) && !empty($preferences->student_stage_at_sgnup)) ? $preferences->student_stage_at_sgnup : '';

        $student_rating = (isset($preferences->subjects_rating) && !empty($preferences->subjects_rating)) ? $preferences->subjects_rating : '';

        $prof_asst_test = (isset($preferences->prof_asst_test) && !empty($preferences->prof_asst_test)) ? $preferences->prof_asst_test : '';

        if ($student_stage_at_sgnup == 0) {
            return redirect()->route('studentstandfor');
        }

        $subscription_yn = (isset($preferences->subscription_yn) && !empty($preferences->subscription_yn)) ? $preferences->subscription_yn : '';
        $today_date = Carbon::now();

        $expiry_date = (isset($preferences->subscription_expiry_date) && !empty($preferences->subscription_expiry_date)) ? $preferences->subscription_expiry_date : '';

        $data_difference = $today_date->diffInDays($expiry_date, false);

        if ($data_difference > 0) {
            //not expired
            $suscription_status = 2;
        } elseif ($data_difference < 0) {
            //expired
            $suscription_status = 0;
        } else {
            //expire today
            $suscription_status = 1;
        }

        if ($suscription_status == 0 || $subscription_yn == 'N') {
            return redirect()->route('subscriptions');
        }

        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');
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


        $previous_score_per = $corrent_score_per = $diff_score_per = 0;
        if (isset($scoreData) && !empty($scoreData)) {

            $corrent_score_per = isset($scoreData[0]['result_percentage']) ? $scoreData[0]['result_percentage'] : 0;
            $previous_score_per = isset($scoreData[1]['result_percentage']) ? $scoreData[1]['result_percentage'] : 0;
            $diff_score_per = $corrent_score_per - $previous_score_per;
        } else {
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
        $api_URL = Config::get('constants.API_NEW_URL');

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
        } else {
            $planner = [];
        }

        return view('afterlogin.dashboard', compact('corrent_score_per', 'score', 'inprogress', 'progress', 'others', 'subjectData', 'trendResponse', 'planner', 'student_rating', 'prof_asst_test'));
    }

    public function student_stand(Request $request)
    {
        return view('signup_poststatus');
    }

    public function store_stand_value(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;

        $stand_value = $request->input('user_stand_value');

        if ($stand_value) {


            $request = [
                'student_id' => (int)$user_id,
                'student_stage_at_sgnup' => (int)$stand_value,
            ];
            $request_json = json_encode($request);


            $api_URL = Config::get('constants.API_NEW_URL');
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

                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function dailyWelcomeUpdates(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;

        $storeddata = $request->input('storeddata');


        if (isset($storeddata) && !empty($storeddata)) {
            $rating = $storeddata;

            $request_rating = [
                'student_id' => (int)$user_id,
                'subjects_rating' => json_encode($rating),
            ];

            $request_json = json_encode($request_rating);

            $api_URL = Config::get('constants.API_NEW_URL');
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
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function editProfile(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        $user_name = $request->username;

        $useremailexists = StudentUsers::where('email', $request->useremail)->where('id', '!=', $user_id)->exists();
        $mobileexists = StudentUsers::where('mobile', $request->user_mobile)->where('id', '!=', $user_id)->exists();
        //echo "<pre>"; print_r($mobileexists); die;
        //$exists = StudentUsers::where('email', $request->useremail)->exists();

        $request = [
            "id" => $user_id,
            "first_name" => $request->firstname,
            "last_name" => $request->lastname,
            "user_name" => $request->username,
            "email" => $request->useremail,
            "mobile" => $request->user_mobile,
        ];

        $request_json = json_encode($request);

        $api_URL = Config::get('constants.API_NEW_URL');
        $curl_url = $api_URL . 'api/users';

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
            $response->user_name = $user_name;

            return json_encode($response);
        }
    }

    public function editProfileImage(Request $request)
    {
        $postData = $request->only('file-input');
        $file = $postData['file-input'];

        // Build the input for validation
        $fileArray = array('image' => $file);

        // Tell the validator that this file should be an image
        $rules = array(
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:5120' // max 5120kb
        );

        // Now pass the input and rules into the validator
        $validator = Validator::make($fileArray, $rules);

        // Check to see if validation fails or passes
        if ($validator->fails())
        {
            // Redirect or return json to frontend with a helpful message to inform the user
            // that the provided file was not an adequate type
            return response(['error' => $validator->errors()->getMessages(), 'success' => false]);
        } else
        {
            // Store the File Now
            $user_id = Auth::user()->id;
            $file = $request->file('file-input');
            $file_name = $file->getClientOriginalName();
            if ($request->hasfile('file-input')) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => Config::get('constants.API_NEW_URL') . 'api/update-profile-picture',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('file' => new CURLFILE($file), 'student_id' => $user_id, 'file_extension' => $file_name),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;
            }
        }
    }


    public function saveFcmToken(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        $fcm_token = isset($request->fcm_token) ? $request->fcm_token : '';
        $request = [
            "token" => $fcm_token,
            "user_id" => $user_id,
        ];

        $request_json = json_encode($request);

        $api_URL = Config::get('constants.API_NEW_URL');
        // $curl_url = 'https://api.uniqtoday.com/api/update_student_token';
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
    }

    public function searchFriendWithKeyWord(Request $request)
    {
        $class_id = Auth::user()->grade_id;
        $reqData = $request->all();
        $searchText = $reqData['search_text'];
        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');
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
        return json_decode($response);
    }

    public function clearAllNotifications()
    {
        $user_id = Auth::user()->id;
        $api_URL = Config::get('constants.API_NEW_URL');
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
    }
}
