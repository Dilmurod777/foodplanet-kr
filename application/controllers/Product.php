<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Product extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('common_m');
		$this->load->model('domestic_m');
		$this->load->model('overseas_m');
		$this->load->model('file_m');
		$this->load->model('wish_m');
	}

    public function list() {
		$filter['category'] = $this->common_m->code_list('food_category')->result_array();
		$filter['company'] = $this->common_m->code_list('oem_company')->result_array();
		$filter['nation'] = $this->overseas_m->overseas_list_all()->result_array();

		$this->data['filter'] = $filter;
		
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/product/list_v');
		$this->load->view('front/common/footer_v');
	}
	
    public function detail() {
		$req = $this->input->post();
		$req['prod_type'] = $this->uri->segment(3, '');
		$req['detail_seq'] = $this->uri->segment(4, '');
		if(empty($req['prod_type']) || empty($req['detail_seq'])) {
			header('Location: /product/list');
			exit;
		}

		$info = array();
		$img = array();
		$label = array();
		$detail = array();
		$list = array();
		$wish = array();

		if($req['prod_type'] === 'nb') {
			$info = $this->domestic_m->nbproduct_info($req['detail_seq'])->row_array();
			$req['img_type'] = 'NB_image';
			$img = $this->domestic_m->prodimg_list($req)->result_array();
			$req['img_type'] = 'NB_label';
			$label = $this->domestic_m->prodimg_list($req)->result_array();
			$req['img_type'] = 'NB_image';
			$detail = $this->domestic_m->prodimg_list($req)->result_array();

			$tmp = array();
			$tmp['biz_no'] = $info['biz_no'];
			$tmp['seq'] = $info['seq'];
			$tmp['product_type'] = $info['product_type'];
			$list = $this->domestic_m->nbproduct_recommend_list($tmp)->result_array();

			$this->domestic_m->update_nbproduct_hit($req['detail_seq']);
			if(!empty($this->data['member'])) {
				$tmp = array();
				$tmp['source_cd'] = $this->data['member']['seq'];
				$tmp['target_cd'] = $req['detail_seq'];
				$tmp['target_type'] = '2';
				$wish = $this->wish_m->wish_info($tmp)->row_array();
			}
		}
		else if($req['prod_type'] === 'oem') {
			$info = $this->domestic_m->oemproduct_info($req['detail_seq'])->row_array();
			$req['img_type'] = 'OEM_image';
			$img = $this->domestic_m->prodimg_list($req)->result_array();
			$req['img_type'] = 'OEM_label';
			$label = $this->domestic_m->prodimg_list($req)->result_array();
			$req['img_type'] = 'OEM_image';
			$detail = $this->domestic_m->prodimg_list($req)->result_array();

			$tmp = array();
			$tmp['biz_no'] = $info['biz_no'];
			$tmp['seq'] = $info['seq'];
			$tmp['product_type'] = $info['product_type'];
			$list = $this->domestic_m->oemproduct_recommend_list($tmp)->result_array();

			$this->domestic_m->update_oemproduct_hit($req['detail_seq']);
			if(!empty($this->data['member'])) {
				$tmp = array();
				$tmp['source_cd'] = $this->data['member']['seq'];
				$tmp['target_cd'] = $req['detail_seq'];
				$tmp['target_type'] = '3';
				$wish = $this->wish_m->wish_info($tmp)->row_array();
			}
		}

		$this->data['info'] = $info;
		$this->data['img'] = $img;
		$this->data['label'] = $label;
		$this->data['detail'] = $detail;
		$this->data['list'] = $list;
		$this->data['req'] = $req;
		$this->data['wish'] = $wish;

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/domestic/product/detail_v');
		$this->load->view('front/common/footer_v');
	}
}