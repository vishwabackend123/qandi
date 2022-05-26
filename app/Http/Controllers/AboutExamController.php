<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

    /**
     * This is about exam conroller.
     */
class AboutExamController extends Controller
{
    /**
     * This function used for about exam page .
     *
     * No paramete.
     *
     * @return void
     */
    public function aboutExam()
    {
        return view('afterlogin.ExamDetails.about_exam');
    }

    /**
     * This function used for eliegibity critera page .
     *
     * No paramete.
     *
     * @return void
     */
    public function eligibilityCriteria()
    {
        return view('afterlogin.ExamDetails.exam_criteria');
    }
}
