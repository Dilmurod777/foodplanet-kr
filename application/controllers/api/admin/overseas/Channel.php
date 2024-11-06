<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Channel extends FP_ApiController {

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
			$req['url'] = '';

			if(!empty($_FILES) && !empty($_FILES['url_attach']) && !empty($_FILES['url_attach']['tmp_name']) && !empty($_FILES['url_attach']['name'])) {
				$res = $this->awss3_lib->upload_s3('ochannel', $_FILES['url_attach']['tmp_name'], $_FILES['url_attach']['name']);

				if($res['result'] === 'succ') {
					$req['url'] = $res['data'];
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '채널이미지 등록에 실패했습니다. (' . $result['data'] . ')';
					echo json_encode($result);
					exit;
				}
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '채널이미지를 등록해주세요.';
				echo json_encode($result);
				exit;
			}

			$res = $this->overseas_m->insert_channel($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
				$this->log_m->insert_log('tb_overseas_channel', 'C', $req, $this->data['admin']['admin_id']);
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
			$req['url'] = '';
			if(!empty($_FILES) && !empty($_FILES['url_attach']) && !empty($_FILES['url_attach']['tmp_name']) && !empty($_FILES['url_attach']['name'])) {
				$res = $this->awss3_lib->upload_s3('ochannel', $_FILES['url_attach']['tmp_name'], $_FILES['url_attach']['name']);

				if($res['result'] === 'succ') {
					$req['url'] = $res['data'];
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '채널이미지 등록에 실패했습니다. (' . $result['data'] . ')';
					echo json_encode($result);
					exit;
				}
			}

			$res = $this->overseas_m->update_channel($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정되었습니다.';
				$this->log_m->insert_log('tb_overseas_channel', 'U', $req, $this->data['admin']['admin_id']);
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
			$result['msg'] = '삭제할 채널을 선택해 주세요.';
		}
		else {
			$req['admin_id'] = $this->data['admin']['admin_id'];
			$res = $this->overseas_m->delete_channel($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제되었습니다.';
				$this->log_m->insert_log('tb_overseas_channel', 'D', $req, $this->data['admin']['admin_id']);
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
		else if(empty(trim($req['channel_name']))) {
			$result['result'] = 'fail';
			$result['msg'] = '채널명을 입력해주세요.';
		}
		else if(empty(trim($req['channel_name_eng']))) {
			$result['result'] = 'fail';
			$result['msg'] = '영문 채널명을 입력해주세요.';
		}
		else if(empty(trim($req['channel_name_origin']))) {
			$result['result'] = 'fail';
			$result['msg'] = '채널 원어명을 입력해주세요.';
		}
		return $result;
	}
}