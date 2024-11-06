<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Product extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('common_m');
		$this->load->model('domestic_m');
		$this->load->model('product_m');
		$this->load->model('file_m');
		$this->load->model('wish_m');
	}

    public function list() {
		$req = $this->input->post();
		$this->data['req'] = $req;
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/domestic/product/list_v');
		$this->load->view('front/common/footer_v');
	}
	
    public function detail() {
		$req = $this->input->post();

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
			$tmp['biz_no'] = $req['biz_no'];
			$tmp['seq'] = $info['seq'];
			$tmp['product_type'] = $info['product_type'];
			$list = $this->domestic_m->nbproduct_recommend_list($tmp)->result_array();

			if(!empty($this->data['member'])) {
				$tmp = array();
				$tmp['source_cd'] = $this->data['member']['seq'];
				$tmp['target_cd'] = $req['detail_seq'];
				$tmp['target_type'] = '2';
				$wish = $this->wish_m->wish_info($tmp)->row_array();
			}

			$this->domestic_m->update_nbproduct_hit($req['detail_seq']);
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
			$tmp['biz_no'] = $req['biz_no'];
			$tmp['seq'] = $info['seq'];
			$tmp['product_type'] = $info['product_type'];
			$list = $this->domestic_m->oemproduct_recommend_list($tmp)->result_array();

			if(!empty($this->data['member'])) {
				$tmp = array();
				$tmp['source_cd'] = $this->data['member']['seq'];
				$tmp['target_cd'] = $req['detail_seq'];
				$tmp['target_type'] = '3';
				$wish = $this->wish_m->wish_info($tmp)->row_array();
			}

			$this->domestic_m->update_oemproduct_hit($req['detail_seq']);
		}

		$this->data['info'] = $info;
		$this->data['img'] = $img;
		$this->data['label'] = $label;
		$this->data['detail'] = $detail;
		$this->data['list'] = $list;
		$this->data['wish'] = $wish;
		$this->data['req'] = $req; 
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/domestic/product/detail_v');
		$this->load->view('front/common/footer_v');
	}
}