<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreLoginController extends Controller
{
    //
    /**
     * Undocumented function
     *
     * @return void
     */
    public function pre_about_exam()
    {
        return view('about_exam');
    }


    public function user_feedback()
    {
        return view('faq');
    }
}
