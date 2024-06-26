<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Aws\SecretsManager\SecretsManagerClient;
use Aws\Exception\AwsException;

class LeadUserController extends Controller
{
	//
	use CommonTrait;

	public function getLeadUser($lead_id, $trail)
	{
		try {
			$curl = curl_init();
			$api_URL = env('CRM_URL');
			$curl_url = $api_URL . 'crm/get_lead_info/' . $lead_id;
			$apiKey = '16c6df40-195d-4480-b735-56f65a19389a';
			$headers = array(
				'x-api-key: ' . $apiKey,
				"Authorization: Bearer " . $this->getAccessToken()
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
				$lead_user_data['Mobile'] = substr($lead_user_data['Mobile'], -10);
				Session::put('lead_trail_status', $trail);
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
	public function emailConfirmation($token)
	{
		$curl = curl_init();
		$api_URL = env('API_URL');
		$curl_url = $api_URL . 'api/email_confirmation/' . $token;
		$curl_option = array(
			CURLOPT_URL => $curl_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer " . $this->getAccessToken()
			),
		);
		curl_setopt_array($curl, $curl_option);

		$response = curl_exec($curl);
		$response_json = json_decode($response, true);
		$err = curl_error($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		$response_status = isset($response_json['status']) ? $response_json['status'] : false;
		$email_id = '';
		$message_success = "";
		if ($response_status) {
			$email_id = isset($response_json['email']) ? $response_json['email'] : '';
			$message_success = isset($response_json['message']) ? $response_json['message'] : '';
		}else
		{
			if(isset($response_json['message']) && !empty($response_json['message']) && ($response_json['message'] == 'Token Expired, please resend email verification')){
				$response_json['message']='Token Expired, please resend email verification';	
			}else
			{
				$response_json['message']='Invalid Token';	
			}
			
		}
		return view('auth.email_confirmation', compact('email_id', 'response_json', 'message_success'));
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
	public function previousyearexam()
	{
		return view('auth.previousyear_exam');
	}
	public function overallAnalyticsNew()
	{
		$client = new SecretsManagerClient([
			'version' => '2017-10-17',
			'region' => 'ap-south-1'
		]);

		$secretName = 'dev/secrets';

		$result = $client->getSecretValue([
			'SecretId' => $secretName,
		]);
	}
	public function exportTestAnalytics()
	{
		return view('auth.export_test_analytics');
	}
	public function reviewTest()
	{
		return view('auth.review_test');
	}
}
