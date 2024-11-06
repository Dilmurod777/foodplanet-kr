                                <?php 
									foreach($list as $row) {
								?>
									<li class="<?php echo !empty($member) && $member['seq'] === $row['member_seq'] ? 'writer' : ''; ?>">
										<dl>
											<dt>
												<div class="profile">
													<div class="img">
														<?php 
															if(!empty($row['profile_img'])) {
														?>
															<img src="/api/common/img_view?img_path=<?php echo $row['profile_img'] ; ?>" alt="<?php echo $row['nickname']; ?> 프로필이미지">
														<?php
															}
														?>
													</div>
													<div class="nick"><?php echo $row['nickname']; ?></div>
												</div>
												<div class="date"><?php echo $row['created_at']; ?></div>
											</dt>
											<dd>
												<div class="rp-contents" id="view_contents_<?php echo $row['reply_seq']; ?>">
													<?php echo nl2br($row['contents']); ?>
												</div>
                                                <?php
                                                    if($row['reply_cnt'] > 0) {
                                                ?>
                                                    <a href="#" onclick="javascript:fnShowSub('<?php echo $row['reply_seq']; ?>', this); return false;" class="btn-toggle btn-reply">답글 <span><?php echo $row['reply_cnt']; ?>개</span></a>
                                                <?php
                                                    }
                                                    else {
                                                ?>
                                                    <a href="#"  onclick="javascript:fnShowSub('<?php echo $row['reply_seq']; ?>', this); return false;" class="btn-toggle btn-reply">답글 <span>달기</span></a>
                                                <?php
                                                    }
                                                ?>

												<!-- 내가 쓴 댓글에서만 노출 -->
												<?php 
													if(!empty($member) && $member['seq'] === $row['member_seq']) {
												?>

													<a href="javascript:;" class="btn-toggle btn-my-edit" id="btn_mod_<?php echo $row['reply_seq']; ?>">수정</a>
													<dl class="rp-write-box rp-edit-box">
														<dt>
															<div class="profile">
																<div class="img">
																<?php 
																	if(!empty($row['profile_img'])) {
																?>
																	<img src="/api/common/img_view?img_path=<?php echo $row['profile_img'] ; ?>" alt="<?php echo $row['nickname']; ?> 프로필이미지">
																<?php
																	}
																?>
																</div>
																<div class="nick"><?php echo $row['nickname']; ?></div>
															</div>
														</dt>
														<dd>
															<textarea cols="" rows="" id="contents_<?php echo $row['reply_seq']; ?>" placeholder="내용을 입력해주세요."><?php echo $row['contents2']; ?></textarea>
															<a href="#" onclick="javascript:fnUpdateReply('<?php echo $row['reply_seq']; ?>'); return false;" class="btn-type3 btn-write">수정하기</a>
														</dd>
													</dl>
                                                <?php
    	    										}
	    	    								?>

													<!-- //내가 쓴 댓글에서만 노출 -->
                                                    <div class="re-reply-area" id="sub_reply_<?php echo $row['reply_seq']; ?>">
                                                        <ul class="re-reply-list" id="sub_reply_list_<?php echo $row['reply_seq']; ?>" >
                                                        </ul>
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
                                                                            <img src="/api/common/img_view?img_path=<?php echo $member['profile_img']; ?>" alt="<?php echo $member['nickname']; ?> 프로필이미지">
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
                                                                <textarea id="contents_sub_<?php echo $row['reply_seq']; ?>" cols="" rows="" placeholder="내용을 입력해주세요."></textarea>
                                                                <a href="#" onclick="javascript:fnAddReply('<?php echo $row['reply_seq']; ?>', $('#contents_sub_<?php echo $row['reply_seq']; ?>')); return false;" class="btn-type3 btn-write">답글 달기</a>
                                                            </dd>
                                                        </dl>
												    </div>

											</dd>
										</dl>
									</li>
								<?php
									}
								?>