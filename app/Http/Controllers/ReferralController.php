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
use Illuminate\Support\Facades\Log;

/**
 * ReferralController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 */
class ReferralController extends Controller
{
    use CommonTrait;
    /**
     * Store Referral Friend
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function storeReferralFriend(Request $request)
    {
        try {
            $userData = Session::get('user_data');
            $user_id = $userData->id;
            $user_mail = $userData->email;
            $exam_id = $userData->grade_id;
            $referrals = (isset($request->refer_emails) && !empty($request->refer_emails)) ? $request->refer_emails : '';
            $referrals_code = (isset($request->refer_code) && !empty($request->refer_code)) ? $request->refer_code : '';

            $refer_mails = explode(',', preg_replace('/\s+/', '', $referrals));
            if (in_array($user_mail, $refer_mails)) {
                if (count($refer_mails) > 1) {
                    return json_encode(array('success' => false, 'message' => 'You cannot refer to yourself. Please remove yourself email id.'));
                } else {
                    return json_encode(array('success' => false, 'message' => 'You cannot refer to yourself.'));
                }
            }
            if (count($refer_mails) > 1) {
                $result = max(array_count_values($refer_mails));

                if ($result > 1) {
                    return json_encode(array('success' => false, 'message' => 'Please remove duplicate email.'));
                }
            }

            $inputjson = [
                "student_id" => $user_id,
                "exam_id" => $exam_id,
                "email" => $referrals,
                "student_refer_by" => $referrals_code,
            ];
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

            if ($httpcode == 200 || $httpcode == 201) {
                return $response_json;
            } else {
                return json_encode(array('success' => false, 'message' => 'Email already referred.'));
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Referral signup
     *
     * @param mixed $referral_code refer code
     *
     * @return void
     */
    public function referralSignup($referral_code)
    {
        try {
            $api_URL = env('API_URL');
            $curl_url = $api_URL . 'api/get-referr-student/' . $referral_code;
            $curl = curl_init();
            $curl_option =array(
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
            $refDecode =  json_decode($response);
            $referral_email = isset($refDecode[0]->email) ? $refDecode[0]->email : '';
            if (isset($referral_email) && !empty($referral_email)) {
                return view('auth.register', compact('referral_email', 'referral_code'));
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
