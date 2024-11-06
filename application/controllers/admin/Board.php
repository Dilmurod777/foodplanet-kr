<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Board extends FP_AdminController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('board_m');
		$this->load->model('common_m');
		$this->load->model('file_m');
	}

  	public function category() {
		$req = $this->input->get();

		$this->data['category'] = $this->board_m->faq_category_list()->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/board/category_v');
		$this->load->view('admin/common/include/footer_v');
	}
	
	public function faq() {
		$category = $this->uri->segment(4, '');
		if(empty($category)) {
			header('Location: /admin/board/category');
			exit;
		}
		$category_name = '';

		$this->data['category'] = $this->common_m->code_list_for_admin('faq_category')->result_array();
		foreach($this->data['category'] as $row) {
			if($row['sub_code'] === $category) $category_name = $row['code_name'];
		}
		$this->data['list'] = $this->board_m->faq_list($category)->result_array();
		$this->data['category_name'] = $category_name;
		$this->data['selected_category'] = $category;

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/board/faq_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function qna_list() {
		$req = $this->input->post();

		$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 20);
		$offset = (isset($req['offset']) ? (int)$req['offset'] : 0);

		$total_rows = $this->board_m->qna_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE);

        $list = $this->board_m->qna_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/board/qna_list_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function qna_detail() {
		$seq = $this->uri->segment(4, '');
		if(empty($seq)) {
			header('Location: /admin/board/qna_list');
			exit;
		}
        $info = $this->board_m->qna_info($seq)->row_array();
		if(empty($info)) {
			header('Location: /admin/board/qna_list');
			exit;
		}

		$this->data['info'] = $info;
		$this->data['files'] = $this->file_m->file_list('qna', $info['qna_seq'])->result_array();
		$this->data['files2'] = $this->file_m->file_list('ans', $info['qna_seq'])->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/board/qna_detail_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function qna_answer() {
		$seq = $this->uri->segment(4, '');
		if(empty($seq)) {
			header('Location: /admin/board/qna_list');
			exit;
		}
        $info = $this->board_m->qna_info($seq)->row_array();
		if(empty($info)) {
			header('Location: /admin/board/qna_list');
			exit;
		}

		$this->data['info'] = $info;
		$this->data['files'] = $this->file_m->file_list('qna', $info['qna_seq'])->result_array();
		$this->data['files2'] = $this->file_m->file_list('ans', $info['qna_seq'])->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/board/qna_answer_v');
		$this->load->view('admin/common/include/footer_v');
	}
}