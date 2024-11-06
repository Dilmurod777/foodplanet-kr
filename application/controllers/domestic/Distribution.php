<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Distribution extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('common_m');
		$this->load->model('domestic_m');
		$this->load->model('product_m');
		$this->load->model('file_m');
	}

  	public function list() {
		$req = $this->input->post();

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/domestic/distribution/list_v');
		$this->load->view('front/common/footer_v');
	}

	public function list_detail() {
		$req = $this->input->post();

		if(empty($req)) {
			$req['offset'] = 0;
		}
		$offset = (int)$req['offset'];

		$total_rows = $this->domestic_m->distribution_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination3(5, $total_rows, $offset, PERPAGE);

        $list = $this->domestic_m->distribution_list($req, $offset, PERPAGE)->result_array();

		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('front/domestic/distribution/list_detail_v', $this->data);
	}

}