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
     * @return \Illuminate\Http\RedirectResponse
     */

    public function handleFacebookCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();

        if (DB::table('student_users')->where('email', '=', $user->email)->exists()) {

            $userData = DB::table('student_users')->where('email', '=', $user->email)->first();
            if (empty($userData->facebook_id)) {
                DB::table('student_users')->where('email', '=', $user->email)->update(['facebook_id' => $user->id]);
            }
        } else {

            $fixed = '98';
            $number = $fixed . mt_rand(10000000, 99999999);
            $insertData = [
                'user_name' => $user->user['name'],
                'email' => $user->user['email'],
                'mobile' => $number,
                'grade_id' => 1,
                'facebook_id' => $user->id,
            ];
            $lastId = DB::table('student_users')->insertGetId($insertData);
            DB::table('student_preferences')->insertGetId(['student_id' => $lastId]);
            $userData = DB::table('student_users')->where('id', '=', $lastId)->first();
        }

        if (Auth::loginUsingId($userData->id)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }

    }
}
