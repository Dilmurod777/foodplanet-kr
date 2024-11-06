<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Myerror extends FP_Controller {

	function __construct()
	{
		parent::__construct();
	}

    public function index() {
		$this->load->view('front/common/header_v');
		$this->load->view('front/common/top_v');
		$this->load->view('errors/error_v');
		$this->load->view('front/common/footer_v');
	}
	
}