<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Excelupload extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('excel');
        $this->load->model('admin/domestic_m', 'domestic_m');
        $this->load->model('common_m', 'common_m');
    }

    public function companym() {
		$result = array();
		$data = array();
		$food = $this->common_m->code_list('food_category')->result_array();

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
					$val['biz_no'] = trim($rowData[1]);
					$val['company_name'] = trim($rowData[2]);
					$val['company_name_eng'] = trim($rowData[3]);
                    $val['logo_img'] = trim($rowData[4]);
                    $val['summary'] = addslashes(trim($rowData[5]));
                    $tmp = explode('#', trim($rowData[6]));
                    $tags = array();
                    for($i = 0; $i < count($tmp); $i++) {
                        if(empty(trim($tmp[$i]))) continue;
                        $tags[] = $tmp[$i];
                    }
                    $val['tags'] = implode(',', $tags);
                    $val['ceo_name'] = trim($rowData[7]);
                    $val['industrial_code'] = trim($rowData[8]);
                    $val['incorporation_at'] = str_replace('.', '-', trim($rowData[9]));
                    $val['addr'] = trim($rowData[10]);
                    $val['homepage'] = trim($rowData[11]);
                    $val['company_tel'] = trim($rowData[12]);
                    $val['introduce_file'] = trim($rowData[13]);

                    $tmp = (strtoupper($rowData[14]) === 'X' ? '' : explode(',', $rowData[14]));
					$food_cd = array();
					$etc_name = array();

					for($i = 0; $i < count($tmp); $i++) {
						$bExists = false;
						foreach($food as $code) {
							if($code['code_name'] === trim($tmp[$i])) {
								$food_cd[] = $code['sub_code'];
								$bExists = true;
								break;
							}
						}
						if(!$bExists) {
							$bEtc = false;
							for($j = 0; $j <  count($food_cd); $j++) {
								if($food_cd[$j] === '029') {
									$bEtc = true;
									break;
								}
							}
							if(!$bEtc) $food_cd[] = '029';
							$etc_name[] = trim($tmp[$i]);
						}
					}

                    $val['category'] = implode(',', $food_cd);
                    $val['category_etc'] = implode(',', $etc_name);
                    $val['main_group'] = trim($rowData[15]);
                    $val['main_product'] = trim($rowData[16]);
                    $val['main_client'] = trim($rowData[17]);
                    $val['main_oem'] = trim($rowData[18]);
                    $val['production_day'] = trim($rowData[19]);
                    $val['unit_day'] = trim($rowData[20]);
                    $val['production_month'] = trim($rowData[21]);
                    $val['unit_month'] = trim($rowData[22]);
                    $val['production_year'] = trim($rowData[23]);
                    $val['unit_year'] = trim($rowData[24]);
                    $val['capa'] = trim($rowData[25]);
                    $val['capa_at'] = trim($rowData[26]);
                    $val['facilities_info'] = trim($rowData[27]);
                    $val['packaging_machine'] = trim($rowData[28]);
                    $val['etc_machine'] = trim($rowData[29]);
                    $val['detection_machine'] = trim($rowData[30]);
                    $val['certi'] = trim($rowData[31]);
                    $val['is_fda'] = strtoupper(trim($rowData[32])) === 'O' ? 'y' : 'n';
                    $val['distribution_channel'] = trim($rowData[33]);
                    $val['export_nation'] = trim($rowData[34]);
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->domestic_m->insert_companym_list($data);
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


    public function companyd() {
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
					$val['biz_no'] = trim($rowData[0]);
					$val['company_name'] = trim($rowData[1]);
                    $val['industrial_code'] = trim($rowData[2]);
					$val['main_product'] = trim($rowData[3]);
					$val['distribution_type'] = trim($rowData[4]);
					$val['sales_year'] = trim($rowData[5]);
					$val['sales_at'] = trim($rowData[6]);
					$val['credit_rating'] = trim($rowData[7]);
					$val['rating_at'] = trim($rowData[8]);
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->domestic_m->insert_companyd_list($data);
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

    public function nbproduct() {
		$result = array();
		$data = array();
		$food = $this->common_m->code_list('food_category')->result_array();

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
					$val['biz_no'] = trim($rowData[1]);
					$val['company_name'] = trim($rowData[2]);

                    $tmp = (strtoupper($rowData[3]) === 'X' ? '' : explode(',', $rowData[3]));
					$food_cd = array();
					$etc_name = array();

					for($i = 0; $i < count($tmp); $i++) {
						$bExists = false;
						foreach($food as $code) {
							if($code['code_name'] === trim($tmp[$i])) {
								$food_cd[] = $code['sub_code'];
								$bExists = true;
								break;
							}
						}
						if(!$bExists) {
							$bEtc = false;
							for($j = 0; $j <  count($food_cd); $j++) {
								if($food_cd[$j] === '029') {
									$bEtc = true;
									break;
								}
							}
							if(!$bEtc) $food_cd[] = '029';
							$etc_name[] = trim($tmp[$i]);
						}
					}

                    $val['category'] = implode(',', $food_cd);
                    $val['category_etc'] = implode(',', $etc_name);
					$val['main_group'] = trim($rowData[4]);

					$val['product_name'] = addslashes(trim($rowData[5]));
					$val['summary'] = addslashes(trim($rowData[6]));
                    $tmp = explode('#', trim($rowData[7]));
                    $tags = array();
                    for($i = 0; $i < count($tmp); $i++) {
                        if(empty(trim($tmp[$i]))) continue;
                        $tags[] = $tmp[$i];
                    }
                    $val['tags'] = implode(',', $tags);
					$val['supply_price'] = trim($rowData[8]);
					$val['moq'] = trim($rowData[9]);
					$val['delivery_day'] = trim($rowData[10]);
					$val['product_type'] = trim($rowData[11]);
					$val['weight'] = trim($rowData[12]);
					$val['unit'] = trim($rowData[13]);
					$val['storage'] = trim($rowData[14]);
					$val['expire_day'] = trim($rowData[15]);
					$val['qty'] = trim($rowData[16]);
					$val['qty_unit'] = trim($rowData[17]);
					$val['container_type'] = trim($rowData[18]);
					$val['channel_status'] = trim($rowData[19]);
					$val['is_main'] = strtoupper(trim($rowData[20])) === 'TRUE' || strtoupper(trim($rowData[20])) === '1' ? 'y' : 'n';
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->domestic_m->insert_nbproduct_list($data);
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
	
    public function oemproduct() {
		$result = array();
		$data = array();
		$food = $this->common_m->code_list('food_category')->result_array();

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
					$val['biz_no'] = trim($rowData[1]);
					$val['company_name'] = trim($rowData[2]);

                    $tmp = (strtoupper($rowData[3]) === 'X' ? '' : explode(',', $rowData[3]));
					$food_cd = array();
					$etc_name = array();

					for($i = 0; $i < count($tmp); $i++) {
						$bExists = false;
						foreach($food as $code) {
							if($code['code_name'] === trim($tmp[$i])) {
								$food_cd[] = $code['sub_code'];
								$bExists = true;
								break;
							}
						}
						if(!$bExists) {
							$bEtc = false;
							for($j = 0; $j <  count($food_cd); $j++) {
								if($food_cd[$j] === '029') {
									$bEtc = true;
									break;
								}
							}
							if(!$bEtc) $food_cd[] = '029';
							$etc_name[] = trim($tmp[$i]);
						}
					}

                    $val['category'] = implode(',', $food_cd);
                    $val['category_etc'] = implode(',', $etc_name);
					$val['main_group'] = trim($rowData[4]);
					$val['main_oem'] = trim($rowData[5]);

                    $val['product_name'] = addslashes(trim($rowData[6]));
					$val['summary'] = addslashes(trim($rowData[7]));
                    $tmp = explode('#', trim($rowData[8]));
                    $tags = array();
                    for($i = 0; $i < count($tmp); $i++) {
                        if(empty(trim($tmp[$i]))) continue;
                        $tags[] = $tmp[$i];
                    }
                    $val['tags'] = implode(',', $tags);
					$val['supply_price'] = trim($rowData[9]);
					$val['moq'] = trim($rowData[10]);
					$val['delivery_day'] = trim($rowData[11]);
					$val['product_type'] = trim($rowData[12]);
					$val['weight'] = trim($rowData[13]);
					$val['unit'] = trim($rowData[14]);
					$val['storage'] = trim($rowData[15]);
					$val['expire_day'] = trim($rowData[16]);
					$val['qty'] = trim($rowData[17]);
					$val['qty_unit'] = trim($rowData[18]);
					$val['container_type'] = trim($rowData[19]);
					$val['channel_status'] = trim($rowData[20]);
					$val['is_main'] = strtoupper(trim($rowData[21])) === 'TRUE' || strtoupper(trim($rowData[21])) === '1' ? 'y' : 'n';
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->domestic_m->insert_oemproduct_list($data);
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

    public function finance() {
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
					$val['biz_no'] = trim($rowData[1]);
					$val['base_year'] = trim($rowData[2]);
					$val['sales_year'] = trim($rowData[3]);
					$val['biz_profits'] = trim($rowData[4]);
					$val['current_profits'] = trim($rowData[5]);
					$val['credit_rating'] = trim($rowData[6]);
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->domestic_m->insert_finance_list($data);
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

    public function facilities() {
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
					$val['biz_no'] = trim($rowData[1]);
					$val['img_url'] = trim($rowData[2]);
					$val['img_desc'] = trim($rowData[3]);
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->domestic_m->insert_facilities_list($data);
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

    public function cert() {
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
					$val['biz_no'] = trim($rowData[1]);
					$val['cert_name'] = trim($rowData[2]);
					$val['cert_img'] = trim($rowData[3]);
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->domestic_m->insert_cert_list($data);
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
	
    public function patent() {
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
					$val['biz_no'] = trim($rowData[1]);
					$val['patent_name'] = addslashes(trim($rowData[2]));
					$val['patent_name_eng'] = addslashes(trim($rowData[3]));
					$val['patent_img'] = trim($rowData[4]);
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->domestic_m->insert_patent_list($data);
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

    public function productimg() {
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
					$val['biz_no'] = trim($rowData[2]);
					$val['product_seq'] = trim($rowData[1]);
					$val['img_type'] = trim($rowData[3]);
					$val['img_url'] = trim($rowData[5]);
					$val['is_main'] = strtoupper(trim($rowData[4])) === 'TRUE' || strtoupper(trim($rowData[4])) === '1' ? 'y' : 'n';
					$val['order_no'] = '1';
					$val['admin_id'] = $this->data['admin']['admin_id'];
					$data[] = $val;

				}
			}
			$res = $this->domestic_m->insert_image_list($data);
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