<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Product extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('product_m');
        $this->load->model('file_m');
    }

	public function update() {
		$req = $this->input->post();

		$result = array();
		$req['member_id'] = $this->data['member']['member_id'];
		if($req['tab'] === 'own') {
			if(trim($req['own_product']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '주요제품을 입력해주세요.';
			}
			else if(trim($req['channel_online']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '온라인 채널을 입력해주세요.';
			}
			else if(trim($req['channel_offline']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '오프라인 채널을 입력해주세요.';
			}
			else if(trim($req['delivery_day']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '오더 납기일자를 입력해주세요.';
			}
			else if(trim($req['order_moq']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '제품별 오더 MOQ를 입력해주세요.';
			}
			else if(trim($req['nb_product']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = 'NB제품 현황을 입력해주세요.';
			}
			else if(trim($req['supply_price']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '제품별 공급단가를 입력해주세요.';
			}
			else if(trim($req['type_cnt']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '용기 타입 및 입수를 입력해주세요.';
			}
			else if(trim($req['expire_day']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '유통기한을 입력해주세요.';
			}
			else if(empty($req['main_product_cd'])) {
				$result['result'] = 'fail';
				$result['msg'] = '상품유형을 선택해주세요.';
			}
			else {
				if(in_array('029', $req['main_product_cd']) && trim($req['main_product_etc']) === '') {
					$result['result'] = 'fail';
					$result['msg'] = '기타 식품유형을 입력해주세요.';
				}
				else {
					$res = $this->product_m->update_product_own($req);
					if($res) {
						$result['result'] = 'succ';
						$result['msg'] = '저장되었습니다.';
					}
					else {
						$result['result'] = 'fail';
						$result['msg'] = '변경에 실패했습니다.';
					}
	
				}
			}
		}
		else if($req['tab'] === 'oem') {
			if(trim($req['channel_online']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '온라인 채널을 입력해주세요.';
			}
			else if(trim($req['channel_offline']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '오프라인 채널을 입력해주세요.';
			}
			else if(trim($req['delivery_day']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '오더 납기일자를 입력해주세요.';
			}
			else if(trim($req['order_moq']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '제품별 오더 MOQ를 입력해주세요.';
			}
			else if(trim($req['nb_product']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = 'NB제품 현황을 입력해주세요.';
			}
			else if(trim($req['supply_price']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '제품별 공급단가를 입력해주세요.';
			}
			else if(trim($req['type_cnt']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '용기 타입 및 입수를 입력해주세요.';
			}
			else if(trim($req['expire_day']) == '') {
				$result['result'] = 'fail';
				$result['msg'] = '유통기한을 입력해주세요.';
			}
			else if(empty($req['main_product_cd'])) {
				$result['result'] = 'fail';
				$result['msg'] = '상품유형을 선택해주세요.';
			}
			else {
				if(in_array('029', $req['main_product_cd']) && trim($req['main_product_etc']) === '') {
					$result['result'] = 'fail';
					$result['msg'] = '기타 식품유형을 입력해주세요.';
				}
				else {
					$res = $this->product_m->update_product_oem($req);
					if($res) {
						$result['result'] = 'succ';
						$result['msg'] = '저장되었습니다.';
					}
					else {
						$result['result'] = 'fail';
						$result['msg'] = '변경에 실패했습니다.';
					}
	
				}
			}
		}
		else {
			$result['result'] = 'fail';
			$result['msg'] = '잘못된 접근입니다.';
		}
		
		echo json_encode($result);
	}

	public function ownregister() {
		$req = $this->input->post();

		$result = array();
		$req['member_id'] = $this->data['member']['member_id'];

		if(trim($req['product_name']) == '') {
			$result['result'] = 'fail';
			$result['msg'] = '제품명을 입력해주세요.';
		}
		else {
			$product_img = array();
			$detail_img = array();
			$label_img = array();
			for($i = 1; $i <= 5; $i++) {
				if(!empty($_FILES) && !empty($_FILES['product_img' . $i]) && !empty($_FILES['product_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'product_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$product_img[] = $tmp;
				}
			}
			$req['product_img'] = $product_img;

			for($i = 1; $i <= 5; $i++) {
				if(!empty($_FILES) && !empty($_FILES['detail_img' . $i]) && !empty($_FILES['detail_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'detail_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$detail_img[] = $tmp;
				}
			}
			$req['detail_img'] = $detail_img;

			for($i = 1; $i <= 3; $i++) {
				if(!empty($_FILES) && !empty($_FILES['label_img' . $i]) && !empty($_FILES['label_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'label_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$label_img[] = $tmp;
				}
			}
			$req['label_img'] = $label_img;

			$res = $this->product_m->insert_product_detail_own($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '저장되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '저장에 실패했습니다.';
			}
	
		}
		
		echo json_encode($result);
	}

	public function ownupdate() {
		$req = $this->input->post();

		$result = array();
		$req['member_id'] = $this->data['member']['member_id'];

		if(trim($req['product_name']) == '') {
			$result['result'] = 'fail';
			$result['msg'] = '제품명을 입력해주세요.';
		}
		else {
			$product_img = array();
			$detail_img = array();
			$label_img = array();
			for($i = 1; $i <= 5; $i++) {
				if(!empty($_FILES) && !empty($_FILES['product_img' . $i]) && !empty($_FILES['product_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'product_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$product_img[] = $tmp;
				}
			}
			$req['product_img'] = $product_img;

			for($i = 1; $i <= 5; $i++) {
				if(!empty($_FILES) && !empty($_FILES['detail_img' . $i]) && !empty($_FILES['detail_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'detail_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$detail_img[] = $tmp;
				}
			}
			$req['detail_img'] = $detail_img;

			for($i = 1; $i <= 3; $i++) {
				if(!empty($_FILES) && !empty($_FILES['label_img' . $i]) && !empty($_FILES['label_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'label_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$label_img[] = $tmp;
				}
			}
			$req['label_img'] = $label_img;

			$res = $this->product_m->update_product_detail_own($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '저장되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '저장에 실패했습니다.';
			}
	
		}
		
		echo json_encode($result);
	}


	public function oemregister() {
		$req = $this->input->post();

		$result = array();
		$req['member_id'] = $this->data['member']['member_id'];

		if(trim($req['product_name']) == '') {
			$result['result'] = 'fail';
			$result['msg'] = '제품명을 입력해주세요.';
		}
		else if(trim($req['brand']) == '') {
			$result['result'] = 'fail';
			$result['msg'] = '브랜드를 선택해주세요.';
		}
		else {
			$product_img = array();
			$detail_img = array();
			$label_img = array();
			for($i = 1; $i <= 5; $i++) {
				if(!empty($_FILES) && !empty($_FILES['product_img' . $i]) && !empty($_FILES['product_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'product_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$product_img[] = $tmp;
				}
			}
			$req['product_img'] = $product_img;

			for($i = 1; $i <= 5; $i++) {
				if(!empty($_FILES) && !empty($_FILES['detail_img' . $i]) && !empty($_FILES['detail_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'detail_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$detail_img[] = $tmp;
				}
			}
			$req['detail_img'] = $detail_img;

			for($i = 1; $i <= 3; $i++) {
				if(!empty($_FILES) && !empty($_FILES['label_img' . $i]) && !empty($_FILES['label_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'label_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$label_img[] = $tmp;
				}
			}
			$req['label_img'] = $label_img;

			$res = $this->product_m->insert_product_detail_oem($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '저장되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '저장에 실패했습니다.';
			}
	
		}
		
		echo json_encode($result);
	}

	public function oemupdate() {
		$req = $this->input->post();

		$result = array();
		$req['member_id'] = $this->data['member']['member_id'];

		if(trim($req['product_name']) == '') {
			$result['result'] = 'fail';
			$result['msg'] = '제품명을 입력해주세요.';
		}
		else if(trim($req['brand']) == '') {
			$result['result'] = 'fail';
			$result['msg'] = '브랜드를 선택해주세요.';
		}
		else {
			$product_img = array();
			$detail_img = array();
			$label_img = array();
			for($i = 1; $i <= 5; $i++) {
				if(!empty($_FILES) && !empty($_FILES['product_img' . $i]) && !empty($_FILES['product_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'product_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$product_img[] = $tmp;
				}
			}
			$req['product_img'] = $product_img;

			for($i = 1; $i <= 5; $i++) {
				if(!empty($_FILES) && !empty($_FILES['detail_img' . $i]) && !empty($_FILES['detail_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'detail_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$detail_img[] = $tmp;
				}
			}
			$req['detail_img'] = $detail_img;

			for($i = 1; $i <= 3; $i++) {
				if(!empty($_FILES) && !empty($_FILES['label_img' . $i]) && !empty($_FILES['label_img' . $i]['name'])) {
					$res = $this->upload_file('product', 'label_img' . $i);
					if($res['status'] == 'fail') {
						echo json_encode($res);
						exit;
					}
					
					$tmp = array();
					$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
					$tmp['file_newname'] = $res['fileinfo']['newname'];
					$tmp['file_orgname'] = $res['fileinfo']['orgname'];
					$tmp['file_ext'] = $res['fileinfo']['ext'];
					$tmp['file_size'] = $res['fileinfo']['size'];
					$label_img[] = $tmp;
				}
			}
			$req['label_img'] = $label_img;

			$res = $this->product_m->update_product_detail_oem($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '저장되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '저장에 실패했습니다.';
			}
	
		}
		
		echo json_encode($result);
	}

}