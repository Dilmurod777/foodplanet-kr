<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Company extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('company_m');
        $this->load->model('file_m');
    }

	public function update() {
		$req = $this->input->post();

		$result = array();
		if(empty($this->data['member'])) {
			$result['result'] = 'login';
			$result['msg'] = '로그인이 필요합니다.';
		}
		else {
			$req['member_id'] = $this->data['member']['member_id'];
			if($req['tab'] === 'manufacture') {
				if(trim($req['manufacture_day']) == '') {
					$result['result'] = 'fail';
					$result['msg'] = '일일 생산 가능량을 입력해주세요.';
				}
				else if(trim($req['manufacture_month']) == '') {
					$result['result'] = 'fail';
					$result['msg'] = '현재 월 생산 가능량을 입력해주세요.';
				}
				else if(trim($req['manufacture_year']) == '') {
					$result['result'] = 'fail';
					$result['msg'] = '연간 생산 실적을 입력해주세요.';
				}
				else if(trim($req['load_cnt']) == '') {
					$result['result'] = 'fail';
					$result['msg'] = '현재 일 창고 적재가능 수량을 입력해주세요.';
				}
				else {
					$res = $this->company_m->update_company_manufacture($req);
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
			else if($req['tab'] === 'facilities') {
				if(!empty($req['facilities_idx'])) {
					$details = array();
					foreach($req['facilities_idx'] as $idx) {
						if(empty(trim($req['facilities_name_' . $idx]))) {
							$result['result'] = 'fail';
							$result['msg'] = '추가된 설비의 이름을 입력해 주세요.';
							echo json_encode($result);
							exit;
						}
						else if($req['facilities_cnt_' . $idx] === '') {
							$result['result'] = 'fail';
							$result['msg'] = '추가된 설비의 보유대수를 입력해 주세요.';
							echo json_encode($result);
							exit;
						}

						$tmp = array();
						$tmp['facilities_name'] = $req['facilities_name_' . $idx];
						$tmp['facilities_cnt'] = $req['facilities_cnt_' . $idx];
						$tmp['facilities_summary'] = $req['facilities_summary_' . $idx];
						$tmp['detail_seq'] = $req['detail_seq_' . $idx];
						if(!empty($_FILES) && !empty($_FILES['facilities_img_' . $idx]) && !empty($_FILES['facilities_img_' . $idx]['name'])) {
							$res = $this->upload_file('facilities', 'facilities_img_' . $idx);
							if($res['status'] == 'fail') {
								echo json_encode($res);
								exit;
							}
							
							$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
							$tmp['file_newname'] = $res['fileinfo']['newname'];
							$tmp['file_orgname'] = $res['fileinfo']['orgname'];
							$tmp['file_ext'] = $res['fileinfo']['ext'];
							$tmp['file_size'] = $res['fileinfo']['size'];
						}
						$details[] = $tmp;
					}
					$req['details'] = $details;
				}

				$res = $this->company_m->update_company_facilities($req);
				if($res) {
					$result['result'] = 'succ';
					$result['msg'] = '저장되었습니다.';
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '변경에 실패했습니다.';
				}
			}
			else if($req['tab'] === 'cert') {
				$details = array();
				if(!empty($req['cert_idx'])) {
					foreach($req['cert_idx'] as $idx) {
						if(empty(trim($req['cert_name_' . $idx]))) {
							$result['result'] = 'fail';
							$result['msg'] = '추가된 인증의 이름을 입력해 주세요.';
							echo json_encode($result);
							exit;
						}

						$tmp = array();
						$tmp['cert_name'] = $req['cert_name_' . $idx];
						$tmp['detail_seq'] = $req['cert_detail_seq_' . $idx];
						$tmp['cert_type'] = '1';
						if(!empty($_FILES) && !empty($_FILES['cert_img_' . $idx]) && !empty($_FILES['cert_img_' . $idx]['name'])) {
							$res = $this->upload_file('cert', 'cert_img_' . $idx);
							if($res['status'] == 'fail') {
								echo json_encode($res);
								exit;
							}
							
							$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
							$tmp['file_newname'] = $res['fileinfo']['newname'];
							$tmp['file_orgname'] = $res['fileinfo']['orgname'];
							$tmp['file_ext'] = $res['fileinfo']['ext'];
							$tmp['file_size'] = $res['fileinfo']['size'];
						}
						$details[] = $tmp;
					}
				}

				if(!empty($req['patent_idx'])) {
					foreach($req['patent_idx'] as $idx) {
						if(empty(trim($req['patent_name_' . $idx]))) {
							$result['result'] = 'fail';
							$result['msg'] = '추가된 특허의 이름을 입력해 주세요.';
							echo json_encode($result);
							exit;
						}

						$tmp = array();
						$tmp['cert_name'] = $req['patent_name_' . $idx];
						$tmp['detail_seq'] = $req['patent_detail_seq_' . $idx];
						$tmp['cert_type'] = '2';
						if(!empty($_FILES) && !empty($_FILES['patent_img_' . $idx]) && !empty($_FILES['patent_img_' . $idx]['name'])) {
							$res = $this->upload_file('cert', 'patent_img_' . $idx);
							if($res['status'] == 'fail') {
								echo json_encode($res);
								exit;
							}
							
							$tmp['file_newpath'] = $res['fileinfo']['filepath'] . $res['fileinfo']['newname'];
							$tmp['file_newname'] = $res['fileinfo']['newname'];
							$tmp['file_orgname'] = $res['fileinfo']['orgname'];
							$tmp['file_ext'] = $res['fileinfo']['ext'];
							$tmp['file_size'] = $res['fileinfo']['size'];
						}
						$details[] = $tmp;
					}
					
				}
				$req['details'] = $details;

				$res = $this->company_m->update_company_cert($req);
				if($res) {
					$result['result'] = 'succ';
					$result['msg'] = '저장되었습니다.';
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '변경에 실패했습니다.';
				}
			}
			else if($req['tab'] === 'distribution') {
				if(empty(trim($req['channel_info']))) {
					$result['result'] = 'fail';
					$result['msg'] = '입점 채널 현황을 입력해주세요.';
				}
				else if(empty(trim($req['competitive_product']))) {
					$result['result'] = 'fail';
					$result['msg'] = '채널별 경쟁제품 현황을 입력해주세요.';
				}
				else if(empty(trim($req['export_nation']))) {
					$result['result'] = 'fail';
					$result['msg'] = '수출 국가를 입력해주세요.';
				}
				else if(empty(trim($req['export_progress']))) {
					$result['result'] = 'fail';
					$result['msg'] = '수출 진행사항을 입력해주세요.';
				}
				else if(empty(trim($req['own_nation']))) {
					$result['result'] = 'fail';
					$result['msg'] = '자사제품 수출 국가를 입력해주세요.';
				}
				else if(empty(trim($req['oem_nation']))) {
					$result['result'] = 'fail';
					$result['msg'] = 'OEM제품 수출 국가를 입력해주세요.';
				}
				else {
					$res = $this->company_m->update_company_distribution($req);
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
			else {
				$result['result'] = 'fail';
				$result['msg'] = '잘못 된 접근입니다.';
			}
			
		}

		echo json_encode($result);
	}

}