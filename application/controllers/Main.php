<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Main extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('company_m');
		$this->load->model('community_m');
	}

  	public function index() {
		$this->data['header_type'] = 'main';

		$this->data['search'] = $this->common_m->recommend_keyword('1')->result_array();
		$this->data['keyword1'] = $this->common_m->recommend_keyword('2')->result_array();
		$this->data['keyword2'] = $this->common_m->recommend_keyword('3')->result_array();
		$this->data['product'] = $this->common_m->recommend_product()->result_array();
		$this->data['company'] = $this->common_m->recommend_main('1', 0, 1)->row_array();
		$this->data['notice'] = $this->common_m->recommend_main('2', 0, 1)->row_array();
		$this->data['review'] = $this->common_m->recommend_main('3', 0, 4)->result_array();

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/main_v');
		$this->load->view('front/common/footer_v');
	}
	
}