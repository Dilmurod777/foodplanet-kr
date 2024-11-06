<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Nbproduct extends FP_AdminController {

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

		$total_rows = $this->domestic_m->nbproduct_list_cnt($req);
		$num = $total_rows - $offset;
		
		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE);

        $list = $this->domestic_m->nbproduct_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/domestic/nbproduct/list_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function register() {
		$this->data['category'] = $this->common_m->code_list('food_category')->result_array();
		$this->data['company'] = $this->common_m->code_list('oem_company')->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/domestic/nbproduct/register_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function edit() {
        $req = $this->input->post();
        if(empty($req['seq'])) {
            header('Location: /admin/domestic/nbproduct/list');
            exit;
        }
        $info = $this->domestic_m->nbproduct_info($req['seq'])->row_array();
        if(empty($info)) {
            header('Location: /admin/domestic/nbproduct/list');
            exit;
        }

        $this->data['info'] = $info;
		$tmp = array();
		$tmp['detail_seq'] = $info['seq'];
		$tmp['img_type'] = 'NB_image';
		$this->data['prodimg'] = $this->domestic_m->prodimg_list($tmp)->result_array();
		$tmp['img_type'] = 'NB_label';
		$this->data['labelimg'] = $this->domestic_m->prodimg_list($tmp)->result_array();

		$this->data['category'] = $this->common_m->code_list('food_category')->result_array();
		$this->data['company'] = $this->common_m->code_list('oem_company')->result_array();

		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/domestic/nbproduct/edit_v');
		$this->load->view('admin/common/include/footer_v');
	}
}