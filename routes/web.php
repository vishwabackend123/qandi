<?php

/* use AWS\CRT\HTTP\Request; */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::any('/', function () {
    /*  if (isset(Auth::user()->id) && !empty(Auth::user()->id)) {
        return Redirect()->route('dashboard');
    } else {
        //                 return view('index'); */
    /* $landing_URL = env('LANDING_URL');
    return redirect($landing_URL); */
    return Redirect()->route('login');
    /*  } */
});

Route::any('/logout', function (Request $request) {
    //return view('index');
    $request->session()->flush();
    return Redirect()->route('login');
    /*  $landing_URL = env('LANDING_URL');
    return redirect($landing_URL); */
});



if (env('STUDENT_ENV') != 'prod') {
    Route::get(
        '/clear-cache',
        function () {
            Artisan::call('cache:clear');
            return "Cache is cleared";
        }
    );
    Route::get(
        '/clear-redis',
        function () {
            Redis::flushDB();
            return "Redis is cleared";
        }
    );
}

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware('auth', 'menu');
Route::any('/dailyWelcomeUpdates', [App\Http\Controllers\HomeController::class, 'dailyWelcomeUpdates'])->name('dailyWelcomeUpdates');
Route::any('/editProfile', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('editProfile');
Route::any('/editProfileImage', [App\Http\Controllers\HomeController::class, 'editProfileImage'])->name('editProfileImage');
Route::any('/saveFcmToken', [App\Http\Controllers\HomeController::class, 'saveFcmToken'])->name('saveFcmToken');

/* Home Controller Routes */
Route::any('/studentstandfor', [App\Http\Controllers\HomeController::class, 'studentStand'])->name('studentstandfor')->middleware('auth', 'menu');
Route::any('/standupstore', [App\Http\Controllers\HomeController::class, 'storeStandValue'])->name('standupstore')->middleware('auth', 'menu');

/* login routes */
Route::any('/sendotplogin', [App\Http\Controllers\StudentSignInController::class, 'sendotplogin'])->name('sendotplogin');
Route::any('/verifyotplogin', [App\Http\Controllers\StudentSignInController::class, 'verifyotplogin'])->name('verifyotplogin');

/* registration  routes */
Route::any('/sendotpsignup', [App\Http\Controllers\StudentSignInController::class, 'sendotpsignup'])->name('sendotpsignup');
Route::any('/verifyOtpRegister', [App\Http\Controllers\StudentSignInController::class, 'verifyOtpRegister'])->name('verifyOtpRegister');

/* Dashboard controller */
//Route::any('/Dashboard', [App\Http\Controllers\DaController::class, 'verifyotplogin'])->name('dashboard');

/* Subscriptions  routes */
Route::any('/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions')->middleware('menu');
Route::any('/trial_subscription/{package_id}/{exam_year}/{exam_id}', [App\Http\Controllers\SubscriptionController::class, 'trialSubscription'])->name('trial_subscription')->middleware('auth');
Route::any('/checkout', [App\Http\Controllers\SubscriptionController::class, 'checkout'])->name('checkout')->middleware('auth');

Route::post('razorpay-payment', [App\Http\Controllers\RazorpayController::class, 'store'])->name('razorpay.payment.store')->middleware('auth');


/* ExamCustom Controller Routs */
Route::get('/exam_custom/{filter?}', [App\Http\Controllers\ExamCustomController::class, 'index'])->name('exam_custom')->middleware('auth', 'menu');
Route::any('/custom_exam', [App\Http\Controllers\ExamCustomController::class, 'subjectExam'])->name('custom_exam')->middleware('auth', 'menu');
Route::any('/ajax_next_question/{ques_id}', [App\Http\Controllers\ExamCustomController::class, 'ajaxNextQuestion'])->name('ajax_next_question')->middleware('auth', 'menu');
Route::any('/ajax_next_subject_question/{subject_id}', [App\Http\Controllers\ExamCustomController::class, 'ajaxNextSubjectQuestion'])->name('ajax_next_subject_question')->middleware('auth', 'menu');
Route::any('/saveAnswer', [App\Http\Controllers\ExamCustomController::class, 'saveAnswer'])->name('saveAnswer')->middleware('auth', 'menu');
Route::any('/clearResponse', [App\Http\Controllers\ExamCustomController::class, 'clearResponse'])->name('clearResponse')->middleware('auth', 'menu');
Route::any('/ajax_custom_topic/{chapt_id}', [App\Http\Controllers\ExamCustomController::class, 'chaptersTopic'])->name('ajax_custom_topic')->middleware('auth', 'menu');
Route::any('/ajax_chapter_list/{subject_id}', [App\Http\Controllers\ExamCustomController::class, 'ajaxChapterList'])->name('ajax_chapter_list')->middleware('auth', 'menu');
Route::any('/filter_subject_chapter/{subject_id}', [App\Http\Controllers\ExamCustomController::class, 'filterSubjectChapter'])->name('filter_subject_chapter')->middleware('auth', 'menu');


/* Review Controller Routs */
Route::any('/exam_review/{result_id}/{pageName?}', [App\Http\Controllers\ReviewController::class, 'getReview'])->name('exam_review')->middleware('auth', 'menu');
Route::any('/next_review_question/{question_id}', [App\Http\Controllers\ReviewController::class, 'nextReviewQuestion'])->name('next_review_question')->middleware('auth', 'menu');
Route::any('/ajax_review_next_subject_question/{subject_id}', [App\Http\Controllers\ReviewController::class, 'ajaxReviewNextSubjectQuestion'])->name('ajax_review_next_subject_question')->middleware('auth', 'menu');
Route::any('/filter_review_question/{filter}', [App\Http\Controllers\ReviewController::class, 'filterReviewQuestion'])->name('filter_review_question')->middleware('auth', 'menu');

/* Review Controller Routs */
Route::any('/exam_result', [App\Http\Controllers\ResultController::class, 'examResult'])->name('exam_result')->middleware('auth', 'menu');
/* Route::any('/exam_result_analysis', [App\Http\Controllers\ResultController::class, 'exam_post_analysis'])->name('exam_result_analysis')->middleware('auth', 'menu');
 */
Route::any('/exam_result_analysis_score', [App\Http\Controllers\ResultController::class, 'examPostAnalysisScore'])->name('exam_result_analysis_score')->middleware('auth', 'menu');
Route::any('/exam_result_analysis_attempt', [App\Http\Controllers\ResultController::class, 'examPostAnalysisAttempt'])->name('exam_result_analysis_attempt')->middleware('auth', 'menu');
Route::any('/exam_result_analysis_rank', [App\Http\Controllers\ResultController::class, 'examPostAnalysisRank'])->name('exam_result_analysis_rank')->middleware('auth', 'menu');



/* Book Mark routes */
Route::any('/markforreview', [App\Http\Controllers\BookmarkController::class, 'addbookmark'])->name('markforreview')->middleware('auth', 'menu');


/* Full exam Controller Routes */
Route::any('/exam/{full_exam}', [App\Http\Controllers\FullExamController::class, 'exam'])->name('exam')->middleware('auth', 'menu');
Route::any('/next_question/{ques_id}', [App\Http\Controllers\FullExamController::class, 'nextQuestion'])->name('next_question')->middleware('auth', 'menu');
Route::any('/next_subject_question/{subject_id}', [App\Http\Controllers\FullExamController::class, 'nextSubjectQuestion'])->name('next_subject_question')->middleware('auth', 'menu');
Route::any('/examresult', [App\Http\Controllers\FullExamController::class, 'exam_result'])->name('examresult')->middleware('auth', 'menu');
Route::any('/examreview', [App\Http\Controllers\FullExamController::class, 'examReview'])->name('examreview')->middleware('auth', 'menu');


/* Full exam Controller Routes */
Route::any('/preparation_center', [App\Http\Controllers\PreparationController::class, 'preparationCenter'])->name('preparation_center')->middleware('auth', 'menu');
Route::any('/download_exampaper', [App\Http\Controllers\PreparationController::class, 'downloadExampaper'])->name('download_exampaper')->middleware('auth', 'menu');
Route::any('/preparation_center_subject', [App\Http\Controllers\PreparationController::class, 'preparationCenterSubject'])->name('preparation_center_subject')->middleware('auth', 'menu');
Route::any('/presentations_chapter', [App\Http\Controllers\PreparationController::class, 'presentationsChapter'])->name('presentations_chapter')->middleware('auth', 'menu');
Route::any('/videos_chapter', [App\Http\Controllers\PreparationController::class, 'videosChapter'])->name('videos_chapter')->middleware('auth', 'menu');
Route::any('/notes_chapter', [App\Http\Controllers\PreparationController::class, 'notesChapter'])->name('notes_chapter')->middleware('auth', 'menu');
Route::any('/preparation_center_chapter', [App\Http\Controllers\PreparationController::class, 'preparation_center_chapter'])->name('preparation_center_chapter')->middleware('auth', 'menu');
Route::any('/bookmarks_chapter', [App\Http\Controllers\PreparationController::class, 'bookmarksChapter'])->name('bookmarks_chapter')->middleware('auth', 'menu');
Route::any('/review_bookmarks', [App\Http\Controllers\PreparationController::class, 'getReviewBookmarks'])->name('review_bookmarks')->middleware('auth', 'menu');
Route::any('/next_review_questionbookmark/{question_id}', [App\Http\Controllers\PreparationController::class, 'nextReviewQuestionbookmark'])->name('next_review_questionbookmark')->middleware('auth', 'menu');
Route::any('/ajax_review_next_subject_questionbookmark/{question_id}', [App\Http\Controllers\PreparationController::class, 'ajaxReviewNextSubjectQuestionbookmark'])->name('ajax_review_next_subject_questionbookmark')->middleware('auth', 'menu');
Route::any('/get_chapter_wise_data', [App\Http\Controllers\PreparationController::class, 'getChapterWiseData'])->name('get_chapter_wise_data')->middleware('auth', 'menu');


/* about Exam Controller Routes */

Route::any('/about_exam', [App\Http\Controllers\AboutExamController::class, 'aboutExam'])->name('about_exam')->middleware('auth', 'menu');
Route::any('/eligibility_criteria', [App\Http\Controllers\AboutExamController::class, 'eligibilityCriteria'])->name('eligibility_criteria')->middleware('auth', 'menu');


/* preLoginController */
Route::any('/aboutexam', [App\Http\Controllers\PreLoginController::class, 'preAboutExam'])->name('aboutexam');
Route::any('/faq', [App\Http\Controllers\PreLoginController::class, 'userFeedback'])->name('faq');

/* Live Exam Controller Routes */

Route::any('/live_exam_login', [App\Http\Controllers\LiveExamController::class, 'examLogin'])->name('live_exam_login')->middleware('auth', 'menu');
Route::any('/live_exam_list', [App\Http\Controllers\LiveExamController::class, 'liveExamList'])->name('live_exam_list')->middleware('auth', 'menu');
Route::any('/live_exam/{id}', [App\Http\Controllers\LiveExamController::class, 'liveExam'])->name('live_exam')->middleware('auth', 'menu');
Route::any('/live_exam_result/{result_id}', [App\Http\Controllers\LiveExamController::class, 'liveExamResult'])->name('live_exam_result')->middleware('auth', 'menu');


/* AnalyticsController Routes */

Route::any('/overall_analytics/{activeid?}', [App\Http\Controllers\AnalyticsController::class, 'overallAnalytics'])->name('overall_analytics')->middleware('auth', 'menu');
Route::any('/export_analytics', [App\Http\Controllers\AnalyticsController::class, 'exportAnalytics'])->name('export_analytics')->middleware('auth', 'menu');
Route::any('/tutorials_session', [App\Http\Controllers\AnalyticsController::class, 'tutorialsSession'])->name('tutorials_session')->middleware('auth', 'menu');
Route::any('/tutorials_signup/{t_id}', [App\Http\Controllers\AnalyticsController::class, 'tutorialsSignup'])->name('tutorials_signup')->middleware('auth', 'menu');

/* TestSeries Routes */
Route::any('/series_list', [App\Http\Controllers\TestSeriesController::class, 'seriesList'])->name('series_list')->middleware('auth', 'menu');
Route::any('/test_series', [App\Http\Controllers\TestSeriesController::class, 'testSeriesExam'])->name('test_series')->middleware('auth', 'menu');

/* Referal Controller Routes */
Route::any('/store_referral', [App\Http\Controllers\ReferralController::class, 'storeReferralFriend'])->name('store_referral')->middleware('auth', 'menu');
Route::any('referral/{referral_code}', [App\Http\Controllers\ReferralController::class, 'referralSignup'])->name('referral_signup');

//google login Start

Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);
//google login End

//facebook login start
Route::get('auth/facebook', [App\Http\Controllers\Auth\FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [App\Http\Controllers\Auth\FacebookController::class, 'handleFacebookCallback']);
//facebook login end
Route::any('/next_tab/{sub_id}', [App\Http\Controllers\AnalyticsController::class, 'nextTab'])->name('next_tab')->middleware('auth', 'menu');


/* Planner Controller Routs */
Route::any('/addPlanner', [App\Http\Controllers\PlannerController::class, 'addPlanner'])->name('addPlanner')->middleware('auth', 'menu');
Route::any('/weekly_exams', [App\Http\Controllers\PlannerController::class, 'weeklyExams'])->name('weekly_exams')->middleware('auth', 'menu');
Route::any('/planner_exam/{planner_id}/{chapter_id}', [App\Http\Controllers\PlannerController::class, 'plannerExam'])->name('planner_exam')->middleware('auth', 'menu');
Route::any('/shuffle_chapter/{subject_id}', [App\Http\Controllers\PlannerController::class, 'shuffleChapter'])->name('shuffle_chapter')->middleware('auth', 'menu');
Route::any('/getWeeklyPlanSchedule', [App\Http\Controllers\PlannerController::class, 'getWeeklyPlanSchedule'])->name('getWeeklyPlanSchedule')->middleware('auth', 'menu');


/**
 * Assessment Exam Controller Routes
 */

Route::any('/assessment_exam', [App\Http\Controllers\AssessmentExamController::class, 'assessmentExam'])->name('assessment_exam')->middleware('auth', 'menu');
/* Route::any('/saveQuestionTimeSession/{qid}', [App\Http\Controllers\AssessmentExamController::class, 'saveQuestionTimeSession'])->name('saveQuestionTimeSession')->middleware('auth', 'menu'); */
Route::any('/searchFreind', [App\Http\Controllers\HomeController::class, 'searchFriendWithKeyWord'])->name('searchFriendWithKeyWord')->middleware('auth', 'menu');
Route::any('/saveQuestionTimeSession/{qid}', [App\Http\Controllers\ExamCustomController::class, 'saveQuestionTimeSession'])->name('saveQuestionTimeSession')->middleware('auth', 'menu');

/* routes for adptive chapter_exam */
Route::any('/custom_exam_chapter', [App\Http\Controllers\ExamCustomController::class, 'chapterAdaptiveExam'])->name('custom_exam_chapter')->middleware('auth', 'menu');
Route::any('/ajax_adaptive_question_chapter/{nkey}', [App\Http\Controllers\ExamCustomController::class, 'ajaxAdaptiveQuestionChapter'])->name('ajax_adaptive_question_chapter')->middleware('auth', 'menu');
Route::any('/saveAdaptiveTimeSession/{qid}', [App\Http\Controllers\ExamCustomController::class, 'saveAdaptiveTimeSession'])->name('saveAdaptiveTimeSession')->middleware('auth', 'menu');
Route::any('/adaptiveClearResponse', [App\Http\Controllers\ExamCustomController::class, 'adaptiveClearResponse'])->name('adaptiveClearResponse')->middleware('auth', 'menu');
Route::any('/saveAdaptiveAnswer', [App\Http\Controllers\ExamCustomController::class, 'saveAdaptiveAnswer'])->name('saveAdaptiveAnswer')->middleware('auth', 'menu');


/* routes for adptive chapter_exam */
Route::any('/custom_exam_topic', [App\Http\Controllers\AdpativeExamController::class, 'topicAdaptiveExam'])->name('custom_exam_topic')->middleware('auth', 'menu');
Route::any('/ajax_adaptive_question_topic/{nkey}', [App\Http\Controllers\AdpativeExamController::class, 'ajaxAdaptiveQuestionTopic'])->name('ajax_adaptive_question_topic')->middleware('auth', 'menu');
Route::any('/adaptive_topic_exam_result', [App\Http\Controllers\AdpativeExamController::class, 'adaptiveTopicExamResult'])->name('adaptive_topic_exam_result')->middleware('auth', 'menu');
Route::any('/adaptive_chapter_exam_result', [App\Http\Controllers\AdpativeExamController::class, 'adaptiveChapterExamResult'])->name('adaptive_chapter_exam_result')->middleware('auth', 'menu');

Route::any('/clear-all-notifications', [App\Http\Controllers\HomeController::class, 'clearAllNotifications'])->name('clearAllNotifications')->middleware('auth', 'menu');
Route::any('/refresh-notifications', [App\Http\Controllers\HomeController::class, 'refreshNotification'])->name('refresh-notifications')->middleware('auth');


Route::any('/adaptive_exam', [App\Http\Controllers\AdpativeExamController::class, 'adaptiveMockExam'])->name('adaptive_mock_exam')->middleware('auth', 'menu');
Route::any('/adaptive_next_question/{ques_id}', [App\Http\Controllers\AdpativeExamController::class, 'adaptiveNextQuestion'])->name('adaptive_next_question')->middleware('auth', 'menu');
Route::any('/adaptive_next_subject_question/{subject_id}', [App\Http\Controllers\AdpativeExamController::class, 'adaptiveNextSubjectQuestion'])->name('adaptive_next_subject_question')->middleware('auth', 'menu');

Route::any('/refund_form', [App\Http\Controllers\SubscriptionController::class, 'refundForm'])->name('refund_form')->middleware('auth', 'menu');
Route::any('/refund_form_submit', [App\Http\Controllers\SubscriptionController::class, 'refundFormSubmit'])->name('refund_form_submit')->middleware('auth', 'menu');

/* Adaptive chapter wise planner route */
Route::any('/plannerExam/{planner_id}', [App\Http\Controllers\PlannerController::class, 'plannerAdaptiveExam'])->name('plannerExam')->middleware('auth', 'menu');
Route::any('/planner_exam_result', [App\Http\Controllers\AdpativeExamController::class, 'adaptiveChapterExamResult'])->name('planner_exam_result')->middleware('auth', 'menu');



/* registration  routes */
Route::any('/getCountry', [App\Http\Controllers\StudentSignInController::class, 'countryList'])->name('getCountry');
Route::any('/getState', [App\Http\Controllers\StudentSignInController::class, 'stateList'])->name('getState');
Route::any('/getCity', [App\Http\Controllers\StudentSignInController::class, 'cityList'])->name('getCity');
Route::any('/signupAddress', [App\Http\Controllers\StudentSignInController::class, 'signupAddress'])->name('signupAddress');
Route::any('/searchCity', [App\Http\Controllers\StudentSignInController::class, 'searchCity'])->name('searchCity');




/* Topic analytics route  */
Route::any('/topic-analytics/{sub_id}', [App\Http\Controllers\AnalyticsController::class, 'topicAnalyticsList'])->name('topic-analytics')->middleware('auth', 'menu');

/* discount code  */
Route::any('/ajax_validate_coupon_code', [App\Http\Controllers\SubscriptionController::class, 'validatDiscountCode'])->middleware('auth');
/*exam history */
Route::any('/get_exam_result_analytics/{result_id}', [App\Http\Controllers\ResultController::class, 'getExamResultAnalytics'])->name('get_exam_result_analytics')->middleware('auth', 'menu');


/* mock exam Routes */
Route::any('/mock_exam', [App\Http\Controllers\MockExamController::class, 'mockExam'])->name('mockExam')->middleware('auth', 'menu');
Route::any('/mock_next_question/{ques_id}', [App\Http\Controllers\MockExamController::class, 'mockNextQuestion'])->name('mockNextQuestion')->middleware('auth', 'menu');
Route::any('/mock_next_subject_question/{subject_id}/{sec_id?}', [App\Http\Controllers\MockExamController::class, 'mockNextSubjectQuestion'])->name('mockNextSubjectQuestion')->middleware('auth', 'menu');
Route::any('/mock_next_sub_sec_question/{sub_id}/{sec_id}', [App\Http\Controllers\MockExamController::class, 'adaptive_next_subject_question'])->name('adaptive_next_subject_question')->middleware('auth', 'menu');

Route::any('/exam_result_analytics/{result_id}', [App\Http\Controllers\ResultController::class, 'examResultAnalytics'])->name('exam_result_analytics')->middleware('auth', 'menu');

Route::any('/previous_year_exam', [App\Http\Controllers\PreviousYearExamController::class, 'index'])->name('previous_year_exam')->middleware('auth', 'menu');
Route::any('/previousYearExam', [App\Http\Controllers\PreviousYearExamController::class, 'previousYearExam'])->name('previousYearExam')->middleware('auth', 'menu');

Route::any('/chapter-analytics/{sub_id}', [App\Http\Controllers\AnalyticsController::class, 'chapterAnalyticsList'])->name('topic-analytics')->middleware('auth', 'menu');
Route::any('/ajax_exam_result_list/{exam_type}', [App\Http\Controllers\ResultController::class, 'ajaxExamResultList'])->middleware('auth', 'menu');

Route::any('/mockExamTest', [App\Http\Controllers\MockExamController::class, 'mockExam'])->name('mockExamTest')->middleware('auth', 'menu');



/* dashboard dailytask exam new routes */

Route::get('/dashboard-DailyTask', [App\Http\Controllers\HomeController::class, 'dailytask'])->name('dashboard-DailyTask')->middleware('auth', 'menu');
Route::get('/dashboard-MyQMatrix', [App\Http\Controllers\HomeController::class, 'myQMatrix'])->name('dashboard-MyQMatrix')->middleware('auth', 'menu');
Route::any('/DailyTask-exam/{category}/{tasktype}', [App\Http\Controllers\HomeController::class, 'dailyTaskExam'])->name('dailyTaskExam')->middleware('auth', 'menu');
Route::any('/DailyTask-Skill-Exam/{category}/{tasktype}/{skill_category}', [App\Http\Controllers\HomeController::class, 'dailyTaskExam'])->name('dailyTaskExamSkill')->middleware('auth', 'menu');
