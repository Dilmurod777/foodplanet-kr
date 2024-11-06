<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FP_Controller extends CI_Controller
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->model('common_m');
		header("Cache-Control: no-cache");

		ini_set('display_errors', '1');

		$uri = $this->uri->segment(1);

		$member = $this->session->userdata('member');
		$this->data['member'] = $member;
		$this->data['meta'] = $this->meta_tag($uri, $this->uri->segment(2), $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$this->data['recommend'] = $this->common_m->recommend_keyword('1')->result_array();
		$this->data['menu'] = $this->uri->segment(1, '');
		$this->data['sub'] = $this->uri->segment(2, '');
		if(!empty($member)) {
			if($uri === 'myerror' || $uri === 'join') {
				header('Location: /');
				exit;
			}

			if($member['member_type'] === '1') {
				$this->data['base'] = 'manufacture';
			}
			else if($member['member_type'] === '2') {
				$this->data['base'] = 'distribution';
			}
			else if($member['member_type'] === '3') {
				$this->data['base'] = 'brand';
			}
			else {
				$this->session->sess_destroy();
				header('Location: /');
				exit;
			}
			$this->data['menu'] = $this->uri->segment(2, '');
			$this->data['tab'] = '';
		}
		else if($uri === 'mypage') {
			header('Location: /');
			exit;
		}
		else if($uri === 'api') {
			if($this->uri->segment(2, '') !== 'common') {
				$result = array();
				$result['result'] = 'login';
				$result['msg'] = '로그인이 필요합니다.';
				echo json_encode($result);
				exit;
			}
		}
	}
	
	public function meta_tag($key1, $key2, $url) {
		$result = array();

/*		if($key1 === 'join') {
			$result['title'] = '회원가입 - 푸드플라넷';
			$result['keyword'] = '푸드플라넷, 회원가입';
			$result['desc'] = '푸드플라넷은 B2B 가공식품 정보 분석 플랫폼으로, 국내 가공식품 제조사 데이터와 해외 주요 수출 10개국의 데이터를 제공합니다.';
			$result['img'] = '/front/assets/images/og_image.png';
			$result['url'] = $url;
		}
		else if($key1 === 'domastic') {
			if($key2 === 'detail') {
				$result['title'] = '[=COMPANY_NAME] - 생산, 설비, 품질 정보 - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 제조사, 생산 정보, 설비 정보, 품질 정보, 제품 정보, 인증 정보, 특허 정보, 유통 정보, 수출 정보';
				$result['desc'] = '[=COMPANY_NAME]의 주요 정보, 제품 정보, 생산, 설비, 인증, 특허, 유통, 수출 데이터를 푸드플라넷에서 확인해보세요.';
				$result['img'] = '[=TAG_IMG]';
				$result['url'] = $url;
			}
			else if($key2 === 'product_list') {
				$result['title'] = '[=COMPANY_NAME] - 자사, 위탁 생산 제품 정보 - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 제품 데이터, 자사 제품 데이터, 위탁 생산 제품 데이터';
				$result['desc'] = '[=COMPANY_NAME]의 자사 생산 데이터, 위탁 생산 데이터를 푸드플라넷에서 확인해보세요.';
				$result['img'] = '[=TAG_IMG]';
				$result['url'] = $url;
			}
			else if($key2 === 'product_detail') {
				$result['title'] = '[=PRODUCT_NAME] - 현황, 생산, 수출 정보 - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 제품 정보, 생산 정보, 수출 정보';
				$result['desc'] = '[=COMPANY_NAME]이 생산하는 [=PRODUCT_NAME]의 제품 생산 상세 데이터를 푸드플라넷에서 확인해보세요.';
				$result['img'] = '[=TAG_IMG]';
				$result['url'] = $url;
			}
			else {
				$result['title'] = '국내 데이터 - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 제조사 데이터, 제조사, 국내 데이터';
				$result['desc'] = '푸드플라넷에서 수천개의 다양한 국내 가공식품 제조사 데이터를 무료로 확인해보세요.';
				$result['img'] = '/front/assets/images/og_image.png';
				$result['url'] = $url;
			}
		}
		else if($key1 === 'overseas') {
			if($key2 === 'detail') {
				$result['title'] = '[=NATION] - 수출 품목, 바이어 정보 - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 수출 데이터, 국가별 수출 데이터, 바이어 데이터';
				$result['desc'] = '[=NATION]의 수출 품목, 품목별 규제 정보와 바이어 정보를 푸드플라넷에서 확인해보세요. ';
				$result['img'] = '[=TAG_IMG]';
				$result['url'] = $url;
			}
			else if($key2 === 'product_list') {
				$result['title'] = '품목별 - 수입 요건, 표준화서류, 바이어 정보 - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 품목별 수출 데이터, 표준화서류, 바이어 데이터';
				$result['desc'] = '[=PRODUCT_NAME]의 국가별 수출 요건 및 표준화 서류, 바이어 정보를 푸드플라넷에서 확인해보세요.';
				$result['img'] = '[=TAG_IMG]';
				$result['url'] = $url;
			}
			else if($key2 === 'product_detail') {
				$result['title'] = '[=PRODUCT_NAME] - 현황, 생산, 수출 정보 - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 제품 정보, 생산 정보, 수출 정보';
				$result['desc'] = '[=COMPANY_NAME]이 생산하는 [=PRODUCT_NAME]의 제품 생산 상세 데이터를 푸드플라넷에서 확인해보세요.';
				$result['img'] = '[=TAG_IMG]';
				$result['url'] = $url;
			}
			else {
				$result['title'] = '해외 데이터 - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 국가 데이터, 수출 품목 데이터, 바이어 데이터';
				$result['desc'] = '[=NATION]의 상위 수출 품목 및 바이어 데이터를 푸드플라넷에서 무료로 확인해보세요. ';
				$result['img'] = '/front/assets/images/og_image.png';
				$result['url'] = $url;
			}
		}
		else if($key1 === 'report') {
			if($key2 === 'detail') {
				$result['title'] = '[=TITLE] - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 리포트, 레포트, 백서';
				$result['desc'] = '가공식품 표준 데이터를 활용한 카테고리별 트렌드 및 비교 분석, 심층분석 리포트';
				$result['img'] = '[=TAG_IMG]';
				$result['url'] = $url;
			}
			else {
				$result['title'] = '분석리포트 -  푸드플라넷';
				$result['keyword'] = '푸드플라넷, 리포트, 레포트, 백서';
				$result['desc'] = '가공식품 표준 데이터를 활용한 카테고리별 트렌드 및 비교 분석, 심층분석 리포트';
				$result['img'] = '/front/assets/images/og_image.png';
				$result['url'] = $url;
			}
		}
		else if($key1 === 'community') {
			if($key2 === 'detail') {
				$result['title'] = '[=TITLE] - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 커뮤니티, 공동구매, 중고 설비 거래, 컨설팅, 구인구직';
				$result['desc'] = '중고 설비 거래, 컨설팅, 구인구직, 공동구매 등 B2B 가공식품 관계사를 위한 커뮤니티';
				$result['img'] = '[=TAG_IMG]';
				$result['url'] = $url;
			}
			else {
				$result['title'] = '커뮤니티 - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 커뮤니티, 공동구매, 중고 설비 거래, 컨설팅, 구인구직';
				$result['desc'] = '중고 설비 거래, 컨설팅, 구인구직, 공동구매 등 B2B 가공식품 관계사를 위한 커뮤니티';
				$result['img'] = '/front/assets/images/og_image.png';
				$result['url'] = $url;
			}
		}
		else if($key1 === 'notice') {
			if($key2 === 'detail') {
				$result['title'] = '[=TITLE] - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 공지사항, 뉴스, 이벤트';
				$result['desc'] = '푸드플라넷은 B2B 가공식품 정보 분석 플랫폼으로, 국내 가공식품 제조사 데이터와 해외 주요 수출 10개국의 데이터를 제공합니다.';
				$result['img'] = '/front/assets/images/og_image.png';
				$result['url'] = $url;
			}
			else if($key2 === 'news') {
				$result['title'] = '[=TITLE] - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 공지사항, 뉴스, 이벤트';
				$result['desc'] = '푸드플라넷은 B2B 가공식품 정보 분석 플랫폼으로, 국내 가공식품 제조사 데이터와 해외 주요 수출 10개국의 데이터를 제공합니다.';
				$result['img'] = '/front/assets/images/og_image.png';
				$result['url'] = $url;
			}
			else if($key2 === 'event') {
				$result['title'] = '[=TITLE] - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 공지사항, 뉴스, 이벤트';
				$result['desc'] = '푸드플라넷은 B2B 가공식품 정보 분석 플랫폼으로, 국내 가공식품 제조사 데이터와 해외 주요 수출 10개국의 데이터를 제공합니다.';
				$result['img'] = '/front/assets/images/og_image.png';
				$result['url'] = $url;
			}
			else {
				$result['title'] = '커뮤니티 - 푸드플라넷';
				$result['keyword'] = '푸드플라넷, 공지사항, 뉴스, 이벤트';
				$result['desc'] = '푸드플라넷은 B2B 가공식품 정보 분석 플랫폼으로, 국내 가공식품 제조사 데이터와 해외 주요 수출 10개국의 데이터를 제공합니다.';
				$result['img'] = '/front/assets/images/og_image.png';
				$result['url'] = $url;
			}
		}
		else if($key1 === 'qna') {
			$result['title'] = '자주 묻는 질문 - 푸드플라넷';
			$result['keyword'] = '푸드플라넷, FAQ, 자주 묻는 질문, Q&A';
			$result['desc'] = '푸드플라넷은 B2B 가공식품 정보 분석 플랫폼으로, 국내 가공식품 제조사 데이터와 해외 주요 수출 10개국의 데이터를 제공합니다.';
			$result['img'] = '/front/assets/images/og_image.png';
			$result['url'] = $url;
		}
		else if($key1 === 'company') {
			$result['title'] = 'About 푸드플라넷 - 푸드플라넷';
			$result['keyword'] = '푸드플라넷, 회사소개';
			$result['desc'] = 'B2B 가공식품 정보 분석 플랫폼 - 푸드플라넷';
			$result['img'] = '/front/assets/images/og_image.png';
			$result['url'] = $url;
		}
		else if($key1 === 'guide') {
			$result['title'] = '사용법 안내 - 푸드플라넷';
			$result['keyword'] = '푸드플라넷, 사용법';
			$result['desc'] = '푸드플라넷은 B2B 가공식품 정보 분석 플랫폼으로, 국내 가공식품 제조사 데이터와 해외 주요 수출 10개국의 데이터를 제공합니다.';
			$result['img'] = '/front/assets/images/og_image.png';
			$result['url'] = $url;
		}
		else { */
			$result['title'] = '푸드플라넷';
			$result['keyword'] = '푸드플라넷, 가공식품 데이터';
			$result['desc'] = '푸드플라넷은 B2B 가공식품 정보 분석 플랫폼으로, 국내 가공식품 제조사 데이터와 해외 주요 수출 10개국의 데이터를 제공합니다.';
			$result['img'] = '/front/assets/images/og_image.png';
			$result['url'] = $url;
//		}

		return $result;
	}

	public function pagination($num_links, $total_rows, $offset, $perpage, $base_uri, $keyword)
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

		$result = '';
		if($pageNo != $prevPageNo) {
			$result .= '<a href="' . $base_uri . '/' . (($prevPageNo - 1) * $pageSize) . (!empty($keyword) ? '?' . $keyword : '') . '" class="btn-prev" ><span class="blind">이전페이지</span></a>';
		}
		for($i = $startPage; $i <= $endPage; $i++) {
			if($i == $pageNo) {
				$result .= '<a class="current">' . $i . '</a>';
			}
			else {
				$result .= '<a href="' . $base_uri . '/' . (($i - 1) * $pageSize) . ');">' . $i . (!empty($keyword) ? '?' . $keyword : '') . '</a>';
			}
		}
		if($pageNo != $nextPageNo) {
			$result .= '<a href="' . $base_uri . '/' . (($nextPageNo - 1) * $pageSize) . (!empty($keyword) ? '?' . $keyword : '') . ' class="btn-next" ><span class="blind">다음페이지</span></a>';
		}
		
		return $result;
	}

	public function pagination2($num_links, $total_rows, $offset, $perpage)
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

	public function pagination3($num_links, $total_rows, $offset, $perpage)
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

		$result = '';
		if($pageNo != $prevPageNo) {
			$result .= '<a href="#" onclick="javascript:goPage(\'' . (($prevPageNo - 1) * $pageSize) . '\'); return false;" class="btn-prev" ><span class="blind">이전페이지</span></a>';
		}
		for($i = $startPage; $i <= $endPage; $i++) {
			if($i == $pageNo) {
				$result .= '<a class="current">' . $i . '</a>';
			}
			else {
				$result .= '<a href="#" onclick="javascript:goPage(\'' . (($i - 1) * $pageSize) . '\'); return false;">' . $i . '</a>';
			}
		}
		if($pageNo != $nextPageNo) {
			$result .= '<a href="#" onclick="javascript:goPage(\'' . (($nextPageNo - 1) * $pageSize) . '\'); return false;" class="btn-next" ><span class="blind">다음페이지</span></a>';
		}
		
		return $result;
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

	public function check_phone($val) {
		$pattern = '/^\d{2,3}-?\d{3,4}-?\d{4}$/';

		if (preg_match($pattern, $val, $matches)) {
			return true;
		} 
		else {
			return false;
		}
	}

	public function check_email($val) {
		$pattern = '/^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,5}$/';

		if (preg_match($pattern, $val, $matches)) {
			return true;
		} 
		else {
			return false;
		}
	}

	public function check_bizno($val) {
		$pattern = '/^\d{3}-?\d{2}-?\d{5}$/';

		if (preg_match($pattern, $val, $matches)) {
			return true;
		} 
		else {
			return false;
		}
	}
}
