<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Util_m extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  function checkPhoneNum($number) { 
    $number = preg_replace("/[^0-9]/", "", $number);

    if(preg_match("/^01[0-9]{8,9}$/", $number))
      return true;
    else
      return false;
  }

  function setSesson($user_id) {
    $session_data = array(
      'user_id'=>$user_id
    );
    $this->session->set_userdata($session_data);
  }

  function setResultStatus($status, $msg) {
    $result = array();

    $result['status'] = $status;
		$result['msg'] = $msg;

    return $result;
  }

}



?>