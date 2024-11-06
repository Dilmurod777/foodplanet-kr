<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Np extends FP_ApiController {

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
			$req['distribution_status'] = '';

			if(!empty($_FILES) && !empty($_FILES['distribution_status_attach']) && !empty($_FILES['distribution_status_attach']['tmp_name']) && !empty($_FILES['distribution_status_attach']['name'])) {
				$res = $this->awss3_lib->upload_s3('onp', $_FILES['distribution_status_attach']['tmp_name'], $_FILES['distribution_status_attach']['name']);

				if($res['result'] === 'succ') {
					$req['distribution_status'] = $res['data'];
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '유통현황이미지 등록에 실패했습니다. (' . $result['data'] . ')';
					echo json_encode($result);
					exit;
				}
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '유통현황이미지를 입력해 주세요.';
				echo json_encode($result);
				exit;
			}

			$res = $this->overseas_m->insert_np($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
				$this->log_m->insert_log('tb_overseas_np', 'C', $req, $this->data['admin']['admin_id']);
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
			$req['distribution_status'] = '';

			if(!empty($_FILES) && !empty($_FILES['distribution_status_attach']) && !empty($_FILES['distribution_status_attach']['tmp_name']) && !empty($_FILES['distribution_status_attach']['name'])) {
				$res = $this->awss3_lib->upload_s3('onp', $_FILES['distribution_status_attach']['tmp_name'], $_FILES['distribution_status_attach']['name']);

				if($res['result'] === 'succ') {
					$req['distribution_status'] = $res['data'];
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '유통현황이미지 등록에 실패했습니다. (' . $result['data'] . ')';
					echo json_encode($result);
					exit;
				}
			}

			$res = $this->overseas_m->update_np($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정되었습니다.';
				$this->log_m->insert_log('tb_overseas_np', 'U', $req, $this->data['admin']['admin_id']);
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
			$result['msg'] = '삭제할 국가별품목을 선택해 주세요.';
		}
		else {
			$req['admin_id'] = $this->data['admin']['admin_id'];
			$res = $this->overseas_m->delete_np($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제되었습니다.';
				$this->log_m->insert_log('tb_overseas_np', 'D', $req, $this->data['admin']['admin_id']);
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
		if(empty(trim($req['nation_seq']))) {
			$result['result'] = 'fail';
			$result['msg'] = '국가를 선택해주세요.';
		}
		else if(empty(trim($req['product_seq']))) {
			$result['result'] = 'fail';
			$result['msg'] = '품목을 선택해주세요.';
		}
		else if(empty(trim($req['export_price']))) {
			$result['result'] = 'fail';
			$result['msg'] = '수출액을 입력해주세요.';
		}
		return $result;
	}
}