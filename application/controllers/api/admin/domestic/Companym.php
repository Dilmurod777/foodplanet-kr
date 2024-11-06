<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Companym extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('admin/domestic_m', 'domestic_m');
        $this->load->model('admin/log_m', 'log_m');
        $this->load->model('common_m');
    }

    public function list()
    {
		$req = $this->input->post();

		$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 10);
		$offset = (isset($req['offset']) ? (int)$req['offset'] : 0);

        $total_rows = 0;
        $total_rows = $this->domestic_m->manufacture_list_cnt($req);

        $num = $total_rows - $offset;
		
		$pagination = $this->pagination(5, $total_rows, $offset, PERPAGE);

        $list = array();
        $list = $this->domestic_m->manufacture_list($req, $offset, PERPAGE)->result_array();

		$this->data['req'] = $req;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['num'] = $num;
		$this->data['pagination'] = $pagination;

        echo json_encode($this->data);
    }

}