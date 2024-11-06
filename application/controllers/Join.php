<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Join extends FP_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('common_m');
		$this->load->model('member_m');
		$this->load->model('company_m');
	}

  	public function step1() {
		$this->data['interest'] = $this->common_m->code_list('interest')->result_array();

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/join/step1_v');
		$this->load->view('front/common/footer_v');
	}
	
    public function step2() {
		header('Location: /join/step1');  
		exit;
		
		$req = $this->input->post();

        if(empty($req['member_type'])) {
			header('Location: /join/step1');  
            exit;
        }
        else if($req['member_type'] !== '1' && $req['member_type'] !== '2' && $req['member_type'] !== '3') {
			header('Location: /join/step1');  
            exit;
        }

        $this->data['req'] = $req;
		$this->data['nation'] = $this->common_m->code_list('nation')->result_array();
		$this->data['industry'] = $this->common_m->code_list('industry')->result_array();
		$this->data['company_type'] = $this->common_m->code_list('company_type')->result_array();

		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/join/step2_v');
		$this->load->view('front/common/footer_v');
	}

    public function step3() {
		header('Location: /join/step1');  
		exit;

		$req = $this->input->post();

		$result = $this->fnChkReq($req);
		if($result['result'] != 'succ') {
			header('Location: /join/step1');  
            exit;
		}

		$this->data['req'] = $req;
		$this->data['info'] = $this->company_m->admin_company_by_bizno($req['biz_no'])->row_array();
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/join/step3_v');
		$this->load->view('front/common/footer_v');
	}

    public function complete() {
		$this->load->view('front/common/header_v', $this->data);
		$this->load->view('front/common/top_v');
		$this->load->view('front/join/complete_v');
		$this->load->view('front/common/footer_v');
	}

	public function ajaxJoin() {
		$req = $this->input->post();

		$result = $this->fnChkReq($req);;
		if($result['result'] == 'succ') {
			$req['joined_ip'] = $this->get_client_ip();

			if(!empty($_FILES) && !empty($_FILES['profile_img']) && !empty($_FILES['profile_img']['name'])) {
				$res = $this->upload_file('profile', 'profile_img');
				if($res['status'] == 'fail') {
					echo json_encode($res);
					exit;
				}
				
				$req['profile_img_newpath']	= $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
				$req['profile_img_newname']	= $res['fileinfo']['newname'];
				$req['profile_img_orgname']	= $res['fileinfo']['orgname'];
				$req['profile_img_ext']	= $res['fileinfo']['ext'];
				$req['profile_img_size']	= $res['fileinfo']['size'];
			}
			if(!empty($_FILES) && !empty($_FILES['bizcard_file']) && !empty($_FILES['bizcard_file']['name'])) {
				$res = $this->upload_file('bizcard', 'bizcard_file');
				if($res['status'] == 'fail') {
					echo json_encode($res);
					exit;
				}
				
				$req['bizcard_file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
				$req['bizcard_file_newname'] = $res['fileinfo']['newname'];
				$req['bizcard_file_orgname'] = $res['fileinfo']['orgname'];
				$req['bizcard_file_ext'] = $res['fileinfo']['ext'];
				$req['bizcard_file_size'] = $res['fileinfo']['size'];
			}
			$res = $this->member_m->insert_member($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '사용자 등록에 실패했습니다.';
			}
		}

		echo json_encode($result);		
	}

	public function ajaxComplete() {
		$req = $this->input->post();

		$result = $this->fnChkReq($req);;
		if($result['result'] == 'succ') {
			$res = $this->member_m->insert_member($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '회원가입에 실패했습니다. 관리자에게 문의해 주세요.';
			}
		}

		echo json_encode($result);		
	}

	private function fnChkReq($req) {
		if(empty($req['member_type'])) {
			$result['result'] = 'fail';
			$result['msg'] = '사용자 종류를 선택해 주세요.';
		}
		else if(empty($req['member_id'])) {
			$result['result'] = 'fail';
			$result['msg'] = '사용자 아이디를 입력해 주세요.';
		}
		else if(empty($req['member_pw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호를 입력해 주세요.';
		}
		else if($req['member_pw'] !== $req['member_pw_confirm']) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호 확인이 일치하지 않습니다.';
		}
		else if(empty($req['name'])) {
			$result['result'] = 'fail';
			$result['msg'] = '성명을 입력해 주세요.';
		}
		else if(empty($req['interest'])) {
			$result['result'] = 'fail';
			$result['msg'] = '주요관심사를 선택해 주세요.';
		}
		else if(empty($req['tel'])) {
			$result['result'] = 'fail';
			$result['msg'] = '연락처를 입력해 주세요.';
		}
		else if(empty($req['email'])) {
			$result['result'] = 'fail';
			$result['msg'] = '이메일을 입력해 주세요.';
		}
		else {
			$info = $this->member_m->member_id_check($req['member_id'])->row_array();
			if(!empty($info)) {
				$result['result'] = 'fail';
				$result['msg'] = '이미사용중인 아이디입니다.';
				return $result;
				exit;
			}

			$info = $this->member_m->member_email_check($req['email'])->row_array();
			if(!empty($info)) {
				$result['result'] = 'fail';
				$result['msg'] = '이미사용중인 이메일입니다.';
				return $result;
				exit;
			}

			$info = $this->member_m->member_tel_check($req['tel'])->row_array();
			if(!empty($info)) {
				$result['result'] = 'fail';
				$result['msg'] = '이미사용중인 연락처입니다.';
				return $result;
				exit;
			}

			$result['result'] = 'succ';
			$result['msg'] = '';
		}
		
		return $result;
	}
}