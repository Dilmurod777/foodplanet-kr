								<ul class="list-title clear">
									<li>제조사명</li>
									<li>대표 제품군</li>
									<li>OEM 제조</li>
									<li>매출</li>
									<li>신용등급</li>
									<li>인증</li>
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
													<a href="#" onclick="javascript:goDetail('<?php echo $row['biz_no']; ?>'); return false;" class="pc-only"><span class="blind">{제조사}상세</span></a>
												</dt>
												<dd>
													<a href="#" onclick="javascript:goDetail('<?php echo $row['biz_no']; ?>'); return false;" >
														<dl>
															<dt>대표 제품군</dt>
															<dd><?php echo !empty($row['main_group']) ? $row['main_group'] : '&nbsp;'; ?></dd>
														</dl>
														<dl>
															<dt>OEM 제조</dt>
															<dd><?php echo !empty($row['main_oem']) ? $row['main_oem'] : '&nbsp;'; ?></dd>
														</dl>
														<dl>
															<dt>매출</dt>
															<dd>
																<?php  
																	echo !empty($row['sales_year']) ? number_format(round($row['sales_year'])) . '억' : '&nbsp';
																?>
															</dd>
														</dl>
														<dl class="pc-only">
															<dt>신용등급</dt>
															<dd><?php echo !empty($row['credit_rating']) ? $row['credit_rating'] : '&nbsp;'; ?></dd>
														</dl>
														<dl>
															<dt>인증</dt>
															<dd><?php echo $row['certi']; ?></dd>
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

	$(".list-cont .btn-list").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			if(getDevice() === 'mobile') {
				$(this).toggleClass("on");
				$(this).next("dd").slideToggle(300);
			}
		});
	});	

})
</script>
