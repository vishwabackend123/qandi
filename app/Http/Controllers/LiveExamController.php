<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserAnalytics;
use App\Models\StudentPreference;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\CommonTrait;


class LiveExamController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function exam_login(Request $request)
    {

        return view('afterlogin.LiveExam.exam_login');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function live_exam(Request $request)
    {
        return view('afterlogin.LiveExam.live_exam');
    }
}
