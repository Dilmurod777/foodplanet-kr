<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Member extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('member_m');
		$this->load->model('company_m');
		$this->load->model('domestic_m');
	}

	public function reset()
	{
		$token = $this->uri->segment(3, '');
		
		$url = 'errors/error3_v';
		if(empty($token)) {
			$url = 'errors/error3_v';
		}
		else {
			$info = $this->member_m->member_info_by_token($token)->row_array();
			if(!empty($info)) {
				$this->data['token'] = $token;
				$url = 'front/resetpw_v';
			}
			else {
				$url = 'errors/error3_v';
			}
		}
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view($url);
		$this->load->view('front/common/footer_v');
	}

  	public function ajaxCheckId() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['member_id'])) {
			$result['result'] = 'fail';
			$result['msg'] = '아이디를 입력해 주세요.';
		}
		else {
			$info = $this->member_m->member_id_check($req['member_id'])->row_array();

			if(empty($info)) {
				$result['result'] = 'succ';
				$result['msg'] = '사용가능한 아이디입니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '이미사용중인 아이디입니다.';
			}
		}
		
		echo json_encode($result);
	}

	public function ajaxCheckNickname() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['nickname'])) {
			$result['result'] = 'fail';
			$result['msg'] = '활동명를 입력해 주세요.';
		}
		else {
			$info = $this->member_m->member_nickname_check($req['nickname'])->row_array();

			if(empty($info)) {
				$result['result'] = 'succ';
				$result['msg'] = '사용가능한 활동명입니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '이미사용중인 활동명입니다.';
			}
		}
		
		echo json_encode($result);
	}

	public function ajaxCheckTel() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['tel'])) {
			$result['result'] = 'fail';
			$result['msg'] = '연락처를 입력해 주세요.';
		}
		else {
			$info = $this->member_m->member_tel_check($req['tel'])->row_array();

			if(empty($info)) {
				$result['result'] = 'succ';
				$result['msg'] = '사용가능한 연락처입니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '이미사용중인 연락처입니다.';
			}
		}
		
		echo json_encode($result);
	}

	public function ajaxCheckEmail() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['email'])) {
			$result['result'] = 'fail';
			$result['msg'] = '이메일을 입력해 주세요.';
		}
		else {
			$info = array();
			if($req['type'] === 'company') {
				$info = $this->member_m->company_email_check($req['email'])->row_array();
			}
			else {
				$info = $this->member_m->employee_email_check($req['email'])->row_array();
			}
			

			if(empty($info)) {
				$result['result'] = 'succ';
				$result['msg'] = '사용가능한 이메일입니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '이미사용중인 이메일입니다.';
			}
		}
		
		echo json_encode($result);
	}

	public function ajaxCheckBizno() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['biz_no'])) {
			$result['result'] = 'fail';
			$result['msg'] = '사업자등록번호를 입력해 주세요.';
		}
		else {
			$info = $this->member_m->company_bizno_check($req['biz_no'])->row_array();
			if(empty($info)) {
				$result['result'] = 'succ';
				$result['msg'] = '사용가능한 사업자등록번호입니다.';
				$result['data'] = array();
				if($req['member_type'] === '1') {
					$result['data'] = $this->domestic_m->manufacture_info($req['biz_no'])->row_array();
				}
				else if($req['member_type'] === '2') {
					$result['data'] = $this->domestic_m->distribution_info($req['biz_no'])->row_array();
				}
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '이미사용중인 사업자등록번호입니다.';
			}
		}
		
		echo json_encode($result);
	}

	public function ajaxLogin() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['member_id']) || empty($req['member_pw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '아이디와 비밀번호를 입력해 주세요.';
			$result['code'] = 'empty';
		}
		else {
			$info = $this->member_m->member_id_check($req['member_id'])->row_array();
			if(empty($info)) {
				$result['result'] = 'fail';
				$result['code'] = 'id';
				$result['msg'] = '해당 아이디는 접근제한중입니다.<br>관리자에게 문의해 주세요.';

				echo json_encode($result);
				exit;
			}

			$info = $this->member_m->member_login_check($req)->row_array();
			if(!empty($info)) {
				if($info['is_leave'] === 'y') {
					$result['result'] = 'fail';
					$result['code'] = 'leave';
					$result['msg'] = '탈퇴한 회원입니다.<br>관리자에게 문의해 주세요.';
				}
				else if($info['is_block'] === 'y') {
					$result['result'] = 'fail';
					$result['code'] = 'block';
					$result['msg'] = '해당 아이디는 접근제한중입니다.<br>관리자에게 문의해 주세요.';
				}
				else if($info['is_dormant'] === 'y') {
					$result['result'] = 'fail';
					$result['code'] = 'dormant';
					$result['msg'] = '휴면회원입니다.<br>관리자에게 문의해 주세요.';
				}
				else {
					$result['result'] = 'succ';
					$result['msg'] = '';
					
					$member = array();
					$member['seq'] = $info['seq'];
					$member['member_id'] = $info['member_id'];
					$member['name'] = $info['name'];
					$member['member_type'] = $info['member_type'];
					$member['profile_img'] = $info['profile_img'];

//					$_SESSION['member'] = $member;
					$this->session->set_userdata('member', $member);

					$val = array();
					$val['seq'] = $info['seq'];
					$val['last_login_ip'] = $this->get_client_ip();
					$this->member_m->update_login($val);
				}
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '';
				$result['code'] = 'pw';
			}
		}
		
		echo json_encode($result);
	}
}