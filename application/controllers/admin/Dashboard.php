<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Dashboard extends FP_AdminController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('board_m');
		$this->load->model('common_m');
	}

  	public function index() {
		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/dashboard/index_v');
		$this->load->view('admin/common/include/footer_v');
	}
	
}