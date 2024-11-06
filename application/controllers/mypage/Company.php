<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Company extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('company_m');
        $this->load->model('common_m');
        $this->load->model('file_m');
    }

	public function manufacture() {
		$this->data['tab'] = 'manufacture';
		$this->data['info'] = $this->company_m->company_manufacture_info($this->data['member']['member_cd'])->row_array();

		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/company_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function facilities() {
		$this->data['tab'] = 'facilities';
		$this->data['info'] = $this->company_m->company_facilities_info($this->data['member']['member_cd'])->row_array();
		$this->data['facilities_list'] = $this->company_m->company_facilities_detail($this->data['member']['member_cd'])->result_array();

		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/company_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function cert() {
		$this->data['tab'] = 'cert';
		$this->data['info'] = $this->company_m->company_cert_info($this->data['member']['member_cd'])->row_array();
		$this->data['cert_list'] = $this->company_m->company_cert_detail($this->data['member']['member_cd'], '1')->result_array();
		$this->data['patent_list'] = $this->company_m->company_cert_detail($this->data['member']['member_cd'], '2')->result_array();

		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/company_v');
		$this->load->view('mypage/common/include/footer_v');
	}

	public function distribution() {
		$this->data['tab'] = 'distribution';
		$this->data['info'] = $this->company_m->company_distribution_info($this->data['member']['member_cd'])->row_array();

		$this->load->view('mypage/common/include/header_v', $this->data);
		$this->load->view('mypage/' . $this->data['base'] . '/company_v');
		$this->load->view('mypage/common/include/footer_v');
	}
}