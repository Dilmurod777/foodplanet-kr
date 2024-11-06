<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="data-detail board-detail notice"><!-- 공지사항 class="board-list notice" -->
				<div class="inner">
					<div class="detail-area">
						<div class="board-detail-top">
							<div class="bdt-inner">
								<div class="title"><?php echo $info['title']; ?></div>
								<div class="date"><?php echo $info['created_at']; ?></div>
								<a href="#" onclick="javascript:fnUrlCopy('/board/detail/<?php echo $info['notice_seq']; ?>');" class="btn-share"><span>공유<span class="pc-only">하기</span></span></a>
							</div>
						</div>
						<div class="board-inner">
							<div class="borad-contents">
								
								<?php echo $info['contents']; ?>

								<?php
									if(!empty($files)) {
										$size = $files[0]['file_size'];
										if($size >= 1024*1024) {
											$size = round($size / (1024*1024)) . 'mb';
										}
										else if($size >= 1024) {
											$size = round($size / 1024) . 'kb';
										}
										else {
											$size = $size . 'byte';
										}
								?>
								<a class="file-download"  href="/api/common/file_download?file_path=<?php echo $files[0]['new_filepath']; ?>&org_file=<?php echo $files[0]['org_filename']; ?>" target="_blank">
									<span class="title">파일 다운로드</span>
									<span class="cont"><?php echo $files[0]['org_filename']; ?> (<?php echo $size;?>)</span>
								</a>
								<?php
									}
								?>
							</div>
							<div class="dt-paging">
								<?php 
									if(!empty($info['prev_seq'])) {
										echo '<a href="/board/detail/' . $info['prev_seq'] . '" class="btn-prev">이전<span class="pc-only"> 글</span></a>';
									}
								?>
								<a href="<?php echo $info['notice_type'] === 'news' ? '/board/news' : '/board/event'; ?>" class="btn-list">목록으로</a>
								<?php
									if(!empty($info['next_seq'])) {
										echo '<a href="/board/detail/'  . $info['next_seq'] . '" class="btn-next">다음<span class="pc-only"> 글</span></a>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
