<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Qna extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

  	public function list() {
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/notice/all_v');
		$this->load->view('front/common/footer_v');
	}
	
}