<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Company extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

  	public function info() {
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/company/info_v');
		$this->load->view('front/common/footer_v');
	}
	
	public function guide() {
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/company/guide_v');
		$this->load->view('front/common/footer_v');
	}
}