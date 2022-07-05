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
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;


use Illuminate\Support\Facades\Validator;
use AWS;

/**
 * HomeController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 */
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
            $prof_test_qcount = (isset($preferences->profiling_test_count) && !empty($preferences->profiling_test_count)) ? $preferences->profiling_test_count : 75;
            /*$mx_Grade_id = isset($userData->mx_Grade_id) && !empty($userData->mx_Grade_id) ?$userData->mx_Grade_id:'';
            if (empty($mx_Grade_id)) {
             if ($student_stage_at_sgnup == 0) {
                return redirect()->route('studentstandfor');
             }
            } */
            if ($student_rating == null || empty($student_rating)) {
                return redirect()->route('performance-rating');
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
                $curl_option = array(

                    CURLOPT_URL => $curl_ref_url,
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
            if (Redis::exists('ideal' . $user_id)) {
                $ideal = json_decode(Redis::get('ideal' . $user_id), true);
                $your_place = json_decode(Redis::get('your_place' . $user_id), true);
                $progress_cat = json_decode(Redis::get('progress_cat' . $user_id), true);
            } else {
                $curl = curl_init();
                $api_URL = env('API_URL');
                $curl_prog_url = $api_URL . 'api/studentDashboard/student_progress_journey/' . $user_id;
                $curl_option = array(

                    CURLOPT_URL => $curl_prog_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                );
                curl_setopt_array($curl, $curl_option);

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
                    //Session::put('ideal', $ideal);
                    //Session::put('your_place', $your_place);
                    //Session::put('progress_cat', $progress_cat);
                    Redis::set('ideal' . $user_id, json_encode($ideal));
                    Redis::set('your_place' . $user_id, json_encode($your_place));
                    Redis::set('progress_cat' . $user_id, json_encode($progress_cat));
                }
            }
            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_myq_url = $api_URL . 'api/myqtoday?student_id=' . $user_id . '&exam_id=' . $exam_id;
            $curl_option = array(

                CURLOPT_URL => $curl_myq_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
            );
            curl_setopt_array($curl, $curl_option);

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

            // myq matrix
            $myq_matrix = $this->getMyqmatrix($user_id, $exam_id);




            return view('afterlogin.dashboard', compact('corrent_score_per', 'score', 'inprogress', 'progress', 'others', 'subjectData', 'trendResponse', 'planner', 'student_rating', 'prof_asst_test', 'ideal', 'your_place', 'progress_cat', 'trial_expired_yn', 'date_difference', 'subjectPlanner_miss', 'planner_subject', 'user_subjects', 'myq_matrix', 'prof_test_qcount'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Student_stand
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function studentStand(Request $request)
    {
        return view('signup_poststatus');
    }
    /**
     * Store_stand_value
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function storeStandValue(Request $request)
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
                        ->back()->withErrors(['api issue']);;
                }
            } else {
                return redirect()
                    ->back()->withErrors(['empty value']);;
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * DailyWelcomeUpdates
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
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
                        "accept: application/json",
                        "content-type: application/json"
                    ),
                );
                curl_setopt_array($curl, $curl_option);
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
     * Edit Profile
     *
     * @param Request $request recieve the body request data
     *
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
                    "accept: application/json",
                    "content-type: application/json"
                ),
            );
            curl_setopt_array($curl, $curl_option);
            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if ($useremailexists == 1) {
                $response['success'] = false;
                $response['error'] = "";
                $response['message'] = "email id or mobile number already exist";
                return json_encode($response);
            } elseif ($mobileexists == 1) {
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
    /**
     * Edit Profile Image
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
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
                return response(json_encode(['error' => $validator->errors()->getMessages(), 'success' => false]));
            } else {
                // Store the File Now
                $userData = Session::get('user_data');

                $user_id = $userData->id;
                $exam_id = $userData->grade_id;
                $file = $request->file('file-input');
                $file_name = $file->getClientOriginalName();
                if ($request->hasfile('file-input')) {
                    $curl = curl_init();
                    $curl_option = array(
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
                    );
                    curl_setopt_array($curl, $curl_option);

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
    /**
     * Save Fcm Token
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
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
                    "accept: application/json",
                    "content-type: application/json"
                ),
            );
            curl_setopt_array($curl, $curl_option);
            $response_json = curl_exec($curl);

            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            return response()->json('Success');
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Search Friend With KeyWord
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
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
            $curl_option = array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            );
            curl_setopt_array($curl, $curl_option);

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
    /**
     * Clear All Notifications
     *
     * @return void
     */
    public function clearAllNotifications()
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;

            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/clear-notifications/' . $user_id;
            $curl = curl_init();
            $curl_option = array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
            );
            curl_setopt_array($curl, $curl_option);

            $response = curl_exec($curl);

            curl_close($curl);
            return Redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Refresh Notification
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function refreshNotification(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;

            $api_URL = env('API_URL');

            $curl = curl_init();
            $curl_url = $api_URL . 'api/notification-history/' . $user_id;
            $curl_option = array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            );
            curl_setopt_array($curl, $curl_option);

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
     * Daily task
     *
     * @return void
     */
    public function dailytask()
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;

            $exam_id = $userData->grade_id;
            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_check_task_url = $api_URL . 'api/check-task-center-history/' . $user_id;
            $curl_option = array(

                CURLOPT_URL => $curl_check_task_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            );
            curl_setopt_array($curl, $curl_option);

            $response_task_json = curl_exec($curl);
            $response_task = json_decode($response_task_json, true);
            $data_task = [];
            if (isset($response_task['success']) && !empty($response_task['success'])) {
                $data_task = $response_task['allowed_details'];
                $collection = collect($data_task);
                $dailyTask = $collection->where('task_type', 'daily')->sortBy('category')->values()->all();
                $weekTask = $collection->where('task_type', 'weekly')->sortBy('category')->values()->all();
            }

            return view('afterlogin.dashboard_dailytask', compact('dailyTask', 'weekTask'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * MyQMatrix
     *
     * @return void
     */
    public function myQMatrix($quadrant_name)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_myq_matrix_url = $api_URL . 'api/myqmatrix-topics-quadrant-wise-breakup/' . $user_id . '/' . $exam_id;
            $curl_option = array(

                CURLOPT_URL => $curl_myq_matrix_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            );
            curl_setopt_array($curl, $curl_option);

            $response_myq_topic_json = curl_exec($curl);
            $response_myq_topic = json_decode($response_myq_topic_json, true);
            $myq_matrix_topic = [];
            if (isset($response_myq_topic['success']) && !empty($response_myq_topic['success'])) {
                $myq_matrix_topic = $response_myq_topic['data'];
                if (isset($myq_matrix_topic['Q1']) && empty($myq_matrix_topic['Q1']) && isset($myq_matrix_topic['Q2']) && empty($myq_matrix_topic['Q2']) && isset($myq_matrix_topic['Q3']) && empty($myq_matrix_topic['Q3']) && isset($myq_matrix_topic['Q4']) && empty($myq_matrix_topic['Q4'])) {
                    $myq_matrix_topic = [];
                }
            }
            $myq_bool = true;
            if ($myq_matrix_topic) {
                $myq_bool = false;
            }
            $myq_matrix = $this->getMyqmatrix($user_id, $exam_id);

            return view('afterlogin.dashboard_myqmatrix', compact('myq_matrix', 'myq_matrix_topic', 'myq_bool', 'quadrant_name'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * GetMyqmatrix
     *
     * @param mixed $user_id user id
     * @param mixed $exam_id exam id
     *
     * @return void
     */
    public function getMyqmatrix($user_id, $exam_id)
    {
        try {
            $curl = curl_init();
            $api_URL = env('API_URL');
            $curl_myq_matrix_url = $api_URL . 'api/myqmatrix-dashboard-values/' . $user_id . '/' . $exam_id;
            $curl_option = array(

                CURLOPT_URL => $curl_myq_matrix_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            );
            curl_setopt_array($curl, $curl_option);

            $response_myq_matrix_json = curl_exec($curl);
            $response_myq_matrix = json_decode($response_myq_matrix_json, true);
            $myq_matrix = [];
            if ($response_myq_matrix['success']) {
                $myq_matrix = $response_myq_matrix['data'];
            }
            return $myq_matrix;
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Gettins selected series details and start exam function
     *
     * @param mixed   $category       category
     * @param mixed   $tasktype       task type
     * @param mixed   $skill_category skill category
     * @param Request $request        recieve the body request data
     *
     * @return void
     */
    public function dailyTaskExam($category, $tasktype, $skill_category = "", Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $filtered_subject = [];

            if (Redis::exists('custom_answer_time_' . $user_id)) {
                Redis::del(Redis::keys('custom_answer_time_' . $user_id));
            }

            if (!empty($category)) {
                if ($category == 'skill') {
                    $category_url = 'skill_' . $skill_category;
                    $test_type = 'Task-Center-' . ucwords($skill_category);
                } elseif ($category == 'weak_topic') {
                    $category_url = 'weak_topic';
                    $test_type = 'Task-Center-Weak-Topic';
                } else {
                    $category_url = $category;
                    $test_type = 'Task-Center-' . ucwords($category);
                }


                $curl_url = "";
                $curl = curl_init();
                $api_URL = env('API_URL');

                $curl_url = $api_URL . 'api/create-test/' . $exam_id . '/' . $category_url . '/' . $user_id;
                $curl_option =  array(

                    CURLOPT_URL => $curl_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",

                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/json"
                    ),
                );
                curl_setopt_array($curl, $curl_option);

                $response_json = curl_exec($curl);

                // $response_json = str_replace('NaN', '""', $response_json);
                // $response_json = stripslashes(html_entity_decode($response_json));

                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
                $response_data = (object)json_decode($response_json, true);

                $status = isset($response_data->success) ? $response_data->success : false;

                if ($status == true) {
                    $responsedata = $response_data->data;

                    $aQuestions_list = isset($responsedata['questions']) ? $responsedata['questions'] : [];

                    $exam_fulltime = isset($responsedata['time_allowed']) ? $responsedata['time_allowed'] : 0;
                    $questions_count = isset($responsedata['total_questions']) ? $responsedata['total_questions'] : 0;
                    $total_marks = isset($responsedata['total_marks']) ? $responsedata['total_marks'] : 0;
                    $exam_name = isset($responsedata['exam_type_name']) ? $responsedata['exam_type_name'] : "";
                } else {
                    $aQuestions_list = [];
                    $test_available = isset($response_data->test_available) ? $response_data->test_available : true;
                    if ($test_available == false) {
                        return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
                    } else {
                        return redirect()->route('dashboard');
                    }
                }


                if (!empty($aQuestions_list)) {
                    $redis_set = 'True';

                    $collection = collect($aQuestions_list)->sortBy('subject_id');
                    $subject_ids = $collection->pluck('subject_id');
                    $subject_list = $subject_ids->unique()->values()->all();

                    $redis_subjects = $this->redis_subjects();
                    $cSubjects = collect($redis_subjects);
                    $aTargets = [];
                    $filtered_subject = $cSubjects->whereIn('id', $subject_list)->all();
                    foreach ($filtered_subject as $sub) {
                        $count_arr = $collection->where('subject_id', $sub->id)->all();
                        $sub->count = count($count_arr);
                        $aTargets[] = $sub->subject_name;
                    }



                    $allQuestions = $collection->keyBy('question_id');
                    $aQuestions_list =  $allQuestions->all();

                    $allQuestionDetails = $this->allCustomQlist($user_id, $allQuestions->all(), $redis_set);
                    $keys = $allQuestions->keys('question_id')->all();

                    $question_data = (object)current($allQuestions->all());
                    $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
                    $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
                    $nextquestion_data = (object)next($aQuestions_list);

                    $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
                    $prev_qid = '';



                    if (isset($question_data) && !empty($question_data)) {
                        //$publicPath = url('/') . '/public/images/questions/';
                        // $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
                        // $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
                        // $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
                        $qs_id = $question_data->question_id;
                        //$option_ques = str_replace("'", '"', $question_data->question_options);
                        $option_ques = $question_data->question_options;

                        $tempdata = json_decode($option_ques, true);
                        $opArr = [];
                        if (isset($tempdata) && is_array($tempdata)) {
                            foreach ($tempdata as $key => $option) {
                                // $option = str_replace('/public/images/questions/', $publicPath, $option);
                                $opArr[$key] = $option;
                            }
                        }
                        //$optionArray = $this->shuffle_assoc($opArr);
                        $optionArray = $opArr;
                        $option_data = $optionArray;
                    } else {
                        $option_data[] = '';
                    }

                    /* set redis for save exam question response */
                    $retrive_array = $retrive_time_array = $retrive_time_sec = $answer_swap_cnt = [];
                    $redis_data = [
                        'given_ans' => $retrive_array,
                        'taken_time' => $retrive_time_array,
                        'taken_time_sec' => $retrive_time_sec,
                        'answer_swap_cnt' => $answer_swap_cnt,
                        'questions_count' => $questions_count,
                        'all_questions_id' => $keys,
                        'full_time' => $exam_fulltime
                    ];
                    // Push Value in Redis
                    Redis::set('custom_answer_time_' . $user_id, json_encode($redis_data));
                    $tagrets = implode(', ', $aTargets);

                    $exam_type = 'PT';
                    $exam_mode = "Practice";
                    //Session::put('exam_name', $exam_name);
                    Redis::set('exam_name' . $user_id, $exam_name);


                    return view('afterlogin.DailyTaskExam.exam', compact('question_data', 'tagrets', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'filtered_subject', 'activesub_id', 'exam_name', 'test_type', 'exam_type', 'exam_mode', 'category', 'tasktype', 'total_marks'));
                } else {
                    return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
                }
            } else {
                return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
            }
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }
    public function performanceRating()
    {
        $user_subjects = $this->redis_subjects();
        $preferences = $this->redis_Preference();
        $student_rating = (isset($preferences->subjects_rating) && !empty($preferences->subjects_rating)) ? $preferences->subjects_rating : '';
        if ($student_rating != null || !empty($student_rating)) {
            return redirect()->route('dashboard');
        }
        return view('afterlogin.performance_rating', compact('user_subjects'));
    }
}
