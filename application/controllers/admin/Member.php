<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Member extends FP_AdminController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('excel');
        $this->load->model('member_m');
        $this->load->model('common_m');
    }

	public function list() {
		$req = $this->input->post();

		$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 20);
		$offset = (isset($req['offset']) ? (int)$req['offset'] : 0);

		$total_rows = $this->member_m->member_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE);

        $list = $this->member_m->member_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;
		$this->data['level'] = $this->common_m->code_list('member_level')->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/member/list_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function detail() {
		$req = $this->input->post();

		if(empty($req) || empty($req['seq'])) {
			header('Location: /admin/member/list');
			exit;
		}

		$info = $this->member_m->member_info($req['seq'])->row_array();
		if(empty($info)) {
			header('Location: /admin/member/list');
			exit;
		}

		$this->data['info'] = $info;

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/member/detail_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function edit() {
		$req = $this->input->post();

		if(empty($req) || empty($req['seq'])) {
			header('Location: /admin/member/list');
			exit;
		}

		$info = $this->member_m->member_info($req['seq'])->row_array();
		if(empty($info)) {
			header('Location: /admin/member/list');
			exit;
		}

		$this->data['info'] = $info;
		$this->data['level'] = $this->common_m->code_list('member_level')->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/member/edit_v');
		$this->load->view('admin/common/include/footer_v');
	}
}