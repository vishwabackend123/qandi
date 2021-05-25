<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $qualification_status = 0;
        if ($qualification_status == 0) {
            return view('signup_poststatus');
        }

        $suscription_status = 0;
        if ($suscription_status == 0) {
            return view('subscriptions');
        }
        return view('home');
    }
}
