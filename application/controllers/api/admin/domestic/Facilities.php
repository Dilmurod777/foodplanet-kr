<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Facilities extends FP_ApiController {

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
                if(!empty($_FILES) && !empty($_FILES['img_url_attach']) && !empty($_FILES['img_url_attach']['tmp_name']) && !empty($_FILES['img_url_attach']['name'])) {
                    $result = $this->awss3_lib->upload_s3('facilities', $_FILES['img_url_attach']['tmp_name'], $_FILES['img_url_attach']['name']);

                    if($result['result'] === 'succ') {
                        $req['img_url'] = $result['data'];
                        $req['admin_id'] = $this->data['admin']['admin_id'];

                        $this->domestic_m->insert_facilities($req);
                        $result['msg'] = '등록하였습니다.';
                        $this->log_m->insert_log('tb_domestic_facilities', 'C', $req, $this->data['admin']['admin_id']);
                    }
                    else {
                        $result['result'] = 'fail';
                        $result['msg'] = '설비 이미지 등록에 실패했습니다. (' . $result['data'] . ')';
                    }
                }
                else {
                    $result['result'] = 'fail';
                    $result['msg'] = '설비 이미지를 입력해 주세요.';
                }

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
            if(!empty($_FILES) && !empty($_FILES['img_url_attach']) && !empty($_FILES['img_url_attach']['tmp_name']) && !empty($_FILES['img_url_attach']['name'])) {
                $result = $this->awss3_lib->upload_s3('facilities', $_FILES['img_url_attach']['tmp_name'], $_FILES['img_url_attach']['name']);
                if($result['result'] === 'succ') {
                    $req['img_url'] = $result['data'];
                }
                else {
                    $result['result'] = 'fail';
                    $result['msg'] = '설비 이미지 등록에 실패했습니다. (' . $result['data'] . ')';
                }
            }

            if($result['result'] === 'succ') {
                $req['admin_id'] = $this->data['admin']['admin_id'];

                $this->domestic_m->update_facilities($req);
                $result['msg'] = '수정하였습니다.';
                $this->log_m->insert_log('tb_domestic_facilities', 'U', $req, $this->data['admin']['admin_id']);
            }
        }

        echo json_encode($result);
    }

    public function delete()
    {
		$req = $this->input->post();

        $result = array();
        if(empty($req['seq'])) {
            $result['result'] = 'fail';
            $result['msg'] = '삭제할 설비를 선택해 주세요.';
        }
        else {
            $req['admin_id'] = $this->data['admin']['admin_id'];

            $this->domestic_m->delete_facilities($req);

            $result['result'] = 'succ';
            $result['msg'] = '삭제되었습니다.';
            $this->log_m->insert_log('tb_domestic_facilities', 'D', $req, $this->data['admin']['admin_id']);
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
        else if(empty($req['img_desc'])) {
            $result['result'] = 'fail';
            $result['msg'] = '설비명을 입력해 주세요.';
        }
        return $result;
    }
}