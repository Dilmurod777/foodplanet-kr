<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Community extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('common_m');
        $this->load->model('community_m');
        $this->load->model('file_m');
	}

  	public function list() {
		$req = $this->input->get();

		$req['community_type'] = $this->uri->segment(3, '');
		if(empty($req['community_type'])) $req['community_type'] = 'all';

		$offset = (int)$this->uri->segment(4, '0');

		$total_rows = $this->community_m->community_list_cnt($req);
		$num = $total_rows - $offset;

		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE, '/community/list/' . $req['community_type'], (!empty($req['keyword']) ? $req['keyword'] : ''));

        $list = $this->community_m->community_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->data['types'] = $this->common_m->code_list('community')->result_array();

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/community/list_v');
		$this->load->view('front/common/footer_v');
	}
	
    public function detail() {
		$seq = $this->uri->segment(3, '');
		if(empty($seq)) {
			header('Location: /community/list');
			exit;
		}

		$info = $this->community_m->community_info($seq)->row_array();
		if(empty($info)) {
			header('Location: /community/list');
			exit;
		}

		$this->community_m->update_community_hit($seq);		
		$files = $this->file_m->file_list('community', $seq)->result_array();

		$this->data['info'] = $info;
		$this->data['files'] = $files;
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/community/detail_v');
		$this->load->view('front/common/footer_v');
	}

    public function write() {
		if(empty($this->data['member'])) {
			header('Location: /community/list');
			exit;
		}
		$this->data['types'] = $this->common_m->code_list('community')->result_array();

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/community/write_v');
		$this->load->view('front/common/footer_v');
	}

    public function edit() {
		$seq = $this->uri->segment(3, '');
		if(empty($seq)) {
			header('Location : /community/list');
			exit;
		}

		$info = $this->community_m->community_info($seq)->row_array();
		if(empty($info) || $info['member_seq'] !== $this->data['member']['seq']) {
			header('Location: /community/detail/' . $seq);
			exit;
		}

		$info['contents'] = $this->html_decode($info['contents']);
		$this->data['info'] = $info;
		$this->data['types'] = $this->common_m->code_list('community')->result_array();
		$this->data['files'] = $this->file_m->file_list('community', $seq)->result_array();

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/community/edit_v');
		$this->load->view('front/common/footer_v');
	}

	public function reply_list()
	{
		$req = $this->input->post();

		$val = array();
		$val['parent_seq'] = $req['parent_seq'];
		$val['community_seq'] = $req['community_seq'];
		$list = $this->community_m->reply_list($val, (int)$req['offset'], PERPAGE)->result_array();

		for($i = 0; $i < count($list); $i++) {
			$list[$i]['contents2'] = $this->html_decode($list[$i]['contents']);
		}
		$this->data['list'] = $list;
		$this->load->view('front/community/reply_v', $this->data);
	}

}
