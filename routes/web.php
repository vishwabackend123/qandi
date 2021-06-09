<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware('auth', 'menu');
Route::any('/dailyWelcomeUpdates', [App\Http\Controllers\HomeController::class, 'dailyWelcomeUpdates'])->name('dailyWelcomeUpdates');

/* Home Controller Routes */
Route::any('/studentstandfor', [App\Http\Controllers\HomeController::class, 'student_stand'])->name('studentstandfor');
Route::any('/standupstore', [App\Http\Controllers\HomeController::class, 'store_stand_value'])->name('standupstore');

/* login routes */
Route::any('/sendotplogin', [App\Http\Controllers\StudentSignInController::class, 'sendotplogin'])->name('sendotplogin');
Route::any('/verifyotplogin', [App\Http\Controllers\StudentSignInController::class, 'verifyotplogin'])->name('verifyotplogin');

/* registration  routes */
Route::any('/sendotpsignup', [App\Http\Controllers\StudentSignInController::class, 'sendotpsignup'])->name('sendotpsignup');
Route::any('/verifyOtpRegister', [App\Http\Controllers\StudentSignInController::class, 'verifyOtpRegister'])->name('verifyOtpRegister');

/* Dashboard controller */
//Route::any('/Dashboard', [App\Http\Controllers\DaController::class, 'verifyotplogin'])->name('dashboard');

/* Subscriptions  routes */
Route::any('/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions');
Route::any('/trial_subscription/{package_id}', [App\Http\Controllers\SubscriptionController::class, 'trial_subscription'])->name('trial_subscription');
Route::any('/checkout', [App\Http\Controllers\SubscriptionController::class, 'checkout'])->name('checkout');

Route::post('razorpay-payment', [App\Http\Controllers\RazorpayController::class, 'store'])->name('razorpay.payment.store');


/* ExamCustom Controller Routs */
Route::get('/exam_custom', [App\Http\Controllers\ExamCustomController::class, 'index'])->name('exam_custom')->middleware('auth', 'menu');
Route::any('/subject_exam', [App\Http\Controllers\ExamCustomController::class, 'subject_exam'])->name('subject_exam')->middleware('auth', 'menu');
Route::any('/ajax_next_question/{ques_id}', [App\Http\Controllers\ExamCustomController::class, 'ajax_next_question'])->name('ajax_next_question')->middleware('auth', 'menu');
Route::any('/saveAnswer', [App\Http\Controllers\ExamCustomController::class, 'saveAnswer'])->name('saveAnswer')->middleware('auth', 'menu');


/* Review Controller Routs */
Route::any('/exam_review/{result_id}', [App\Http\Controllers\ReviewController::class, 'getReview'])->name('exam_review')->middleware('auth', 'menu');
Route::any('/next_review_question/{question_id}', [App\Http\Controllers\ReviewController::class, 'next_review_question'])->name('next_review_question')->middleware('auth', 'menu');


/* Review Controller Routs */
Route::post('/exam_result', [App\Http\Controllers\ResultController::class, 'exam_result'])->name('exam_result')->middleware('auth', 'menu');



/* Book Mark routes */
Route::post('/markforreview', [App\Http\Controllers\BookmarkController::class, 'addbookmark'])->name('markforreview')->middleware('auth', 'menu');
