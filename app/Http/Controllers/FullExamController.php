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

class FullExamController extends Controller
{
    //

    public function exam(Request $request, $exam_name)
    {

        if ($exam_name == 'full_exam') {
            $exam_name = 'Full Exam';
        } else {
            $exam_name = 'Mock Test';
        }

        $exam_fulltime = 5400;
        $exam_ques_count = 90;


        return view('afterlogin.ExamViews.exam', compact('exam_name', 'exam_fulltime', 'exam_ques_count'));
    }

    function exam_result()
    {

        return view('afterlogin.ExamViews.resultview');
    }

    function exam_review()
    {
        return view('afterlogin.ExamViews.review');
    }
}
