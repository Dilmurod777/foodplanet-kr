	<footer class="footer">
		<div class="foot-top">
			<ul class="foot-nav">
				<li><a href="/company/info">회사소개</a></li>
				<li><a href="/company/guide">사용방법</a></li>
				<li><a href="/board/notice">공지사항</a></li>
				<li><a href="/board/faq">문의하기</a></li>
				<li><a href="javascript:;" class="btn-layer" data-link="#layer-terms">이용약관</a></li>
				<li><a href="javascript:;" class="btn-layer" data-link="#layer-privacy">개인정보처리방침</a></li>
			</ul>
		</div>
		<div class="foot-btm">
			<dl>
				<dt>CONTACT US</dt>
				<dd>
					<ul>
						<li><a href="tel:8221234567">+82 2 573 3555</a></li>
						<li><a href="mailto:contact@thefoodplanet.co.kr">support@thefoodplanet.co.kr</a></li>
						<li>서울특별시 강남구 논현로34길 34, 4층</li>
						<li>Copyright © 2022 The JRD. All Rights Reserved.</li>
					</ul>
				</dd>
			</dl>
			<ul class="foot-sns">
				<li><a href="javascript:;"><img src="/assets/front/images/icon_foot_sns1.svg"  alt="인스타그램" /></a></li>
				<li><a href="javascript:;"><img src="/assets/front/images/icon_foot_sns2.svg"  alt="트위터" /></a></li>
				<li><a href="javascript:;"><img src="/assets/front/images/icon_foot_sns3.svg"  alt="페이스북" /></a></li>
			</ul>
		</div>
	</footer>

	<a href="javascript:;" class="quick-top"><img src="/assets/front/images/btn_top.png"  alt="맨위로" /></a>

	<!-- layer dim -->
	<div class="dim"></div>
	
	<!-- layer : 검색 -->
	<div id="layer-search" class="layerpop layer-search scroll-x">
		<div class="layer-inner">
			<div class="layer-title"><a href="0-main.html"><span class="blind">FOODPLANET</span></a></div>
			<div class="layer-container">
				<div class="searchbox">
					<input type="text" value="" placeholder="검색어를 입력해주세요." class="ip-search" onkeypress="javascript:if(event.keyCode == 13) { goSearch($(this).val());  return false; };"  />
					<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg"  alt="검색어삭제" /></button>
				</div>
				<div class="search-items">
					<dl class="recommend">
						<dt>추천 검색어</dt>
						<dd>
						<?php
							$idx = 1;
							if(count($recommend) <= 5) {
								echo '<ul>';
								foreach($recommend as $row) {
									echo '<li>';
									echo '	<a href="#" onclick="javascript:goSearch(\'' . $row['search_text'] . '\'); return false;"><span>' . $idx . '</span>' . $row['search_text'] . '</a>';
									echo '</li>';
									$idx++;
								}
								echo '</ul>';
							}
							else {
								echo '<ul>';
								for($i = 0; $i < 5; $i++) {
									echo '<li>';
									echo '	<a href="javascript:goSearch(\'' . $recommend[$i]['search_text'] . '\'); return false;"><span>' . $idx . '</span>' . $recommend[$i]['search_text'] . '</a>';
									echo '</li>';
									$idx++;
								}
								echo '</ul>';

								echo '<ul>';
								for($i = 5; $i < count($recommend); $i++) {
									echo '<li>';
									echo '	<a href="javascript:goSearch(\'' . $recommend[$i]['search_text'] . '\'); return false;"><span>' . $idx . '</span>' . $recommend[$i]['search_text'] . '</a>';
									echo '</li>';
									$idx++;
								}
								echo '</ul>';
							}
						?>
						</dd>
					</dl>
					<dl class="recently">
						<dt>최근 검색어</dt>
						<dd id="search_text_wrap">
						</dd>
					</dl>
				</div>
				<a href="javascript:;" class="layer-close"><span class="blind">닫기</span></a>
			</div>
		</div>
	</div>

	<!-- layer : 이용약관 -->
	<div id="layer-terms" class="layerpop type-center type-term">
		<div class="layer-container">
			<h3>서비스 약관</h3>
			<div class="layer-cont">
				<div class="term-cont"><strong>제 1 조 (목적)</strong>
					이 약관은 재단법인 ㅇㅇㅇ가 제공하는 서비스의 이용과 관련하여 재단과 회원과의 권리, 의무 및 책임사항, 기타 필요한 사항을 규정함을 목적으로 합니다. 


					<strong>제 2 조 (정의)</strong>
					이 약관에서 사용하는 용어의 정의는 다음과 같습니다. 

					① "서비스"라 함은 구현되는 단말기(PC, TV, 휴대형단말기 등의 각종 유무선 장치를 포함)와 상관없이 회원이 이용할 수 있는 서비스를 의미합니다.

					② "회원"이라 함은 재단의 서비스에 접속하여 이 약관에 동의하고 재단과 이용계약을 체결하여 재단이 제공하는 서비스를 이용하는 고객을 말합니다. 

					③ "아이디(ID)"이라 함은 회원의 식별과 서비스 이용을 위하여 회원이 정하고 재단이 승인하는 문자와 숫자의 조합을 의미합니다. 

					④ "비밀번호"라 함은 회원이 부여받은 아이디(ID)와 일치되는 회원임을 확인하고 비밀보호를 위해 회원 자신이 정한 문자 또는 숫자의 조합을 의미합니다.


					<strong>제 1 조 (목적)</strong>
					이 약관은 재단법인 ㅇㅇㅇ가 제공하는 서비스의 이용과 관련하여 재단과 회원과의 권리, 의무 및 책임사항, 기타 필요한 사항을 규정함을 목적으로 합니다. 


					<strong>제 2 조 (정의)</strong>
					이 약관에서 사용하는 용어의 정의는 다음과 같습니다. 

					① "서비스"라 함은 구현되는 단말기(PC, TV, 휴대형단말기 등의 각종 유무선 장치를 포함)와 상관없이 회원이 이용할 수 있는 서비스를 의미합니다.

					② "회원"이라 함은 재단의 서비스에 접속하여 이 약관에 동의하고 재단과 이용계약을 체결하여 재단이 제공하는 서비스를 이용하는 고객을 말합니다. 

					③ "아이디(ID)"이라 함은 회원의 식별과 서비스 이용을 위하여 회원이 정하고 재단이 승인하는 문자와 숫자의 조합을 의미합니다. 

					④ "비밀번호"라 함은 회원이 부여받은 아이디(ID)와 일치되는 회원임을 확인하고 비밀보호를 위해 회원 자신이 정한 문자 또는 숫자의 조합을 의미합니다.	
				</div>
			</div>
			<a href="javascript:;" class="layer-close"><span class="blind">닫기</span></a>
		</div>
	</div>

	<!-- layer : 개인정보처리방침 -->
	<div id="layer-privacy" class="layerpop type-center type-term">
		<div class="layer-container">
			<h3>개인정보 처리 방침</h3>
			<div class="layer-cont">
				<div class="term-cont">재단법인 ㅇㅇㅇ는 "개인정보보호법", "정보통신망이용촉진및정보보호등에관한법률(이하 "정보통신망법")", "통신비밀보호법", "전기통신사업법" 등 개인정보처리자가 준수하여야 할 관련 법령상의 개인정보 보호 규정을 준수하며, 관련 법령에 의거한 개인정보 처리방침을 정하여 정보주체의 권익 보호에 최선을 다하고 있습니다. 본 개인정보 처리방침은 재단을 통하여 정보주체가 제공하는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며, 개인정보 보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다. 재단은 개인정보 처리방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다. 


					1. 수집하는 개인정보의 항목 및 수집방법 

					가. 수집하는 개인정보 항목 
					1) 엔트리 회원가입을 위해 재단은 다음과 같은 개인정보를 수집합니다. 선택항목의 경우, 입력을 하지 않아도 회원가입이 가능합니다. - 필수항목: 아이디, 비밀번호, 성별 - 선택항목: 이메일 주소, 휴대전화번호 2) 네이버 아이디를 이용해 회원가입 하는 경우, 재단은 다음과 같은 개인정보를 수집합니다. 선택항목의 경우, 입력을 하지 않아도 회원가입이 가능합니다. - 필수항목: 성별, 이메일 주소 - 선택항목: 휴대전화번호 3) 서비스 내 행사의 경품으로 재화 또는 서비스를 제공하는 경우 추가적으로 다음과 같은 개인정보를 수집할 수 있습니다.
				</div>
			</div>
			<a href="javascript:;" class="layer-close"><span class="blind">닫기</span></a>
		</div>
	</div>

	<!-- layer : 로그인 -->
	<div id="layer-login" class="layer-login">
		<div class="login-dim"></div>
		<div class="layer-container">
			<h3>LOGIN</h3>
			<div class="layer-cont">
				<div class="login-cont">
					<div class="logo">
						<div class="pc-only"><img src="/assets/front/images/logo_ori.png" alt="food planet" /></div>
						<div class="mo-only">로그인</div>
					</div>
					<dl class="login-form">
						<dt>ID</dt>
						<dd>
							<input type="text" id="login_member_id" class="ip-id" />
							<div class="error-msg">Please check your ID</div>
						</dd>
						<dt>PASSWORD</dt>
						<dd >
							<input type="password" id="login_member_pw" class="ip-password" onkeypress="javascript:if(event.keyCode == 13) { fnLogin();  return false; };" />
							<div class="error-msg">Please check your PASSWORD</div>
						</dd>
					</dl>
					<div class="login-btm">
						<a href="#" onclick="javascript:fnLogin(); return false;" id="btn_login" class="btn-type2 btn-submit btn-disabled">Submit</a><!-- class="btn-disabled" 버튼활성화시 삭제 -->
						<ul>
							<li><a href="/join/step1">회원가입</a></li>
							<li><a href="#" onclick="javascript:fnShowResetPw(); return false;" class="btn-join btn-find">비밀번호 찾기</a></li>
						</ul>
					</div>
				</div>
			</div>
			<a href="javascript:;" class="btn-close-login"><span class="blind">닫기</span></a>
		</div>
	</div>

	<!-- layer : 비밀번호찾기 -->
	<div id="layer-find" class="layerpop type-center type-find">
		<div class="login-dim"></div>
		<div class="layer-container">
			<div class="layer-cont">
				<div class="login-cont find-cont">
					<dl>
						<dt>비밀번호를 잊으셨나요?</dt>
						<dd>
							<div>가입 시 입력한 이메일 주소를 입력하시면 비밀번호를<br />재설정할 수 있는 링크를 보내드립니다.</div>
							<input type="text" id="find_email" class="ip-email" placeholder="이메일을 입력하세요" />
						</dd>
					</dl>
					<div class="find-btm">
						<a href="#" onclick="javascript:fnResetPw(); return false;" class="btn-type2 btn-submit">Submit</a><!-- class="btn-disabled" 버튼비활성 -->
					</div>
				</div>
			</div>
			<a href="#" onclick="javascript:fnClosePresetPw(); return false;" class="layer-close"><span class="blind">닫기</span></a>
		</div>
	</div>

	<!-- layer : 비밀번호찾기 - 이메일전송완료 -->
	<div id="layer-emailsent" class="layerpop type-center layer-over layer-emailsent">
		<div class="layer-container">
			<dl class="msg-alert">
				<dt>이메일 전송 완료</dt>
				<dd>
					<div class="msg-alert-cont"><span id="send_find_email"></span>으로<br />재설정 링크를 발송하였습니다.</div>
					<a href="/" class="btn-type3">메인으로 이동하기</a>
				</dd>
			</dl>
			<a href="javascript:;" class="layer-close"><span class="blind">닫기</span></a>
		</div>
	</div>

	<!-- layer : 비밀번호찾기 - 회원정보없음 -->
	<div id="layer-nomem" class="layerpop type-center layer-over layer-emailsent">
		<div class="layer-container">
			<dl class="msg-alert">
				<dt>가입된 회원 정보가 없습니다.</dt>
				<dd>
					<div class="msg-alert-cont">입력된 이메일은 회원 정보에 등록되어 있지 않습니다.<br />회원가입 후, 서비스 이용을 부탁드립니다.</div>
					<a href="/join/step1" class="btn-type3">회원가입하러 가기</a>
				</dd>
			</dl>
			<a href="javascript:;" class="layer-close"><span class="blind">닫기</span></a>
		</div>
	</div>

	<!-- layer : 검색결과없음 -->
	<div id="layer-nodata" class="layerpop type-center layer-nodata">
		<div class="layer-container">
			<dl class="nodata">
				<dt>검색 결과가 없습니다.</dt>
				<dd>
					<div>검색어를 변경해보세요.</div>
					<a href="#" onclick="javascript:fnClosePop(); return false;" class="btn-type2">리스트로 돌아가기</a>
				</dd>
			</dl>
			<a href="#" onclick="javascript:fnClosePop(); return false;" class="layer-close"><span class="blind">닫기</span></a>
		</div>
	</div>
	

	<div id="layer-sign" class="layerpop type-center layer-nodata">
		<div class="layer-container">
			<dl class="nodata">
				<dt>로그인 후 이용해주세요.</dt>
				<dd>
					<div>회원만 문의하기 접수가 가능합니다.</div>
					<a href="#" onclick="javascript:fnShowLogin(); return false;" class="btn-type2">로그인 하기</a>
				</dd>
			</dl>
			<a href="javascript:;" class="layer-close"><span class="blind">닫기</span></a>
		</div>
	</div>

</div>
<script>
$(document).ready(function() {
	$('#login_member_id').on('input', function() {
		$(this).parent().removeClass('error');
		if($('#login_member_id').val() != '' && $('#login_member_pw').val() != '') {
			$('#btn_login').removeClass('btn-disabled');
		}
		else {
			$('#btn_login').addClass('btn-disabled');
		}
	});
	$('#login_member_pw').on('input', function() {
		$(this).parent().removeClass('error');
		if($('#login_member_id').val() != '' && $('#login_member_pw').val() != '') {
			$('#btn_login').removeClass('btn-disabled');
		}
		else {
			$('#btn_login').addClass('btn-disabled');
		}
	})

	<?php
		if(!empty($member)) {
			echo 'fnGetSearchText();';
		}
	?>
})

function fnLogin() {
	if($('#btn_login').hasClass('btn-disabled')) {
		return;
	}
	$('#login_member_id').parent().removeClass('error');
	$('#login_member_pw').parent().removeClass('error');
	$.ajax({
			url: "/member/ajaxLogin",
			type: "POST",
			data: { member_id : $('#login_member_id').val(), member_pw : $('#login_member_pw').val() },
			dataType: "JSON",
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					location.reload();
				}
				else {
					if(data.code == 'id') {
						$('#layer-nomem').addClass('is-opened');
					}
					else if(data.code == 'pw') {
						$('#login_member_pw').parent().addClass('error');
					}
					else {
						showAlert(data.msg);
					}
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function goSearch(keyword) {
	$('#frmGoSearch').remove();
	var str = '<form id="frmGoSearch" method="post" action="/search">'
			+ '		<input type="hidden"  name="search_text" value="' + keyword + '"  />'
			+ '</form>';
	$('body').append(str);
	$('#frmGoSearch').submit();
}

function  fnDeleteSearchText(keyword)  {
	$.ajax({
			url: "/api/common/delete_searchtext",
			type: "POST",
			data: { search_text : keyword },
			dataType: "JSON",
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					var str = '';
					var idx = 1;
					if(data.data.length > 0 && data.data.length <= 5) {
						str += '<ul>';
						for(var i = 0; i < data.data.length; i++) {
							str += '<li>'
								+ '		<a href="#" onclick="javascript:goSearch(\'' + data.data[i].search_text + '\'); return false;"><span>' + idx + '</span>' + data.data[i].search_text + '</a>'
								+ '		<a href="#" onclick="javascript:fnDeleteSearchText(\'' + data.data[i].search_text + '\'); return false;" class="delete-item"><span class="blind">검색어 삭제</span></a>'
								+ '</li>';
							idx++;
						}
						str += '</ul>';
					}
					else if(data.data.length > 5){
						str += '<ul>';
						for(var i = 0; i < 5; i++) {
							str += '<li>'
								+ '		<a href="#" onclick="javascript:goSearch(\'' + data.data[i].search_text + '\'); return false;"><span>' + idx + '</span>' + data.data[i].search_text + '</a>'
								+ '		<a href="#" onclick="javascript:fnDeleteSearchText(\'' + data.data[i].search_text + '\'); return false;" class="delete-item"><span class="blind">검색어 삭제</span></a>'
								+ '</li>';
							idx++;
						}
						str += '</ul>';

						str += '<ul>';
						for(var i = 5; i < data.data.length; i++) {
							str += '<li>'
								+ '		<a href="#" onclick="javascript:goSearch(\'' + data.data[i].search_text + '\'); return false;"><span>' + idx + '</span>' + data.data[i].search_text + '</a>'
								+ '		<a href="#" onclick="javascript:fnDeleteSearchText(\'' + data.data[i].search_text + '\'); return false;" class="delete-item"><span class="blind">검색어 삭제</span></a>'
								+ '</li>';
							idx++;
						}
						str += '</ul>';
					}
					$('#search_text_wrap').html(str);
				}
				else {
					showAlert(data.msg);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function  fnGetSearchText()  {
	$.ajax({
			url: "/api/common/get_searchtext",
			type: "POST",
			data: { search_text : '' },
			dataType: "JSON",
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					var str = '';
					var idx = 1;
					if(data.data.length > 0 && data.data.length <= 5) {
						str += '<ul>';
						for(var i = 0; i < data.data.length; i++) {
							str += '<li>'
								+ '		<a href="#" onclick="javascript:goSearch(\'' + data.data[i].search_text + '\'); return false;"><span>' + idx + '</span>' + data.data[i].search_text + '</a>'
								+ '		<a href="#" onclick="javascript:fnDeleteSearchText(\'' + data.data[i].search_text + '\'); return false;" class="delete-item"><span class="blind">검색어 삭제</span></a>'
								+ '</li>';
							idx++;
						}
						str += '</ul>';
					}
					else if(data.data.length > 5){
						str += '<ul>';
						for(var i = 0; i < 5; i++) {
							str += '<li>'
								+ '		<a href="#" onclick="javascript:goSearch(\'' + data.data[i].search_text + '\'); return false;"><span>' + idx + '</span>' + data.data[i].search_text + '</a>'
								+ '		<a href="#" onclick="javascript:fnDeleteSearchText(\'' + data.data[i].search_text + '\'); return false;" class="delete-item"><span class="blind">검색어 삭제</span></a>'
								+ '</li>';
							idx++;
						}
						str += '</ul>';

						str += '<ul>';
						for(var i = 5; i < data.data.length; i++) {
							str += '<li>'
								+ '		<a href="#" onclick="javascript:goSearch(\'' + data.data[i].search_text + '\'); return false;"><span>' + idx + '</span>' + data.data[i].search_text + '</a>'
								+ '		<a href="#" onclick="javascript:fnDeleteSearchText(\'' + data.data[i].search_text + '\'); return false;" class="delete-item"><span class="blind">검색어 삭제</span></a>'
								+ '</li>';
							idx++;
						}
						str += '</ul>';
					}
					$('#search_text_wrap').html(str);
				}
				else {
					showAlert(data.msg);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function fnClosePop() {
	closepop('#layer-nodata');
	$('#layer-nodata').hide();
}

function fnGoQna() {
	<?php 
		if(!empty($member)) {
	?>
			location.href = '/board/qna';
	<?php
		}
		else {
	?>
		$("#layer-sign").addClass("is-opened");
		$("html").addClass("is-opened");
	<?php
		}
	?>
}

<?php
	if(empty($member)) {
?>
function fnShowLogin() {
	closepop('#layer-sign');

	$("html").addClass("open-login");
}

<?php
	}
?>

function fnShowResetPw() {
	$('#find_email').val('');
	$('html').removeClass('open-login');
	$("#layer-find").addClass("is-opened");
	$("html").addClass("is-opened");
}

function fnClosePresetPw() {
	$('html').addClass('open-login');
	$("#layer-find").removeClass("is-opened");
	$("html").removeClass("is-opened");
}

function fnResetPw() {
	if($('#find_email').val() == '') {
		showAlert('이메일을 입력해 주세요.');
		return;
	}
	if(!fnCheckEmail($('#find_email').val())) {
		showAlert('이메일 형식이 올바르지 않습니다.');
		return;
	}

	$.ajax({
		url: "/api/common/find_pw",
		type: "POST",
		data: { 'email' : $('#find_email').val() },
		dataType: "JSON",
		async : false,
		success: function(data) {
			if(data.result == 'succ') {
				$('#send_find_email').html($('#find_email').val());
				$('#layer-find').removeClass('is-opened');
				$('#layer-emailsent').addClass('is-opened');
			}
			else if(data.result == 'exists') {
				$('#layer-find').removeClass('is-opened');
				$('#layer-nomem').addClass('is-opened');
			}
			else {
				showAlert(result.msg);
			}
		},
		error: function(result) {
			showAlert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
		}
	});

}
</script>
</body>
</html>