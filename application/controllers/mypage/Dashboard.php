<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Dashboard extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('request_m');
        $this->load->model('member_m');
        $this->load->model('product_m');
    }

	public function index() {
		header('Location: /mypage/member');
		exit;
	}
}