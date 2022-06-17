<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadUserController extends Controller
{
    public function getLeadUser($lead_id,$trail)
    {
        return view('lead_user', compact('lead_id', 'trail'));
    }
}
