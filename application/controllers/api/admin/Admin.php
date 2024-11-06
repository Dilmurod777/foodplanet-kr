<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Admin extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('admin/admin_m', 'admin_m');
        $this->load->model('admin/log_m', 'log_m');
    }

	public function register()
	{
		$req = $this->input->post();

		$result = array();
		if(empty($req['admin_id'])) {
			$result['result'] = 'fail';
			$result['msg'] = '관리자ID를 입력해주세요.';
		}
		else if(empty($req['admin_name'])) {
			$result['result'] = 'fail';
			$result['msg'] = '관리자이름을 입력해주세요.';
		}
		else if(!$this->check_passowrd($req['admin_pw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호는 영문,숫자,특수문자(@$!%*#?&) 포함 8자 이상입니다.';
		}
		else if($req['admin_pw'] !== $req['admin_pw_confirm']) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호 확인이 일치하지 않습니다.';
		}
		else if(!$this->check_phone($req['admin_tel'])) {
			$result['result'] = 'fail';
			$result['msg'] = '관리자 연락처 형식이 정확하지 않습니다.';
		}
		else if(!$this->check_email($req['admin_email'])) {
			$result['result'] = 'fail';
			$result['msg'] = '관리자 이메일 형식이 정확하지 않습니다.';
		}
		else {
			$res = $this->admin_m->admin_info_by_id($req['admin_id'])->row_array();
			if(!empty($req)) {
				$result['result'] = 'fail';
				$result['msg'] = '이미 등록된 ID입니다.';
			}
			else {
				$req['admin_id2'] = $this->data['admin']['admin_id'];

				$res = $this->admin_m->insert_admin($req);
	
				if($res) {
					$result['result'] = 'succ';
					$result['msg'] = '등록되었습니다.';
					$this->log_m->insert_log('tb_admin', 'C', $req, $this->data['admin']['admin_id']);
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '관리자 등록에 실패했습니다.';
				}
			}
		}

		echo json_encode($result);		
	}

	public function edit()
	{
		$req = $this->input->post();

		$result = array();
		if(empty($req['admin_name'])) {
			$result['result'] = 'fail';
			$result['msg'] = '관리자이름을 입력해주세요.';
		}
		else if(!$this->check_phone($req['admin_tel'])) {
			$result['result'] = 'fail';
			$result['msg'] = '관리자 연락처 형식이 정확하지 않습니다.';
		}
		else if(!$this->check_email($req['admin_email'])) {
			$result['result'] = 'fail';
			$result['msg'] = '관리자 이메일 형식이 정확하지 않습니다.';
		}
		else {
			$req['admin_id2'] = $this->data['admin']['admin_id'];

			$res = $this->admin_m->update_admin($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정되었습니다.';
				$this->log_m->insert_log('tb_admin', 'U', $req, $this->data['admin']['admin_id']);
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
		if(empty($req['admin_seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '삭제할 관리자를 선택해 주세요.';
		}
		else {
			$req['admin_id2'] = $this->data['admin']['admin_id'];
			$res = $this->admin_m->delete_admin($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제되었습니다.';
				$this->log_m->insert_log('tb_admin', 'D', $req, $this->data['admin']['admin_id']);
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '삭제에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}
 	
	public function change_pw()
	{
		$req = $this->input->post();

		$result = array();
		if(empty($req['admin_seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '관리자를 선택해주세요.';
		}
		else if(!$this->check_passowrd($req['admin_pw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호는 영문,숫자,특수문자(@$!%*#?&) 포함 8자 이상입니다.';
		}
		else if($req['admin_pw'] !== $req['admin_pw_confirm']) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호 확인이 일치하지 않습니다.';
		}
		else {
			$req['admin_id2'] = $this->data['admin']['admin_id'];

			$res = $this->admin_m->change_pw($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '수정에 실패했습니다.';
			}
		}

		echo json_encode($result);		
	}

	public function change_pw_mine()
	{
		$req = $this->input->post();

		$result = array();
		if(empty($req['old_pw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '현재 비밀번호를 입력해주세요.';
		}
		else if(!$this->check_passowrd($req['admin_pw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호는 영문,숫자,특수문자(@$!%*#?&) 포함 8자 이상입니다.';
		}
		else if($req['admin_pw'] !== $req['admin_pw_confirm']) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호 확인이 일치하지 않습니다.';
		}
		else {
			$res = $this->admin_m->login_check($this->data['admin']['admin_id'], $req['old_pw'])->row_array();
			if(empty($res)) {
				$result['result'] = 'fail';
				$result['msg'] = '현재 비밀번호가 정확하지 않습니다.';
			}
			else {
				$req['admin_id2'] = $this->data['admin']['admin_id'];
				$req['admin_seq'] = $this->data['admin']['admin_seq'];
				$res = $this->admin_m->change_pw($req);

				if($res) {
					$result['result'] = 'succ';
					$result['msg'] = '수정되었습니다.';
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '수정에 실패했습니다.';
				}
			}

		}

		echo json_encode($result);		
	}

}