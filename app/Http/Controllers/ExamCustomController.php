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

class ExamCustomController extends Controller
{
    //
    use CommonTrait;

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $cacheKey = 'exam_subjects:' . $exam_id;
        if ($data = Redis::get($cacheKey)) {
            $subject_list = json_decode($data);
        }


        $api_url = Config::get('constants.API_NEW_URL') . 'api/subjects/' . $exam_id;

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
            $responsedata = json_decode($response_json);

            $subject_list = $responsedata->response;
        } else {
            $subject_list = [];
        }

        Redis::set($cacheKey, json_encode($subject_list));

        /* $active_subject = !empty($subject_list) ? head($subject_list) : [];
        $active_subject_id = isset($active_subject->sub_id) ? $active_subject->sub_id : '';
 */
        $subject_chapter_list = [];

        if (!empty($subject_list)) {
            foreach ($subject_list as $row) {

                $subject_id = $row->id;
                $aSubject_chapters = $this->get_subject_chapter($subject_id);

                $subject_chapter_list[$subject_id] = $aSubject_chapters;

                //$subject_chapter_list[$subject_id] = !empty($topTen) ? $topTen : [];
            }
        }


        return view('afterlogin.ExamCustom.exam_custom', compact('subject_list', 'subject_chapter_list'));
    }

    public function get_subject_chapter($active_subject_id)
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $cacheKey = 'exam_subjects_chapters:' . $active_subject_id;
        if ($data = Redis::get($cacheKey)) {
            $chapter_list = json_decode($data);
        } else {

            $api_url = Config::get('constants.API_NEW_URL') . 'api/chapters/' . $user_id . '/' . $active_subject_id;

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
                $responsedata = json_decode($response_json);

                $chapter_list = $responsedata->response;
            } else {
                $chapter_list = [];
            }

            Redis::set($cacheKey, json_encode($chapter_list));
        }
        $collection = collect($chapter_list);

        $sorted = $collection->sortBy([
            ['chapter_name', 'asc']
        ]);
        $chapters = $sorted->values()->all();


        return $chapters;
    }

    public function get_subject_topics($active_subject_id)
    {
        $cacheKey = 'exam_subjects_topics:' . $active_subject_id;
        if ($data = Redis::get($cacheKey)) {
            $topic_list = json_decode($data);
            return $topic_list;
        }

        $api_url = Config::get('constants.API_php_URL') . 'api/getTopics/' . $active_subject_id;

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

        if ($httpcode == 200) {
            $responsedata = json_decode($response_json);

            $topic_list = $responsedata->response;
        } else {
            $topic_list = [];
        }

        Redis::set($cacheKey, json_encode($topic_list));
        return $topic_list;
    }


    public function subject_exam(Request $request)
    {
        $filtered_subject = [];

        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        if (Redis::exists('custom_answer_time')) {
            Redis::del(Redis::keys('custom_answer_time'));
        }


        $question_count = isset($request->question_count) ? $request->question_count : 30;
        $subject_id = isset($request->subject_id) ? $request->subject_id : 0;
        $chapter_id = isset($request->chapter_id) ? $request->chapter_id : 0;


        $select_topic = isset($request->topics) ? explode(",", (int)$request->topics, true) : [];

        $inputjson['student_id'] = $user_id;
        $inputjson['exam_id'] = (string)$exam_id;
        $inputjson['question_cnt'] = $question_count;
        $inputjson['subject_id'] = (string)$subject_id;
        $inputjson['chapter_id'] = (string)$chapter_id;
        $inputjson['topic_list'] = !empty($select_topic) ? json_encode($select_topic) : '';

        $request = json_encode($inputjson);

        $curl_url = "";
        $curl = curl_init();
        $api_URL = Config::get('constants.API_NEW_URL');

        $curl_url = $api_URL . 'api/custom-question-selection';

        curl_setopt_array($curl, array(
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
        ));
        $response_json = curl_exec($curl);

        $response_json = str_replace('NaN', '""', $response_json);

        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $responsedata = json_decode($response_json);
        $httpcode_response = isset($responsedata->success) ? $responsedata->success : false;

        if ($httpcode_response == true) {

            if (!empty($responsedata)) {
                $aQuestions_list = isset($responsedata->questions) ? $responsedata->questions : [];

                $exam_fulltime = $responsedata->time_allowed;
                $questions_count = count($aQuestions_list);
            } else {
                return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
            }
        } else {
            $aQuestions_list = [];
            $questions_count = 0;
            $exam_fulltime = 0;
            return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
        }

        $redis_set = 'True';


        $collection = collect($aQuestions_list)->sortBy('subject_id');
        $grouped = $collection->groupBy('subject_id');
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

        $allQuestions = $collection->keyBy('question_id')->sortBy('question_id');
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
            $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
            $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
            $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
            $qs_id = $question_data->question_id;
            $option_ques = str_replace("'", '"', $question_data->question_options);

            $tempdata = json_decode($option_ques, true);
            $opArr = [];
            if (isset($tempdata) && is_array($tempdata)) {
                foreach ($tempdata as $key => $option) {
                    $option = str_replace('/public/images/questions/', $publicPath, $option);
                    $opArr[$key] = $option;
                }
            }
            $optionArray = $this->shuffle_assoc($opArr);
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
            'full_time' => $exam_fulltime,
        ];

        // Push Value in Redis
        Redis::set('custom_answer_time', json_encode($redis_data));

        $tagrets = implode(', ', $aTargets);

        $test_type = 'Mocktest';
        $exam_type = 'PT';

        return view('afterlogin.ExamCustom.exam', compact('test_type', 'exam_type', 'question_data', 'tagrets', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'filtered_subject', 'activesub_id'));
    }

    function shuffle_assoc($list)
    {
        if (!is_array($list)) {
            return $list;
        }

        $keys = array_keys($list);
        shuffle($keys);
        $random = array();
        foreach ($keys as $key) {
            $random[$key] = $list[$key];
        }
        return $random;
    }




    public function ajax_next_question($quest_id, Request $request)
    {


        $user_id = Auth::user()->id;
        $cacheKey = 'CustomQuestion:all:' . $user_id;
        $redis_result = Redis::get($cacheKey);

        if (isset($redis_result) && !empty($redis_result)) :
            $response = json_decode($redis_result);
        endif;

        $allQuestions = isset($response) ? $response : []; // redis response as object
        $allQuestionsArr = (array)$allQuestions; //object convert to array

        $allkeys = array_keys((array)$allQuestions); //Array of all keys

        $question_data = isset($allQuestions->$quest_id) ? $allQuestions->$quest_id : []; // required question all data

        $activeq_id = isset($question_data->question_id) ? $question_data->question_id : ''; //ccurrent question id
        $que_sub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
        $key = array_search($quest_id, array_column($allQuestionsArr, 'question_id'));

        $qNo = $key + 1;
        $nextKey = $key + 1;
        $nextKey = $nextKey % count($allQuestionsArr);
        if ($key > 0) { // Key would become 0
            $prevKey = $key - 1;
        } else {
            $prevKey = $key;
        }
        $next_qid = '';
        $prev_qid = '';


        $next_qid = $allkeys[$nextKey];

        $prev_qid = $allkeys[$prevKey];
        $last_qid = end($allkeys);

        if (isset($question_data) && !empty($question_data)) {
            // $publicPath = url('/') . '/public/images/questions/';
            $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
            $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
            $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
            $qs_id = $question_data->question_id;
            $option_ques = str_replace("'", '"', $question_data->question_options);

            $tempdata = json_decode($option_ques, true);
            $opArr = [];
            if (isset($tempdata) && is_array($tempdata)) {
                foreach ($tempdata as $key => $option) {
                    $option = str_replace('/public/images/questions/', $publicPath, $option);
                    $opArr[$key] = $option;
                }
            }
            $optionArray = $this->shuffle_assoc($opArr);
            $option_data = $optionArray;
        } else {
            $option_data[] = '';
        }
        $session_result = Redis::get('custom_answer_time');
        $sessionResult = json_decode($session_result);



        $aGivenAns = isset($sessionResult->given_ans->$quest_id) ? $sessionResult->given_ans->$quest_id : [];
        $aquestionTakenTime = isset($sessionResult->taken_time_sec->$quest_id) ? $sessionResult->taken_time_sec->$quest_id : 0;

        return view('afterlogin.ExamCustom.next_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'));
    }


    public function saveAnswer(Request $request)
    {
        /* # code... */
        $data = $request->all();
        $question_id = isset($data['question_id']) ? $data['question_id'] : '';
        $option_id = isset($data['option_id']) ? $data['option_id'] : '';
        $q_submit_time = isset($data['q_submit_time']) ? $data['q_submit_time'] : '';

        $redis_result = Redis::get('custom_answer_time');

        if (!empty($redis_result)) {
            $redisArray = json_decode($redis_result, true);
            $retrive_array = $redisArray['given_ans'];
            $retrive_time_array = $redisArray['taken_time'];
            $answer_swap_cnt = $redisArray['answer_swap_cnt'];
            $retrive_time_sec = $redisArray['taken_time_sec'];

            $retrive_time_sec[$question_id] = (int)$q_submit_time;
            //$time_taken = $redisArray['time_taken'] ?? array();
            if (isset($option_id) && $option_id != '') {
                $retrive_array[$question_id] = $option_id;
                $retrive_time_array[$question_id] = gmdate('H:i:s', (int)$q_submit_time);
            }
        } else {
            $retrive_array = $retrive_time_array = $answer_swap_cnt = $retrive_time_sec = [];
            if (isset($option_id) && $option_id != '') {
                $retrive_array[$question_id] = $option_id;
                $retrive_time_array[$question_id] = gmdate('H:i:s', (int)$q_submit_time);
            }
            $retrive_time_sec[$question_id] = (int)$q_submit_time;
        }
        if (isset($answer_swap_cnt[$question_id])) {
            $answer_swap_cnt[$question_id] = $answer_swap_cnt[$question_id] + 1;
        } else {
            $answer_swap_cnt[$question_id] = 0;
        }

        $redisArray['given_ans'] = $retrive_array;
        $redisArray['taken_time'] = $retrive_time_array;
        $redisArray['answer_swap_cnt'] = $answer_swap_cnt;
        $redisArray['taken_time_sec'] = $retrive_time_sec;


        // Push Value in Redis
        Redis::set('custom_answer_time', json_encode($redisArray));

        $response['status'] = 200;
        $response['message'] = "save response successfully";


        return json_encode($response);
    }

    public function clearResponse(Request $request)
    {
        /* # code... */
        $data = $request->all();
        $question_id = isset($data['question_id']) ? $data['question_id'] : '';
        $option_id = isset($data['option_id']) ? $data['option_id'] : '';

        $redis_result = Redis::get('custom_answer_time');


        if (!empty($redis_result)) {
            $redisArray = json_decode($redis_result, true);
            $retrive_array = $redisArray['given_ans'];
            $retrive_time_array = $redisArray['taken_time'];
            $answer_swap_cnt = $redisArray['answer_swap_cnt'] ?? array();

            $retrive_array[$question_id] = '';
        }
        if (isset($answer_swap_cnt[$question_id])) {
            $answer_swap_cnt[$question_id] = $answer_swap_cnt[$question_id] + 1;
        } else {
            $answer_swap_cnt[$question_id] = 0;
        }

        $redisArray['given_ans'] = $retrive_array;
        $redisArray['taken_time'] = $retrive_time_array;
        $redisArray['answer_swap_cnt'] = $answer_swap_cnt;


        // Push Value in Redis
        Redis::set('custom_answer_time', json_encode($redisArray));

        $response['status'] = 200;
        $response['message'] = "save response successfully";


        return json_encode($response);
    }



    public function ajax_next_subject_question($subject_id, Request $request)
    {


        $user_id = Auth::user()->id;
        $cacheKey = 'CustomQuestion:all:' . $user_id;
        $redis_result = Redis::get($cacheKey);

        if (isset($redis_result) && !empty($redis_result)) :
            $response = json_decode($redis_result);
        endif;

        $allQuestions = isset($response) ? $response : []; // redis response as object
        $collection = collect($allQuestions);
        $filtered = $collection->where('subject_id', $subject_id);
        $filtered_questions = $filtered->values()->all();

        $allQuestionsArr = (array)$allQuestions; //object convert to array

        $allkeys = array_keys((array)$allQuestions); //Array of all keys

        //$question_data = isset($allQuestions->$quest_id) ? $allQuestions->$quest_id : []; // required question all data
        $question_data = current($filtered_questions);
        $activeq_id = isset($question_data->question_id) ? $question_data->question_id : ''; //ccurrent question id

        $que_sub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';


        $key = array_search($activeq_id, array_column($allQuestionsArr, 'question_id'));

        $qNo = $key + 1;
        $nextKey = $key + 1;
        $nextKey = $nextKey % count($allQuestionsArr);
        if ($key > 0) { // Key would become 0
            $prevKey = $key - 1;
        } else {
            $prevKey = $key;
        }
        $next_qid = '';
        $prev_qid = '';


        $next_qid = $allkeys[$nextKey];

        $prev_qid = $allkeys[$prevKey];
        $last_qid = end($allkeys);



        if (isset($question_data) && !empty($question_data)) {
            //$publicPath = url('/') . '/public/images/questions/';
            $publicPath = 'https://admin.uniqtoday.com' . '/public/images/questions/';
            $question_data->question = str_replace('/public/images/questions/', $publicPath, $question_data->question);
            $question_data->passage_inst = str_replace('/public/images/questions/', $publicPath, $question_data->passage_inst);
            $qs_id = $question_data->question_id;
            $option_ques = str_replace("'", '"', $question_data->question_options);

            $tempdata = json_decode($option_ques, true);
            $opArr = [];
            if (isset($tempdata) && is_array($tempdata)) {
                foreach ($tempdata as $key => $option) {
                    $option = str_replace('/public/images/questions/', $publicPath, $option);
                    $opArr[$key] = $option;
                }
            }
            $optionArray = $this->shuffle_assoc($opArr);
            $option_data = $optionArray;
        } else {
            $option_data[] = '';
        }

        $session_result = Redis::get('custom_answer_time');
        $sessionResult = json_decode($session_result);

        $aGivenAns = isset($sessionResult->given_ans->$activeq_id) ? $sessionResult->given_ans->$activeq_id : [];
        $aquestionTakenTime = isset($sessionResult->taken_time->$activeq_id) ? $sessionResult->taken_time->$activeq_id : '00:00:00';


        return view('afterlogin.ExamCustom.next_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'));
    }


    public function  chaptersTopic(Request $request, $chapter_id)
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $filter_by = isset($request->filter_type) ? $request->filter_type : '';
        //$topics = DB::table('topics')->select('id as topic_id', 'topic_name')->where('chapter_id', $chapter_id)->get()->toArray();

        $api_url = Config::get('constants.API_NEW_URL') . 'api/topics-by-chapter-id/' . $user_id . '/' . $chapter_id;

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
            $responsedata = json_decode($response_json);


            $topics_list = $responsedata->response;
        } else {
            $topics_list = [];
        }

        $collect_topic = collect($topics_list);
        if ($filter_by == 'asc') {
            $sorted = $collect_topic->sortBy([
                ['topic_name', 'asc']
            ]);
            $topics = $sorted->values()->all();
        } elseif ($filter_by == 'desc') {
            $sorted = $collect_topic->sortBy([
                ['topic_name', 'desc']
            ]);
            $topics = $sorted->values()->all();
        } else {
            $sorted = $collect_topic->sortBy([
                ['topic_name', 'asc']
            ]);
            $topics = $sorted->values()->all();
        }


        return view('afterlogin.ExamCustom.custom_topic', compact('topics'));
    }


    public function ajax_chapter_list($active_subject_id, Request $request)
    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;

        $selected_chapter = isset($request->selected_chapters) ? $request->selected_chapters : [];

        $cacheKey = 'exam_subjects_chapters:' . $active_subject_id;
        if ($data = Redis::get($cacheKey)) {
            $chapter_list = json_decode($data);

            return view('afterlogin.chpater_planner', compact('chapter_list', 'active_subject_id', 'selected_chapter'));
            //return $chapter_list;
        }

        $api_url = Config::get('constants.API_NEW_URL') . 'api/chapters/' . $user_id . '/' . $active_subject_id;

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
            $responsedata = json_decode($response_json);

            $chapter_list = $responsedata->response;
            Redis::set($cacheKey, json_encode($chapter_list));
        } else {
            $chapter_list = [];
        }

        return view('afterlogin.chpater_planner', compact('chapter_list', 'active_subject_id', 'selected_chapter'));
    }


    public function filter_subject_chapter(Request $request, $active_subject_id)

    {
        $user_id = Auth::user()->id;
        $exam_id = Auth::user()->grade_id;
        $filter_by = isset($request->filter_type) ? $request->filter_type : '';
        $subject_id = $active_subject_id;

        $cacheKey = 'exam_subjects_chapters:' . $active_subject_id;
        if ($data = Redis::get($cacheKey)) {
            $chapter_list = json_decode($data);
        } else {

            $api_url = Config::get('constants.API_NEW_URL') . 'api/chapters/' . $user_id . '/' . $active_subject_id;

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
                $responsedata = json_decode($response_json);

                $chapter_list = $responsedata->response;
            } else {
                $chapter_list = [];
            }

            Redis::set($cacheKey, json_encode($chapter_list));
        }

        $collection = collect($chapter_list);
        if ($filter_by == 'asc') {
            $sorted = $collection->sortBy([
                ['chapter_name', 'asc']
            ]);
            $chapters = $sorted->values()->all();
        } elseif ($filter_by == 'desc') {
            $sorted = $collection->sortBy([
                ['chapter_name', 'desc']
            ]);
            $chapters = $sorted->values()->all();
        } else {
            $sorted = $collection->sortBy([
                ['chapter_name', 'asc']
            ]);
            $chapters = $sorted->values()->all();
        }



        return view('afterlogin.ExamCustom.custom_chapter_list', compact('chapters', 'subject_id'));
    }



    public function saveQuestionTimeSession(Request $request, $question_id)
    {

        $question_time = $request->q_time;
        $redis_result = Redis::get('custom_answer_time');

        if (!empty($redis_result)) {
            $redisArray = json_decode($redis_result, true);

            $retrive_time_sec = $redisArray['taken_time_sec'];
            $retrive_time_array = $redisArray['taken_time'];


            $retrive_time_sec[$question_id] = (int)$question_time;
            $retrive_time_array[$question_id] = gmdate('H:i:s', $question_time);
        } else {
            $retrive_time_sec = [];
            $retrive_time_array = [];

            $retrive_time_sec[$question_id] = (int)$question_time;
            $retrive_time_array[$question_id] = gmdate('H:i:s', $question_time);
        }

        $redisArray['taken_time_sec'] = $retrive_time_sec;
        $redisArray['taken_time'] = $retrive_time_array;


        // Push Value in Redis
        Redis::set('custom_answer_time', json_encode($redisArray));

        $response['status'] = 200;
        $response['message'] = "save response successfully";


        return json_encode($response);
    }
}
