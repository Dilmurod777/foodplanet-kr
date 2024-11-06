<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Wish extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('wish_m');
        $this->load->model('member_m');
        $this->load->model('common_m');
    }

	public function list() {
		$req = $this->input->get();

		if(!isset($req['keyword'])) $req['keyword'] = '';
		$req['seq'] = $this->data['member']['seq'];

		$offset = (int)$this->uri->segment(4, '0');

		$req['seq'] = $this->data['member']['seq'];
		$total_rows = $this->wish_m->wish_list_cnt($req, $offset, PERPAGE);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination2(5, $total_rows, $offset, PERPAGE);

        $list = $this->wish_m->wish_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/common/wish/list_v');
		$this->load->view('mypage/common/include/footer_v');
	}
	
	public function detail() {
		$target_cd = $this->uri->segment(4, '');
		if(empty($target_cd)) {
			header('Location: /mypage/wish/list');
			exit;
		}

		$info = $this->member_m->member_info($target_cd)->row_array();
		if(empty($info)) {
			header('Location: /mypage/wish/list');
			exit;
		}

		$this->data['info'] = $info;
		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/common/wish/detail_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function request() {
		$target_cd = $this->uri->segment(4, '');
		if(empty($target_cd)) {
			header('Location: /mypage/wish/list');
			exit;
		}

		$info = $this->member_m->member_info($target_cd)->row_array();
		if(empty($info)) {
			header('Location: /mypage/wish/list');
			exit;
		}

		$this->data['info'] = $info;
		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/common/wish/request_v');
		$this->load->view('mypage/common/include/footer_v');
	}

}