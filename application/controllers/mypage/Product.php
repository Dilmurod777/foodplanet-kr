<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Product extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('product_m');
        $this->load->model('common_m');
        $this->load->model('file_m');
    }

	public function own() {
		$this->data['tab'] = 'own';
		$this->data['category'] = $this->common_m->code_list('food_category')->result_array();
		$this->data['info'] = $this->product_m->own_product_info($this->data['member']['member_cd'])->row_array();

		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/product_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function ownlist() {
		$req = $this->input->get();
		$this->data['tab'] = 'ownlist';

		$offset = (int)$this->uri->segment(4, '0');

		if(!isset($req['keyword'])) $req['keyword'] = '';
		$req['member_cd'] = $this->data['member']['member_cd'];

		$total_rows = $this->product_m->own_product_detail_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination2(5, $total_rows, $offset, PERPAGE);

        $list = $this->product_m->own_product_detail_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/ownlist_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function ownregister() {
		$this->data['tab'] = 'ownregister';
		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/ownregister_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function ownedit() {
		$seq = (int)$this->uri->segment(4, '');
		if(empty($seq)) {
			header('Location: /mypage/product/ownlist');
			exit;
		}
		$this->data['tab'] = 'ownedit';
		$info = $this->product_m->own_product_detail_info($seq)->row_array();
		$this->data['prod_thumb'] = $this->file_m->file_list('prod_thumb', $info['detail_seq'])->result_array();
		$this->data['prod_detail'] = $this->file_m->file_list('prod_detail', $info['detail_seq'])->result_array();
		$this->data['prod_label'] = $this->file_m->file_list('prod_label', $info['detail_seq'])->result_array();

		$this->data['info'] = $info;
		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/ownedit_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function oem() {
		$this->data['tab'] = 'oem';
		$this->data['category'] = $this->common_m->code_list('food_category')->result_array();
		$this->data['info'] = $this->product_m->oem_product_info($this->data['member']['member_cd'])->row_array();

		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/product_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function oemlist() {
		$req = $this->input->get();
		$this->data['tab'] = 'oemlist';

		$offset = (int)$this->uri->segment(4, '0');

		if(!isset($req['keyword'])) $req['keyword'] = '';
		$req['member_cd'] = $this->data['member']['member_cd'];

		$total_rows = $this->product_m->oem_product_detail_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination2(5, $total_rows, $offset, PERPAGE);

        $list = $this->product_m->oem_product_detail_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/oemlist_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function oemregister() {
		$this->data['tab'] = 'oemregister';
		$this->data['company'] = $this->common_m->code_list('oem_company')->result_array();
		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/oemregister_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function oemedit() {
		$seq = (int)$this->uri->segment(4, '');
		if(empty($seq)) {
			header('Location: /mypage/product/oemlist');
			exit;
		}
		$this->data['tab'] = 'oemedit';
		$this->data['company'] = $this->common_m->code_list('oem_company')->result_array();
		$info = $this->product_m->oem_product_detail_info($seq)->row_array();
		
		$this->data['prod_thumb'] = $this->file_m->file_list('oem_thumb', $info['detail_seq'])->result_array();
		$this->data['prod_detail'] = $this->file_m->file_list('oem_detail', $info['detail_seq'])->result_array();
		$this->data['prod_label'] = $this->file_m->file_list('oem_label', $info['detail_seq'])->result_array();

		$this->data['info'] = $info;
		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/oemedit_v');
		$this->load->view('mypage/common/include/footer_v');
	}

}