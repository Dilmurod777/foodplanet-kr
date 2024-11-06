<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Excelupload extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('excel');
        $this->load->model('admin/overseas_m', 'overseas_m');
        $this->load->model('common_m', 'common_m');
    }

    public function nation() {
		$result = array();
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['files']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel -> getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 2; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					
					if(empty(trim($rowData[0]))) continue;

					$val = array();
					$val['seq'] = trim($rowData[0]);
					$val['nation_name'] = trim($rowData[1]);
					$val['nation_name_eng'] = trim($rowData[2]);
					$val['nation_code'] = trim($rowData[3]);
					$val['continent'] = trim($rowData[4]);
					$val['logo_img'] = trim($rowData[5]);
					$val['background_img'] = trim($rowData[6]);
					$val['flag_img'] = trim($rowData[7]);
					$val['currency'] = trim($rowData[8]);
					$val['language'] = trim($rowData[9]);
					$val['fta_status'] = trim($rowData[10]);
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->overseas_m->insert_nation_list($data);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';
			}
			
		} 
		catch(exception $e) {
			$result['result'] = 'fail';
			$result['msg'] = $e;
		}		

		echo json_encode($result);
		exit;
    }


    public function channel() {
		$result = array();
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['files']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel -> getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 2; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					if(empty(trim($rowData[0]))) continue;

					$val = array();
					$val['seq'] = trim($rowData[0]);
					$val['nation_seq'] = trim($rowData[1]);
					$val['nation_name'] = trim($rowData[2]);
					$val['channel_name'] = addslashes(trim($rowData[3]));
					$val['channel_name_eng'] = addslashes(trim($rowData[4]));
					$val['channel_name_origin'] = addslashes(trim($rowData[5]));
					$val['main_product'] = trim($rowData[6]);
					$val['url'] = trim($rowData[7]);
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->overseas_m->insert_channel_list($data);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';
			}
			
		} 
		catch(exception $e) {
			$result['result'] = 'fail';
			$result['msg'] = $e;
		}		

		echo json_encode($result);
		exit;
    }	

    public function product() {
		$result = array();
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['files']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel -> getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 2; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					if(empty(trim($rowData[0]))) continue;

					$val = array();
					$val['seq'] = trim($rowData[0]);
					$val['product_name'] = trim($rowData[1]);
					$val['product_name_eng'] = trim($rowData[2]);
					$val['product_img'] = trim($rowData[3]);
					$val['background_img'] = trim($rowData[4]);
					$val['summary'] = '';
					$val['hscode'] = trim($rowData[5]);
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->overseas_m->insert_product_list($data);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';
			}
			
		} 
		catch(exception $e) {
			$result['result'] = 'fail';
			$result['msg'] = $e;
		}		

		echo json_encode($result);
		exit;
    }	
	
    public function topproduct() {
		$result = array();
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['files']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel -> getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 2; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					if(empty(trim($rowData[0]))) continue;

					$val = array();
					$val['seq'] = trim($rowData[0]);
					$val['nation_seq'] = trim($rowData[1]);
					$val['product_seq'] = trim($rowData[2]);
					$val['order_no'] = trim($rowData[3]);
					$val['product_name'] = trim($rowData[4]);
					$val['hscode'] = trim($rowData[5]);
					$val['price'] = preg_replace('/[^0-9]*/s', '', trim($rowData[6]));
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->overseas_m->insert_top_list($data);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';
			}
			
		} 
		catch(exception $e) {
			$result['result'] = 'fail';
			$result['msg'] = $e;
		}		

		echo json_encode($result);
		exit;
    }

    public function np() {
		$result = array();
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['files']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel -> getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 2; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					if(empty(trim($rowData[0]))) continue;

					$val = array();
					$val['seq'] = trim($rowData[0]);
					$val['product_seq'] = trim($rowData[1]);
					$val['nation_seq'] = trim($rowData[2]);
					$val['nation_name'] = trim($rowData[3]);
					$val['export_price'] = preg_replace('/[^0-9]*/s', '', trim($rowData[4]));
					$val['distribution_status'] = trim($rowData[5]);
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->overseas_m->insert_np_list($data);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';
			}
			
		} 
		catch(exception $e) {
			$result['result'] = 'fail';
			$result['msg'] = $e;
		}		

		echo json_encode($result);
		exit;
    }	

    public function hscode() {
		$result = array();
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['files']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel->getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 2; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					if(empty(trim($rowData[0]))) continue;

					$val = array();
					$val['seq'] = trim($rowData[0]);
					$val['nation_seq'] = trim($rowData[2]);
					$val['product_seq'] = trim($rowData[1]);
					$val['hscode'] = trim($rowData[3]);
					$val['desc'] = addslashes(trim($rowData[4]));
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->overseas_m->insert_hscode_list($data);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';
			}
			
		} 
		catch(exception $e) {
			$result['result'] = 'fail';
			$result['msg'] = $e;
		}		

		echo json_encode($result);
		exit;
    }		

    public function document() {
		$result = array();
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['files']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel->getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 2; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					if(empty(trim($rowData[0]))) continue;

					$val = array();
					$val['seq'] = trim($rowData[0]);
					$val['nation_seq'] = trim($rowData[2]);
					$val['product_seq'] = trim($rowData[1]);
					$val['document_kind'] = trim($rowData[3]);
					$val['hscode'] = trim($rowData[4]);
					$val['title'] = trim($rowData[5]);
					$val['desc'] = addslashes(trim($rowData[6]));
					$val['document'] = addslashes(trim($rowData[7]));
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->overseas_m->insert_document_list($data);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';
			}
			
		} 
		catch(exception $e) {
			$result['result'] = 'fail';
			$result['msg'] = $e;
		}		

		echo json_encode($result);
		exit;
    }
	
    public function law() {
		$result = array();
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['files']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel->getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 2; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					if(empty(trim($rowData[0]))) continue;

					$val = array();
					$val['seq']= trim($rowData[0]);
					$val['nation_seq'] = trim($rowData[2]);
					$val['product_seq'] = trim($rowData[1]);
					$val['law_kind'] = trim($rowData[3]);
					$val['hscode'] = trim($rowData[4]);
					$val['laws'] = addslashes(trim($rowData[5]));
					$val['desc']= addslashes(trim($rowData[6]));
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->overseas_m->insert_law_list($data);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';
			}
			
		} 
		catch(exception $e) {
			$result['result'] = 'fail';
			$result['msg'] = $e;
		}		

		echo json_encode($result);
		exit;
    }	

    public function requirement() {
		$result = array();
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['files']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel->getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 2; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					if(empty(trim($rowData[0]))) continue;

					$val = array();
					$val['seq'] = trim($rowData[0]);
					$val['nation_seq'] = trim($rowData[1]);
					$val['product_name'] = trim($rowData[2]);
					$val['hscode'] = trim($rowData[3]);
					$val['export_requirement'] = addslashes(trim($rowData[4]));
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->overseas_m->insert_requirement_list($data);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';
			}
			
		} 
		catch(exception $e) {
			$result['result'] = 'fail';
			$result['msg'] = $e;
		}		

		echo json_encode($result);
		exit;
    }	

    public function trends() {
		$result = array();
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['files']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel->getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 2; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					if(empty(trim($rowData[0]))) continue;

					$val = array();
					$val['seq'] = trim($rowData[0]);
					$val['nation_seq'] = trim($rowData[1]);
					$val['product_seq'] = trim($rowData[2]);
					$val['title'] = addslashes(trim($rowData[3]));
					$val['link_url'] = trim($rowData[4]);
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->overseas_m->insert_trends_list($data);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';
			}
			
		} 
		catch(exception $e) {
			$result['result'] = 'fail';
			$result['msg'] = $e;
		}		

		echo json_encode($result);
		exit;
    }	

    public function buyer() {
		$result = array();
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['files']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel->getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 2; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					if(empty(trim($rowData[0]))) continue;

					$val = array();
					$val['seq'] = trim($rowData[0]);
					$val['nation_seq'] = trim($rowData[1]);
					$val['product_seq'] = trim($rowData[2]);
					$val['company_name'] = addslashes(trim($rowData[3]));
					$val['owner_name'] = addslashes(trim($rowData[4]));
					$val['category'] = trim($rowData[5]);
					$val['hscode'] = trim($rowData[6]);
					$val['volume_order'] = trim($rowData[7]);
					$val['available_period'] = trim($rowData[8]);
					$val['product_name'] = strtoupper(trim($rowData[9])) === 'X' ? '' : addslashes(trim($rowData[9]));
					$val['desc'] = addslashes(trim($rowData[10]));
					$val['trade_condition'] = strtoupper(trim($rowData[11])) === 'X' ? '' : trim($rowData[11]);
					$val['trade_volume'] = strtoupper(trim($rowData[12])) === 'X' ? '' : trim($rowData[12]);
					$val['request_company_name'] = strtoupper(trim($rowData[13])) === 'X' ? '' : addslashes(trim($rowData[13]));
					$val['main_product'] = strtoupper(trim($rowData[14])) === 'X' ? '' : addslashes(trim($rowData[14]));
					$val['main_income'] = strtoupper(trim($rowData[15])) === 'X' ? '' : addslashes(trim($rowData[15]));
					$val['is_korea'] = strtoupper(trim($rowData[16])) === 'Y' ? 'y' : (strtoupper(trim($rowData[16])) === 'X' ? '' : 'n');
					$val['contact'] = strtoupper(trim($rowData[17])) === 'X' ? '' : addslashes(trim($rowData[17]));
					$val['export_staff'] = strtoupper(trim($rowData[18])) === 'X' ? '' : addslashes(trim($rowData[18]));
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->overseas_m->insert_buyer_list($data);
			if($res) {
				$result['result'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
			else {
				$result['result'] = 'fail';
				$result['msg'] = '등록에 실패했습니다.';
			}
			
		} 
		catch(exception $e) {
			$result['result'] = 'fail';
			$result['msg'] = $e;
		}		

		echo json_encode($result);
		exit;
    }		
}