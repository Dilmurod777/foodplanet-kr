<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Hscode extends FP_AdminController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('common_m');
        $this->load->model('admin/overseas_m', 'overseas_m');
    }

	public function list() {
		$req = $this->input->post();

		$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 20);
		$offset = (isset($req['offset']) ? (int)$req['offset'] : 0);

		$total_rows = $this->overseas_m->hscode_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE);

        $list = $this->overseas_m->hscode_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination; 

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/overseas/hscode/list_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function register() {
		$this->data['nation'] = $this->overseas_m->nation_list_all()->result_array();
		$this->data['product'] = $this->overseas_m->product_list_all()->result_array();
		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/overseas/hscode/register_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function edit() {
        $req = $this->input->post();
        if(empty($req['seq'])) {
            header('Location: /admin/overseas/hscode/list');
            exit;
        }
        $info = $this->overseas_m->hscode_info($req['seq'])->row_array();
        if(empty($info)) {
            header('Location: /admin/overseas/hscode/list');
            exit;
        }

        $this->data['info'] = $info;
		$this->data['nation'] = $this->overseas_m->nation_list_all()->result_array();
		$this->data['product'] = $this->overseas_m->product_list_all()->result_array();
		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/overseas/hscode/edit_v');
		$this->load->view('admin/common/include/footer_v');
	}
}