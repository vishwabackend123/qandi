<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreparationController extends Controller
{
    //

    public function preparation_center(Request $request)
    {
        return view('afterlogin.Preparation.preparation_center');
    }


    public function download_exampaper(Request $request)
    {
        return view('afterlogin.Preparation.exam_papers');
    }
}
