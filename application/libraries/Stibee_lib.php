<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stibee_lib {
    function add_user($token, $data) {
		$url = STIBEE_API . '/v1/lists/' . $token . '/subscribers';

		$result = array();

		$headers = array('AccessToken:' . STIBEE_KEY, 'Content-Type: application/json');
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	
		$result = curl_exec($ch);

		return json_decode($result, true);
	}	

    function send_mail($email, $data, $type) {
		$data2 = array();
		$data2['email'] = $email;
		$data2['name'] = $email;
		$data2['tag1'] = '';
		$data2['tag2'] = '';
		$data2['tag3'] = '';

		$data3 = array();
		$data3['eventOccuredBy'] = 'MANUAL';
		$data3['confirmEmailYN'] = 'N';
		$data3['groupIds'] = array(STIBEE_SYS);
		$data3['subscribers'] = array();
		$data3['subscribers'][] = $data2;

		$res = $this->add_user(STIBEE_SYS, $data3);

		$url = STIBEE_MAIL . $type;

		$headers = array('AccessToken:' . STIBEE_KEY, 'Content-Type: application/json');
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	
		$result = curl_exec($ch);

		return $result;
	}	
}

?>