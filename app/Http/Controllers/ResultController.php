<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    //
    public function exam_result(Request $request)
    {
        return view('afterlogin.ExamCustom.exam_result');
    }
}
