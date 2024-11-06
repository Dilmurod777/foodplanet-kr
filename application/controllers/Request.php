<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Request extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('company_m');
		$this->load->model('product_m');
		$this->load->model('member_m');
	}

  	public function write() {
		$req = $this->input->post();
		if(empty($req) || empty($req['member_cd'])) {
			header('Location: /');
			exit;
		}

		$info = $this->company_m->company_info_for_request($req['member_cd'])->row_array();
		$prod = array();
		$mem = array();
		if(!empty($req['detail_seq']) && !empty($req['product_type'])) {
			$prod = $this->product_m->product_detail_for_request($req['detail_seq'], $req['product_type'])->row_array();
		}
		if(!empty($this->data['member'])) {
			$mem = $this->member_m->member_info_for_request($this->data['member']['seq'])->row_array();
		}

		$this->data['info'] = $info;
		$this->data['prod'] = $prod;
		$this->data['mem'] = $mem;
		$this->data['req'] = $req;
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/request/write_v');
		$this->load->view('front/common/footer_v');
	}
	

}