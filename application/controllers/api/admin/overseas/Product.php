<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Product extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->library('awss3_lib');
        $this->load->model('admin/overseas_m', 'overseas_m');
        $this->load->model('admin/log_m', 'log_m');
    }

	public function register()
	{
		$req = $this->input->post();

		$result = $this->chk_require($req);
		if($result['result'] == 'succ') {
			$req['admin_id'] = $this->data['admin']['admin_id'];
			$req['product_img'] = '';
			$req['background_img'] = '';

			if(!empty($_FILES) && !empty($_FILES['product_img_attach']) && !empty($_FILES['product_img_attach']['tmp_name']) && !empty($_FILES['product_img_attach']['name'])) {
				$res = $this->awss3_lib->upload_s3('oproduct', $_FILES['product_img_attach']['tmp_name'], $_FILES['product_img_attach']['name']);

				if($res['result'] === 'succ') {
					$req['product_img'] = $res['data'];
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '상품 대표이미지 등록에 실패했습니다. (' . $result['data'] . ')';
					echo json_encode($result);
					exit;
				}
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '상품 대표이미지를 입력해 주세요.';
				echo json_encode($result);
				exit;
			}

			if(!empty($_FILES) && !empty($_FILES['background_img_attach']) && !empty($_FILES['background_img_attach']['tmp_name']) && !empty($_FILES['background_img_attach']['name'])) {
				$res = $this->awss3_lib->upload_s3('oproduct', $_FILES['background_img_attach']['tmp_name'], $_FILES['background_img_attach']['name']);

				if($res['result'] === 'succ') {
					$req['background_img'] = $result['data'];
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '백그라운드이미지 등록에 실패했습니다. (' . $result['data'] . ')';
					echo json_encode($result);
					exit;
				}
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '백그라운드이미지를 입력해 주세요.';
				echo json_encode($result);
				exit;
			}

			$res = $this->overseas_m->insert_product($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
				$this->log_m->insert_log('tb_overseas_product', 'C', $req, $this->data['admin']['admin_id']);
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '게시글 등록에 실패했습니다.';
			}
		}

		echo json_encode($result);		
	}

	public function edit()
	{
		$req = $this->input->post();

		$result = $this->chk_require($req);
		if($result['result'] == 'succ') {
			$req['admin_id'] = $this->data['admin']['admin_id'];
			$req['product_img'] = '';
			$req['background_img'] = '';

			if(!empty($_FILES) && !empty($_FILES['product_img_attach']) && !empty($_FILES['product_img_attach']['tmp_name']) && !empty($_FILES['product_img_attach']['name'])) {
				$res = $this->awss3_lib->upload_s3('oproduct', $_FILES['product_img_attach']['tmp_name'], $_FILES['product_img_attach']['name']);

				if($res['result'] === 'succ') {
					$req['product_img'] = $result['data'];
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '국가 대표이미지 등록에 실패했습니다. (' . $result['data'] . ')';
					echo json_encode($result);
					exit;
				}
			}

			if(!empty($_FILES) && !empty($_FILES['background_img_attach']) && !empty($_FILES['background_img_attach']['tmp_name']) && !empty($_FILES['background_img_attach']['name'])) {
				$res = $this->awss3_lib->upload_s3('oproduct', $_FILES['background_img_attach']['tmp_name'], $_FILES['background_img_attach']['name']);

				if($res['result'] === 'succ') {
					$req['background_img'] = $result['data'];
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '백그라운드이미지 등록에 실패했습니다. (' . $result['data'] . ')';
					echo json_encode($result);
					exit;
				}
			}

			$res = $this->overseas_m->update_product($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정되었습니다.';
				$this->log_m->insert_log('tb_overseas_product', 'U', $req, $this->data['admin']['admin_id']);
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '수정에 실패했습니다.';
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
			$res = $this->overseas_m->delete_product($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제되었습니다.';
				$this->log_m->insert_log('tb_overseas_product', 'D', $req, $this->data['admin']['admin_id']);
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '삭제에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}
 	
	public function chk_require($req) {
		$result = array();
		$result['result'] = 'succ';
		if(empty(trim($req['product_name']))) {
			$result['result'] = 'fail';
			$result['msg'] = '제품명을 입력해주세요.';
		}
		else if(empty(trim($req['product_name_eng']))) {
			$result['result'] = 'fail';
			$result['msg'] = '제품 영문명을 입력해주세요.';
		}
		else if(empty(trim($req['hscode']))) {
			$result['result'] = 'fail';
			$result['msg'] = 'HSCODE를 입력해주세요.';
		}
		return $result;
	}
}