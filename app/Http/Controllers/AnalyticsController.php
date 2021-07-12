<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function overall_analytics(Request $request)
    {

        return view('afterlogin.Analytics.overall_analytics');
    }

    public function export_analytics(Request $request)
    {

        return view('afterlogin.Analytics.export_analytics');
    }
}
