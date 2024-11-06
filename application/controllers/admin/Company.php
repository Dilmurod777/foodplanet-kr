<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Company extends FP_AdminController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('excel');
        $this->load->model('member_m');
        $this->load->model('common_m');
        $this->load->model('admin/company_m', 'admin_company_m');
    }

	public function index() {
		$this->load->view('admin/common/include/header_v', $this->data);
		$this->load->view('admin/company/list_v');
		$this->load->view('admin/common/include/footer_v');
	}

	public function excelBI01() {
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
					$val['company_name'] = $rowData[1];
					$val['member_type'] = $rowData[2];
					$val['owner_name'] = (strtoupper($rowData[3]) === 'X' ? '' : $rowData[3]);
					$val['group_name'] = (strtoupper($rowData[4]) === 'X' ? '' : $rowData[4]);
					$val['company_type'] = (strtoupper($rowData[5]) === 'X' ? '' : $rowData[5]);
					$val['incorporation_at'] = (strtoupper($rowData[6]) === 'X' ? '' : str_replace('.', '-', $rowData[6]));
					$val['zonecode'] = (strtoupper($rowData[8]) === 'X' ? '' : $rowData[8]);
					$val['addr'] = (strtoupper($rowData[7]) === 'X' ? '' : $rowData[7]);
					$val['industrial_code'] = (strtoupper($rowData[9]) === 'X' ? '' : $rowData[9]);
					$val['industrial_name'] = (strtoupper($rowData[10]) === 'X' ? '' : $rowData[10]);
					$val['homepage'] = (strtoupper($rowData[11]) === 'X' ? '' : $rowData[11]);
					$val['company_tel'] = (strtoupper($rowData[12]) === 'X' ? '' : $rowData[12]);
					$val['company_fax'] = (strtoupper($rowData[13]) === 'X' ? '' : $rowData[13]);
					$val['company_email'] = (strtoupper($rowData[14]) === 'X' ? '' : $rowData[14]);
					$val['confirmed_at'] = (strtoupper($rowData[15]) === 'X' ? '' : str_replace('.', '-', $rowData[15]));
					$val['admin_id'] = 'admin';
					$data[] = $val;

				}
			}
			$this->admin_company_m->insert_bi01_list($data);
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelBI011() {
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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
					$val['employee_name'] = (strtoupper($rowData[1]) === 'X' ? '' : $rowData[1]);
					$val['employee_tel'] = (strtoupper($rowData[2]) === 'X' ? '' : $rowData[2]);
					$val['etc_memo'] = (strtoupper($rowData[3]) === 'X' ? '' : $rowData[3]);
					$val['sample'] = (strtoupper($rowData[4]) === 'X' ? '' : $rowData[4]);
					$val['sample_testing'] = (strtoupper($rowData[5]) === 'X' ? '' : $rowData[5]);
					$val['admin_memo'] = (strtoupper($rowData[6]) === 'X' ? '' : $rowData[6]);
					$val['admin_id'] = 'admin';
					$data[] = $val;

					//		            $allData[] = $rowData[0];
				}
			}
			$this->admin_company_m->insert_bi011_list($data);
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelBI02() {
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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
					$val['year_sales'] = (strtoupper($rowData[1]) === 'X' ? '' : $rowData[1]);
					$val['biz_profit'] = (strtoupper($rowData[2]) === 'X' ? '' : $rowData[2]);
					$val['net_profit'] = (strtoupper($rowData[3]) === 'X' ? '' : $rowData[3]);
					$val['credit_rating'] = (strtoupper($rowData[4]) === 'X' ? '' : $rowData[4]);
                    $val['confirmed_at'] = (strtoupper($rowData[5]) === 'X' ? '' : $rowData[5]);
					$val['admin_id'] = 'admin';
					$data[] = $val;
				}
			}
			$this->admin_company_m->insert_bi02_list($data);
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelBI03() {
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

		try {
			$food = $this->common_m->code_list('food_category')->result_array();

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

					$tmp = (strtoupper($rowData[1]) === 'X' ? '' : $rowData[1]);
					$food_cd = '';
					$etc_name = '';
					foreach($food as $code) {
						if($code['code_name'] === $tmp) {
							$food_cd = $code['sub_code'];
							break;
						}
					}
					if($food_code === '' || $food_cd == '028') {
						$food_cd = '028';
						$etc_name = $tmp;
					}

					$val = array();
					$val['biz_no'] = trim($rowData[0]);
					$val['main_product_cd'] = $food_cd;
					$val['main_product_etc'] = $etc_name;
                    $val['nb_product_moq'] = (strtoupper($rowData[2]) === 'X' ? '' : $rowData[2]);
                    $val['nb_product_price'] = (strtoupper($rowData[3]) === 'X' ? '' : $rowData[3]);
                    $val['nb_product_delivery'] = (strtoupper($rowData[4]) === 'X' ? '' : $rowData[4]);
                    $val['nb_product_type'] = (strtoupper($rowData[5]) === 'X' ? '' : $rowData[5]);
                    $val['nb_material_moq'] = (strtoupper($rowData[6]) === 'X' ? '' : $rowData[6]);
                    $val['nb_material_leadtime'] = (strtoupper($rowData[7]) === 'X' ? '' : $rowData[7]);
                    $val['nb_material_price'] = (strtoupper($rowData[8]) === 'X' ? '' : $rowData[8]);
                    $val['oem_product_moq'] = (strtoupper($rowData[9]) === 'X' ? '' : $rowData[9]);
                    $val['oem_product_price'] = (strtoupper($rowData[10]) === 'X' ? '' : $rowData[10]);
                    $val['oem_product_delivery'] = (strtoupper($rowData[11]) === 'X' ? '' : $rowData[11]);
                    $val['oem_material_moq'] = (strtoupper($rowData[12]) === 'X' ? '' : $rowData[12]);
                    $val['oem_material_leadtime'] = (strtoupper($rowData[13]) === 'X' ? '' : $rowData[13]);
                    $val['oem_material_price'] = (strtoupper($rowData[14]) === 'X' ? '' : $rowData[14]);
                    $val['confirmed_at'] = (strtoupper($rowData[15]) === 'X' ? '' : $rowData[15]);
                    $val['payment_type'] = (strtoupper($rowData[16]) === 'X' ? '' : $rowData[16]);
					$val['admin_id'] = 'admin';
					$data[] = $val;
				}
			}
			$this->admin_company_m->insert_bi03_list($data);
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelBI03_product() {
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

		try {
			$food = $this->common_m->code_list('food_category')->result_array();

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

					$tmp2 = (strtoupper($rowData[2]) === 'X' ? '' : $rowData[2]);
					$tmp2 = explode(',', $tmp2);
					$food_cd = array();
					$food_name = array();
					$etc_name = array();
					for($i = 0; $i < count($tmp2); $i++) {
						foreach($food as $code) {
							if($code['code_name'] === $tmp2[$i]) {
								$food_cd[] = $code['sub_code'];
								$food_name[] = $tmp2[$i];
								break;
							}
						}
					}
					if(count($tmp2) !== count($food_cd)) {
						for($i = 0; $i < count($tmp2); $i++) {
							if(empty($tmp2[$i])) continue;

							$bExists = false;
							for($j = 0; $j < count($food_cd); $j++) {
								if($tmp2[$i] == $food_name[$j]) {
									$bExists = true;
									break;
								}

							}

							if(!$bExists) {
								$food_cd[] = '028';
								$etc_name[] = $tmp2[$i];
							}
						}
					}

					$val = array();
					$val['biz_no'] = trim($rowData[0]);
					$val['main_product_cd'] = implode(',', $food_cd);
					$val['main_product_etc'] = implode(',', $etc_name);
                    $val['nb_product_moq'] = '';
                    $val['nb_product_price'] = '';
                    $val['nb_product_delivery'] = '';
                    $val['nb_product_type'] = '';
                    $val['nb_material_moq'] = '';
                    $val['nb_material_leadtime'] = '';
                    $val['nb_material_price'] = '';
                    $val['oem_product_moq'] = '';
                    $val['oem_product_price'] = '';
                    $val['oem_product_delivery'] = '';
                    $val['oem_material_moq'] = '';
                    $val['oem_material_leadtime'] = '';
                    $val['oem_material_price'] = '';
                    $val['confirmed_at'] = '';
                    $val['payment_type'] = '';
					$val['admin_id'] = 'admin';
					$data[] = $val;
				}
			}
			$this->admin_company_m->insert_bi03_list($data);
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}


	public function excelBI031() {
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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
                    $val['product_name'] = (strtoupper($rowData[1]) === 'X' ? '' : $rowData[1]);
                    $val['product_summary'] = (strtoupper($rowData[2]) === 'X' ? '' : $rowData[2]);
                    $val['tags'] = (strtoupper($rowData[3]) === 'X' ? '' : $rowData[3]);
                    $val['maker'] = (strtoupper($rowData[4]) === 'X' ? '' : $rowData[4]);
                    $val['supply_price'] = (strtoupper($rowData[5]) === 'X' ? '' : $rowData[5]);
                    $val['moq'] = (strtoupper($rowData[6]) === 'X' ? '' : $rowData[6]);
                    $val['food_type'] = (strtoupper($rowData[7]) === 'X' ? '' : $rowData[7]);
                    $val['brand'] = (strtoupper($rowData[8]) === 'X' ? '' : $rowData[8]);
                    $val['expire_day'] = (strtoupper($rowData[9]) === 'X' ? '' : $rowData[9]);
                    $val['channel'] = (strtoupper($rowData[10]) === 'X' ? '' : $rowData[10]);
                    $val['delivery_day'] = (strtoupper($rowData[11]) === 'X' ? '' : $rowData[11]);
                    $val['type_cnt'] = (strtoupper($rowData[12]) === 'X' ? '' : $rowData[12]);
                    $val['material_leadtime'] = (strtoupper($rowData[13]) === 'X' ? '' : $rowData[13]);
                    $val['material_moq'] = (strtoupper($rowData[14]) === 'X' ? '' : $rowData[14]);
                    $val['material_price'] = (strtoupper($rowData[15]) === 'X' ? '' : $rowData[15]);
                    $val['export_nation'] = (strtoupper($rowData[16]) === 'X' ? '' : $rowData[16]);
                    $val['export_progress'] = (strtoupper($rowData[17]) === 'X' ? '' : $rowData[17]);
                    $val['is_ios22000'] = (strtoupper($rowData[18]) === 'X' ? '' : $rowData[18]);
                    $val['is_fda'] = (strtoupper($rowData[19]) === 'X' ? '' : $rowData[19]);
                    $val['is_halal'] = (strtoupper($rowData[20]) === 'X' ? '' : $rowData[20]);
                    $val['product_img'] = (strtoupper($rowData[21]) === 'X' ? '' : $rowData[21]);
                    $val['label_img'] = (strtoupper($rowData[22]) === 'X' ? '' : $rowData[22]);
                    $val['size'] = (strtoupper($rowData[23]) === 'X' ? '' : $rowData[23]);
                    $val['storage_method'] = (strtoupper($rowData[24]) === 'X' ? '' : $rowData[24]);
                    $val['manufacture_day'] = (strtoupper($rowData[25]) === 'X' ? '' : $rowData[25]);
                    $val['manufacture_month'] = (strtoupper($rowData[26]) === 'X' ? '' : $rowData[26]);
                    $val['manufacture_year'] = (strtoupper($rowData[27]) === 'X' ? '' : $rowData[27]);
                    $val['cert_confirmed_at'] = (strtoupper($rowData[28]) === 'X' ? '' : $rowData[28]);
					$val['admin_id'] = 'admin';
					$data[] = $val;
				}
			}
			$this->admin_company_m->insert_bi031_list($data);
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelBI032() {
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

		try {
			$oem = $this->common_m->code_list('oem_company')->result_array();

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

					$tmp = (strtoupper($rowData[4]) === 'X' ? '' : $rowData[4]);
					$maker_code = '';
					$etc_name = '';
					foreach($oem as $code) {
						if($code['code_name'] === $tmp) {
							$maker_code = $code['sub_code'];
							break;
						}
					}
					if($maker_code === '' || $maker_code == '026') {
						$maker_code = '028';
						$etc_name = $tmp;
					}

					$val = array();
					$val['biz_no'] = trim($rowData[0]);
                    $val['product_name'] = (strtoupper($rowData[1]) === 'X' ? '' : $rowData[1]);
                    $val['product_summary'] = (strtoupper($rowData[2]) === 'X' ? '' : $rowData[2]);
                    $val['tags'] = (strtoupper($rowData[3]) === 'X' ? '' : $rowData[3]);
                    $val['maker_cd'] = $maker_code; 
                    $val['maker_etc'] = $etc_name; 
                    $val['supply_price'] = (strtoupper($rowData[5]) === 'X' ? '' : $rowData[5]);
                    $val['moq'] = (strtoupper($rowData[6]) === 'X' ? '' : $rowData[6]);
                    $val['food_type'] = (strtoupper($rowData[7]) === 'X' ? '' : $rowData[7]);
                    $val['brand'] = (strtoupper($rowData[8]) === 'X' ? '' : $rowData[8]);
                    $val['expire_day'] = (strtoupper($rowData[9]) === 'X' ? '' : $rowData[9]);
                    $val['channel'] = (strtoupper($rowData[10]) === 'X' ? '' : $rowData[10]);
                    $val['delivery_day'] = (strtoupper($rowData[11]) === 'X' ? '' : $rowData[11]);
                    $val['other_company'] = (strtoupper($rowData[12]) === 'X' ? '' : $rowData[12]);
                    $val['product_type'] = (strtoupper($rowData[13]) === 'X' ? '' : $rowData[13]);
                    $val['material_leadtime'] = (strtoupper($rowData[14]) === 'X' ? '' : $rowData[14]);
                    $val['material_moq'] = (strtoupper($rowData[15]) === 'X' ? '' : $rowData[15]);
                    $val['material_price'] = (strtoupper($rowData[16]) === 'X' ? '' : $rowData[16]);
                    $val['export_nation'] = (strtoupper($rowData[17]) === 'X' ? '' : $rowData[17]);
                    $val['export_progress'] = (strtoupper($rowData[18]) === 'X' ? '' : $rowData[18]);
                    $val['is_ios22000'] = (strtoupper($rowData[19]) === 'X' ? '' : $rowData[19]);
                    $val['is_fda'] = (strtoupper($rowData[20]) === 'X' ? '' : $rowData[20]);
                    $val['is_halal'] = (strtoupper($rowData[21]) === 'X' ? '' : $rowData[21]);
                    $val['product_img'] = (strtoupper($rowData[22]) === 'X' ? '' : $rowData[22]);
                    $val['label_img'] = (strtoupper($rowData[23]) === 'X' ? '' : $rowData[23]);
                    $val['size'] = (strtoupper($rowData[24]) === 'X' ? '' : $rowData[24]);
                    $val['storage_method'] = (strtoupper($rowData[25]) === 'X' ? '' : $rowData[25]);
                    $val['manufacture_day'] = (strtoupper($rowData[26]) === 'X' ? '' : $rowData[26]);
                    $val['manufacture_month'] = (strtoupper($rowData[27]) === 'X' ? '' : $rowData[27]);
                    $val['manufacture_year'] = (strtoupper($rowData[28]) === 'X' ? '' : $rowData[28]);
                    $val['cert_confirmed_at'] = (strtoupper($rowData[29]) === 'X' ? '' : $rowData[29]);
					$val['admin_id'] = 'admin';
					$data[] = $val;
				}
			}
			$this->admin_company_m->insert_bi032_list($data);
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelBI04() {
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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
					$val['cert'] = (strtoupper($rowData[1]) === 'X' ? '' : $rowData[1]);
					$val['patent'] = (strtoupper($rowData[2]) === 'X' ? '' : $rowData[2]);
					$val['iso'] = (strtoupper($rowData[3]) === 'X' ? '' : $rowData[3]);
					$val['fda'] = (strtoupper($rowData[4]) === 'X' ? '' : $rowData[4]);
					$val['halal'] = (strtoupper($rowData[5]) === 'X' ? '' : $rowData[5]);
					$val['confirmed_at'] = (strtoupper($rowData[6]) === 'X' ? '' : $rowData[6]);
					$val['admin_id'] = 'admin';
					$data[] = $val;
				}
			}
			$this->admin_company_m->insert_bi04_list($data);
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelBI05() {
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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
					$val['manufacture_day'] = (strtoupper($rowData[1]) === 'X' ? '' : $rowData[1]);
                    $val['manufacture_month'] = (strtoupper($rowData[2]) === 'X' ? '' : $rowData[2]);
                    $val['load_cnt'] = (strtoupper($rowData[3]) === 'X' ? '' : $rowData[3]);
                    $val['manufacture_year'] = (strtoupper($rowData[4]) === 'X' ? '' : $rowData[4]);
                    $val['model_lines'] = (strtoupper($rowData[5]) === 'X' ? '' : $rowData[5]);
                    $val['machine_pack'] = (strtoupper($rowData[6]) === 'X' ? '' : $rowData[6]);
                    $val['machine_etc'] = (strtoupper($rowData[7]) === 'X' ? '' : $rowData[7]);
                    $val['machine_detector'] = (strtoupper($rowData[8]) === 'X' ? '' : $rowData[8]);
                    $val['confirmed_at'] = (strtoupper($rowData[9]) === 'X' ? '' : $rowData[9]);
					$val['admin_id'] = 'admin';
					$data[] = $val;
				}
			}
			$this->admin_company_m->insert_bi05_list($data);
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelBI06() {
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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
					$val['channel_cnt'] = (strtoupper($rowData[1]) === 'X' ? '' : $rowData[1]);
                    $val['channel_name'] = (strtoupper($rowData[2]) === 'X' ? '' : $rowData[2]);
                    $val['nb_export_nation'] = (strtoupper($rowData[3]) === 'X' ? '' : $rowData[3]);
                    $val['oem_export_nation'] = (strtoupper($rowData[4]) === 'X' ? '' : $rowData[4]);
                    $val['oem_company'] = (strtoupper($rowData[5]) === 'X' ? '' : $rowData[5]);
                    $val['confirmed_at'] = (strtoupper($rowData[6]) === 'X' ? '' : $rowData[6]);
					$val['admin_id'] = 'admin';
					$data[] = $val;
				}
			}
			$this->admin_company_m->insert_bi06_list($data);
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelBI07() {
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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
                    $val['export_nation'] = (strtoupper($rowData[1]) === 'X' ? '' : $rowData[1]);
                    $val['confirmed_at'] = (strtoupper($rowData[2]) === 'X' ? '' : $rowData[2]);
					$val['admin_id'] = 'admin';
					$data[] = $val;
				}
			}
			$this->admin_company_m->insert_bi07_list($data);
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}





	public function excelOverseasBI01() {
		$req = $this->input->post();

		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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

					$this->admin_company_m->insert_overseas_bi01($req['nation_seq'], $rowData);

				}
			}
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelOverseasNI02() {
		$req = $this->input->post();
		
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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

					$this->admin_company_m->insert_overseas_ni02($req['nation_seq'], $rowData);

				}
			}
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelOverseasEI00() {
		$req = $this->input->post();
		
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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

					$this->admin_company_m->insert_overseas_ei00($req['nation_seq'], $rowData);

				}
			}
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelOverseasMI01() {
		$req = $this->input->post();
		
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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

					$this->admin_company_m->insert_overseas_mi01($req['nation_seq'], $rowData);

				}
			}
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelOverseasPI00() {
		$req = $this->input->post();
		
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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

					$this->admin_company_m->insert_overseas_pi00($req['nation_seq'], $rowData);

				}
			}
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelOverseasPI02() {
		$req = $this->input->post();
		
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

		try {

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$sheetsCount = $objPHPExcel -> getSheetCount();

			for($i = 0; $i < $sheetsCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
	        	$sheet = $objPHPExcel->getActiveSheet();
	
				$highestRow = $sheet->getHighestRow();   			           // 마지막 행
				$highestColumn = $sheet->getHighestColumn();	// 마지막 컬럼


		         // 한줄읽기
				for($row = 1; $row <= $highestRow; $row++) {
		            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
		            $tmp = $sheet->rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
					$rowData = $tmp[0];
					
					if(empty(trim($rowData[0]))) continue;

					$this->admin_company_m->insert_overseas_pi02($req['nation_seq'], $req['product_seq'], $rowData);

				}
			}
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelOverseasEI01() {
		$req = $this->input->post();
		
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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

					$this->admin_company_m->insert_overseas_ei01($req['nation_seq'], $req['product_seq'], $rowData);

				}
			}
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

	public function excelOverseasEI02() {
		$req = $this->input->post();
		
		$data = array();

		$filename = iconv("UTF-8", "EUC-KR", $_FILES['excel']['tmp_name']);

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

					$this->admin_company_m->insert_overseas_ei02($req['nation_seq'], $req['product_seq'], $rowData);

				}
			}
			
		} 
		catch(exception $e) {
			echo $e;
		}		
	}

}