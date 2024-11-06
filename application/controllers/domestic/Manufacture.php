<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Manufacture extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('common_m');
		$this->load->model('company_m');
		$this->load->model('domestic_m');
		$this->load->model('product_m');
		$this->load->model('file_m');
		$this->load->model('wish_m');
	}

  	public function list() {
		$req = $this->input->post();

		$filter = array();
		$filter['category'] = $this->common_m->code_list('food_category')->result_array();
		$filter['company'] = $this->common_m->code_list('oem_company')->result_array();
		$this->data['list'] = $this->common_m->recommend_manufacture10()->result_array();

		$this->data['filter'] = $filter;

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/domestic/manufacture/list_v');
		$this->load->view('front/common/footer_v');
	}

	public function list_detail() {
		$req = $this->input->post();

		if(empty($req)) {
			$req['offset'] = 0;
		}
		$offset = (int)$req['offset'];

		$total_rows = $this->domestic_m->manufacture_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination3(5, $total_rows, $offset, PERPAGE);

        $list = $this->domestic_m->manufacture_list($req, $offset, PERPAGE)->result_array();

		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('front/domestic/manufacture/list_detail_v', $this->data);
	}
	
    public function detail() {
		$req = $this->input->post();
		if(empty($req)) {
			header('Location: /domestic/manufacture/list');
			exit;
		}
		else if(empty($req['biz_no'])) {
			header('Location: /domestic/manufacture/list');
			exit;
		}
		$info = array();
		$facilities = array();
		$cert = array();
		$patent = array();
		$nb = array();
		$oem = array();
		$summary = array();
		$wish = array();

		$info = $this->domestic_m->manufacture_info($req['biz_no'])->row_array();
		$nb['list'] = $this->domestic_m->nbproduct_list($req, 0, 4)->result_array();
		$nb['top'] = $this->domestic_m->nbproduct_top($req)->row_array();
		$oem['list'] = $this->domestic_m->oemproduct_list($req, 0, 4)->result_array();
		$oem['top'] = $this->domestic_m->oemproduct_top($req)->row_array();
		$facilities = $this->domestic_m->facilities_list($req)->result_array();
		$cert = $this->domestic_m->cert_list($req)->result_array();
		$patent = $this->domestic_m->patent_list($req)->result_array();
		if(!empty($this->data['member'])) {
			$tmp = array();
			$tmp['source_cd'] = $this->data['member']['seq'];
			$tmp['target_cd'] = $req['biz_no'];
			$tmp['target_type'] = '1';
			$wish = $this->wish_m->wish_info($tmp)->row_array();
		}


		$this->domestic_m->update_manufacture_hit($req['biz_no']);

		$this->data['info'] = $info;
		$this->data['facilities'] = $facilities;
		$this->data['cert'] = $cert;
		$this->data['patent'] = $patent;
		$this->data['nb'] = $nb;
		$this->data['oem'] = $oem;
		$this->data['wish'] = $wish;
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/domestic/manufacture/detail_v');
		$this->load->view('front/common/footer_v');
	}

}