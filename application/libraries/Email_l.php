<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_l
{
	public function __construct() 
	{
//		parent::__construct();
	}
	
	public function email_send($from, $name, $to, $subject, $message) 
	{
		$CI =& get_instance();
		
		$config = [];
		$config['protocol'] = 'smtp';
		$config['smtp_crypto'] = 'ssl';
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'hitch@appdr.com';
		$config['smtp_pass'] = 'dtwirmlwfdmqargy';
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
		$CI->load->library('email', $config);
		
		$CI->email->from($from, $name);
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($message);	
		
		return $CI->email->send();
	}
}
