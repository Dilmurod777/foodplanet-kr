<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Board extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('stibee_lib');
        $this->load->model('board_m');
        $this->load->model('common_m');
        $this->load->model('admin/log_m', 'log_m');
    }

	public function qna_register()
	{
		$req = $this->input->post();

		$result = array();
		if(empty(trim($req['company_name']))) {
			$result['result'] = 'fail';
			$result['msg'] = '회사명을 입력해 주세요.';
		}
		else if(empty(trim($req['employee_name']))) {
			$result['result'] = 'fail';
			$result['msg'] = '담당자명을 입력해 주세요.';
		}
		else if(empty(trim($req['employee_tel']))) {
			$result['result'] = 'fail';
			$result['msg'] = '담당자 연락처를 입력해 주세요.';
		}
		else if(empty(trim($req['employee_email']))) {
			$result['result'] = 'fail';
			$result['msg'] = '담당자 이메일을 입력해 주세요.';
		}
		else if(empty(trim($req['contents']))) {
			$result['result'] = 'fail';
			$result['msg'] = '내용을 입력해 주세요.';
		}
		else {
			$req['company_name'] = $this->html_encode($req['company_name']);
			$req['employee_name'] = $this->html_encode($req['employee_name']);
			$req['contents'] = $this->html_encode($req['contents']);
			$req['seq'] = $this->data['member']['seq'];
			$req['member_id'] = $this->data['member']['member_id'];

			if(!empty($_FILES) && !empty($_FILES['files']) && !empty($_FILES['files']['name'])) {
				$res = $this->upload_file('qna', 'files');
				if($res['status'] == 'fail') {
					echo json_encode($res);
					exit;
				}
				
				$req['file_newpath']	= $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
				$req['file_newname']	= $res['fileinfo']['newname'];
				$req['file_orgname']	= $res['fileinfo']['orgname'];
				$req['file_ext']	= $res['fileinfo']['ext'];
				$req['file_size']	= $res['fileinfo']['size'];
			}

			$res = $this->board_m->insert_qna($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '문의 등록에 실패했습니다.';
			}
		}

		echo json_encode($result);		
	}

	public function qna_answer()
	{
		$req = $this->input->post();

		$result = array();
		if(empty(trim($req['answer_title']))) {
			$result['result'] = 'fail';
			$result['msg'] = '제목을 입력해 주세요.';
		}
		else if(empty(trim($req['answer']))) {
			$result['result'] = 'fail';
			$result['msg'] = '내용을 입력해 주세요.';
		}
		else {
			$data = array();
			$data['subscriber'] = $req['employee_email'];
			$data['answer'] = nl2br($req['answer']);

			$res = $this->stibee_lib->send_mail($req['employee_email'], $data, STIBEE_QNA);

			if(!empty($res) && $res === 'ok') {

				$req['answer_title'] = $this->html_encode($req['answer_title']);
				$req['answer'] = $this->html_encode($req['answer']);
				$req['member_id'] = $this->data['admin']['admin_id'];
	
				if(!empty($_FILES) && !empty($_FILES['attach_file']) && !empty($_FILES['attach_file']['name'])) {
					$res = $this->upload_file('qna', 'attach_file');
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$req['file_newpath']	= $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$req['file_newname']	= $res['fileinfo']['newname'];
					$req['file_orgname']	= $res['fileinfo']['orgname'];
					$req['file_ext']	= $res['fileinfo']['ext'];
					$req['file_size']	= $res['fileinfo']['size'];
				}
	
				$res = $this->board_m->update_qna($req);
	
				if($res) {
					$result['result'] = 'succ';
					$result['msg'] = '답변하였습니다.';
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '문의 답변에 실패했습니다.';
				}
	
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '이메일 발송에 실패했습니다.';
			}

		}

		echo json_encode($result);		
	}

	public function faq()
	{
		$req = $this->input->post();

		$uri1 = $this->uri->segment(4, '');
		$uri2 = $this->uri->segment(5, '');

		$result = array();
		if($uri1 === 'category') {
			if($uri2 === 'change_order') {
				$result = $this->category_change_order($req);
			}
			else if($uri2 === 'delete') {
				$result = $this->category_delete($req);
			} 
			else if($uri2 === 'update') {
				$result = $this->category_update($req);
			}
			else if($uri2 === 'register') {
				$result = $this->category_register($req);
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '잘못된 접근입니다.';
			}
		}
		else if($uri1 === 'change_order') {
			$result = $this->change_order($req);
		}
		else if($uri1 === 'register') {
			$result = $this->faq_register($req);
		}
		else if($uri1 === 'update') {
			$result = $this->faq_update($req);
		}
		else if($uri1 === 'delete') {
			$result = $this->faq_delete($req);
		}
		else if($uri1 === 'info') {
			$result = $this->faq_info($req);
		}
		else {
			$result['result'] = 'fail';
			$result['msg'] = '잘못된 접근입니다.';
		}
		
		echo json_encode($result);
	}

	private function change_order($req) {
		$req['member_id'] = $this->data['admin']['admin_id'];

		$res = $this->board_m->change_order($req);
		
		$result = array();
		if($res) {
			$result['result'] = 'succ';
		}
		else {
			$result['result'] = 'fail';
			$result['msg'] = '수정에 실패했습니다.';	
		}

		return $result;
	}

	private function faq_info($req) {
		$result = array();
		if(empty($req['faq_seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = 'FAQ를 선택해주세요.';
		}
		else {
			$info = $this->board_m->faq_info($req['faq_seq'])->row_array();
			
			if(!empty($info)) {
				$result['result'] = 'succ';
				$result['msg'] = '';
				$result['data'] = $info;
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '삭제에 실패했습니다.';	
			}
		}

		return $result;
	}

	private function faq_delete($req) {
		$result = array();
		if(empty($req['faq_seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '삭제될 FAQ를 선택해주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];

			$res = $this->board_m->delete_faq($req);
			
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제했습니다.';	
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '삭제에 실패했습니다.';	
			}
		}

		return $result;
	}

	private function faq_update($req) {
		$result = array();
		if(empty($req['faq_seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '수정할 FAQ를 선택해주세요.';
		}
		else if(empty($req['category'])) {
			$result['result'] = 'fail';
			$result['msg'] = '카테고리코드를 선택해주세요.';
		}
		else if(empty($req['title'])) {
			$result['result'] = 'fail';
			$result['msg'] = '제목을 입력해주세요.';
		}
		else if(empty($req['contents'])) {
			$result['result'] = 'fail';
			$result['msg'] = '내용을 입력해주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];

			$res = $this->board_m->update_faq($req);
			
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정했습니다.';	
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '수정에 실패했습니다.';	
			}
		}

		return $result;
	}

	private function faq_register($req) {
		$result = array();
		if(empty($req['category'])) {
			$result['result'] = 'fail';
			$result['msg'] = '카테고리코드를 선택해주세요.';
		}
		else if(empty($req['title'])) {
			$result['result'] = 'fail';
			$result['msg'] = '제목을 입력해주세요.';
		}
		else if(empty($req['contents'])) {
			$result['result'] = 'fail';
			$result['msg'] = '내용을 입력해주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];

			$res = $this->board_m->insert_faq($req);
				
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록했습니다.';	
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';	
			}
		}

		return $result;
	}	


	private function category_change_order($req) {
		$req['member_id'] = $this->data['admin']['admin_id'];
		$req['main_code'] = 'faq_category';

		$res = $this->common_m->change_order($req);
		
		$result = array();
		if($res) {
			$result['result'] = 'succ';
		}
		else {
			$result['result'] = 'fail';
			$result['msg'] = '수정에 실패했습니다.';	
		}

		return $result;
	}

	private function category_delete($req) {
		$result = array();
		if(empty($req['sub_code'])) {
			$result['result'] = 'fail';
			$result['msg'] = '삭제될 카테고리를 선택해주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];
			$req['main_code'] = 'faq_category';

			$res = $this->common_m->delete_code($req);
			
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제했습니다.';	
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '삭제에 실패했습니다.';	
			}
		}

		return $result;
	}

	private function category_update($req) {
		$result = array();
		if(empty($req['sub_code'])) {
			$result['result'] = 'fail';
			$result['msg'] = '수정할 카테고리를 선택해주세요.';
		}
		else if(empty($req['code_name'])) {
			$result['result'] = 'fail';
			$result['msg'] = '카테고리명을 입력해주세요.';
		}
		else if(empty($req['is_use'])) {
			$result['result'] = 'fail';
			$result['msg'] = '사용여부를 선택해주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];
			$req['main_code'] = 'faq_category';

			$res = $this->common_m->update_code($req);
			
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정했습니다.';	
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '수정에 실패했습니다.';	
			}
		}

		return $result;
	}

	private function category_register($req) {
		$result = array();
		if(empty($req['sub_code'])) {
			$result['result'] = 'fail';
			$result['msg'] = '카테고리코드를 입력해주세요.';
		}
		else if(empty($req['code_name'])) {
			$result['result'] = 'fail';
			$result['msg'] = '카테고리명을 입력해주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];
			$req['main_code'] = 'faq_category';

			$tmp = $this->common_m->exists_code('faq_category', $req['sub_code'])->row_array();
			if(empty($tmp)) {
				$res = $this->common_m->insert_code($req);
				
				if($res) {
					$result['result'] = 'succ';
					$result['msg'] = '등록했습니다.';	
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '등록에 실패했습니다.';	
				}
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '이미등록된 카테고리코드입니다.';
			}
		}

		return $result;
	}
}