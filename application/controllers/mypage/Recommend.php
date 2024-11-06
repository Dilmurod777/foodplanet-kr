<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Recommend extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
    }

	public function index() {
		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/recommend_v');
		$this->load->view('mypage/common/include/footer_v');
	}

}