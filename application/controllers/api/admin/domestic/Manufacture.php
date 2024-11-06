<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Manufacture extends FP_ApiController {

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
                $req['logo_img'] = '';
                $req['introduce_file'] = '';

                if(!empty($_FILES) && !empty($_FILES['logo_img_attach']) && !empty($_FILES['logo_img_attach']['tmp_name']) && !empty($_FILES['logo_img_attach']['name'])) {
                    $result = $this->awss3_lib->upload_s3('bizcard', $_FILES['logo_img_attach']['tmp_name'], $_FILES['logo_img_attach']['name']);
                    if($result['result'] === 'succ') {
                        $req['logo_img'] = $result['data'];
                    }
                }
                if(!empty($_FILES) && !empty($_FILES['introduce_file_attach']) && !empty($_FILES['introduce_file_attach']['tmp_name']) && !empty($_FILES['introduce_file_attach']['name'])) {
                    $result = $this->awss3_lib->upload_s3('introduce', $_FILES['introduce_file_attach']['tmp_name'], $_FILES['introduce_file_attach']['name']);
                    if($result['result'] === 'succ') {
                        $req['introduce_file'] = $result['data'];
                    }
                }
                $req['admin_id'] = $this->data['admin']['admin_id'];

                $this->domestic_m->insert_companym($req);
                $result['msg'] = '등록하였습니다.';
                $this->log_m->insert_log('tb_domestic_finance', 'C', $req, $this->data['admin']['admin_id']);
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
            if(!empty($_FILES) && !empty($_FILES['logo_img_attach']) && !empty($_FILES['logo_img_attach']['tmp_name']) && !empty($_FILES['logo_img_attach']['name'])) {
                $result = $this->awss3_lib->upload_s3('bizcard', $_FILES['logo_img_attach']['tmp_name'], $_FILES['logo_img_attach']['name']);
                if($result['result'] === 'succ') {
                    $req['logo_img'] = $result['data'];
                }
            }
            if(!empty($_FILES) && !empty($_FILES['introduce_file_attach']) && !empty($_FILES['introduce_file_attach']['tmp_name']) && !empty($_FILES['introduce_file_attach']['name'])) {
                $result = $this->awss3_lib->upload_s3('introduce', $_FILES['introduce_file_attach']['tmp_name'], $_FILES['introduce_file_attach']['name']);
                if($result['result'] === 'succ') {
                    $req['introduce_file'] = $result['data'];
                }
            }
            $req['admin_id'] = $this->data['admin']['admin_id'];

            $this->domestic_m->insert_companym($req);
            $result['msg'] = '수정하였습니다.';
            $this->log_m->insert_log('tb_domestic_finance', 'U', $req, $this->data['admin']['admin_id']);
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

            $this->domestic_m->delete_companym($req);

            $result['result'] = 'succ';
            $result['msg'] = '삭제되었습니다.';
            $this->log_m->insert_log('tb_domestic_finance', 'D', $req, $this->data['admin']['admin_id']);
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
        else if(empty($req['ceo_name'])) {
            $result['result'] = 'fail';
            $result['msg'] = '대표자명을 입력해 주세요.';
        }
        else if(empty($req['company_tel'])) {
            $result['result'] = 'fail';
            $result['msg'] = '대표연락처를 입력해 주세요.';
        }
        else if(!$this->check_phone($req['company_tel'])) {
            $result['result'] = 'fail';
            $result['msg'] = '연락처 형식이 올바르지 않습니다.';
        }
        else if(empty($req['addr'])) {
            $result['result'] = 'fail';
            $result['msg'] = '주소를 입력해 주세요.';
        }
        else if(empty($req['incorporation_at'])) {
            $result['result'] = 'fail';
            $result['msg'] = '설립일을 입력해 주세요.';
        }
        else if(empty($req['industrial_code'])) {
            $result['result'] = 'fail';
            $result['msg'] = '산업분류코드를 입력해 주세요.';
        }
        else if(empty($req['category'])) {
            $result['result'] = 'fail';
            $result['msg'] = '카테고리를 선택해 주세요.';
        }
        else if(empty($req['main_group'])) {
            $result['result'] = 'fail';
            $result['msg'] = '대표제품군을 입력해 주세요.';
        }
        else if(empty($req['main_product'])) {
            $result['result'] = 'fail';
            $result['msg'] = '주요제품을 입력해 주세요.';
        }
        return $result;
    }
}