<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FP_AdminController extends CI_Controller
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');

		header("Cache-Control: no-cache");
		ini_set('display_errors', '1');

		$uri = $this->uri->segment(1);

		$admin = $this->session->userdata('admin');
		$this->data['admin'] = $admin;
		$this->data['menu'] = $this->uri->segment(2, '');
		$this->data['sub'] = $this->uri->segment(3, '');
		if(empty($admin)) {
			if($uri === 'api') {
				$result = array();
				$result['result'] = 'login';
				$result['msg'] = '로그인이 필요합니다.';
				echo json_encode($result);
				exit;
			}
			else {
				header('Location: /admin/login');
				exit;
			}
		}
	}

	public function html_encode($str)
	{
		$str = STR_REPLACE('&', '&amp;', $str);
		$str = STR_REPLACE('<', '&lt;', $str);
		$str = STR_REPLACE('>', '&gt;', $str);
		$str = STR_REPLACE('"', '&quot;', $str);
		$str = STR_REPLACE("'", '&#39;', $str);
		$str = STR_REPLACE('/', '&#x2F;', $str);
		$str = STR_REPLACE('`', '&#x60;', $str);
		return $str;
	}

	public function html_decode($str)
	{
		$str = STR_REPLACE('&amp;', '&', $str);
		$str = STR_REPLACE('&lt;', '<', $str);
		$str = STR_REPLACE('&gt;', '>', $str);
		$str = STR_REPLACE('&quot;', '"', $str);
		$str = STR_REPLACE('&#39;', "'", $str);
		$str = STR_REPLACE('&#x2F;', '/', $str);
		$str = STR_REPLACE('&#x60;', '`', $str);
		return $str;
	}

	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public function pagination($num_links = 5, $total_rows, $offset, $perpage)
	{
		$result = '';
		if($total_rows <= 0) return $result;

		$pageNo = $offset/$perpage + 1;
		$pageSize = $perpage;

		$finalPage = floor(($total_rows + ($pageSize - 1)) / $pageSize);
        if($pageNo > $finalPage) $pageNo = $finalPage; // 기본 값 설정
		
		if($pageNo < 0 || $pageNo > $finalPage) $pageNo = 1; // 현재 페이지 유효성 체크

        $isNowFirst = $pageNo == 1 ? true : false; // 시작 페이지 (전체)
        $isNowFinal = $pageNo == $finalPage ? true : false; // 마지막 페이지 (전체)

        $startPage = floor(($pageNo - 1) / $num_links) * $num_links + 1; // 시작 페이지 (페이징 네비 기준)
        $endPage = $startPage + $num_links - 1; // 끝 페이지 (페이징 네비 기준)

        if($endPage > $finalPage) { // [마지막 페이지 (페이징 네비 기준) > 마지막 페이지] 보다 큰 경우
        	$endPage = $finalPage;
        }

        $firstPageNo = 1; // 첫 번째 페이지 번호

		$prevPageNo = 1;
        if (!$isNowFirst) {
            $prevPageNo = (($pageNo - 1) < 1 ? 1 : ($pageNo - 1)); // 이전 페이지 번호
        }
		$nextPageNo = $finalPage;
        if (!$isNowFinal) {
            $nextPageNo = (($pageNo + 1) > $finalPage ? $finalPage : ($pageNo + 1)); // 다음 페이지 번호
        }

		$result = '<div class="btn_group text-center">';
		if($pageNo != $firstPageNo) {
			$result .= '<button class="btn btn-white" onclick="goPage(' . (($firstPageNo - 1) * $pageSize) . ');"><i class="fa fa-step-backward"></i></button>';
		}
		if($pageNo != $prevPageNo) {
			$result .= '<button class="btn btn-white" onclick="goPage(' . (($prevPageNo - 1) * $pageSize) . ');"><i class="fa fa-chevron-left"></i></button>';
		}
		for($i = $startPage; $i <= $endPage; $i++) {
			if($i == $pageNo) {
				$result .= '<button class="btn btn-success">' . $i . '</button>';
			}
			else {
				$result .= '<button class="btn btn-white" onclick="goPage(' . (($i - 1) * $pageSize) . ');">' . $i . '</button>';		
			}
		}
		if($pageNo != $nextPageNo) {
			$result .= '<button class="btn btn-white" onclick="goPage(' . (($nextPageNo - 1) * $pageSize) . ');"><i class="fa fa-chevron-right"></i></button>';
		}
		if($pageNo != $finalPage) {
			$result .= '<button class="btn btn-white" onclick="goPage(' . (($finalPage - 1) * $pageSize) . ');"><i class="fa fa-step-forward"></i></button>';
		}
		$result .= '</div>';
		
		return $result;
	}  
		
	function upload_file($target, $file_name) {
		if(!is_dir(DATA_PATH . '/' . $target . '/')){
			mkdir(DATA_PATH . '/' . $target . '/',0777);
		}
		if(!is_dir(DATA_PATH . '/' . $target . '/'.date('Y').'/')){
			mkdir(DATA_PATH . '/' . $target . '/'.date('Y').'/',0777);
		}
		if(!is_dir(DATA_PATH . '/' . $target . '/'.date('Y').'/'.date('m').'/')){
			mkdir(DATA_PATH . '/' . $target . '/'.date('Y').'/'.date('m').'/',0777);
		}
		if(!is_dir(DATA_PATH . '/' . $target . '/'.date('Y').'/'.date('m').'/'.date('d').'/')){
			mkdir(DATA_PATH . '/' . $target . '/'.date('Y').'/'.date('m').'/'.date('d').'/',0777);
		}
		$file_path=DATA_PATH . '/' . $target . '/'.date('Y').'/'.date('m').'/'.date('d').'/';
		$file_target_path = '/' . $target . '/'.date('Y').'/'.date('m').'/'.date('d').'/';


		$config['upload_path'] = $file_path;
		$config['allowed_types'] = '*';
		$config['max_size']	= 0;
		$config['encrypt_name']  = TRUE;
		$config['remove_spaces']  = TRUE;

		$this->load->library('upload', $config);
		$result = array();
		if($this->upload->do_upload($file_name)){
			$data = $this->upload->data();

			$_file['newname'] = $data['file_name'];
			$_file['orgname'] = $data['orig_name'];
			$_file['filepath'] = $file_target_path;

			$fileinfo = pathinfo($data['orig_name']);

			$_file['ext'] = $fileinfo['extension'];
			$_file['size'] = round($data['file_size'] * 1024);
			$result['fileinfo'] = $_file;
			$result['status'] = 'succ';
		}
		else {
			$result['status'] = 'fail';
			$result['msg'] = $this->upload->display_errors();
		}
		return $result;
	}

	public function upload_multifile($target)
	{
		if(!is_dir(DATA_PATH . '/' . $target . '/')){
			mkdir(DATA_PATH . '/' . $target . '/',0777);
		}
		if(!is_dir(DATA_PATH . '/' . $target . '/'.date('Y').'/')){
			mkdir(DATA_PATH . '/' . $target . '/'.date('Y').'/',0777);
		}
		if(!is_dir(DATA_PATH . '/' . $target . '/'.date('Y').'/'.date('m').'/')){
			mkdir(DATA_PATH . '/' . $target . '/'.date('Y').'/'.date('m').'/',0777);
		}
		if(!is_dir(DATA_PATH . '/' . $target . '/'.date('Y').'/'.date('m').'/'.date('d').'/')){
			mkdir(DATA_PATH . '/' . $target . '/'.date('Y').'/'.date('m').'/'.date('d').'/',0777);
		}
		$file_path=DATA_PATH . '/' . $target . '/'.date('Y').'/'.date('m').'/'.date('d').'/';
		$file_target_path = '/' . $target . '/'.date('Y').'/'.date('m').'/'.date('d').'/';


		$config['upload_path'] = $file_path;
		$config['allowed_types'] = '*';
		$config['max_size']	= 0;
		$config['encrypt_name']  = TRUE;
		$config['remove_spaces']  = TRUE;

		$this->load->library('upload', $config);

		$result = array();
		$result['status'] = 'succ';
		$result['fileinfo'] = array();
		for($i = 0; $i < count($_FILES['files']['name']); $i++) {
			 $_FILES['tmp']['name']= $_FILES['files']['name'][$i];
			 $_FILES['tmp']['type']= $_FILES['files']['type'][$i];
			 $_FILES['tmp']['tmp_name']= $_FILES['files']['tmp_name'][$i];
			 $_FILES['tmp']['error']= $_FILES['files']['error'][$i];
			 $_FILES['tmp']['size']= $_FILES['files']['size'][$i];
			if($this->upload->do_upload('tmp')){
				$data = $this->upload->data();
	
				$_file['newname'] = $data['file_name'];
				$_file['orgname'] = $data['orig_name'];
				$_file['filepath'] = $file_target_path;
				$fileinfo = pathinfo($data['orig_name']);
				$ext = $fileinfo['extension'];
				$_file['ext'] = $ext;
				$_file['size'] = round($data['file_size'] * 1024);
				$result['fileinfo'][] = $_file;
			}else{
				$result['status'] = 'fail';
				$result['msg'] = $this->upload->display_errors();
			}
		}
		echo json_encode($result);
		exit;
	}
}
