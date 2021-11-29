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
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

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

        $aPreparation = $preparation_list;
        //        if (!empty($preparation_list)) {
        //            foreach ($preparation_list as $list) {
        //                $values = $list->values;
        //                $aPreparation[$list->subject_id][] = $values[0];
        //            }
        //        }
        return view('afterlogin.Preparation.preparation_center', compact('subject_list', 'aPreparation'));
    }


    public function download_exampaper(Request $request)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
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
            $status = isset($responseData->success) ? $responseData->success : false;

            $return_response = [];
            if ($status == true) {
                foreach ($responseData->response as $value) {
                    $responsePdf = $value->paper_file_name;
                }
                $imgUrl = str_replace(' ', '+', 'https://pre-year-paper.s3.ap-south-1.amazonaws.com/' . $responsePdf);

                $return_response['status'] = 'success';
                $return_response['message'] = "Result found successfully";
                $return_response['imgUrl'] = $imgUrl;

                return json_encode($return_response);
            } else {
                $return_response['status'] = 'failed';
                $return_response['message'] = "No file found to download.";
                return json_encode($return_response);
            }
        endif;

        $subject_list = $this->redis_subjects();
        return view('afterlogin.Preparation.exam_papers', compact('subject_list'));
    }


    public function preparation_center_subject(Request $request)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
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
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

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
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

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
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

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
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

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



    public function getReviewBookmarks()
    {

        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        //$cacheKey = 'exam_review:' . $user_id;
        /*if (Redis::exists($cacheKey)) {
            Redis::del(Redis::keys($cacheKey));
        }*/

        // if (!empty($result_id)) {
        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/bookmark-questions/' . $user_id . '/' . $exam_id;
        curl_setopt_array($curl, array(
            //CURLOPT_URL => config('constants.API_php_URL_local') . "get_review/" . $result_id, //local
            CURLOPT_URL =>  $curl_url, //live
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",

            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",

            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if (isset($response) && !empty($response)) :
            $response = json_decode($response);
        endif;
        // }


        $result_response = $response ?? [];
        //echo "<pre>"; print_r($result_response); die;

        $question_data = [];
        $attempt_opt = [];

        if (isset($result_response->response) && !empty($result_response->response)) {

            $collection = collect($result_response->response);
            $aQuestionslist = $collection->sortBy('subject_id');
            $grouped = $collection->groupBy('subject_id');
            $subject_ids = $collection->pluck('subt_id');
            $subject_list = $subject_ids->unique()->values()->all();


            $redis_subjects = $this->redis_subjects();
            $cSubjects = collect($redis_subjects);

            $filtered_subject = $cSubjects->whereIn('id', $subject_list)->all();
            $all_data = collect($result_response->response);
            // $all_ids = $result_response->question_ids;
            $all_question_list = $aQuestionslist->all();

            $collection = collect($all_question_list);

            $allQuestions = $aQuestionslist->keyBy('question_id');
            $keys = $allQuestions->keys('question_id')->all();

            $first = $result_response->response[0]->question_id;

            $key = array_search($first, array_column($result_response->response, 'question_id'));
            $qNo = $key + 1;
            $nextKey = $key + 1;
            $nextKey = $nextKey % count($result_response->response);
            if ($key > 0) { // Key would become 0
                $prevKey = $key - 1;
            } else {
                $prevKey = $key;
            }

            $word1 = "/public/images/questions/";
            $word2 = "public/images/questions/";



            $question_data = $all_data->where('question_id', $first)->first();
            $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
            $activesub_id = isset($question_data->subt_id) ? $question_data->subt_id : '';
            $activeChapt_id = isset($question_data->chapter_id) ? $question_data->chapter_id : '';
            $chapter_list = $this->redis_chapter_list($activesub_id);
            $collection_chpater = collect($chapter_list);
            $filter = $collection_chpater->where('chapter_id', $activeChapt_id)->first();
            $chapter_name = isset($filter->chapter_name) ? $filter->chapter_name : '';

            $question_data->chapter_name = $chapter_name;


            $nextquestion_data = next($all_question_list);
            $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
            $prev_qid = '';


            $q_id = $question_data->question_id;
            $question = $question_data->question;
            $reference_text = $question_data->reference_text;
            $explanation = $question_data->explanation;
            $correct_answer = $question_data->answers;
            $attempt_opt = isset($question_data->option_id) ? (array)json_decode($question_data->option_id) : [];

            $question_id_array[] = $q_id;
            //$publicPath = url('/') . '/public/images/questions/';
            $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
            if ((strpos($question, $word1) !== false)) {
                $question_data->question = str_replace($word1, $publicPath, $question_data->question);
            } elseif ((strpos($question, $word2) !== false)) {
                $question_data->question = str_replace($word2, $publicPath, $question_data->question);
            }
            if ((strpos($reference_text, $word1) !== false)) {
                $question_data->reference_text = str_replace($word1, $publicPath, $question_data->reference_text);
            } elseif ((strpos($reference_text, $word2) !== false)) {
                $question_data->reference_text = str_replace($word2, $publicPath, $question_data->reference_text);
            }
            if ((strpos($explanation, $word1) !== false)) {
                $question_data->explanation = str_replace($word1, $publicPath, $question_data->explanation);
            } elseif ((strpos($explanation, $word2) !== false)) {
                $question_data->explanation = str_replace($word2, $publicPath, $question_data->explanation);
            }
            $tempdata = (array)json_decode($question_data->question_options);
            $opArr = [];
            if (isset($tempdata) && is_array($tempdata)) {
                foreach ($tempdata as $key => $option) {

                    if ((strpos($option, $word1) !== false)) {
                        $option = str_replace($word1, $publicPath, $option);
                    } elseif ((strpos($option, $word2) !== false)) {
                        $option = str_replace($word2, $publicPath, $option);
                    }

                    $opArr[$key] = $option;
                }
            }
            $question_data->question_options = json_encode($opArr);

            $correct_ans = isset($question_data->answers) ? json_decode($question_data->answers) : '';

            if (isset($correct_ans)) {
                foreach ($correct_ans as $ankey => $anoption) {


                    if ((strpos($anoption, $word1) !== false)) {
                        $anoption = str_replace($word1, $publicPath, $anoption);
                    } elseif ((strpos($anoption, $word2) !== false)) {
                        $anoption = str_replace($word2, $publicPath, $anoption);
                    }

                    $correct_ans->$ankey = $anoption;
                }
            }

            $answerKeys = array_keys((array)$correct_ans);
            // echo "<pre>"; print_r($all_question_list); die;

            return view('afterlogin.Preparation.review_bookmarks', compact('question_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'all_question_list', 'attempt_opt', 'correct_ans', 'answerKeys', 'filtered_subject', 'activesub_id'));
        } else {
            return redirect()->route('dashboard');
        }
    }


    public function next_review_questionbookmark($question_id)
    {

        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/bookmark-questions/' . $user_id . '/' . $exam_id;
        curl_setopt_array($curl, array(
            //CURLOPT_URL => config('constants.API_php_URL_local') . "get_review/" . $result_id, //local
            CURLOPT_URL =>  $curl_url, //live
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",

            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",

            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if (isset($response) && !empty($response)) :
            $response = json_decode($response);
        endif;

        $result_response = $response;
        $question_data = [];
        $attempt_opt = [];
        $word1 = "/public/images/questions/";
        $word2 = "public/images/questions/";
        //echo "<pre>"; print_r($result_response); die;
        if (isset($result_response->response) && !empty($result_response->response)) {


            $all_data = collect($result_response->response)->sortBy('subject_id');

            $allQuestions = $all_data->keyBy('question_id');
            $allQuestionsArr = $all_data->all();
            $allkeys = $allQuestions->keys('question_id')->all();



            $first = $result_response->response[0]->question_id;

            $key = array_search($question_id, array_column($allQuestionsArr, 'question_id'));

            $qNo = $key + 1;
            $nextKey = $key + 1;
            $nextKey = $nextKey % count($result_response->response);
            if ($key > 0) { // Key would become 0
                $prevKey = $key - 1;
            } else {
                $prevKey = $key;
            }

            $next_qid = $allkeys[$nextKey];

            $prev_qid = $allkeys[$prevKey];
            $last_qid = end($allkeys);

            $question_data = $all_data->where('question_id', $question_id)->first();
            $q_id = $question_data->question_id;
            $activeq_id = $question_data->question_id;
            $question = $question_data->question;
            $reference_text = $question_data->reference_text;
            $explanation = $question_data->explanation;
            $attempt_opt = isset($question_data->option_id) ? (array)json_decode($question_data->option_id) : [];

            $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
            $activeChapt_id = isset($question_data->chapter_id) ? $question_data->chapter_id : '';
            $chapter_list = $this->redis_chapter_list($activesub_id);
            $collection_chpater = collect($chapter_list);
            $filter = $collection_chpater->where('chapter_id', $activeChapt_id)->first();
            $chapter_name = isset($filter->chapter_name) ? $filter->chapter_name : '';

            $question_data->chapter_name = $chapter_name;

            $question_id_array[] = $q_id;
            //$publicPath = url('/') . '/public/images/questions/';
            $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
            if ((strpos($question, $word1) !== false)) {
                $question_data->question = str_replace($word1, $publicPath, $question_data->question);
            } elseif ((strpos($question, $word2) !== false)) {
                $question_data->question = str_replace($word2, $publicPath, $question_data->question);
            }
            if ((strpos($reference_text, $word1) !== false)) {
                $question_data->reference_text = str_replace($word1, $publicPath, $question_data->reference_text);
            } elseif ((strpos($reference_text, $word2) !== false)) {
                $question_data->reference_text = str_replace($word2, $publicPath, $question_data->reference_text);
            }
            if ((strpos($explanation, $word1) !== false)) {
                $question_data->explanation = str_replace($word1, $publicPath, $question_data->explanation);
            } elseif ((strpos($explanation, $word2) !== false)) {
                $question_data->explanation = str_replace($word2, $publicPath, $question_data->explanation);
            }
            $tempdata = (array)json_decode($question_data->question_options);
            $opArr = [];
            if (isset($tempdata) && is_array($tempdata)) {
                foreach ($tempdata as $key => $option) {

                    if ((strpos($option, $word1) !== false)) {
                        $option = str_replace($word1, $publicPath, $option);
                    } else if ((strpos($option, $word2) !== false)) {
                        $option = str_replace($word2, $publicPath, $option);
                    }
                    $opArr[$key] = $option;
                }
            }
        }
        $question_data->question_options = json_encode($opArr);


        $correct_ans = isset($question_data->answers) ? json_decode($question_data->answers) : '';

        if (isset($correct_ans)) {
            foreach ($correct_ans as $ankey => $anoption) {


                if ((strpos($anoption, $word1) !== false)) {
                    $anoption = str_replace($word1, $publicPath, $anoption);
                } elseif ((strpos($anoption, $word2) !== false)) {
                    $anoption = str_replace($word2, $publicPath, $anoption);
                }

                $correct_ans->$ankey = $anoption;
            }
        }
        $answerKeys = array_keys((array)$correct_ans);


        return view('afterlogin.ExamCustom.next_review_questionbookmark', compact('question_data', 'attempt_opt', 'qNo', 'correct_ans', 'answerKeys', 'activeq_id', 'next_qid', 'prev_qid'));
    }



    public function ajax_review_next_subject_questionbookmark($subject_id, Request $request)
    {

        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/bookmark-questions/' . $user_id . '/' . $exam_id;
        curl_setopt_array($curl, array(
            //CURLOPT_URL => config('constants.API_php_URL_local') . "get_review/" . $result_id, //local
            CURLOPT_URL =>  $curl_url, //live
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",

            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",

            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if (isset($response) && !empty($response)) :
            $response = json_decode($response);
        endif;

        $result_response = $response;
        $question_data = [];
        $attempt_opt = [];
        $word1 = "/public/images/questions/";
        $word2 = "public/images/questions/";

        if (isset($result_response->response) && !empty($result_response->response)) {


            $all_data = collect($result_response->response);
            $all_data = $all_data->sortBy('subt_id');

            $allQuestions = $all_data->keyBy('question_id');
            $filtered = $all_data->where('subject_id', $subject_id);

            // $first = $filtered->first();
            //$question_id = $first->question_id;
            $allQuestionsArr = $all_data->all();
            $allkeys = $allQuestions->keys('question_id')->all();

            $question_id = $result_response->response[0]->question_id;
            //echo "<pre>"; print_r($first); die;
            $key = array_search($question_id, array_column($allQuestionsArr, 'question_id'));

            $qNo = $key + 1;
            $nextKey = $key + 1;
            $nextKey = $nextKey % count($result_response->response);
            if ($key > 0) { // Key would become 0
                $prevKey = $key - 1;
            } else {
                $prevKey = $key;
            }

            $next_qid = $allkeys[$nextKey];

            $prev_qid = $allkeys[$prevKey];
            $last_qid = end($allkeys);

            $question_data = $all_data->where('question_id', $question_id)->first();
            $q_id = $question_data->question_id;
            $activeq_id = $question_data->question_id;
            $question = $question_data->question;
            $reference_text = $question_data->reference_text;
            $explanation = $question_data->explanation;
            $attempt_opt = isset($question_data->option_id) ? (array)json_decode($question_data->option_id) : [];

            $question_id_array[] = $q_id;
            //$publicPath = url('/') . '/public/images/questions/';
            $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
            if ((strpos($question, $word1) !== false)) {
                $question_data->question = str_replace($word1, $publicPath, $question_data->question);
            } elseif ((strpos($question, $word2) !== false)) {
                $question_data->question = str_replace($word2, $publicPath, $question_data->question);
            }
            if ((strpos($reference_text, $word1) !== false)) {
                $question_data->reference_text = str_replace($word1, $publicPath, $question_data->reference_text);
            } elseif ((strpos($reference_text, $word2) !== false)) {
                $question_data->reference_text = str_replace($word2, $publicPath, $question_data->reference_text);
            }
            if ((strpos($explanation, $word1) !== false)) {
                $question_data->explanation = str_replace($word1, $publicPath, $question_data->explanation);
            } elseif ((strpos($explanation, $word2) !== false)) {
                $question_data->explanation = str_replace($word2, $publicPath, $question_data->explanation);
            }
            $tempdata = (array)json_decode($question_data->question_options);
            $opArr = [];
            if (isset($tempdata) && is_array($tempdata)) {
                foreach ($tempdata as $key => $option) {

                    if ((strpos($option, $word1) !== false)) {
                        $option = str_replace($word1, $publicPath, $option);
                    } else if ((strpos($option, $word2) !== false)) {
                        $option = str_replace($word2, $publicPath, $option);
                    }
                    $opArr[$key] = $option;
                }
            }
        }
        $question_data->question_options = json_encode($opArr);


        $correct_ans = isset($question_data->answers) ? json_decode($question_data->answers) : '';

        if (isset($correct_ans)) {
            foreach ($correct_ans as $ankey => $anoption) {


                if ((strpos($anoption, $word1) !== false)) {
                    $anoption = str_replace($word1, $publicPath, $anoption);
                } elseif ((strpos($anoption, $word2) !== false)) {
                    $anoption = str_replace($word2, $publicPath, $anoption);
                }

                $correct_ans->$ankey = $anoption;
            }
        }
        $answerKeys = array_keys((array)$correct_ans);

        // echo "<pre>"; print_r($question_data); die;
        return view('afterlogin.ExamCustom.next_review_questionbookmark', compact('question_data', 'attempt_opt', 'qNo', 'correct_ans', 'answerKeys', 'activeq_id', 'next_qid', 'prev_qid'));
    }
}
