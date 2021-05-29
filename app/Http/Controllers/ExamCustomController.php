<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamCustomController extends Controller
{
    public function index(Request $request)
    {
        return view('afterlogin.ExamCustom.exam_custom');
    }




    public function subject_exam(Request $request)
    {
        return view('afterlogin.ExamCustom.exam');
    }
}
