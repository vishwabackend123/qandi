<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutExamController extends Controller
{
    //

    public function about_exam()
    {
        return view('afterlogin.ExamDetails.about_exam');
    }



    public function eligibility_criteria()
    {
        return view('afterlogin.ExamDetails.exam_criteria');
    }
}
