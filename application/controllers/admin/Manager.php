<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Manager extends FP_AdminController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('admin/manager_m', 'manager_m');
		$this->load->model('common_m');
		$this->load->model('file_m');
	}

  	public function search10() {
		$this->data['list'] = $this->common_m->recommend_keyword('1')->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/manager/search10_v');
		$this->load->view('admin/common/include/footer_v');
	}
	
	public function keyword1() {
		$this->data['list'] = $this->common_m->recommend_keyword('2')->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/manager/keyword1_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function keyword2() {
		$this->data['list'] = $this->common_m->recommend_keyword('3')->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/manager/keyword2_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function product10() {
		$this->data['list'] = $this->common_m->recommend_product()->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/manager/product10_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function manufacture10() {
		$this->data['list'] = $this->common_m->recommend_manufacture10()->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/manager/manufacture10_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function recommend() {
		$this->data['company'] = $this->common_m->recommend_main('1', 0, 1)->row_array();
		$this->data['notice'] = $this->common_m->recommend_main('2', 0, 1)->row_array();
		$this->data['review'] = $this->common_m->recommend_main('3', 0, 4)->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/manager/recommend_v');
		$this->load->view('admin/common/include/footer_v');
	}

}