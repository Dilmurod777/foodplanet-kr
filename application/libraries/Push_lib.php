<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Push_lib {
    function push_send($tokens, $message, $os_type) {
		$url = 'https://fcm.googleapis.com/fcm/send';
		$apiKey = "AAAA3jwIeZA:APA91bFrgFcm1ljEExcf7nrhnxuCf6GWDy1eQEu8imxsuAgBhVCwGeQLRXAA0D7qdWhXGSrC-gvJfND-DnOPfCabn5p0EMeF5MwKNIXM60SDgQszrPBO_bE5ncbJ5m-zwL2b4ZeNRVCj";

		// Android와 iOS를 구분하여 메시지를 보낸다. ( 메시지 형식이 달라서 나눠줘야 한다. )
		$result = array();

		if ($os_type == "android") {
			$fields = array('registration_ids' => $tokens,'data' => $message);
		} else if ($os_type == "ios") {
//			$message['mutable_content'] = true;
			$fields = array('registration_ids' => $tokens,'notification' => $message, 'mutable_content' => true);
		} else {
			echo $phone_type;
			exit;
		}
		// $fields = array('registration_ids' => $tokens,'notification' => $message, 'data' => $message);
	
		$result['send'] = json_encode($fields);
		$headers = array('Authorization:key='.$apiKey,'Content-Type: application/json');
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	
		$result['result'] = curl_exec($ch);

        return $result;
	}	

}

?>