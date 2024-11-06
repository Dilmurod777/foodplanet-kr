<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Request extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('request_m');
        $this->load->model('common_m');
        $this->load->model('member_m');
        $this->load->model('file_m');
    }

	public function list() {
		$req = $this->input->get();

		$offset = (int)$this->uri->segment(4, '0');

		if(!isset($req['keyword'])) $req['keyword'] = '';
		$req['member_cd'] = $this->data['member']['member_cd'];

		$total_rows = $this->request_m->request_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination2(5, $total_rows, $offset, PERPAGE);

        $list = $this->request_m->request_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/common/request/list_v');
		$this->load->view('mypage/common/include/footer_v');
	}
	
	public function detail() {
		$seq = $this->uri->segment(4, '');
		if(empty($seq)) {
			header('Location: /mypage/request/list');
			exit;
		}

		$info = $this->request_m->request_info($seq)->row_array();
		if(empty($info)) {
			header('Location: /mypage/request/list');
			exit;
		}

		$file = array();
		if($info['req_type'] === '3') {
			$file = $this->file_m->file_list('request_qna', $info['request_seq'])->result_array();
			$file2 = $this->file_m->file_list('request_ans', $info['request_seq'])->result_array();
		}

		$this->data['info'] = $info;
		$this->data['file'] = $file;
		$this->data['file2'] = $file2;
		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/common/request/detail' . $info['req_type'] . '_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function estimate() {
		$seq = $this->uri->segment(4, '');
		if(empty($seq)) {
			header('Location: /mypage/request/list');
			exit;
		}

		$req = $this->request_m->request_info($seq)->row_array();
		if(empty($req)) {
			header('Location: /mypage/request/list');
			exit;
		}

		$info = $this->member_m->member_info($this->data['member']['member_cd'])->row_array();

		$this->data['info'] = $info;
		$this->data['req'] = $req;
		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/common/request/estimate_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function answer() {
		$seq = $this->uri->segment(4, '');
		if(empty($seq)) {
			header('Location: /mypage/request/list');
			exit;
		}

		$info = $this->request_m->request_info($seq)->row_array();
		if(empty($info)) {
			header('Location: /mypage/request/list');
			exit;
		}

		$file = array();
		$file2 = array();
		if($info['req_type'] === '3') {
			$file = $this->file_m->file_list('request_qna', $info['request_seq'])->result_array();
		}

		$this->data['info'] = $info;
		$this->data['file'] = $file;
		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/common/request/answer_v');
		$this->load->view('mypage/common/include/footer_v');
	}

}