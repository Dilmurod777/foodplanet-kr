<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Report extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('report_m');
		$this->load->model('file_m');
	}

  	public function list() {
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/report/list_v');
		$this->load->view('front/common/footer_v');
	}
	
	public function list_detail() {
		$req = $this->input->post();

		$offset = (int)$req['offset'];

		$total_rows = $this->report_m->report_list_cnt($req);
        $list = $this->report_m->report_list($req, $offset, 12)->result_array();

		$result = array();
		$result['req'] = $req;
		$result['list'] = $list;
		$result['total_rows'] = $total_rows;

		echo json_encode($result);
		exit;
	}		

    public function detail() {
		$seq = $this->uri->segment(3, '');
		if(empty($seq)) {
			header('Location: /report/list');
			exit;
		}

		$info = $this->report_m->report_info($seq)->row_array();
		if(empty($info)) {
			header('Location: /report/list');
			exit;
		}

		$this->data['file'] = $this->file_m->file_list('rep_attach', $seq)->result_array();
		$this->data['info'] = $info;

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/report/detail_v');
		$this->load->view('front/common/footer_v');
	}

}