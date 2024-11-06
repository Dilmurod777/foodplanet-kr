<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Board extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('board_m');
		$this->load->model('common_m');
		$this->load->model('member_m');
		$this->load->model('file_m');
	}

  	public function notice() {
		$req = $this->input->get();
		$req['type'] = 'news';
		$this->data['news'] = $this->board_m->notice_list($req, 0, 3)->result_array();
		$req['type'] = 'event';
		$this->data['event'] = $this->board_m->notice_list($req, 0, 3)->result_array();
		$this->data['total_rows'] = $this->board_m->notice_list_total($req);

		$this->data['req'] = $req;

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/board/notice_v');
		$this->load->view('front/common/footer_v');
	}
	
    public function news() {
		$req = $this->input->get();

		$req['type'] = 'news';
		$offset = (int)$this->uri->segment(3, '0');

		$total_rows = $this->board_m->notice_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE, '/board/news', (!empty($req['keyword']) ? $req['keyword'] : ''));

        $list = $this->board_m->notice_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/board/news_v');
		$this->load->view('front/common/footer_v');
	}

    public function event() {
		$req = $this->input->get();

		$req['type'] = 'event';
		$offset = (int)$this->uri->segment(3, '0');

		$total_rows = $this->board_m->notice_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE, '/board/event', (!empty($req['keyword']) ? $req['keyword'] : ''));

        $list = $this->board_m->notice_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/board/event_v');
		$this->load->view('front/common/footer_v');
	}

    public function detail() {
		$seq = $this->uri->segment(3, '');
		if(empty($seq)) {
			header('Location: /board/notice');
			exit;
		}

		$info = $this->board_m->notice_info($seq)->row_array();
		if(empty($info)) {
			header('Location: /board/notice');
			exit;
		}

		$this->data['info'] = $info;
		$this->data['files'] = $this->file_m->file_list('notice', $info['notice_seq'])->result_array();

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/board/detail_v');
		$this->load->view('front/common/footer_v');
	}

	public function faq() {
		$category = $this->uri->segment('3', '');

		$this->data['category'] = $this->common_m->code_list('faq_category')->result_array();
		if(empty($category)) {
			$category = $this->data['category'][0]['sub_code'];
		}
		$this->data['list'] = $this->board_m->faq_list($category)->result_array();
		$this->data['selected'] = $category;

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/board/faq_v');
		$this->load->view('front/common/footer_v');
	}

	public function qna() {
		if(empty($this->data['member'])) {
			header('Location: /board/faq');
			exit;
		}

		if(empty($_SERVER) || empty($_SERVER['HTTP_REFERER'])) {
			$this->data['back_url'] = '/board/faq';
		}
		else {
			$this->data['back_url'] = $_SERVER['HTTP_REFERER'];
		}
		$this->data['info'] = $this->member_m->member_info($this->data['member']['seq'])->row_array();
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/board/qna_v');
		$this->load->view('front/common/footer_v');
	}
}