<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Search extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('common_m');
		$this->load->model('domestic_m');
		$this->load->model('overseas_m');
		$this->load->model('community_m');
	}

  	public function index() {
		$req = $this->input->post();
		if(empty($req) ||  empty($req['search_text'])) {
			header('Location: /');
			exit;
		}

		$domestic = array();
		$overseas = array();
		$community = array();
		if(!empty($req['search_text'])) {
			if(!empty($this->data['member'])) {
				$this->common_m->insert_search($this->data['member']['seq'], $req['search_text']);
			}

			$val = array();
			$val['keyword'] = $req['search_text'];
			$val['order_by'] = 'hit_cnt';
			$domestic = $this->domestic_m->manufacture_list($val, 0, 3)->result_array();
			$overseas = $this->overseas_m->overseas_list($val, 0, 3)->result_array();
			$community = $this->community_m->community_list($val, 0, 6)->result_array();
		}

		$this->data['domestic'] = $domestic;
		$this->data['overseas'] = $overseas;
		$this->data['community'] = $community;
		$this->data['req'] = $req;
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/search/total_v');
		$this->load->view('front/common/footer_v');
	}
	
	public function domestic() {
		$req = $this->input->post();
		if(empty($req) ||  empty($req['search_text'])) {
			header('Location: /');
			exit;
		}

		if(!empty($req['search_text']) && !empty($this->data['member'])) {
			$this->common_m->insert_search($this->data['member']['seq'], $req['search_text']);
		}
		if(empty($req['order_by'])) $req['order_by'] = 'hit';
		$req['keyword'] = $req['search_text'];

		$filter = array();
		$filter['category'] = $this->common_m->code_list('food_category')->result_array();
		$filter['company'] = $this->common_m->code_list('oem_company')->result_array();
		
		$this->data['total_rows'] = $this->domestic_m->manufacture_list_cnt($req);
		$this->data['filter'] = $filter;
		$this->data['req'] = $req;

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/search/domestic_v');
		$this->load->view('front/common/footer_v');
	}

	public function overseas() {
		$req = $this->input->post();
		if(empty($req) || empty($req['search_text'])) {
			header('Location: /');
			exit;
		}

		if(!empty($req['search_text']) && !empty($this->data['member'])) {
			$this->common_m->insert_search($this->data['member']['seq'], $req['search_text']);
		}
		if(empty($req['order_by'])) $req['order_by'] = 'hit_cnt';
		if(empty($req['offset'])) $req['offset'] = 0;
		$offset = $req['offset'];
		$req['keyword'] = $req['search_text'];

/*		$filter = array();
		$filter['category'] = $this->common_m->code_list('overseas_category')->result_array();
		$filter['hscode'] = $this->common_m->code_list('hscode')->result_array(); */
		
		$total_rows = $this->overseas_m->overseas_list_cnt($req);
		
		$pagination = $this->pagination3(5, $total_rows, $offset, PERPAGE);

        $list = $this->overseas_m->overseas_list($req, $offset, PERPAGE)->result_array();

		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['pagination'] = $pagination;
		$this->data['req'] = $req;

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/search/overseas_v');
		$this->load->view('front/common/footer_v');
	}

	public function community() {
		$req = $this->input->post();
		if(empty($req) ||  empty($req['search_text'])) {
			header('Location: /');
			exit;
		}

		if(!empty($req['search_text']) && !empty($this->data['member'])) {
			$this->common_m->insert_search($this->data['member']['seq'], $req['search_text']);
		}
		if(empty($req['order_by'])) $req['order_by'] = 'hit';
		$req['keyword'] = $req['search_text'];
		$req['community_type'] = 'all';
		if(!isset($req['offset'])) {
			$req['offset'] = 0;
		}
		$offset = (int)$req['offset'];

		$total_rows = $this->community_m->community_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination3(5, $total_rows, $offset, PERPAGE);

        $list = $this->community_m->community_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/search/community_v');
		$this->load->view('front/common/footer_v');
	}

}