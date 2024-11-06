<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Wish extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('wish_m');
    }

	public function update()
	{
		$req = $this->input->post();
		$req['member_id'] = $this->data['member']['member_id'];
		$res = $this->wish_m->insert_wish($req);

		$result = array();
		if($res) {
			$result['result'] = 'succ';
			$result['msg'] = $req['is_wish'] === 'y' ? '등록하였습니다.' : '삭제하였습니다.';
		}
		else {
			$result['result'] = 'fail';
			$result['msg'] = '등록에 실패했습니다.';
		}

		echo json_encode($result);
		exit;
	}

	public function get()
	{
		$req = $this->input->post();
		$info = $this->wish_m->wish_info($req)->row_array();

		echo json_encode($info);
	}
}