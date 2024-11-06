<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Member extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('member_m');
        $this->load->model('common_m');
    }

	public function index() {
		$this->data['interest'] = $this->common_m->code_list('interest')->result_array();
        $this->data['info'] = $this->member_m->member_info($this->data['member']['seq'])->row_array();
        
		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/member_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function logout() {
		$this->session->set_userdata('member', null);
		header('Location: /');
		exit;
	}
}