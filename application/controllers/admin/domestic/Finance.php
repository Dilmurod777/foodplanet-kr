<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Finance extends FP_AdminController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('common_m');
        $this->load->model('admin/domestic_m', 'domestic_m');
    }

	public function list() {
		$req = $this->input->post();

		$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 20);
		$offset = (isset($req['offset']) ? (int)$req['offset'] : 0);

		$total_rows = $this->domestic_m->finance_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE);

        $list = $this->domestic_m->finance_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/domestic/finance/list_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function register() {
		$this->data['category'] = $this->common_m->code_list('food_category')->result_array();
		$this->data['company'] = $this->common_m->code_list('oem_company')->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/domestic/finance/register_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function edit() {
        $req = $this->input->post();
        if(empty($req['biz_no'])) {
            header('Location: /admin/domestic/finance/list');
            exit;
        }
        if(empty($req['base_year'])) {
            header('Location: /admin/domestic/finance/list');
            exit;
        }
        $info = $this->domestic_m->finance_info($req['biz_no'], $req['base_year'])->row_array();
        if(empty($info)) {
            header('Location: /admin/domestic/finance/list');
            exit;
        }

        $this->data['info'] = $info;
		$this->data['req'] = $req;

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/domestic/finance/edit_v');
		$this->load->view('admin/common/include/footer_v');
	}
}