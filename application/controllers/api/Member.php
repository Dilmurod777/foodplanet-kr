<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Member extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('member_m');
        $this->load->model('file_m');
    }

  	public function change_password() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['old_pw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '현재 비밀번호를 입력해주세요.';
		}
		else if(empty($req['new_pw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '신규 비밀번호를 입력해주세요.';
		}
		else if($req['new_pw'] !== $req['new_pw_confirm']) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호확인이 일치하지 않습니다.';
		}
		else {
			$info = $this->member_m->member_pw_check($this->data['member']['seq'], $req['old_pw'])->row_array();
			if(empty($info)) {
				$result['result'] = 'fail';
				$result['msg'] = '현재 비밀번호가 일치하지 않습니다.';
			}
			else {
				$res = $this->member_m->update_password($this->data['member']['seq'], $req['new_pw']);

				if($res) {
					$result['result'] = 'succ';
					$result['msg'] = '비밀번호가 변경되었습니다.';
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '비밀번호 변경에 실패했습니다.';
				}
			}
		}

		echo json_encode($result);
		exit;
	}

	public function change_password2() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['new_pw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '신규 비밀번호를 입력해주세요.';
		}
		else if($req['new_pw'] !== $req['new_pw_confirm']) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호확인이 일치하지 않습니다.';
		}
		else {
			$res = $this->member_m->update_password($req['seq'], $req['new_pw']);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '비밀번호가 변경되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '비밀번호 변경에 실패했습니다.';
			}
		}

		echo json_encode($result);
		exit;
	}

	public function change_profile_img() {
		$req = $this->input->post();

		$result = array();
		if(!empty($_FILES) && !empty($_FILES['profile_img']) && !empty($_FILES['profile_img']['name'])) {
			$res = $this->upload_file('profile','profile_img');
			if($res['status'] == 'fail') {
				echo json_encode($res);
				exit;
			}
			
			$this->file_m->delete_file_by_parent('profile', $this->data['member']['seq']);

			$value = array();

			$value['parent_gbn'] = 'profile';
			$value['parent_cd'] = $this->data['member']['seq'];
			$value['org_filename'] = $res['fileinfo']['orgname'];
            $value['new_filepath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
            $value['new_filename'] = $res['fileinfo']['newname'];
            $value['file_size'] = $res['fileinfo']['size'];
            $value['file_ext'] = $res['fileinfo']['ext'];
			$value['created_by'] = $this->data['member']['member_id'];
			$value['updated_by'] = $this->data['member']['member_id'];
			$res2 = $this->file_m->insert_file($value);

			if($res2) {
				$result['result'] = 'succ';
				$result['msg'] = '프로필 이미지를 변경했습니다.';
				$result['data'] = $res['fileinfo'];
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '프로필 이미지 변경에 실패했습니다.';
			}
		}
		else {
			$result['result'] = 'fail';
			$result['msg'] = '프로필 이미지를 등록해 주세요.';
		}
		echo json_encode($result);
		exit;
	}
	
	public function change_nickname() {
		$req = $this->input->post();
		$result = array();
		if(empty($req['nickname'])) {
			$result['result'] = 'fail';
			$result['msg'] = '변경할 활동명을 입력해주세요.';
		}
		else {
			$info = $this->member_m->member_nickname_check2($this->data['member']['seq'], $req['nickname'])->row_array();
			if(!empty($info)) {
				$result['result'] = 'fail';
				$result['msg'] = '이미 사용중인 활동명입니다.';
			}
			else {
				$res = $this->member_m->update_field($this->data['member']['seq'], 'nickname', $req['nickname']);
				if($res) {
					$result['result'] = 'succ';
					$result['msg'] = '활동명을 변경했습니다.';
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '활동명 변경에 실패했습니다.';
				}
			}
		}

		echo json_encode($result);
		exit;
	}

	public function update() {
		$req = $this->input->post();

		$result = array();
		if(empty($this->data['member'])) {
			$result['result'] = 'login';
			$result['msg'] = '로그인이 필요합니다.';
		}
		else if(empty($req['interest'])) {
			$result['result'] = 'fail';
			$result['msg'] = '주요관심사를 입력해주세요.';
		}
		else {
			$req['seq'] = $this->data['member']['seq'];
			$req['member_id'] = $this->data['member']['member_id'];

			if(!empty($_FILES) && !empty($_FILES['profile_img']) && !empty($_FILES['profile_img']['name'])) {
				$res = $this->upload_file('profile', 'profile_img');
				if($res['status'] == 'fail') {
					echo json_encode($res);
					exit;
				}
					
				$req['profile_img_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
				$req['profile_img_newname'] = $res['fileinfo']['newname'];
				$req['profile_img_orgname'] = $res['fileinfo']['orgname'];
				$req['profile_img_ext'] = $res['fileinfo']['ext'];
				$req['profile_img_size'] = $res['fileinfo']['size'];
			}

			$res = $this->member_m->update_member($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정되었습니다.';

				$info = $this->member_m->member_info($this->data['member']['seq'])->row_array();
				$this->data['member']['profile_img'] = $info['profile_img'];
				$this->session->set_userdata('member', $this->data['member']);
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '수정에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}

	public function leave() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '탈퇴처리할 회원을 선택해주세요.';
		}
		else if(empty($req['leaved_memo'])) {
			$result['result'] = 'fail';
			$result['msg'] = '탈퇴사유를 입력해주세요.';
		}
		else {
			$res = $this->member_m->update_member_leave($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '탈퇴처리되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '탈퇴처리에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}

	public function block() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '차단처리할 회원을 선택해주세요.';
		}
		else if(empty($req['blocked_memo'])) {
			$result['result'] = 'fail';
			$result['msg'] = '차단사유를 입력해주세요.';
		}
		else {
			$res = $this->member_m->update_member_block($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '차단처리되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '차단처리에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}

	public function unleave() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '탈퇴복원할 회원을 선택해주세요.';
		}
		else {
			$res = $this->member_m->update_member_unleave($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '복원되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '복원처리에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}

	public function unblock() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '차단해제할 회원을 선택해주세요.';
		}
		else {
			$res = $this->member_m->update_member_unblock($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '차단해제되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '차단해제에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}

}