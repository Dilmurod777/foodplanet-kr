<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Requirement extends FP_ApiController {

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

			$res = $this->overseas_m->insert_requirement($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
				$this->log_m->insert_log('tb_overseas_requirement', 'C', $req, $this->data['admin']['admin_id']);
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

			$res = $this->overseas_m->update_requirement($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정되었습니다.';
				$this->log_m->insert_log('tb_overseas_requirement', 'U', $req, $this->data['admin']['admin_id']);
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
			$result['msg'] = '삭제할 문서를 선택해 주세요.';
		}
		else {
			$req['admin_id'] = $this->data['admin']['admin_id'];
			$res = $this->overseas_m->delete_requirement($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제되었습니다.';
				$this->log_m->insert_log('tb_overseas_requirement', 'D', $req, $this->data['admin']['admin_id']);
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
		else if(empty(trim($req['product_name']))) {
			$result['result'] = 'fail';
			$result['msg'] = '품목을 입력해주세요.';
		}
		else if(empty(trim($req['hscode']))) {
			$result['result'] = 'fail';
			$result['msg'] = 'HSCODE를 입력해주세요.';
		}
		else if(empty(trim($req['export_requirement']))) {
			$result['result'] = 'fail';
			$result['msg'] = '수출국 요건을 입력해주세요.';
		}
		return $result;
	}
}