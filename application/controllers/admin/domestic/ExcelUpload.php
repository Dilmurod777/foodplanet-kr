<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class ExcelUpload extends FP_AdminController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('common_m');
        $this->load->model('admin/domestic_m', 'domestic_m');
    }

	public function index() {
		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/domestic/excelupload/index_v');
		$this->load->view('admin/common/include/footer_v');
	}
}