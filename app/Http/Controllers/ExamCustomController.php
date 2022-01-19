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
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        $cacheKey = 'exam_subjects:' . $exam_id;
        if ($data = Redis::get($cacheKey)) {
            $subject_list = json_decode($data);
        }


        $api_url = env('API_URL') . 'api/subjects/' . $exam_id;

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

        if (!empty($subject_list)) {
            Redis::set($cacheKey, json_encode($subject_list));
        }

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
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $cacheKey = 'exam_subjects_chapters:' . $active_subject_id;

        $api_url = env('API_URL') . 'api/chapters/' . $user_id . '/' . $active_subject_id;

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

        return $topic_list;
    }


    public function subject_exam(Request $request)
    {
        $filtered_subject = [];

        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        if (Redis::exists('custom_answer_time_' . $user_id)) {
            Redis::del(Redis::keys('custom_answer_time_' . $user_id));
        }


        $question_count = isset($request->question_count) ? $request->question_count : 30;
        $subject_id = isset($request->subject_id) ? $request->subject_id : 0;
        $subject_name = isset($request->subject_name) ? $request->subject_name : 0;
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
        $api_URL = env('API_URL');

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
        $aQuestions_list = isset($responsedata->questions) ? $responsedata->questions : [];

        if ($httpcode_response == true) {

            if (!empty($aQuestions_list)) {
                //$exam_fulltime = $responsedata->time_allowed;
                $questions_count = count($aQuestions_list);
                $exam_fulltime = 60;
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
        $aQuestions_list = $allQuestions->all();

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
            'full_time' => $exam_fulltime,
        ];

        // Push Value in Redis
        Redis::set('custom_answer_time_' . $user_id, json_encode($redis_data));

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
        $userData = Session::get('user_data');
        $user_id = $userData->id;

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
        $nextKey = (count($allQuestionsArr) > 0) ? $nextKey % count($allQuestionsArr) : $nextKey;
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
            //$optionArray = $this->shuffle_assoc($opArr);
            $optionArray = $opArr;
            $option_data = $optionArray;
        } else {
            $option_data[] = '';
        }
        $session_result = Redis::get('custom_answer_time_' . $user_id);
        $sessionResult = json_decode($session_result);


        $aGivenAns = (isset($sessionResult->given_ans->$quest_id) && !empty($sessionResult->given_ans->$quest_id)) ? $sessionResult->given_ans->$quest_id : [];
        $aquestionTakenTime = isset($sessionResult->taken_time_sec->$quest_id) ? $sessionResult->taken_time_sec->$quest_id : 0;

        return view('afterlogin.ExamCustom.next_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'));
    }

    public function saveAnswer(Request $request)
    {
        $userData = Session::get('user_data');
        $user_id = $userData->id;

        /* # code... */
        $data = $request->all();
        $question_id = isset($data['question_id']) ? $data['question_id'] : '';
        $option_id = isset($data['option_id']) ? $data['option_id'] : '';
        $q_submit_time = isset($data['q_submit_time']) ? $data['q_submit_time'] : '';

        $redis_result = Redis::get('custom_answer_time_' . $user_id);

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
        Redis::set('custom_answer_time_' . $user_id, json_encode($redisArray));

        $response['status'] = 200;
        $response['message'] = "save response successfully";


        return json_encode($response);
    }

    public function clearResponse(Request $request)
    {
        $userData = Session::get('user_data');
        $user_id = $userData->id;
        /* # code... */
        $data = $request->all();
        $question_id = isset($data['question_id']) ? $data['question_id'] : '';
        $option_id = isset($data['option_id']) ? $data['option_id'] : '';

        $redis_result = Redis::get('custom_answer_time_' . $user_id);


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
        Redis::set('custom_answer_time_' . $user_id, json_encode($redisArray));

        $response['status'] = 200;
        $response['message'] = "save response successfully";


        return json_encode($response);
    }


    public function ajax_next_subject_question($subject_id, Request $request)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;

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
        $nextKey = (count($allQuestionsArr) > 0) ? $nextKey % count($allQuestionsArr) : $nextKey;
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
            //$optionArray = $this->shuffle_assoc($opArr);
            $optionArray = $opArr;
            $option_data = $optionArray;
        } else {
            $option_data[] = '';
        }

        $session_result = Redis::get('custom_answer_time_' . $user_id);
        $sessionResult = json_decode($session_result);

        $aGivenAns = (isset($sessionResult->given_ans->$activeq_id) && !empty($sessionResult->given_ans->$activeq_id)) ? $sessionResult->given_ans->$activeq_id : [];
        $aquestionTakenTime = isset($sessionResult->taken_time_sec->$activeq_id) ? $sessionResult->taken_time_sec->$activeq_id : 0;


        return view('afterlogin.ExamCustom.next_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'));
    }


    public function chaptersTopic(Request $request, $chapter_id)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        $filter_by = isset($request->filter_type) ? $request->filter_type : '';
        //$topics = DB::table('topics')->select('id as topic_id', 'topic_name')->where('chapter_id', $chapter_id)->get()->toArray();

        $api_url = env('API_URL') . 'api/topics-by-chapter-id/' . $user_id . '/' . $chapter_id;

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
        if ($filter_by == 'priority') {
            $sorted = $collect_topic->sortBy([
                ['topic_priority', 'asc']
            ]);
            $topics = $sorted->values()->all();
        } elseif ($filter_by == 'sequence') {
            $sorted = $collect_topic->sortBy([
                ['topic_sequence', 'asc']
            ]);
            $topics = $sorted->values()->all();
        } elseif ($filter_by == 'prof_asc') {
            $sorted = $collect_topic->sortBy([
                ['topic_score', 'asc']
            ]);
            $topics = $sorted->values()->all();
        } elseif ($filter_by == 'prof_desc') {
            $sorted = $collect_topic->sortBy([
                ['topic_score', 'desc']
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
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        $selected_chapter = isset($request->selected_chapters) ? $request->selected_chapters : [];

        $cacheKey = 'exam_subjects_chapters:' . $active_subject_id;
        if ($data = Redis::get($cacheKey)) {
            $chapter_list = json_decode($data);

            return view('afterlogin.chpater_planner', compact('chapter_list', 'active_subject_id', 'selected_chapter'));
            //return $chapter_list;
        }

        $api_url = env('API_URL') . 'api/chapters/' . $user_id . '/' . $active_subject_id;

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
            if (!empty($chapter_list)) {
                Redis::set($cacheKey, json_encode($chapter_list));
            }
        } else {
            $chapter_list = [];
        }

        return view('afterlogin.chpater_planner', compact('chapter_list', 'active_subject_id', 'selected_chapter'));
    }


    public function filter_subject_chapter(Request $request, $active_subject_id)

    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $filter_by = isset($request->filter_type) ? $request->filter_type : '';

        $subject_id = $active_subject_id;


        //        $cacheKey = 'exam_subjects_chapters:' . $active_subject_id;
        //        if ($data = Redis::get($cacheKey)) {
        //            $chapter_list = json_decode($data);
        //        } else {

        $api_url = env('API_URL') . 'api/chapters/' . $user_id . '/' . $active_subject_id;

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
        //            if (!empty($chapter_list)) {
        //                Redis::set($cacheKey, json_encode($chapter_list));
        //            }
        //        }


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
        } elseif ($filter_by == 'prof_asc') {
            $sorted = $collection->sortBy([
                ['chapter_score', 'asc']
            ]);
            $chapters = $sorted->values()->all();
        } elseif ($filter_by == 'prof_desc') {
            $sorted = $collection->sortBy([
                ['chapter_score', 'desc']
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
        $userData = Session::get('user_data');
        $user_id = $userData->id;

        $question_time = $request->q_time;
        $redis_result = Redis::get('custom_answer_time_' . $user_id);

        if (!empty($redis_result)) {
            $redisArray = json_decode($redis_result, true);

            $retrive_array = $redisArray['given_ans'];
            $retrive_time_array = $redisArray['taken_time'];
            $answer_swap_cnt = $redisArray['answer_swap_cnt'];
            $retrive_time_sec = $redisArray['taken_time_sec'];

            $retrive_time_sec[$question_id] = (int)$question_time;
            $retrive_time_array[$question_id] = gmdate('H:i:s', $question_time);
        } else {
            $retrive_time_sec = [];
            $retrive_time_array = [];

            $retrive_time_sec[$question_id] = (int)$question_time;
            $retrive_time_array[$question_id] = gmdate('H:i:s', $question_time);
        }


        $redisArray['given_ans'] = $retrive_array;
        $redisArray['taken_time'] = $retrive_time_array;
        $redisArray['answer_swap_cnt'] = $answer_swap_cnt;
        $redisArray['taken_time_sec'] = $retrive_time_sec;

        // Push Value in Redis
        Redis::set('custom_answer_time_' . $user_id, json_encode($redisArray));

        $response['status'] = 200;
        $response['message'] = "save response successfully";


        return json_encode($response);
    }


    /* Chapter wise Adaptive api */
    public function chapterAdaptiveExam(Request $request)
    {
        $filtered_subject = [];

        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;

        if (Redis::exists('adaptive_session:' . $user_id)) {
            Redis::del(Redis::keys('adaptive_session:' . $user_id));
        }

        $question_count = isset($request->question_count) ? $request->question_count : 30;
        $subject_id = isset($request->subject_id) ? $request->subject_id : 0;
        $chapter_id = isset($request->chapter_id) ? $request->chapter_id : 0;

        $select_topic = isset($request->topics) ? explode(",", (int)$request->topics, true) : [];


        $inputjson['student_id'] = $user_id;
        $inputjson['exam_id'] = (string)$exam_id;
        $inputjson['chapter_id'] = $chapter_id;
        $inputjson['session_id'] = 0;
        $inputjson['end_test'] = "";
        $inputjson['exam_over'] = "";
        $inputjson['questions_list'] = [];
        $inputjson['answerList'] = [];

        $request = json_encode($inputjson);


        $curl_url = "";
        $curl = curl_init();
        $api_URL = env('API_URL');

        $curl_url = $api_URL . 'api/adaptive-assessment-chapter-practice';

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
        $aQuestionslist = isset($responsedata->questions) ? $responsedata->questions : [];
        $session_id = isset($responsedata->session_id) ? $responsedata->session_id : [];
        $test_name = isset($responsedata->test_name) ? $responsedata->test_name : 'Chapter Level Exam';

        if ($httpcode_response == true) {
            if (!empty($aQuestionslist)) {
                $exam_fulltime = $responsedata->time_allowed;
                $questions_count = count($aQuestionslist);
            } else {
                return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
            }
        } else {

            return Redirect::back()->withErrors(['Question not available With these filters! Please try Again.']);
        }
        $exam_fulltime = 60; //60min set for cahpter adaptive exam
        $redis_set = 'True';

        $collection = collect($aQuestionslist)->sortBy('subject_id');
        $grouped = $collection->groupBy('subject_id');
        $subject_ids = $collection->pluck('subject_id');
        $question_ids = $collection->pluck('question_id')->values()->all();

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


        $allQuestionDetails = $this->adaptiveCustomQlist($user_id, $aQuestionslist, $redis_set);
        $keys = array_keys($allQuestionDetails);

        $question_data = (object)current($allQuestionDetails);

        $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
        $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
        $nextquestion_data = (object)next($allQuestionDetails);

        $next_qKey = 1;
        $prev_qKey = 0;

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
            //$optionArray = $this->shuffle_assoc($opArr);
            $optionArray = $opArr;
            $option_data = $optionArray;
        } else {
            $option_data[] = '';
        }

        /* set redis for save exam question response */
        $retrive_array = $retrive_time_array = $retrive_time_sec = $answer_swap_cnt = $aQ_list = [];
        $redis_data = [
            'given_ans' => $retrive_array,
            'taken_time' => $retrive_time_array,
            'taken_time_sec' => $retrive_time_sec,
            'answer_swap_cnt' => $answer_swap_cnt,
            'questions_count' => $questions_count,
            'all_questions_id' => $question_ids,
            'full_time' => $exam_fulltime,
        ];

        // Push Value in Redis
        Redis::set('adaptive_session:' . $user_id, json_encode($redis_data));

        $tagrets = implode(', ', $aTargets);

        $test_type = 'Mocktest';
        $exam_type = 'PT';


        return view('afterlogin.AdaptiveExamChapter.adaptiveExam', compact('session_id', 'test_type', 'exam_type', 'question_data', 'tagrets', 'option_data', 'keys', 'activeq_id', 'next_qKey', 'prev_qKey', 'questions_count', 'exam_fulltime', 'filtered_subject', 'activesub_id', 'test_name'));
    }


    public function ajax_adaptive_question_chapter($key, Request $request)
    {
        $qNo = $key + 1;
        $next_qid = $key + 1;
        $prev_qid = $key - 1;

        $session_id = isset($request->session_id) ? $request->session_id : [];
        $chapter_id = isset($request->chapter_id) ? $request->chapter_id : [];

        $userData = Session::get('user_data');

        $user_id = $userData->id;

        $cacheKey = 'CustomQuestionAdaptive:all:' . $user_id;
        $redis_result = Redis::get($cacheKey);

        if (isset($redis_result) && !empty($redis_result)) :
            $response = json_decode($redis_result);
        endif;

        $allQuestions = isset($response) ? $response : []; // redis response as object

        $allQuestionsArr = (array)$allQuestions; //object convert to array

        $allkeys = array_keys((array)$allQuestions); //Array of all keys

        $next_question_data = isset($allQuestions[$key]) ? $allQuestions[$key] : []; // required question all data

        if (empty($next_question_data)) {

            $question_data = $this->getNextAdpativeQues($session_id, $key, $chapter_id);
        } else {
            $question_data = $next_question_data;
        }
        $activeq_id = isset($question_data->question_id) ? $question_data->question_id : ''; //ccurrent question id
        $quest_id = $activeq_id;
        $que_sub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
        $que_sub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
        // $key = array_search($activeq_id, array_column($allQuestionsArr, 'question_id'));


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
            //$optionArray = $this->shuffle_assoc($opArr);
            $optionArray = $opArr;
            $option_data = $optionArray;

            $session_result = Redis::get('adaptive_session:' . $user_id);
            $sessionResult = json_decode($session_result);

            $aGivenAns = (isset($sessionResult->given_ans->$quest_id->answer) && !empty($sessionResult->given_ans->$quest_id->answer)) ? $sessionResult->given_ans->$quest_id->answer : [];


            $aquestionTakenTime = isset($sessionResult->taken_time_sec->$quest_id) ? $sessionResult->taken_time_sec->$quest_id : 0;

            $view = view('afterlogin.AdaptiveExamChapter.next_adaptive_question', compact('qNo', 'question_data', 'option_data', 'activeq_id', 'next_qid', 'prev_qid', 'last_qid', 'que_sub_id', 'aGivenAns', 'aquestionTakenTime'))->render();

            return response(array('status' => 'success', 'html' => $view));
        } else {
            return response(array('status' => 'failed'));
        }
    }


    public function saveAdaptiveTimeSession(Request $request, $question_id)
    {
        $userData = Session::get('user_data');
        $user_id = $userData->id;

        $question_time = $request->q_time;
        $redis_result = Redis::get('adaptive_session:' . $user_id);

        if (!empty($redis_result)) {
            $redisArray = json_decode($redis_result, true);
            $retrive_array = $redisArray['given_ans'];
            $retrive_time_array = $redisArray['taken_time'];
            $answer_swap_cnt = $redisArray['answer_swap_cnt'];
            $retrive_time_sec = $redisArray['taken_time_sec'];


            $retrive_array[$question_id]['timetaken'] = gmdate('H:i:s', (int)$question_time);

            $retrive_time_sec[$question_id] = (int)$question_time;
            $retrive_time_array[$question_id] = gmdate('H:i:s', $question_time);
        } else {
            $retrive_time_sec = [];
            $retrive_time_array = [];

            $retrive_time_sec[$question_id] = (int)$question_time;
            $retrive_time_array[$question_id] = gmdate('H:i:s', $question_time);
        }

        $redisArray['given_ans'] = $retrive_array;
        $redisArray['taken_time'] = $retrive_time_array;
        $redisArray['answer_swap_cnt'] = $answer_swap_cnt;
        $redisArray['taken_time_sec'] = $retrive_time_sec;


        // Push Value in Redis
        Redis::set('adaptive_session:' . $user_id, json_encode($redisArray));

        $response['status'] = 200;
        $response['message'] = "save response successfully";


        return json_encode($response);
    }

    public function adaptiveClearResponse(Request $request)
    {
        $userData = Session::get('user_data');
        $user_id = $userData->id;
        /* # code... */
        $data = $request->all();
        $question_id = isset($data['question_id']) ? $data['question_id'] : '';
        $option_id = isset($data['option_id']) ? $data['option_id'] : '';

        $redis_result = Redis::get('adaptive_session:' . $user_id);


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
        Redis::set('adaptive_session:' . $user_id, json_encode($redisArray));

        $response['status'] = 200;
        $response['message'] = "save response successfully";


        return json_encode($response);
    }

    public function saveAdaptiveAnswer(Request $request)
    {
        $userData = Session::get('user_data');
        $user_id = $userData->id;
        /* # code... */
        $data = $request->all();
        $question_id = isset($data['question_id']) ? $data['question_id'] : '';
        $option_id = isset($data['option_id']) ? $data['option_id'] : '';
        $q_submit_time = isset($data['q_submit_time']) ? $data['q_submit_time'] : '';

        $redis_result = Redis::get('adaptive_session:' . $user_id);

        if (!empty($redis_result)) {
            $redisArray = json_decode($redis_result, true);
            $retrive_array = $redisArray['given_ans'];
            $retrive_time_array = $redisArray['taken_time'];
            $answer_swap_cnt = $redisArray['answer_swap_cnt'];
            $retrive_time_sec = $redisArray['taken_time_sec'];

            $retrive_time_sec[$question_id] = (int)$q_submit_time;
            //$time_taken = $redisArray['time_taken'] ?? array();
            if (isset($option_id) && $option_id != '') {

                $retrive_array[$question_id]['answer'] = $option_id;
                $retrive_array[$question_id]['timetaken'] = gmdate('H:i:s', (int)$q_submit_time);
                $retrive_array[$question_id]['question_id'] = (int)$question_id;

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
            $retrive_array[$question_id]['attemptCount'] = $answer_swap_cnt[$question_id] + 1;
            $answer_swap_cnt[$question_id] = $answer_swap_cnt[$question_id] + 1;
        } else {
            $answer_swap_cnt[$question_id] = 0;
            $retrive_array[$question_id]['attemptCount'] = 0;
        }

        $redisArray['given_ans'] = $retrive_array;
        $redisArray['taken_time'] = $retrive_time_array;
        $redisArray['answer_swap_cnt'] = $answer_swap_cnt;
        $redisArray['taken_time_sec'] = $retrive_time_sec;


        // Push Value in Redis
        Redis::set('adaptive_session:' . $user_id, json_encode($redisArray));

        $response['status'] = 200;
        $response['message'] = "save response successfully";


        return json_encode($response);
    }

    public function getNextAdpativeQues($session_id, $nextkey, $chapter_id)
    {
        $userData = Session::get('user_data');

        $user_id = $userData->id;
        $exam_id = $userData->grade_id;
        $cacheKey = 'CustomQuestionAdaptive:all:' . $user_id;
        $redis_result = Redis::get($cacheKey);
        $redisQuestionArray = json_decode($redis_result);

        $session_result = Redis::get('adaptive_session:' . $user_id);
        $sessionResult = json_decode($session_result);
        $questionList = isset($sessionResult->all_questions_id) ? $sessionResult->all_questions_id : [];
        $answerList = isset($sessionResult->given_ans) ? (array)$sessionResult->given_ans : [];


        $inputjson['student_id'] = (int)$user_id;
        $inputjson['exam_id'] = (int)$exam_id;
        $inputjson['chapter_id'] = (int)$chapter_id;
        $inputjson['session_id'] = (int)$session_id;
        $inputjson['end_test'] = "no";
        $inputjson['questions_list'] = array_values($questionList);
        $inputjson['answerList'] = array_values($answerList);

        $request = json_encode($inputjson);


        $curl_url = "";
        $curl = curl_init();
        $api_URL = env('API_URL');

        $curl_url = $api_URL . 'api/adaptive-assessment-chapter-practice';

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

        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $responsedata = json_decode($response_json);
        $res_status = isset($responsedata->success) ? $responsedata->success : false;
        $res_questions = isset($responsedata->questions) ? $responsedata->questions : [];

        if ($res_status == true && !empty($res_questions)) {
            if (Redis::exists('adaptive_session:' . $user_id)) {
                Redis::del(Redis::keys('adaptive_session:' . $user_id));

                $questions_count = count($res_questions);
                $newQuestions = collect($res_questions);

                $question_ids = $newQuestions->pluck('question_id')->values()->all();

                $retrive_array = $retrive_time_array = $retrive_time_sec = $answer_swap_cnt = [];
                $redis_data = [
                    'given_ans' => $retrive_array,
                    'taken_time' => $retrive_time_array,
                    'taken_time_sec' => $retrive_time_sec,
                    'answer_swap_cnt' => $answer_swap_cnt,
                    'questions_count' => $questions_count,
                    'all_questions_id' => $question_ids,

                ];

                // Push Value in Redis
                Redis::set('adaptive_session:' . $user_id, json_encode($redis_data));
            }

            $nArray = array_merge($redisQuestionArray, $res_questions);

            $allQuestionDetails = $this->adaptiveCustomQlist($user_id, $nArray, 'True');
            $next_question_data = isset($allQuestionDetails[$nextkey]) ? $allQuestionDetails[$nextkey] : []; // required question all data

            return $next_question_data;
        } else {

            return [];
        }
    }
}
