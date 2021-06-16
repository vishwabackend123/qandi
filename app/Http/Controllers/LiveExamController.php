<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
