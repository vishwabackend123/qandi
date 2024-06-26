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
 * BookmarkController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 */
class BookmarkController extends Controller
{
    use CommonTrait;

    /**
     * Addbookmark
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function addbookmark(Request $request)
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $subject_id = isset($request->subject_id) ? $request->subject_id : 0;
            $question_id = isset($request->question_id) ? $request->question_id : 0;
            $chapter_id = isset($request->chapter_id) ? $request->chapter_id : 0;

            $inputjson['subject_id'] = (int)$subject_id;
            $inputjson['student_id'] = (int)$user_id; //30776; //(string);
            $inputjson['exam_id'] = (int)$exam_id;
            $inputjson['question_id'] = (int)$question_id;
            $inputjson['chapter_id'] = (int)$chapter_id;

            $request = json_encode($inputjson);
            $api_URL = env('API_URL');


            $curl_url = $api_URL . 'api/bookmark-questions';
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
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            );
            $curl = curl_init();
            curl_setopt_array($curl, $curl_option);

            $response_json = curl_exec($curl);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode == 200 || $httpcode == 201) {
                return $response_json;
            } else {
                return $err;
            }
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }
}
