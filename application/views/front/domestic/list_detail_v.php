								<ul class="list-title clear">
									<li>제조사명</li>
									<li>대표 제품군</li>
									<li>OEM 제조</li>
									<li>매출</li>
									<li>신용등급</li>
									<li>생산규모</li>
									<li>수출 진행 국가</li>
								</ul>
								<ul class="list-cont">
									<!-- sample 반복 -->
									<?php 
										foreach($list as $row) {
									?>
										<li>
											<dl>
												<dt class="btn-list">
													<?php echo $row['company_name']; ?>
													<dl class="mo-only">
														<dt>신용등급</dt>
														<dd><?php echo $row['credit_rating']; ?></dd>
													</dl>
													<a href="#" onclick="javascript:goDetail('<?php echo $row['member_cd']; ?>', '<?php echo $row['biz_no']; ?>'); return false;" class="pc-only"><span class="blind">{제조사}상세</span></a>
												</dt>
												<dd>
													<a href="#" onclick="javascript:goDetail('<?php echo $row['member_cd']; ?>', '<?php echo $row['biz_no']; ?>'); return false;" >
														<dl>
															<dt>대표 제품군</dt>
															<dd><?php echo !empty($row['main_product_name']) ? $row['main_product_name'] : '&nbsp;'; ?></dd>
														</dl>
														<dl>
															<dt>OEM 제조</dt>
															<dd>&nbsp;</dd>
														</dl>
														<dl>
															<dt>매출</dt>
															<dd>
																<?php  
																	if($row['year_sales'] === '미등록') {
																		echo '미등록';
																	}	
																	else if($row['year_sales'] > 100000) {
																		echo number_format(round($row['year_sales']/100000)) . '억';
																	}
																	else if($row['year_sales'] > 10000){
																		echo number_format(round($row['year_sales']/10000)) . '천만';
																	}
																	else if($row['year_sales'] > 1000){
																		echo number_format(round($row['year_sales']/1000)) . '백만';
																	}
																	else if($row['year_sales'] > 100){
																		echo number_format(round($row['year_sales']/100)) . '십만';
																	}
																	else if($row['year_sales'] > 10){
																		echo number_format(round($row['year_sales']/10)) . '만';
																	}
																?>
															</dd>
														</dl>
														<dl class="pc-only">
															<dt>신용등급</dt>
															<dd><?php echo $row['credit_rating']; ?></dd>
														</dl>
														<dl>
															<dt>생산규모</dt>
															<dd><?php echo is_numeric($row['manufacture_year']) ? number_format($row['manufacture_year']) : $row['manufacture_year']; ?></dd>
														</dl>
														<dl>
															<dt>수출 진행 국가</dt>
															<dd><?php echo $row['export_nation']; ?></dd>
														</dl>
													</a>
												</dd>
											</dl>
										</li>
									<?php
										}
									?>
									<!-- //sample 반복 -->
								</ul>
								<div class="paging">
									<?php echo $pagination; ?>
								</div>
<script>
$(document).ready(function() {
	$('#total_rows').html('<?php echo number_format($total_rows); ?>');
})
</script>