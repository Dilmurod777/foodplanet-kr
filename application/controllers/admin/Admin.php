<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Admin extends FP_AdminController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('common_m');
        $this->load->model('admin/admin_m', 'admin_m');
    }

	public function list() {
		$req = $this->input->post();

		$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 20);
		$offset = (isset($req['offset']) ? (int)$req['offset'] : 0);

		$total_rows = $this->admin_m->admin_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE);

        $list = $this->admin_m->admin_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination; 

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/admin/list_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function register() {
		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/admin/register_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function edit() {
        $req = $this->input->post();
        if(empty($req['seq'])) {
            header('Location: /admin/admin/list');
            exit;
        }
        $info = $this->admin_m->admin_info($req['seq'])->row_array();
        if(empty($info)) {
            header('Location: /admin/admin/list');
            exit;
        }

        $this->data['info'] = $info;
		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/admin/edit_v');
		$this->load->view('admin/common/include/footer_v');
	}
}