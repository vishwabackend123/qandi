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

class PreparationController extends Controller
{
    //
    use CommonTrait;

    public function preparation_center(Request $request)
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;
        $subject_list = $this->redis_subjects();

        $api_url = Config::get('constants.API_NEW_URL') . 'api/subjectResources/chapterWiseSummary/' . $exam_id . '/' . $user_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
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

        if ($httpcode == 200 || $httpcode == 201) {
            $preparation_data = json_decode($response_json);

            $preparation_list = $preparation_data->response;
        } else {
            $preparation_list = [];
        }


        $aPreparation = [];
        if (!empty($preparation_list)) {
            foreach ($preparation_list as $list) {
                $aPreparation[$list->subject_id] = $list->values;
            }
        }

        return view('afterlogin.Preparation.preparation_center', compact('subject_list', 'aPreparation'));
    }


    public function download_exampaper(Request $request)
    {
        $exam_id = Auth::user()->grade_id;
        $data = $request->all();
        $responsePdf = '';
        if (isset($data) && !empty($data)) :
            $api_url = 'http://3.108.176.99:8080/api/previous-year-question-paper/download/' . $data['exam_year'] . '/' . $exam_id . '/' . $data['subject_id'];
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api_url,
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
            $responseData = json_decode($response);
            foreach ($responseData->response as $value) {
                $responsePdf = $value->paper_file_name;
            }
            $imgUrl = str_replace(' ', '+', 'https://pre-year-paper.s3.ap-south-1.amazonaws.com/' . $responsePdf);
            return $imgUrl;
        endif;

        $subject_list = $this->redis_subjects();
        return view('afterlogin.Preparation.exam_papers', compact('subject_list'));
    }


    public function preparation_center_subject(Request $request)
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $subject_id = $request->subject_id;
        $preType = $request->preType;

        $api_url_pre = 'api/subjectResources/subject-wise-resources';

        $api_url = Config::get('constants.API_NEW_URL') . $api_url_pre . '/' . $user_id . '/' . $exam_id . '/' . $subject_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
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
        $status = isset($aResponse->success) ? json_decode($aResponse->success) : false;
        $values = (object)array();

        $values->subject_id = isset($aResponse->subject_id) ? $aResponse->subject_id : '';
        $values->subject_name = isset($aResponse->subject_name) ? $aResponse->subject_name : '';

        $values->total_notes = isset($aResponse->total_notes) ? $aResponse->total_notes : '';
        $values->total_videos = isset($aResponse->total_videos) ? $aResponse->total_videos : '';
        $values->total_bookmarks = isset($aResponse->total_bookmarks) ? $aResponse->total_bookmarks : '';
        $values->total_presentations = isset($aResponse->total_presentations) ? $aResponse->total_presentations : '';

        $preparation_list = [];

        if ($preType == 'presentation') {
            $preparation_list = isset($aResponse->presentation) ? $aResponse->presentation : '';
        } elseif ($preType == 'videos') {
            $preparation_list = isset($aResponse->videos) ? $aResponse->videos : '';
        } elseif ($preType == 'notes') {
            $preparation_list = isset($aResponse->notes) ? $aResponse->notes : '';
        } elseif ($preType == 'bookmark') {
            $preparation_list = isset($aResponse->bookmark_questions) ? $aResponse->bookmark_questions : '';
        }
        return view('afterlogin.Preparation.subject_ajax_prepration_data', compact('preType', 'values', 'preparation_list'));
    }

    public function presentations_chapter(Request $request)
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $chapter_id = $request->chapter_id;
        $values = isset($request->values) ? json_decode($request->values) : [];

        $api_url = Config::get('constants.API_NEW_URL') . 'api/subjectResources/presentations/' . $chapter_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
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
        $status = isset($aResponse->success) ? $aResponse->success : false;

        if ($status == true) {
            $preparation_data = json_decode($response_json);

            $preparation_list = $preparation_data->Presentations;
        } else {
            $preparation_list = [];
        }

        return view('afterlogin.Preparation.preparation_center_ajax', compact('values', 'preparation_list'));
    }

    public function videos_chapter(Request $request)
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $chapter_id = $request->chapter_id;
        $values = isset($request->values) ? json_decode($request->values) : [];

        $api_url = Config::get('constants.API_NEW_URL') . 'api/subjectResources/videos/' . $chapter_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
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
        $status = isset($aResponse->success) ? $aResponse->success : false;

        if ($status == true) {
            $preparation_data = json_decode($response_json);

            $preparation_list = $preparation_data->Videos;
        } else {
            $preparation_list = [];
        }


        return view('afterlogin.Preparation.video_ajax', compact('values', 'preparation_list'));
    }


    public function notes_chapter(Request $request)
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $chapter_id = $request->chapter_id;
        $values = isset($request->values) ? json_decode($request->values) : [];

        $api_url = Config::get('constants.API_NEW_URL') . 'api/subjectResources/notes/' . $chapter_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
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
        $status = isset($aResponse->success) ? $aResponse->success : false;

        if ($status == true) {
            $preparation_data = json_decode($response_json);

            $preparation_list = $preparation_data->Notes;
        } else {
            $preparation_list = [];
        }

        return view('afterlogin.Preparation.notes_ajax', compact('values', 'preparation_list'));
    }

    public function bookmarks_chapter(Request $request)
    {

        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $chapter_id = $request->chapter_id;
        $values = isset($request->values) ? json_decode($request->values) : [];

        $api_url = Config::get('constants.API_NEW_URL') . 'api/subjectResources/bookmarks/' . $user_id . '/' . $exam_id . '/' . $chapter_id;;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
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


        $preparation_list = $aResponse->bookmark_questions;


        return view('afterlogin.Preparation.bookmarks_ajax', compact('values', 'preparation_list'));
    }
}
