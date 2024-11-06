								<ul class="list-cont">
									<!-- sample 반복 -->
									<?php
										foreach($list as $row) {
									?>
									<li>
										<a href="/overseas/detail/<?php echo $row['nation_seq']; ?>">
											<span class="flags"><img src="<?php echo empty($row['nation_img']) ? '/assets/front/images/icon_noprofile.svg' : '/api/common/img_view?img_path=' . $row['nation_img']; ?>" alt="<?php echo $row['nation_name']; ?> 국기이미지" /></span>
											<span class="flags-cont">
												<span class="title1"><?php echo $row['continent']; ?></span>
												<span class="title2"><?php echo $row['nation_name']; ?></span>
												<span class="items"><?php echo $row['main_export_name'] . (!empty($row['main_exprot_etc']) ? ' (' . $row['main_export_etc'] . ')' : ''); ?></span>
											</span>
										</a>
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