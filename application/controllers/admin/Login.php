<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('excel');
        $this->load->model('admin/admin_m', 'admin_m');
    }

	public function  index() {
		$this->load->view('admin/common/include/header_v');
		$this->load->view('admin/login_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function ajaxLoginAction() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['adminId'])) {
			$result['result'] = 'fail';
			$result['msg'] = '아이디를 입력해주세요.';
		}
		else if(empty($req['adminPw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호를 입력해주세요.';
		}
		else {
			$res = $this->admin_m->login_check($req['adminId'], $req['adminPw'])->row_array();
			if(empty($res)) {
				$result['result'] = 'fail';
				$result['msg'] = '아이디 또는 비밀번호가 일치하지 않습니다.';
			}
			else if($res['is_block'] === 'y') {
				$result['result'] = 'fail';
				$result['msg'] = '[' . $res['blocked_reason'] . '] 사유로 접근금지 되었습니다. 관리자에게 문의해 주세요.';
			}
			else {
				$this->admin_m->update_last_login($res['admin_seq']);
				$this->session->set_userdata('admin', $res);
				$result['result'] = 'succ';
				$result['msg'] = '';
			}
		}

		echo json_encode($result);
		exit;
	}

	public function logout() {
		$this->session->unset_userdata('admin');
		header('Location: /admin/login');
	}
}