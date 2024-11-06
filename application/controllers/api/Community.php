<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Community extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('community_m');
    }

	public function register()
	{
		$req = $this->input->post();

		$result = $this->fnChkReq($req);;
		if($result['result'] == 'succ') {
			$req['title'] = $this->html_encode($req['title']);
			$req['contents'] = $this->html_encode($req['contents']);
			$req['member_seq'] = $this->data['member']['seq'];
			$req['member_id'] = $this->data['member']['member_id'];

			if(!empty($_FILES) && !empty($_FILES['files']) && !empty($_FILES['files']['name'])) {
				$res = $this->upload_file('community', 'files');
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

			$res = $this->community_m->insert_community($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '게시글 등록에 실패했습니다.';
			}
		}

		echo json_encode($result);		
	}

	public function update()
	{
		$req = $this->input->post();

		$result = array();
		if(empty($req['seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '수정할 게시글을 선택해 주세요.';
		}
		else {
			$result = $this->fnChkReq($req);;
			if($result['result'] == 'succ') {
				$req['title'] = $this->html_encode($req['title']);
				$req['contents'] = $this->html_encode($req['contents']);
				$req['member_seq'] = $this->data['member']['seq'];
				$req['member_id'] = $this->data['member']['member_id'];

				if(!empty($_FILES) && !empty($_FILES['files']) && !empty($_FILES['files']['name'])) {
					$res = $this->upload_file('community', 'files');
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
				

				$res = $this->community_m->update_community($req);

				if($res) {
					$result['result'] = 'succ';
					$result['msg'] = '수정되었습니다.';
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '게시글 수정에 실패했습니다.';
				}
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
			$result['msg'] = '삭제할 게시글을 선택해 주세요.';
		}
		else {
			$req['member_id'] = $this->data['member']['member_id'];
			$res = $this->community_m->delete_community($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '게시글 삭제에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}

	public function delete2()
	{
		$req = $this->input->post();
		$result = array();
		if(empty($req['community_seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '삭제할 게시글을 선택해 주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];
			$req['seq'] = $req['community_seq'];
			$res = $this->community_m->delete_community($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '게시글 삭제에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}
	
	private function fnChkReq($req) {
		$result = array();
		if(empty(trim($req['title']))) {
			$result['result'] = 'fail';
			$result['msg'] = '제목을 입력해 주세요.';
		}
		else if(empty(trim($req['contents']))) {
			$result['result'] = 'fail';
			$result['msg'] = '내용을 입력해 주세요.';
		}
		else {
			$result['result'] = 'succ';
			$result['msg'] = '';
		}
		return $result;
	}

	public function reply_register()
	{
		$req = $this->input->post();

		$result = array();
		if(empty($req['community_seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '댓글을 작성할 게시글을 선택해 주세요.';
		}
		else if(empty(trim($req['contents']))) {
			$result['result'] = 'fail';
			$result['msg'] = '댓글을 입력해 주세요.';
		}
		else {
			$req['contents'] = $this->html_encode($req['contents']);
			$req['member_seq'] = $this->data['member']['seq'];
			$req['member_id'] = $this->data['member']['member_id'];
			$req['depth'] = $req['parent_seq'] == '0' ? '1' : '2';

			$res = $this->community_m->insert_reply($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '댓글 등록에 실패했습니다.';
			}
		}


		echo json_encode($result);		
	}

	public function reply_update()
	{
		$req = $this->input->post();

		$result = array();
		if(empty($req['seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '수정할 댓글을 선택해 주세요.';
		}
		else if(empty(trim($req['contents']))) {
			$result['result'] = 'fail';
			$result['msg'] = '댓글을 입력해 주세요.';
		}
		else {
			$req['contents'] = $this->html_encode($req['contents']);
			$req['member_id'] = $this->data['member']['member_id'];

			$res = $this->community_m->update_reply($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정되었습니다.';
				$result['data'] = $req;
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '댓글 수정에 실패했습니다.';
			}
		}

		echo json_encode($result);		
	}

	public function reply_delete()
	{
		$req = $this->input->post();
		$result = array();
		if(empty($req['seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '삭제할 댓글을 선택해 주세요.';
		}
		else {
			$req['member_id'] = $this->data['member']['member_id'];
			$res = $this->community_m->delete_reply($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '댓글 삭제에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}

	public function reply_delete2()
	{
		$req = $this->input->post();
		$result = array();
		if(empty($req['reply_seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '삭제할 댓글을 선택해 주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];
			$req['seq'] = $req['reply_seq'];
			$res = $this->community_m->delete_reply($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '댓글 삭제에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}

	public function reply_list()
	{
		$req = $this->input->post();

		$val = array();
		$val['parent_seq'] = $req['parent_seq'];
		$val['community_seq'] = $req['community_seq'];
		$list = $this->community_m->reply_list($val, '', PERPAGE)->result_array();

		for($i = 0; $i < count($list); $i++) {
			$list[$i]['contents2'] = $this->html_decode($list[$i]['contents']);
		}

		echo json_encode($list);
	}

}