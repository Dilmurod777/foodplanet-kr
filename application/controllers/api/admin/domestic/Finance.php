<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Finance extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->library('awss3_lib');
        $this->load->model('admin/domestic_m', 'domestic_m');
        $this->load->model('admin/log_m', 'log_m');
        $this->load->model('common_m');
    }

    public function chk_bizno()
    {
		$req = $this->input->post();
        $result = array();
        if(empty($req['biz_no'])) {
            $result['result'] = 'fail';
            $result['msg'] = '사업자 등록번호를 입력해 주세요.';
        }
        else if(!$this->check_bizno($req['biz_no'])) {
            $result['result'] = 'fail';
            $result['msg'] = '사업자 등록번호 형식이 정확하지 않습니다.';
        }
        else {
            $info = $this->domestic_m->manufacture_info($req['biz_no'])->row_array();
            if(empty($info)) {
                $result['result'] = 'fail';
                $result['msg'] = '미등록된 사업자등록번호 입니다.';
            }
            else {
                $result['result'] = 'succ';
                $result['msg'] = '사용가능한 사업자등록번호 입니다.';
            }
        }

        echo json_encode($result);
    }

    public function register()
    {
		$req = $this->input->post();

        $result = array();
        if(empty($req['chk_biz_no']) || $req['chk_biz_no'] === 'n') {
            $result['result'] = 'fail';
            $result['msg'] = '사업자등록번호를 확인해 해주세요.';
        }
        else {
            $result = $this->chk_require($req);
            if($result['result'] == 'succ') {
                $req['admin_id'] = $this->data['admin']['admin_id'];

                $this->domestic_m->insert_finance($req);
                $result['msg'] = '등록하였습니다.';
            }
        }

        echo json_encode($result);
    }

    public function edit()
    {
		$req = $this->input->post();

        $result = array();
        $result = $this->chk_require($req);
        if($result['result'] == 'succ') {
            $req['admin_id'] = $this->data['admin']['admin_id'];

            $this->domestic_m->insert_finance($req);
            $result['msg'] = '수정하였습니다.';
        }

        echo json_encode($result);
    }

    public function delete()
    {
		$req = $this->input->post();

        $result = array();
        if(empty($req['biz_no'])) {
            $result['result'] = 'fail';
            $result['msg'] = '삭제할 사업자등록번호를 입력해 주세요.';
        }
        else if(empty($req['base_year'])) {
            $result['result'] = 'fail';
            $result['msg'] = '삭제할 기준연도를 입력해 주세요.';
        }
        else {
            $req['admin_id'] = $this->data['admin']['admin_id'];

            $this->domestic_m->delete_finance($req);

            $result['result'] = 'succ';
            $result['msg'] = '삭제되었습니다.';
        }

        echo json_encode($result);
    }

    public function chk_require($req) {
        $result = array();
        $result['result'] = 'succ';
        if(empty($req['biz_no'])) {
            $result['result'] = 'fail';
            $result['msg'] = '사업자 등록번호를 입력해 주세요.';
        }
        else if(empty($req['base_year'])) {
            $result['result'] = 'fail';
            $result['msg'] = '기준년도를 입력해 주세요.';
        }
        else if(empty($req['sales_year'])) {
            $result['result'] = 'fail';
            $result['msg'] = '연매출을 입력해 주세요.';
        }
        else if(empty($req['biz_profits'])) {
            $result['result'] = 'fail';
            $result['msg'] = '영업이익을 선택해 주세요.';
        }
        else if(empty($req['current_profits'])) {
            $result['result'] = 'fail';
            $result['msg'] = '당기순이익을 선택해 주세요.';
        }
        else if(empty($req['credit_rating'])) {
            $result['result'] = 'fail';
            $result['msg'] = '신용등급을 입력해 주세요.';
        }
        return $result;
    }
}