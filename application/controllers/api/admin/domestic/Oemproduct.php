<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Oemproduct extends FP_ApiController {

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
                $result['data'] = $info;
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
                $imgs = array();
                if(!empty($_FILES) && !empty($_FILES['prod_img1_attach']) && !empty($_FILES['prod_img1_attach']['tmp_name']) && !empty($_FILES['prod_img1_attach']['name'])) {
                    $res = $this->awss3_lib->upload_s3('product', $_FILES['prod_img1_attach']['tmp_name'], $_FILES['prod_img1_attach']['name']);

                    if($res['result'] === 'succ') {
                        $tmp = array();
                        $tmp['img_url'] = $res['data'];
                        $tmp['img_type'] = 'OEM_image';
                        $tmp['is_main'] = 'y';
                        $tmp['order_no'] = '1';
                        $tmp['admin_id'] = $this->data['admin']['admin_id'];
                        $imgs[] = $tmp;
                    }
                    else {
                        $result['result'] = 'fail';
                        $result['msg'] = '제품 이미지 등록에 실패했습니다. (' . $result['data'] . ')';
                        echo json_encode($result);
                        exit;
                    }
                }
                else {
                    $result['result'] = 'fail';
                    $result['msg'] = '제품 대표이미지를 입력해 주세요.';
                    echo json_encode($result);
                    exit;
                }

                for($i = 2; $i <= 5; $i++) {
                    if(!empty($_FILES) && !empty($_FILES['prod_img' . $i . '_attach']) && !empty($_FILES['prod_img' . $i . '_attach']['tmp_name']) && !empty($_FILES['prod_img' . $i . '_attach']['name'])) {
                        $res = $this->awss3_lib->upload_s3('product', $_FILES['prod_img' . $i . '_attach']['tmp_name'], $_FILES['prod_img' . $i . '_attach']['name']);

                        if($res['result'] === 'succ') {
                            $tmp = array();
                            $tmp['img_url'] = $res['data'];
                            $tmp['img_type'] = 'OEM_image';
                            $tmp['is_main'] = 'n';
                            $tmp['order_no'] = $i;
                            $tmp['admin_id'] = $this->data['admin']['admin_id'];
                            $imgs[] = $tmp;
                        }
                    }
                }

                for($i = 1; $i <= 5; $i++) {
                    if(!empty($_FILES) && !empty($_FILES['label_img' . $i . '_attach']) && !empty($_FILES['label_img' . $i . '_attach']['tmp_name']) && !empty($_FILES['label_img' . $i . '_attach']['name'])) {
                        $res = $this->awss3_lib->upload_s3('product', $_FILES['label_img' . $i . '_attach']['tmp_name'], $_FILES['label_img' . $i . '_attach']['name']);

                        if($res['result'] === 'succ') {
                            $tmp = array();
                            $tmp['img_url'] = $res['data'];
                            $tmp['img_type'] = 'OEM_label';
                            $tmp['is_main'] = 'n';
                            $tmp['order_no'] = $i;
                            $tmp['admin_id'] = $this->data['admin']['admin_id'];
                            $imgs[] = $tmp;
                        }
                    }
                }

                $req['imgs'] = $imgs;
                $this->domestic_m->insert_oemproduct($req);
                $result['msg'] = '등록하였습니다.';
                $this->log_m->insert_log('tb_domestic_oem', 'C', $req, $this->data['admin']['admin_id']);
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
                    $tmp = array();
                    $tmp['img_url'] = $res['data'];
                    $tmp['img_type'] = 'NB_image';
                    $tmp['is_main'] = 'y';
                    $tmp['order_no'] = '1';
                    $tmp['admin_id'] = $this->data['admin']['admin_id'];
                    $imgs[] = $tmp;
                }
                else {
                    $result['result'] = 'fail';
                    $result['msg'] = '제품 이미지 등록에 실패했습니다. (' . $result['data'] . ')';
                    echo json_encode($result);
                    exit;
                }
            }
            else if(empty($req['prod_img1'])) {
                $result['result'] = 'fail';
                $result['msg'] = '제품 대표이미지를 입력해 주세요.';
                echo json_encode($result);
                exit;
            }

            for($i = 2; $i <= 5; $i++) {
                if(!empty($_FILES) && !empty($_FILES['prod_img' . $i . '_attach']) && !empty($_FILES['prod_img' . $i . '_attach']['tmp_name']) && !empty($_FILES['prod_img' . $i . '_attach']['name'])) {
                    $res = $this->awss3_lib->upload_s3('product', $_FILES['prod_img' . $i . '_attach']['tmp_name'], $_FILES['prod_img' . $i . '_attach']['name']);

                    if($res['result'] === 'succ') {
                        $tmp = array();
                        $tmp['img_url'] = $res['data'];
                        $tmp['img_type'] = 'NB_image';
                        $tmp['is_main'] = 'n';
                        $tmp['order_no'] = $i;
                        $tmp['admin_id'] = $this->data['admin']['admin_id'];
                        $imgs[] = $tmp;
                    }
                }
            }

            for($i = 1; $i <= 5; $i++) {
                if(!empty($_FILES) && !empty($_FILES['label_img' . $i . '_attach']) && !empty($_FILES['label_img' . $i . '_attach']['tmp_name']) && !empty($_FILES['label_img' . $i . '_attach']['name'])) {
                    $res = $this->awss3_lib->upload_s3('product', $_FILES['label_img' . $i . '_attach']['tmp_name'], $_FILES['label_img' . $i . '_attach']['name']);

                    if($res['result'] === 'succ') {
                        $tmp = array();
                        $tmp['img_url'] = $res['data'];
                        $tmp['img_type'] = 'NB_label';
                        $tmp['is_main'] = 'n';
                        $tmp['order_no'] = $i;
                        $tmp['admin_id'] = $this->data['admin']['admin_id'];
                        $imgs[] = $tmp;
                    }
                }
            }


            if($result['result'] === 'succ') {
                $req['admin_id'] = $this->data['admin']['admin_id'];

                $this->domestic_m->update_oemproduct($req);
                $result['msg'] = '수정하였습니다.';
                $this->log_m->insert_log('tb_domestic_oem', 'U', $req, $this->data['admin']['admin_id']);
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
            $result['msg'] = '삭제할 제품을 선택해 주세요.';
        }
        else {
            $req['admin_id'] = $this->data['admin']['admin_id'];

            $this->domestic_m->delete_oemproduct($req);

            $result['result'] = 'succ';
            $result['msg'] = '삭제되었습니다.';
            $this->log_m->insert_log('tb_domestic_oem', 'D', $req, $this->data['admin']['admin_id']);
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
        else if(empty($req['product_name'])) {
            $result['result'] = 'fail';
            $result['msg'] = '제품명을 입력해 주세요.';
        }
        else if(empty($req['category'])) {
            $result['result'] = 'fail';
            $result['msg'] = '카테고리를 선택해 주세요.';
        }
        else if(empty($req['main_group'])) {
            $result['result'] = 'fail';
            $result['msg'] = '대표제품군을 입력해 주세요.';
        }
        return $result;
    }
}