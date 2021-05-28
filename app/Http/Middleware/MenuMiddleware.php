<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Closure;
use Illuminate\Http\Request;

class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_data = Auth::user();
        $user_id = Auth::user()->id;

        $preferences = DB::table('student_preferences')->select('student_stage_at_sgnup', 'subjects_rating')->where('student_id', $user_id)->first();

        $subjects_rating = (isset($preferences->subjects_rating) && !empty($preferences->subjects_rating)) ? $preferences->subjects_rating : '';



        \Illuminate\Support\Facades\View::share('subjects_rating', $subjects_rating);

        return $next($request);
    }
}
