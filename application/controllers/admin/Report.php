<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Report extends FP_AdminController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('report_m');
        $this->load->model('file_m');
    }

	public function list() {
		$req = $this->input->post();

		$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 20);
		$offset = (isset($req['offset']) ? (int)$req['offset'] : 0);

		$total_rows = $this->report_m->report_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE);

        $list = $this->report_m->report_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/report/list_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function register() {
		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/report/register_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function detail() {
		$seq = $this->uri->segment(4, '');

		if(empty($seq)) {
			header('Location: /admin/report/list');
			exit;
		}

		$info = $this->report_m->report_info($seq)->row_array();
		if(empty($info)) {
			header('Location: /admin/report/list');
			exit;
		}

		$this->data['info'] = $info;
		$this->data['files'] = $this->file_m->file_list('report', $info['report_seq'])->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/report/detail_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function edit() {
		$seq = $this->uri->segment(4, '');

		if(empty($seq)) {
			header('Location: /admin/report/list');
			exit;
		}

		$info = $this->report_m->report_info($seq)->row_array();
		if(empty($info)) {
			header('Location: /admin/report/list');
			exit;
		}

		$this->data['info'] = $info;
		$info['title'] = $this->html_decode($info['title']);
		$this->data['files'] = $this->file_m->file_list('report', $info['report_seq'])->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/report/edit_v');
		$this->load->view('admin/common/include/footer_v');
	}
}