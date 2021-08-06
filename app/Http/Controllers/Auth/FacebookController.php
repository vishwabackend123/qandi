<?php

namespace App\Http\Controllers\Auth;

use App\FacebookUser;
use App\Http\Controllers\Controller;
use App\Models\StudentUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
class FacebookController extends Controller
{
    use CommonTrait;

    /**
     * Create a new controller instance.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     * @return int
     */
    public function studentRewards($user_id)
    {
        $id = DB::table('user_analytics')->insertGetId(
            [
                'user_id' => $user_id,
                'login_date' => now(),
                'time_start' => now(),
                'traffic_source' => 'Web',
                'pages_visted' => json_encode([$user_id]),
            ]
        );
        return $id;
    }

    public function handleFacebookCallback(Request $request)
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('facebook_id', $user->id)->first();

            $user_role = "Student";
            if ($finduser) {

                Auth::login($finduser);
                $new_sessid = \Session::getId(); //get new session_id after user sign in
                \DB::table('student_users')->where('id', $user->id)->update(['session_id' => $new_sessid]);
                $name = ucwords($finduser->first_name) . ' ' . ucwords($finduser->middle_name) . ' ' . ucwords($finduser->last_name);

                $analyticsid = $this->studentRewards($finduser->id);
                Session::put('analyticsid', $analyticsid);
                Session::put('user_data', ['user_id' => $finduser->id, 'user_name' => $name, 'user_email' => $finduser->email, 'role' => $user_role, 'session_id' => $new_sessid, 'analyticsid' => $analyticsid]);

                $token = $this->getJWTToken($finduser->id);

            DB::table('student_users')->where('id', $finduser->id)->update(['jwt_token'=>$token]);
                if (isset($data['code']) && !empty($data['code'])) {
                    $oRedeem = new RedeemController;
                    return $oRedeem->access_redeem($request);
                }
                $studentpreferenceData = DB::table('student_preferences')->where('student_id', $finduser->id)->first();

                return redirect('auth/social_account');

            } else {
                $mobile =rand();
                if (isset($_COOKIE["mobValue"])):
                    $mobile .=  $_COOKIE["mobValue"];
                else:
                    echo "Cookie Not Set";
                endif;
                $newUser = User::create([
                    'first_name' => $user->name,
                    'email' => $user->email ?? 'demo@gmail.com',
                    'mobile' => $mobile,
                    'facebook_id' => $user->id
                ]);

                Auth::login($newUser);
                $new_sessid = \Session::getId(); //get new session_id after user sign in
                \DB::table('student_users')->where('id', $user->id)->update(['session_id' => $new_sessid]);
                $name = ucwords($newUser->first_name) . ' ' . ucwords($newUser->middle_name) . ' ' . ucwords($newUser->last_name);

                DB::table('student_preferences')->insert([
                    'student_id' => $newUser->id,
                ]);

                $token = $this->getJWTToken($newUser->id);

                $analyticsid = $this->studentRewards($newUser->id);
                Session::put('analyticsid', $analyticsid);
                Session::put('user_data', ['user_id' => $newUser->id, 'user_name' => $name, 'user_email' => $newUser->email, 'role' => $user_role, 'session_id' => $new_sessid, 'analyticsid' => $analyticsid]);

                if (isset($data['code']) && !empty($data['code'])) {
                    $oRedeem = new RedeemController;
                    return $oRedeem->access_redeem($request);
                }
                $studentpreferenceData = DB::table('student_preferences')->where('student_id', $newUser->id)->first();
                return redirect('auth/social_account');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function userInfo(Request $request)
    {
        $user_data = $request->session()->get('user_data');
        $user_id = $user_data['user_id'];
        $user_name = $user_data['user_name'];
        $analyticsid = isset($user_data['analyticsid']) ? $user_data['analyticsid'] : '';
        $r_book_data = array();
        $r_subject_data = array();
        $r_chapter_count = array();
        $purchase_book = '';
        $suggested_book = '';
        $all_qbank = '';
        $subscribed_data = '';
        $user_info = DB::table('student_users as user')
            ->leftjoin('student_preferences as spp', 'spp.student_id', '=', 'user.id')
            ->where('id', '=', $user_id)->first();

        $sch_result_data = DB::table('scholarship_result as sr')
            ->select('sr.result_announced_date')
            ->where('sr.student_id', '=', $user_id)
            ->orderBy('sr.id', 'desc')
            ->first();

        $user_info->result_announced_date = isset($sch_result_data->result_announced_date) ? $sch_result_data->result_announced_date : date('Y-m-d');

        $name = ucwords($user_info->first_name) . ' ' . ucwords($user_info->middle_name) . ' ' . ucwords($user_info->last_name);
        $user_info_details = DB::table('student_users as user')->select(
            'sp.*', 'user.id', 'user.first_name', 'user.last_name', 'user.middle_name',
            'user.address', 'user.zipcode', 'user.country', 'st.name as state',
            'ct.name as city_name', 'user.city as u_city', 'user.state as ustate',
            'user.institution_id', 'ins.institution_name', 'user.user_profile_img',
            'country.country_name as country_name', 'user.gender', 'user.grade_id',
            'user.stream_code', 'exam.class_exam_cd', 'exam.id as exam_id', 's.subscription_yn', 's.subscription_expiry_date')
            ->leftjoin('state as st', 'st.id', '=', 'user.state')
            ->leftjoin('student_preferences as s', 'user.id', '=', 's.student_id')
            ->leftjoin('city as ct', 'ct.id', '=', 'user.city')
            ->leftjoin('class_exams as exam', 'exam.id', '=', 'user.grade_id')
            ->leftjoin('country', 'user.country', '=', 'country.id')
            ->leftjoin('country as ins_con', 'user.country', '=', 'ins_con.ID')
            ->leftjoin('institution as ins', 'ins.id', '=', 'user.institution_id')
            ->leftjoin('student_parents as sp', 'sp.id', '=', 'user.parent_id')
            ->where('user.id', '=', $user_id)->first();
        $uState = $user_info_details->ustate;
        Session::put('user_data', ['user_id' => $user_info->id, 'user_name' => $name, 'user_email' => $user_info->email, 'role' => 'Student', 'analyticsid' => $analyticsid]);

        $redeem_data = DB::table('user_redemptions')
            ->select('book_id', 'subject_id', 'redemption_date')
            ->where('user_id', '=', $user_id)
            ->get()->toArray();

        $all_qbank = DB::table('subjects as sub')
            ->select('sub.id as subject_id', 'sub.subject_name', 'sub.subject_thumbnail_image_path', 'bk.id as book_id', 'bk.book_title', 'bk.book_cover_image_path')
            ->leftjoin('books as bk', 'bk.subject_id', '=', 'sub.id')
            ->get();

        $from = date('Y-m-d', strtotime("-1 days"));
        $to = date('Y-m-d');
        $notification_count = 0;
        $country = $this->getCountry();
        $exam = DB::table('class_exams')->select('class_exam_cd', 'id')->get();
        $state = $this->getState(1);
        $Institution = $this->getAllInstitution();
        $userdata = StudentUsers::where('id', $user_id)->first();
        $parent_id = isset($userdata->parent_id) ? $userdata->parent_id : '';
        $parentData = DB::table('student_parents')->where('id', $parent_id)->first();


        $citylist = DB::table('city')->where('state_id', $uState)->get();


        return view('userView.social_account', compact('exam', 'Institution', 'country', 'state', 'user_data', 'user_info', 'user_info_details', 'redeem_data', 'r_book_data', 'r_subject_data', 'purchase_book', 'suggested_book', 'all_qbank', 'subscribed_data', 'notification_count', 'parentData', 'citylist'));

    }
}
