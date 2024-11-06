<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->
<style>
.img {position:relative;display:block;border-radius:100%;width:42px;height:42px;overflow:hidden;background:url(../../images/no-profile.png) 0 0 no-repeat;background-size:cover;}
.img img {width:100% !important;height: 100% !important;-o-object-fit: cover;object-fit: cover;-o-object-position: center center;object-position: center center;}
</style>
<div class="container">
		<div class="sub-container">
			<div class="data-detail board-detail community"><!-- 커뮤니티 class="board-list community" -->
				<div class="inner">
					<div class="detail-area">
						<div class="board-detail-top">
							<div class="bdt-inner">
								<div class="title"><?php echo $info['title']; ?></div>
								<div class="date"><?php echo $info['created_at']; ?></div>
								<div class="btn-area">
									<div class="btn-writer">
									<?php 
										if(!empty($member) && $member['seq'] === $info['member_seq']) {
									?>
										<a href="/community/edit/<?php echo $info['community_seq']; ?>" class="btn-edit"><span class="blind">수정하기</span></a>
										<a href="#" onclick="javascript:fnDelete(); return false;" class="btn-delete"><span class="blind">삭제하기</span></a>
									<?php
										}
									?>
									</div>
									<a href="#" onclick="javascript:fnCopyUrl('/community/detail/<?php echo $info['community_seq']; ?>');" class="btn-share"><span>공유<span class="pc-only">하기</span></span></a>
								</div>
							</div>
						</div>
						<div class="board-inner">
							<div class="borad-contents">
								<!-- 사용자 BO 등록 컨텐츠 -->
								<?php
									echo nl2br($info['contents']);
								?>
								<!-- //사용자 BO 등록 컨텐츠 -->
								<?php 
									if(!empty($files)) {
								?>
								<a class="file-download"  href="/api/common/file_download?file_path=<?php echo $files[0]['new_filepath']; ?>&org_file=<?php echo $files[0]['org_filename']; ?>">
									<span class="title">파일 다운로드</span>
									<span class="cont"><?php echo $files[0]['org_filename']; ?> (<?php 
																									if($files[0]['file_size'] < 1024) {
																										echo $files[0]['file_size'] . 'Byte';

																									}
																									else if($files[0]['file_size'] < 1024*1024) {
																										echo round($files[0]['file_size'] / 1024) . 'KB';
																									}
																									else {
																										echo round($files[0]['file_size'] / 1024 / 1024) . 'MB';
																									} 
																								?>)</span>
								</a>
								<?php
									}
								?>
							</div>
							<div class="dt-paging">
								<?php
									if(!empty($info['prev_seq'])) {
								?>
									<a href="/community/detail/<?php echo $info['prev_seq']; ?>" class="btn-prev">이전<span class="pc-only"> 글</span></a>
								<?php
									}
								?>
								<a href="/community/list" class="btn-list">목록으로</a>
								<?php
									if(!empty($info['next_seq'])) {
								?>
									<a href="/community/detail/<?php echo $info['next_seq']; ?>" class="btn-next">다음<span class="pc-only"> 글</span></a>
								<?php
									}
								?>
							</div>
							<div class="reply-area">
								<div class="total-count">댓글 <span><?php echo number_format($info['reply_cnt']); ?></span>개</div>
								<dl class="rp-write-box">
									<dt>
										<div class="profile">
										<?php 
											if(empty($member)) {
										?>
											<div class="img"></div>
											<div class="nick">비회원</div>
										<?php
											}
											else {
										?>
											<div class="img">
												<?php 
													if(!empty($member['profile_img'])) {
												?>
													<img src="/api/common/img_view?img_path=<?php echo $member['profile_img']; ?>" alt="<?php echo $member['member_id']; ?> 프로필이미지">
												<?php
													}
												?>
											</div>
											<div class="nick"><?php echo $member['member_id']; ?></div>
										<?php
											}
										?>
										</div>
									</dt>
									<dd>
										<textarea cols="" rows="" placeholder="내용을 입력해주세요." id="contents"></textarea>
										<a href="#" onclick="javascript:fnAddReply('0', $('#contents')); return false;" class="btn-type3 btn-write">댓글 <span>등록</span></a>
									</dd>
								</dl>
								<ul class="reply-list">
								
								</ul>
								<div class="btn-more-box"><a href="#" onclick="javascript:fnGetReply(0); return false;" class="btn-type5">댓글 더보기</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<form id="frmReply">
	<input type="hidden" name="offset" value="0" />
	<input type="hidden" name="parent_seq" value="0" />
	<input type="hidden" name="community_seq" value="<?php echo $info['community_seq']; ?>" />
</form>
<script>
$(document).ready(function() {
	$('#contents').on('focus', function() {
		<?php 
			if(empty($member)) {
		?>
			showAlert('로그인 이후 작성 가능합니다.');
			$(this).blur();
		<?php
			}
		?>
	})

	$(document).on("click", ".btn-my-edit" , function(e){
		$(this).toggleClass("on");
	});

	fnGetReply(0);
})

function fnAddReply(idx, obj) {
	$.ajax({
			url: "/api/community/reply_register",
			type: "POST",
			data: {
					community_seq : '<?php echo $info['community_seq']; ?>', 
					contents : $(obj).val() , 
					parent_seq : idx
				 },
			dataType : 'json',
			async : false,
			success: function(data) {
				showAlert(data.msg);
				if(data.result == 'succ') {
					if(idx == '0') {
						fnGetReply(0, 0);
					}
					else {
						fnGetReply2(idx);
					}
					$(obj).val('');
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function fnUpdateReply(seq) {
	$.ajax({
			url: "/api/community/reply_update",
			type: "POST",
			data: {
					seq : seq, 
					contents : $('#contents_' + seq).val() , 
				 },
			dataType : 'json',
			async : false,
			success: function(data) {
				showAlert(data.msg);
				if(data.result == 'succ') {
					$('#btn_mod_' + data.data.seq).toggleClass('on');
					$('#view_contents_' + data.data.seq).html(data.data.contents);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function fnGetReply(parent, page = '') {
	if(page !== '') $('#frmReply input[name=offset]').val(page);
	$('#frmReply input[name=parent_seq]').val(parent);
	$.ajax({
			url: "/community/reply_list",
			type: "POST",
			data: $('#frmReply').serialize(),
			async : false,
			success: function(data) {
				if($.trim(data) != '') {
					$('.reply-list').html(data);
					var offset = parseInt($('#frmReply input[name=offset]').val());
					offset += 10;
					$('#frmReply input[name=offset]').val(offset);
				}
				else {
					$('.btn-more-box').hide();
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function fnGetReply2(parent) {
	$.ajax({
			url: "/api/community/reply_list",
			type: "POST",
			data: {parent_seq : parent, community_seq : $('#frmReply input[name=community_seq]').val() },
			async : false,
			dataType : 'json',
			success: function(data) {
				console.log(data);

				var mem = '<?php echo !empty($member) ? $member['seq'] : ''; ?>';
				var str = '';
				for(var i = 0; i < data.length; i++) {
					str += '<li class="' + (mem == data[i].member_seq ? 'writer' : '') + '">'
						+	'	<dl>'
						+	'		<dt>'
						+	'			<div class="profile">'
						+	'				<div class="img">' + (data[i].profile_img != '' ? '<img src="/api/common/img_view?img_path=' + data[i].profile_img + '" alt="' + data[i].nickname + ' 프로필이미지">' : '') + '</div>'
						+	'				<div class="nick">' + data[i].nickname + '</div>'
						+	'			</div>'
						+	'			<div class="date">' + data[i].created_at + '</div>'
						+	'		</dt>'
						+	'		<dd>'
						+	'			<div class="rp-contents"  id="view_contents_' + data[i].reply_seq + '">' + data[i].contents + '</div>';
					
					if(mem == data[i].member_seq) {
						str += '			<a href="javascript:;" class="btn-toggle btn-my-edit" id="btn_mod_' + data[i].reply_seq + '">수정</a>'
							+	'			<dl class="rp-write-box rp-edit-box">'
							+	'				<dt>'
							+	'					<div class="profile">'
							+	'						<div class="img"><?php echo !empty($member) && !empty($member['profile_img']) ? '<img src="/api/common/img_view?img_path=' . $member['profile_img'] . '" alt="' . $member['member_id'] . ' 프로필이미지">' : ''; ?></div>'
							+	'						<div class="nick"><?php echo !empty($member) ? $member['member_id'] : ''; ?></div>'
							+	'					</div>'
							+	'				</dt>'
							+	'				<dd>'
							+	'					<textarea id="contents_' + data[i].reply_seq + '" cols="" rows="" placeholder="내용을 입력해주세요.">' + data[i].contents2 + '</textarea>'
							+	'					<a href="#" onclick="javascript:fnUpdateReply(\'' + data[i].reply_seq + '\'); return false;" class="btn-type3 btn-write">수정하기</a>'
							+	'				</dd>'
							+	'			</dl>';
					}
                                                                        
                    str += '		</dd>'
						+	'	</dl>'
						+	'</li>';
				}

				$('#sub_reply_list_' + parent).html(str);
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function fnShowSub(seq, obj) {
	$(obj).toggleClass("on");
	if($(obj).hasClass('on')) {
		fnGetReply2(seq);
		$('#sub_reply_' + seq).show();
	}
	else {
		$('#sub_reply_' + seq).hide();
	}
}

function fnDelete() {
	showConfirm('게시글을 삭제하시겠습니까?' , function() {
		$.ajax({
			url: "/api/community/delete",
			type: "POST",
			data: {seq : '<?php echo $info['community_seq']; ?>' },
			async : false,
			dataType : 'json',
			success: function(data) {
				if(data.result == 'succ') {
					showAlert(data.msg, function() { location.href = '/community/list'; });
				}
				else {
					showAlert(data.msg);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
		});

	})	
}

</script>