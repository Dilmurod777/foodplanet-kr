								<ul class="list-title clear">
									<li>유통사명</li>
									<li>표준산업</li>
									<li>국내 / 해외</li>
									<li>주요 제품군</li>
									<li>매출</li>
									<li>신용등급</li>
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
												</dt>
												<dd>
													<dl>
														<dt>표준산업</dt>
														<dd><?php echo !empty($row['industrial_code']) ? $row['industrial_code'] : '&nbsp;'; ?></dd>
													</dl>
													<dl>
														<dt>국내 / 해외</dt>
														<dd><?php echo !empty($row['distribution_type']) ? $row['distribution_type'] : '&nbsp;'; ?></dd>
													</dl>
													<dl>
														<dt>주요 제품군</dt>
														<dd><?php echo $row['main_product']; ?></dd>
													</dl>
													<dl>
														<dt>매출</dt>
														<dd>
															<?php  
																echo number_format(round($row['sales_year'])) . '억';
															?>
														</dd>
													</dl>
													<dl class="pc-only">
														<dt>신용등급</dt>
														<dd><?php echo $row['credit_rating']; ?></dd>
													</dl>
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
			$(this).toggleClass("on");
			$(this).next("dd").slideToggle(300);
		});
	});	
})
</script>