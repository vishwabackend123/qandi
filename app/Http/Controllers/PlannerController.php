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

class PlannerController extends Controller
{
    //
    use CommonTrait;

    public function addPlanner(Request $request)
    {
        dd($request->all());
    }
}
