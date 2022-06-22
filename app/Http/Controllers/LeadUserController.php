<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

class LeadUserController extends Controller {
	public function getLeadUser($lead_id, $trail) {
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
				$lead_user_data['Mobile'] = substr($lead_user_data['Mobile'],-10);
				return view('lead_user', compact('lead_user_data', 'trail'));
			} else {
				die('Unauthorized action.');
			}
		} catch (\Exception $e) {
			Log::info($e->getMessage());
		}

	}
}
