<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Common extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('img_lib');
		$this->load->library('awss3_lib');
		$this->load->library('stibee_lib');
        $this->load->model('member_m');
        $this->load->model('file_m');
        $this->load->model('product_m');
        $this->load->model('overseas_m');
        $this->load->model('wish_m');
    }

	public function edit_img_upload()
	{
		$req = $this->input->post();
		$req['target'] = 'edit';

		if(!is_dir(DATA_PATH . '/' . $req['target'] . '/')){
			mkdir(DATA_PATH . '/' . $req['target'] . '/',0777);
		}
		if(!is_dir(DATA_PATH . '/' . $req['target'] . '/'.date('Y').'/')){
			mkdir(DATA_PATH . '/' . $req['target'] . '/'.date('Y').'/',0777);
		}
		if(!is_dir(DATA_PATH . '/' . $req['target'] . '/'.date('Y').'/'.date('m').'/')){
			mkdir(DATA_PATH . '/' . $req['target'] . '/'.date('Y').'/'.date('m').'/',0777);
		}
		if(!is_dir(DATA_PATH . '/' . $req['target'] . '/'.date('Y').'/'.date('m').'/'.date('d').'/')){
			mkdir(DATA_PATH . '/' . $req['target'] . '/'.date('Y').'/'.date('m').'/'.date('d').'/',0777);
		}
		$file_path=DATA_PATH . '/' . $req['target'] . '/'.date('Y').'/'.date('m').'/'.date('d').'/';
		$file_target_path = '/' . $req['target'] . '/'.date('Y').'/'.date('m').'/'.date('d').'/';

        $config['upload_path'] = $file_path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= 0;
		$config['encrypt_name']  = TRUE;
		$config['remove_spaces']  = TRUE;

		$this->load->library('upload', $config);

		$result = array();
		$result['result'] = 'succ';
		$result['file_url'] = '';
		if($this->upload->do_upload('edit_img')){
			$data = $this->upload->data();

//			$this->img_lib->init($file_path . $data['file_name']);
//			$this->img_lib->save();

			$result['file_url'] = '/api/common/img_view?img_path=' . $file_target_path . $data['file_name'];
		}
		else{
			$result['result'] = 'fail';
			$result['msg'] = $this->upload->display_errors();
		}
		echo json_encode($result);
		exit;
	}

	public function img_view()
	{
		$req = $this->input->get();
		$file = DATA_PATH . $req['img_path'];
		if( file_exists($file) ){

		    $fsize = filesize($file);   // 다운로드로 사용할 경우를 대비한 파일 크기
		    $path_parts = pathinfo($file);  // 경로 정보
    		$ext = strtolower($path_parts["extension"]);  // 확장자 정보
			switch ($ext) { 
      			case "pdf": $ctype="application/pdf"; $cdispostion = true; break; 
      			case "exe": $ctype="application/octet-stream"; $cdispostion =true; break; 
				case "zip": $ctype="application/zip"; $cdispostion = true; break; 
      			case "doc": $ctype="application/msword"; $cdispostion = true; break; 
      			case "xls": $ctype="application/vnd.ms-excel"; $cdispostion = true; break; 
      			case "ppt": $ctype="application/vnd.ms-powerpoint"; $cdispostion =true; break; 
      			case "gif": $ctype="image/gif"; $cdispostion = false; break; 
      			case "png": $ctype="image/png"; $cdispostion = false; break; 
      			case "svg": $ctype="image/svg+xml"; $cdispostion = false; break; 
      			case "jpeg": 
      			case "jpg": $ctype="image/jpg"; $cdispostion = false; break; 
      			default: $ctype="application/force-download";  $cdispostion = true; 
    		} 
     
    		header("Pragma: public"); // required 
    		header("Expires: 0"); 
    		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    		header("Cache-Control: private",false); // required for certain browsers 
    		header("Content-Type: $ctype"); 
    		if($cdispostion == true) {  // 다운로드로 전환할 경우에 사용함
        		header("Content-Disposition: attachment; filename=\"".$req['org_file']."\";" ); 
    		}
    		header("Content-Transfer-Encoding: binary"); 
    		header("Content-Length: ".$fsize); 
    		ob_clean(); 
    		flush(); 
	    	readfile( $file); 
//			echo 'data:' . $ctype . ';base64,' . base64_encode(fread(fopen($file, 'r'), $fsize));
		} 
		else {
			echo 'error';	
		}
	}

	public function file_download()
	{
		$req = $this->input->get();
		$file = DATA_PATH . $req['file_path'];
		if( file_exists($file) ){

		    $fsize = filesize($file);   // 다운로드로 사용할 경우를 대비한 파일 크기
		    $path_parts = pathinfo($file);  // 경로 정보
    		$ext = strtolower($path_parts["extension"]);  // 확장자 정보
			switch ($ext) { 
      			case "pdf": $ctype="application/pdf"; $cdispostion = true; break; 
      			case "exe": $ctype="application/octet-stream"; $cdispostion =true; break; 
				case "zip": $ctype="application/zip"; $cdispostion = true; break; 
      			case "doc": $ctype="application/msword"; $cdispostion = true; break; 
      			case "xls": $ctype="application/vnd.ms-excel"; $cdispostion = true; break; 
      			case "ppt": $ctype="application/vnd.ms-powerpoint"; $cdispostion =true; break; 
      			case "gif": $ctype="image/gif"; $cdispostion = false; break; 
      			case "png": $ctype="image/png"; $cdispostion = false; break; 
      			case "svg": $ctype="image/svg+xml"; $cdispostion = false; break; 
      			case "jpeg": 
      			case "jpg": $ctype="image/jpg"; $cdispostion = false; break; 
      			default: $ctype="application/force-download";  $cdispostion = true; 
    		} 
     
    		header("Pragma: public"); // required 
    		header("Expires: 0"); 
    		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    		header("Cache-Control: private",false); // required for certain browsers 
    		header("Content-Type: $ctype"); 
    		if($cdispostion == true) {  // 다운로드로 전환할 경우에 사용함
        		header("Content-Disposition: attachment; filename=\"".$req['org_file']."\";" ); 
    		}
    		header("Content-Transfer-Encoding: binary"); 
    		header("Content-Length: ".$fsize); 
    		ob_clean(); 
    		flush(); 
	    	readfile( $file); 
//			echo 'data:' . $ctype . ';base64,' . base64_encode(fread(fopen($file, 'r'), $fsize));
		} 
		else {
			echo 'error';	
		}
	}

	public function s3_upload()
	{
		$req = $this->input->post();

		$result = array();
		if(empty($req['target'])) {
			$result['result'] = 'fail';
			$result['msg'] = '등록 종류를 입력해주세요.';
		}
		else if(empty($_FILES) || empty($_FILES['files']) || empty($_FILES['files']['tmp_name'])) {
			$result['result'] = 'fail';
			$result['msg'] = '파일을 입력해주세요.';
		}
		else {
			// 파일 업로드 하기 전 설정
			$result = $this->awss3_lib->upload_s3('test', $_FILES['files']['tmp_name'], $_FILES['files']['name']);
		}

		echo json_encode($result);
		exit;
	}

	public function product_list()
	{
		$req = $this->input->post();
		$data = array();
		
		if(empty($req)) {
			$req['offset'] = 0;
		}
		$offset = (int)$req['offset'];
	
		$list = array();
		$total_rows = 0;

		if($req['prod_type'] === 'nb') {
			$list = $this->product_m->nbproduct_list($req, $offset, 16)->result_array();
			$total_rows = $this->product_m->nbproduct_list_cnt($req);
		}
		else if($req['prod_type'] === 'oem') {
			$list = $this->product_m->oemproduct_list($req, $offset, 16)->result_array();
			$total_rows = $this->product_m->oemproduct_list_cnt($req);
		}
		$data['list'] = $list;
		$data['total_rows'] = $total_rows;
		echo json_encode($data);
	}

	public function product_list2()
	{
		$req = $this->input->post();
		
		$offset = (int)$req['offset'];
	
		$data = array();
		$data['list'] = $this->product_m->product_list($req, $offset, 16)->result_array();
		$data['total_rows'] = $this->product_m->product_list_cnt($req);
		echo json_encode($data);
	}

	public function buyer_list()
	{
		$req = $this->input->post();
		
		$offset = (int)$req['offset'];
	
		$data = array();
		$data['list'] = $this->overseas_m->buyer_list($req['seq'], $offset, 10)->result_array();
		echo json_encode($data);
	}

	public function trends_list()
	{
		$req = $this->input->post();
		
		$offset = (int)$req['offset'];
	
		$data = array();
		$data['list'] = $this->overseas_m->trends_list($req['seq'], $offset, 10)->result_array();
		echo json_encode($data);
	}

	public function buyer_list2()
	{
		$req = $this->input->post();
		
		$offset = (int)$req['offset'];
	
		$data = array();
		$data['list'] = $this->overseas_m->buyer_list2($req, $offset, 10)->result_array();
		echo json_encode($data);
	}

	public function trends_list2()
	{
		$req = $this->input->post();
		
		$offset = (int)$req['offset'];
	
		$data = array();
		$data['list'] = $this->overseas_m->trends_list2($req, $offset, 10)->result_array();
		echo json_encode($data);
	}

	public function requirement_list()
	{
		$req = $this->input->post();
		
		$offset = (int)$req['offset'];
	
		$data = array();
		$data['list'] = $this->overseas_m->requirement_list($req, $offset, 10)->result_array();
		echo json_encode($data);
	}

	public function laws_list()
	{
		$req = $this->input->post();
		
		$offset = (int)$req['offset'];
	
		$data = array();
		$data['list'] = $this->overseas_m->laws_list($req, $offset, 10)->result_array();
		echo json_encode($data);
	}

	public function document_list()
	{
		$req = $this->input->post();
		
		$offset = (int)$req['offset'];
	
		$data = array();
		$data['list'] = $this->overseas_m->document_list($req, $offset, 10)->result_array();
		echo json_encode($data);
	}

	public function delete_searchtext()
	{
		$req = $this->input->post();
		
		$result = array();
		if($this->data['member']) {
			$this->common_m->delete_search($this->data['member'][''], $req['search_text']);
			$result['result'] = 'succ';
			$result['msg'] = '';
			$result['data'] = $this->common_m->search_list($this->data['member']['seq'])->result_array();
		}
		else {
			$result['result'] = 'fail';
			$result['msg'] = '로그인이 필요합니다.';
		}

		echo json_encode($result);
	}

	public function get_searchtext()
	{
		$result = array();
		$result['result'] = 'succ';
		$result['msg'] = '';
		if($this->data['member']) {
			$data = $this->common_m->search_list($this->data['member']['seq'])->result_array();
		}
		$result['data'] = $data;

		echo json_encode($result);
	}

	public function set_wish()
	{
		$req = $this->input->post();
		$result = array();
		
		if(empty($this->data['member'])) {
			$result['result'] = 'fail';
			$result['msg'] = '로그인 후 이용해 주세요.';
		}
		else {
			$req['source_cd'] = $this->data['member']['seq'];
			$req['member_id'] = $this->data['member']['member_id'];
			$this->wish_m->insert_wish($req);
			$result['result'] = 'succ';
			$result['msg'] = '';
		}

		echo json_encode($result);
	}

	public function newsletter()
	{
		$req = $this->input->post();
		$result = array();
		if(empty($req['email'])) {
			$result['result'] = 'fail';
			$result['msg'] = '이메일을 등록해 주세요.';
		}
		else {
			$data = array();

			$data2 = array();
			$data2['email'] = $req['email'];
			$data2['name'] = $req['email'];
			$data2['tag1'] = '';
			$data2['tag2'] = '';
			$data2['tag3'] = '';

			$data['eventOccuredBy'] = 'SUBSCRIBER';
			$data['confirmEmailYN'] = 'N';
			$data['groupIds'] = array(STIBEE_NEWS);
			$data['subscribers'] = array();
			$data['subscribers'][] = $data2;

			$res = $this->stibee_lib->add_user(STIBEE_NEWS, $data);

			if(!empty($res) && ($res['Ok'] === '1' || $res['Ok'] === 'true' || $res['Ok'])) {
				$result['result'] = 'succ';
				$result['msg'] = '뉴스레터를 신청해 주셔서 감사합니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '뉴스레터 신청에 실패했습니다. 관리자에게 문의해 주세요.';
			}
		}

		echo json_encode($result);
	}

	public function find_pw()
	{
		$req = $this->input->post();
		$result = array();
		if(empty($req['email'])) {
			$result['result'] = 'fail';
			$result['msg'] = '이메일을 입력해 주세요.';
		}
		else {
			$info = $this->member_m->company_email_check($req['email'])->row_array();
			if(empty($info)) {
				$result['result'] = 'exists';
				$result['msg'] = '';
			}
			else {
				$token = '';
				$key = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
				for($i=0; $i < 64; $i++) {
					$token .= $key[rand(0,61)];
				}

				$tmp = array();
				$tmp['seq'] = $info['seq'];
				$tmp['token'] = $token;
				$this->member_m->update_member_pwreset($tmp);

				$data = array();
				$data['subscriber'] = $req['email'];
				$data['link'] = $_SERVER["HTTP_HOST"] . '/member/reset_pw/' . $token;

				$res = $this->stibee_lib->send_mail($req['email'], $data, STIBEE_PW);

				if(!empty($res) && $res === 'ok') {
					$result['result'] = 'succ';
					$result['msg'] = '';
				}
				else {
					$result['result'] = 'fail';
					$result['msg'] = '이메일 발송에 실패했습니다. 관리자에게 문의해 주세요.';
				}
			}
		}

		echo json_encode($result);
	}

	public function change_reset_pw()
	{
		$req = $this->input->post();
		$result = array();
		if(empty($req['new_pw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '신규 비밀번호를 입력해 주세요.';
		}
		else if(!$this->check_passowrd($req['new_pw'])) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호는 영문,숫자,특수문자(@$!%*#?&) 혼합으로 6~20자로 입력해 주세요.';
		}
		else if($req['new_pw'] !== $req['new_pw_confirm']) {
			$result['result'] = 'fail';
			$result['msg'] = '비밀번호 확인이 일치하지 않습니다.';
		}
		else {
			$info = $this->member_m->member_info_by_token($req['token'])->row_array();
			if(empty($info)) {
				$result['result'] = 'fail';
				$result['msg'] = '유효기간이 만료되었습니다. 비밀번호 재설정을 다시 신청해 주세요.';
			}
			else {
				$req['seq'] = $info['seq'];
				$this->member_m->change_reset_pw($req);

				$result['result'] = 'succ';
				$result['msg'] = '비밀번호가 수정되었습니다.';
			}
		}

		echo json_encode($result);
	}

	public function auth_send() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['email'])) {
			$result['result'] = 'fail';
			$result['msg'] = '이메일을 입력해 주세요.';
		}
		else {
			$res = $this->member_m->member_email_check($req['email'])->row_array();
			
			if(!empty($res)) {
				$result['result'] = 'fail';
				$result['msg'] = '이미 사용중인 이메일입니다.';
			}
			else {
				$auth = sprintf('%06d',rand(000000,999999));
				$val = array();
				$val['auth_num'] = $auth;
				$val['email'] = $req['email'];
				$this->common_m->insert_auth($val);
	
				$data = array();
				$data['subscriber'] = $req['email'];
				$data['authentication_code'] = $auth;
	
				$res = $this->stibee_lib->send_mail($req['email'], $data, STIBEE_AUTH);
	
				$result['result'] = 'succ';
				$result['msg'] = '인증번호를 발송하였습니다.';
	
			}
		}
		
		echo json_encode($result);
	}

	public function auth_check() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['email'])) {
			$result['result'] = 'fail';
			$result['msg'] = '이메일을 입력해 주세요.';
		}
		else if(empty($req['auth_num'])) {
			$result['result'] = 'fail';
			$result['msg'] = '인증번호를 입력해 주세요.';
		}
		else {
			$res = $this->common_m->chk_auth($req);

			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '인증이 완료되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '인증에 실패했습니다.';
			}
		}
		
		echo json_encode($result);
	}

	public function recommend() {
		$req = $this->input->post();

		$result = array();
		if(empty($req['name'])) {
			$result['result'] = 'fail';
			$result['msg'] = '섬명을 입력해 주세요.';
		}
		else if(empty($req['email'])) {
			$result['result'] = 'fail';
			$result['msg'] = '이메일을 입력해 주세요.';
		}
		else {
			$data = array();
			$data['subscriber'] = $req['email'];
			$data['name'] = $req['name'];
			$data['user_name'] = $this->data['member']['name'];
	
			$res = $this->stibee_lib->send_mail($req['email'], $data, STIBEE_RECOMMEND);
	
			$result['result'] = 'succ';
			$result['msg'] = '초대메일을 발송하였습니다.';
		}
		
		echo json_encode($result);

	}
}