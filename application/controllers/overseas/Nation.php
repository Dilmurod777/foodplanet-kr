<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Nation extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('common_m');
		$this->load->model('overseas_m');
	}

  	public function list() {
		$req = $this->input->post();

		if(empty($req)) {
			$req['offset'] = 0;
			$req['order_by'] = 'hit_cnt';
		}
		$offset = (int)$req['offset'];

		$total_rows = $this->overseas_m->overseas_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination3(5, $total_rows, $offset, PERPAGE);

        $list = $this->overseas_m->overseas_list($req, $offset, PERPAGE)->result_array();

		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;
		$this->data['req'] = $req;

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/overseas/nation/list_v');
		$this->load->view('front/common/footer_v');
	}
	
    public function detail() {
		$seq = $this->uri->segment(4, '');

		if(empty($seq)) {
			header('Location: /overseas/nation/list');
			exit;		
		}

		$this->data['info'] = $this->overseas_m->overseas_nation_info($seq)->row_array();
		$this->data['top'] = $this->overseas_m->overseas_top($seq)->result_array();
		$this->data['channel'] = $this->overseas_m->overseas_channel($seq)->result_array();
		$this->data['require'] = $this->overseas_m->overseas_requirement($seq)->result_array();
//		$this->data['hscode'] = $this->overseas_m->overseas_hscode($seq)->result_array();
		
		$this->overseas_m->nation_hit_cnt($seq);

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/overseas/nation/detail_v');
		$this->load->view('front/common/footer_v');
	}

	public function hit_cnt() {
		$req = $this->input->post();

		$this->overseas_m->trends_hit_cnt($req['seq']);

		$result = array();
		$result['result'] = 'succ';

		echo json_encode($result);
	}

}