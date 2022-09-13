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
 * PreviousYearExamController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 */
class PreviousYearExamController extends Controller
{
    use CommonTrait;


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
     * Index
     *
     * @return void
     */
    public function index()
    {
        try {
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            $curl_url = "";
            $curl = curl_init();
            $api_URL = env('API_URL');

            $curl_url = $api_URL . 'api/previous-year-papers/' . $exam_id . '/' . $user_id;

            curl_setopt_array($curl, array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 120,
                CURLOPT_TIMEOUT => 120,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/json",
                    "Authorization: Bearer " . $this->getAccessToken()
                ),
            ));

            $response_json = curl_exec($curl);


            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode == 200 || $httpcode == 201) {
                $response_data = (array)(json_decode($response_json));
                $upcomming_live_exam = isset($response_data['paper-list']) ? $response_data['paper-list'] : [];
                foreach ($upcomming_live_exam as $key => $value) {
                    if ($value->test_completed_yn == 'Y') {
                        unset($upcomming_live_exam[$key]);
                    }
                }
                $collection = collect($upcomming_live_exam);

                $unique = $collection->unique('paper_year');
                $years_list = $unique->pluck('paper_year');
                $years_list->all();
                $header_title = "Previous Year Exam";
                return view('afterlogin.PreviousYearExam.index', compact('upcomming_live_exam', 'years_list', 'header_title'));
            } else {
                return Redirect::back()->withErrors(['There is some error  for this result id.']);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    /**
     * Previous Year Exam
     *
     * @param Request $request recieve the body request data
     *
     * @return void
     */
    public function previousYearExam(Request $request, $inst = '')
    {
        try {
            $header_title = "Previous Year Exam";
            $filtered_subject = [];
            $userData = Session::get('user_data');

            $user_id = $userData->id;
            $exam_id = $userData->grade_id;
            if (Redis::exists('custom_answer_time_' . $user_id)) {
                Redis::del(Redis::keys('custom_answer_time_' . $user_id));
            }


            $paper_id = isset($request->paper_id) ? $request->paper_id : '';


            $pyCacheKey = 'PreviousYearExam:' . $user_id;
            if ($inst == 'instruction') {
                if (Redis::exists($pyCacheKey)) {
                    Redis::del($pyCacheKey);
                }
            }

            if (Redis::exists($pyCacheKey)) {
                $response_json = Redis::get($pyCacheKey);
                $paper_id = Session::get('paper_id');
            } else {




                $curl_url = "";
                $curl = curl_init();
                $api_URL = env('API_URL');

                $curl_url = $api_URL . 'api/previous-year-question-paper/' . $paper_id;
                $curl_option = array(
                    CURLOPT_URL => $curl_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FAILONERROR => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 360,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",

                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/json",
                        "Authorization: Bearer " . $this->getAccessToken()

                    ),
                );
                curl_setopt_array($curl, $curl_option);
                $response_json = curl_exec($curl);

                $err = curl_error($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                Redis::set($pyCacheKey, $response_json);
                Session::put('paper_id', $paper_id);
            }

            $responsedata = json_decode($response_json);

            $response_status = isset($responsedata->success) ? $responsedata->success : false;

            if ($response_status == true) {
                $aQuestions_list = isset($responsedata->questions) ? $responsedata->questions : [];

                $aSections = isset($responsedata->sections) ? $responsedata->sections : [];
                $exam_fulltime = $responsedata->time_allowed ?? '';
                //$exam_ques_count = $questions_count = count($aQuestions_list);
                $exam_ques_count = $questions_count = isset($responsedata->total_ques) ? $responsedata->total_ques : 0;
                $total_marks  = isset($responsedata->total_marks) ? $responsedata->total_marks : 0;


                $exam_name = isset($responsedata->paper_details[0]->paper_name) ? $responsedata->paper_details[0]->paper_name : '';
            } else {
                $aQuestions_list = $aSections = [];
                $questions_count = 0;
                $exam_fulltime = 0;
                $total_marks = 0;
                return Redirect::back()->withErrors(["question isn't available for this exam ."]);
            }
            $exam_ques_count = $questions_count;

            $redis_set = 'True';

            // $exam_fulltime = (isset($exam_fulltime) && !empty($exam_fulltime)) ? $exam_fulltime : $questions_count  * 60;
            $sort = array();


            foreach ($aQuestions_list as $k => $v) {
                $sort['subject_id'][$k] = $v->subject_id;
                $sort['section_id'][$k] = $v->section_id;
            }

            // sort by subject_id desc and then title asc
            array_multisort($sort['subject_id'], SORT_ASC, $sort['section_id'], SORT_ASC, $aQuestions_list);

            $collection = collect($aQuestions_list);

            /*  $aQuestionslist = $collection->sortBy('subject_id'); */
            $aQuestionslist = $collection;

            $subject_ids = $collection->pluck('subject_id');




            $subject_list = $subject_ids->unique()->values()->all();

            $redis_subjects = $this->redis_subjects();
            $cSubjects = collect($redis_subjects);
            $aTargets = $aSectionSub = $aSubSecCount = $aSubIds = [];
            $filtered_subject = $cSubjects->whereIn('id', $subject_list)->all();
            foreach ($filtered_subject as $sub) {
                $count_arr = $collection->where('subject_id', $sub->id)->all();
                $aSubIds[] = $sub->id;
                $sub->count = count($count_arr);
                $aTargets[] = $sub->subject_name;
                $aSectionIds = $collection->where('subject_id', $sub->id)->pluck('section_id');
                $aSectionSub[$sub->id] = $aSectionIds->unique()->values()->all();
                foreach ($aSections as $secK => $secV) {
                    $countSecQ = $collection->where('subject_id', $sub->id)->where('section_id', $secV->id)->count();
                    $aSubSecCount[$sub->id][$secV->id] = $countSecQ;
                }
            }


            $allQuestions = $aQuestionslist->keyBy('question_id');


            $aQuestions_list = $aQuestionslist->values()->all();

            $allQuestionDetails = $this->allCustomQlist($user_id, $allQuestions->all(), $redis_set);

            $keys = $allQuestions->keys('question_id')->all();

            $question_data = current($aQuestions_list);
            $activeq_id = isset($question_data->question_id) ? $question_data->question_id : '';
            $activesub_id = isset($question_data->subject_id) ? $question_data->subject_id : '';
            $nextquestion_data = next($aQuestions_list);
            $next_qid = isset($nextquestion_data->question_id) ? $nextquestion_data->question_id : '';
            $prev_qid = '';

            if (isset($question_data) && !empty($question_data)) {
                $qs_id = $question_data->question_id;

                $option_ques = $question_data->question_options;

                $tempdata = json_decode($option_ques, true);
                $opArr = [];
                if (isset($tempdata) && is_array($tempdata)) {
                    foreach ($tempdata as $key => $option) {
                        $opArr[$key] = $option;
                    }
                }

                $optionArray = $opArr;
                $option_data = $optionArray;
            } else {
                $option_data[] = '';
            }
            $tagrets = implode(', ', $aTargets);
            $test_type = 'PreviousYear';
            $exam_type = 'PT';
            $exam_mode = 'Practice';

            if (isset($inst) && $inst == 'instruction') {

                /* set redis for save exam question response */
                $retrive_array = $retrive_time_array = $retrive_time_sec = $answer_swap_cnt = $attempt_sub_section_cnt =  [];
                $redis_data = [
                    'given_ans' => $retrive_array,
                    'taken_time' => $retrive_time_array,
                    'taken_time_sec' => $retrive_time_sec,
                    'answer_swap_cnt' => $answer_swap_cnt,
                    'questions_count' => $questions_count,
                    'all_questions_id' => $keys,
                    'full_time' => $exam_fulltime,
                    'section_data' => $aSections,
                    'attempt_count' => $attempt_sub_section_cnt,
                    'aSectionSub' => $aSectionSub,
                    'aSubSecCount' => $aSubSecCount,
                    'aSubjectIds' => $aSubIds,
                ];


                // Push Value in Redis
                Redis::set('custom_answer_time_' . $user_id, json_encode($redis_data));
                $exam_url = route('previousYearExam');

                $exam_title = "Previous Year Test";



                return view('afterlogin.MockExam.mock_exam_instruction', compact('exam_url', 'exam_name', 'questions_count', 'tagrets', 'exam_fulltime', 'total_marks', 'filtered_subject', 'exam_title', 'header_title', 'aSections'));
            }



            //Session::put('exam_name', $exam_name);
            Redis::set('exam_name' . $user_id, $exam_name);
            Redis::set('test_type' . $user_id, $test_type);
            return view('afterlogin.PreviousYearExam.previousYearExam', compact('filtered_subject', 'tagrets', 'question_data', 'option_data', 'keys', 'activeq_id', 'next_qid', 'prev_qid', 'questions_count', 'exam_fulltime', 'exam_ques_count', 'exam_name', 'activesub_id', 'test_type', 'exam_type', 'aSections', 'aSectionSub', 'aSubSecCount', 'total_marks', 'exam_mode', 'paper_id', 'header_title'));
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }
}
