<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Product extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('common_m');
		$this->load->model('overseas_m');
	}

    public function detail() {
		$nation_seq = $this->uri->segment(4, '');
		$product_seq = $this->uri->segment(5, '');

		if(empty($nation_seq) || empty($product_seq)) {
			header('Location: /overseas/nation/list');
			exit;		
		}

		$req = array();
		$req['nation_seq'] = $nation_seq;
		$req['product_seq'] = $product_seq;
		$this->data['info'] = $this->overseas_m->overseas_product_info($nation_seq, $product_seq)->row_array();
		$this->data['nation'] = $this->overseas_m->nation_list_for_product($nation_seq, $product_seq)->result_array();

		if(empty($this->data['info'])) {
			header('Location: /overseas/nation/detail/' . $nation_seq);
			exit;		
		}
		$this->data['req'] = $req;
		$this->overseas_m->product_hit_cnt($nation_seq, $product_seq);

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/overseas/product/detail_v');
		$this->load->view('front/common/footer_v');
	}

}