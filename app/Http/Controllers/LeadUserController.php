<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class LeadUserController extends Controller
{
	//
	use CommonTrait;

	public function getLeadUser($lead_id, $trail)
	{
		try {
			$curl = curl_init();
			$api_URL = env('API_URL');
			$curl_url = $api_URL . 'crm/get_lead_info/' . $lead_id;
			$apiKey = '16c6df40-195d-4480-b735-56f65a19389a';
			$headers = array(
				'x-api-key: ' . $apiKey,
			);
			$curl_option = array(
				CURLOPT_URL => $curl_url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => $headers,
			);
			curl_setopt_array($curl, $curl_option);

			$response_json = curl_exec($curl);
			$err = curl_error($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			$response_data = json_decode($response_json, true);
			if (isset($response_data['success']) && !empty($response_data['success'])) {
				$lead_user_data = $response_data['data'];
				if ($lead_user_data['mx_Exam_id'] == 2) {
					$lead_user_data['mx_Exam_id'] = 4;
				}
				$lead_user_data['Mobile'] = substr($lead_user_data['Mobile'], -10);
				return view('lead_user', compact('lead_user_data', 'trail'));
			} else {
				die('Unauthorized action.');
			}
		} catch (\Exception $e) {
			Log::info($e->getMessage());
		}
	}
	public function performanceAnalytics()
	{
		$preferences = $this->redis_Preference();
		$prof_test_qcount = (isset($preferences->profiling_test_count) && !empty($preferences->profiling_test_count)) ? $preferences->profiling_test_count : 75;
		$prof_asst_test = (isset($preferences->prof_asst_test) && !empty($preferences->prof_asst_test)) ? $preferences->prof_asst_test : '';
		$user_subjects = $this->redis_subjects();

		$subjects = [];
		foreach ($user_subjects as $sub) {
			$subjects[] = $sub->subject_name;
		}
		$subjects_name = implode(', ', $subjects);
		if (isset($prof_asst_test) && $prof_asst_test == 'Y') {
			return redirect()->route('dashboard');
		} else {
			return view('auth.performance_analytics', compact(['prof_test_qcount', 'subjects_name']));
		}
	}


	public function examInstructions()
	{
		return view('auth.exam_instructions');
	}
	
	public function weeklyPlan()
	{
		return view('auth.weekly_plan');
	}
	public function contactUs()
	{
		return view('auth.contact_us');
	}
	public function chapterPlanner()
	{
		return view('auth.chapter_planner');
	}
	public function planner()
	{
		return view('auth.planner');
	}
	public function emailConfirmation()
	{
		return view('auth.email_confirmation');
	}
	public function testAnalyticsMocktest()
	{
		return view('auth.test_analytics_mocktest');
	}
	public function aeckMyqmatrix()
	{
		return view('auth.aeck_myqmatrix');
	}
    public function practic_exam()
	{
		return view('auth.practic_exam');
	}
	public function exportOverallAnalytics()
	{
		return view('auth.export_overall_analytics');
	}
     public function mock_test()
	{
		return view('auth.mock_test');
	}
    public function live_exam()
	{
		return view('auth.live_exam');
	}
	public function examTest()
	{
		return view('auth.exam_test');
	}
    public function overallAnalyticsNew()
	{
		return view('auth.overall_analytics_new');
	}

}
