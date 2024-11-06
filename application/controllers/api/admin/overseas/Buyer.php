<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Buyer extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->library('awss3_lib');
        $this->load->model('admin/overseas_m', 'overseas_m');
        $this->load->model('admin/log_m', 'log_m');
    }

	public function register()
	{
		$req = $this->input->post();

		$result = $this->chk_require($req);
		if($result['result'] == 'succ') {
			$req['admin_id'] = $this->data['admin']['admin_id'];

			$res = $this->overseas_m->insert_buyer($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
				$this->log_m->insert_log('tb_overseas_buyer', 'C', $req, $this->data['admin']['admin_id']);
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '게시글 등록에 실패했습니다.';
			}
		}

		echo json_encode($result);		
	}

	public function edit()
	{
		$req = $this->input->post();

		$result = $this->chk_require($req);
		if($result['result'] == 'succ') {
			$req['admin_id'] = $this->data['admin']['admin_id'];

			$res = $this->overseas_m->update_buyer($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '수정되었습니다.';
				$this->log_m->insert_log('tb_overseas_buyer', 'U', $req, $this->data['admin']['admin_id']);
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
		if(empty($req['seq'])) {
			$result['result'] = 'fail';
			$result['msg'] = '삭제할 바이어를 선택해 주세요.';
		}
		else {
			$req['admin_id'] = $this->data['admin']['admin_id'];
			$res = $this->overseas_m->delete_buyer($req);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '삭제되었습니다.';
				$this->log_m->insert_log('tb_overseas_buyer', 'D', $req, $this->data['admin']['admin_id']);
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '삭제에 실패했습니다.';
			}
		}

		echo json_encode($result);
	}
 	
	public function chk_require($req) {
		$result = array();
		$result['result'] = 'succ';
		if(empty(trim($req['nation_seq']))) {
			$result['result'] = 'fail';
			$result['msg'] = '국가를 선택해주세요.';
		}
		else if(empty(trim($req['product_seq']))) {
			$result['result'] = 'fail';
			$result['msg'] = '품목을 선택해주세요.';
		}
		else if(empty(trim($req['company_name']))) {
			$result['result'] = 'fail';
			$result['msg'] = '업체명을 입력해주세요.';
		}
		else if(empty(trim($req['owner_name']))) {
			$result['result'] = 'fail';
			$result['msg'] = '대표명을 입력해주세요.';
		}
		else if(empty(trim($req['category']))) {
			$result['result'] = 'fail';
			$result['msg'] = '카테고리를 입력해주세요.';
		}
		else if(empty(trim($req['hscode']))) {
			$result['result'] = 'fail';
			$result['msg'] = 'HSCODE를 입력해주세요.';
		}
		else if(empty(trim($req['volume_order']))) {
			$result['result'] = 'fail';
			$result['msg'] = '요청단위를 입력해주세요.';
		}
		else if(empty(trim($req['available_period']))) {
			$result['result'] = 'fail';
			$result['msg'] = '유효기간을 입력해주세요.';
		}
		else if(empty(trim($req['product_name']))) {
			$result['result'] = 'fail';
			$result['msg'] = '상품명을 입력해주세요.';
		}
		else if(empty(trim($req['desc']))) {
			$result['result'] = 'fail';
			$result['msg'] = '상세내용을 입력해주세요.';
		}
		else if(empty(trim($req['trade_condition']))) {
			$result['result'] = 'fail';
			$result['msg'] = '거래조건을 입력해주세요.';
		}
		else if(empty(trim($req['trade_volume']))) {
			$result['result'] = 'fail';
			$result['msg'] = '희망거래량을 입력해주세요.';
		}
		else if(empty(trim($req['request_company_name']))) {
			$result['result'] = 'fail';
			$result['msg'] = '기업명을 입력해주세요.';
		}
		else if(empty(trim($req['main_product']))) {
			$result['result'] = 'fail';
			$result['msg'] = '주요품목을 입력해주세요.';
		}
		else if(empty(trim($req['main_income']))) {
			$result['result'] = 'fail';
			$result['msg'] = '주요수입국 입력해주세요.';
		}
		else if(empty(trim($req['contact']))) {
			$result['result'] = 'fail';
			$result['msg'] = '접촉방법을 입력해주세요.';
		}
		else if(empty(trim($req['export_staff']))) {
			$result['result'] = 'fail';
			$result['msg'] = '무역관 담당자를 입력해주세요.';
		}
		return $result;
	}
}