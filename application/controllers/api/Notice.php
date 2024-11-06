<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Notice extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('notice_m');
    }

	public function register()
	{
		$req = $this->input->post();

		if(empty(trim($req['title']))) {
			$result['result'] = 'fail';
			$result['msg'] = '제목을 입력해주세요.';
		}
		else if(empty(trim($req['contents']))){
			$result['result'] = 'fail';
			$result['msg'] = '내용을 입력해주세요.';
		}
		else {
			$req['title'] = $this->html_encode($req['title']);
			$req['contents'] = $this->remove_script($req['contents']);
			$req['member_id'] = $this->data['admin']['admin_id'];
			$req['thumbnail_img'] = '';
			$req['thumbnail_img_name'] = '';

			if(!empty($_FILES) && !empty($_FILES['thumbnail_file']) && !empty($_FILES['thumbnail_file']['name'])) {
				$res = $this->upload_file('notice', 'thumbnail_file');
				if($res['status'] == 'fail') {
					echo json_encode($res);
					exit;
				}
				
				$req['thumbnail_img']	= $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
				$req['thumbnail_img_name']	= $res['fileinfo']['orgname'];
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '썸네일 이미지를 입력해 주세요.';
				echo json_encode($result);
				exit;				
			}

			if(!empty($_FILES) && !empty($_FILES['attach_file']) && !empty($_FILES['attach_file']['name'])) {
				$res = $this->upload_file('notice', 'attach_file');
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

			$res = $this->notice_m->insert_notice($req);

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
		if(empty($req['notice_seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '수정할 공지사항을 선택해 주세요.';
		}
		else if(empty(trim($req['title']))) {
			$result['result'] = 'fail';
			$result['msg'] = '제목을 입력해주세요.';
		}
		else if(empty(trim($req['contents']))){
			$result['result'] = 'fail';
			$result['msg'] = '내용을 입력해주세요.';
		}
		else {
			$req['title'] = $this->html_encode($req['title']);
			$req['contents'] = $this->remove_script($req['contents']);
			$req['member_id'] = $this->data['admin']['admin_id'];
			$req['thumbnail_img'] = '';
			$req['thumbnail_img_name'] = '';

			if(!empty($_FILES) && !empty($_FILES['thumbnail_file']) && !empty($_FILES['thumbnail_file']['name'])) {
				$res = $this->upload_file('notice', 'thumbnail_file');
				if($res['status'] == 'fail') {
					echo json_encode($res);
					exit;
				}
				
				$req['thumbnail_img']	= $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
				$req['thumbnail_img_name']	= $res['fileinfo']['orgname'];
			}

			if(!empty($_FILES) && !empty($_FILES['attach_file']) && !empty($_FILES['attach_file']['name'])) {
				$res = $this->upload_file('notice', 'attach_file');
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

			$res = $this->notice_m->update_notice($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '게시글 수정에 실패했습니다.';
			}
		}

		echo json_encode($result);		
	}

	public function delete()
	{
		$req = $this->input->post();
		$result = array();
		if(empty($req['notice_seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '삭제할 게시글을 선택해 주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];
			$res = $this->notice_m->delete_notice($req);
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
 	

}