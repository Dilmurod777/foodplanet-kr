<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Distribution extends FP_ApiController {

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
            $info = $this->domestic_m->distribution_info($req['biz_no'])->row_array();
            if(empty($info)) {
                $result['result'] = 'succ';
                $result['msg'] = '등록가능한 사업자등록번호 입니다.';
            }
            else {
                $result['result'] = 'fail';
                $result['msg'] = '이미등록된 사업자등록번호 입니다.';
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
            $result['msg'] = '사업자등록번호 중복체크를 해주세요.';
        }
        else {
            $result = $this->chk_require($req);
            if($result['result'] == 'succ') {
                $req['admin_id'] = $this->data['admin']['admin_id'];

                $this->domestic_m->insert_companyd($req);
                $result['msg'] = '등록하였습니다.';
                $this->log_m->insert_log('tb_domestic_companyd', 'C', $req, $this->data['admin']['admin_id']);
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

            $this->domestic_m->insert_companyd($req);
            $result['msg'] = '수정하였습니다.';
            $this->log_m->insert_log('tb_domestic_companyd', 'U', $req, $this->data['admin']['admin_id']);
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
        else {
            $req['admin_id'] = $this->data['admin']['admin_id'];

            $this->domestic_m->delete_companyd($req);

            $result['result'] = 'succ';
            $result['msg'] = '삭제되었습니다.';
            $this->log_m->insert_log('tb_domestic_companyd', 'D', $req, $this->data['admin']['admin_id']);
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
        else if(empty($req['company_name'])) {
            $result['result'] = 'fail';
            $result['msg'] = '회사명을 입력해 주세요.';
        }
        else if(empty($req['industrial_code'])) {
            $result['result'] = 'fail';
            $result['msg'] = '산업분류코드를 입력해 주세요.';
        }
        else if(empty($req['main_product'])) {
            $result['result'] = 'fail';
            $result['msg'] = '주요상품을 선택해 주세요.';
        }
        else if(empty($req['distribution_type'])) {
            $result['result'] = 'fail';
            $result['msg'] = '유통유형을 선택해 주세요.';
        }
        else if(empty($req['sales_year'])) {
            $result['result'] = 'fail';
            $result['msg'] = '연매출을 입력해 주세요.';
        }
        else if(empty($req['sales_at'])) {
            $result['result'] = 'fail';
            $result['msg'] = '연매출 기준년을 입력해 주세요.';
        }
        else if(empty($req['credit_rating'])) {
            $result['result'] = 'fail';
            $result['msg'] = '신용등급을 입력해 주세요.';
        }
        else if(empty($req['rating_at'])) {
            $result['result'] = 'fail';
            $result['msg'] = '신용등급 기준년을 입력해 주세요.';
        }
        return $result;
    }
}