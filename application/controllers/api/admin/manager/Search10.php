
<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Search10 extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('admin/manager_m', 'manager_m');
        $this->load->model('admin/log_m', 'log_m');
    }

	public function register()
	{
		$req = $this->input->post();

		if(empty(trim($req['keyword']))) {
			$result['result'] = 'fail';
			$result['msg'] = '검색어를 입력해주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];
			$res = $this->manager_m->insert_search10($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
				$this->log_m->insert_log('tb_recommend_keyword', 'C', $req, $this->data['admin']['admin_id']);
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

		if(empty(trim($req['keyword']))) {
			$result['result'] = 'fail';
			$result['msg'] = '검색어를 입력해주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];

            $res = $this->manager_m->update_search10($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정되었습니다.';
				$this->log_m->insert_log('tb_recommend_keyword', 'U', $req, $this->data['admin']['admin_id']);
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
		if(empty($req['recommend_seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '삭제할 검색어를 선택해 주세요.';
		}
		else {
			$req['member_id'] = $this->data['admin']['admin_id'];
			$res = $this->manager_m->delete_search10($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제되었습니다.';
				$this->log_m->insert_log('tb_recommend_keyword', 'D', $req, $this->data['admin']['admin_id']);
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '삭제에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}
 	
	public function change_order() {
        $req = $this->input->post();

		$req['member_id'] = $this->data['admin']['admin_id'];

		$res = $this->manager_m->search10_change_order($req);
		
		$result = array();
		if($res) {
			$result['result'] = 'succ';
			$this->log_m->insert_log('tb_recommend_keyword', 'U', $req, $this->data['admin']['admin_id']);
		}
		else {
			$result['result'] = 'fail';
			$result['msg'] = '수정에 실패했습니다.';	
		}

		echo json_encode($result);
	}

}