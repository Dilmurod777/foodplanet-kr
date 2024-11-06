<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Community extends FP_AdminController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('community_m');
        $this->load->model('common_m');
        $this->load->model('file_m');
    }

	public function list() {
		$req = $this->input->post();

		$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 20);
		$offset = (isset($req['offset']) ? (int)$req['offset'] : 0);

		$total_rows = $this->community_m->community_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE);

        $list = $this->community_m->community_list($req, $offset, PERPAGE)->result_array();
		$this->data['types'] = $this->common_m->code_list('community')->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/community/list_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function detail() {
		$seq = $this->uri->segment(4, '');

		if(empty($seq)) {
			header('Location: /admin/community/list');
			exit;
		}

		$info = $this->community_m->community_info($seq)->row_array();
		if(empty($info)) {
			header('Location: /admin/community/list');
			exit;
		}

		$this->data['info'] = $info;
		$val = array();
		$val['community_seq'] = $seq;
		$val['parent_seq'] = '0';
		$reply = $this->community_m->reply_list($val, '', '')->result_array();
		for($i = 0; $i < count($reply); $i++) {
			$tmp = array();
			$tmp['community_seq'] = $seq;
			$tmp['parent_seq'] = $reply[$i]['reply_seq'];
			$reply[$i]['list'] = $this->community_m->reply_list($tmp, '', '')->result_array();
		}
		$this->data['reply'] = $reply;
		$this->data['files'] = $this->file_m->file_list('community', $seq)->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/community/detail_v');
		$this->load->view('admin/common/include/footer_v');
	}

}