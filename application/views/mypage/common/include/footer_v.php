<script>
function fnLogout(){
	location.href="/admin/login/logout";
}
function fnShowLoad()
{
	$('#loader_wrap').show();
	$('#loader').css('animation', '	spin 2s linear infinite');
}
	
function fnHideLoad()
{
	$('#loader_wrap').hide();
	$('#loader').css('animation', '	unset');
}

</script>
    
<style>
#loader_wrap {
	width:100%;
	height:100%;
	position:fixed;
	top:0;
	left:0;
	background-color:#000;
	opacity:0.7;
	z-index:10000;
	display:none;
}
#loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
	top:50%;
	left:50%;
	margin-left:-60px;
	margin-top:-60px;
	position:absolute;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<div id="loader_wrap">
	<div id="loader">
    </div>
</div>
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
						<li><a href="tel:8221234567">+82 2 123 4567</a></li>
						<li><a href="mailto:admin@foodplanet.com">admin@foodplanet.com</a></li>
						<li>서울특별시 강남구 논현로34길 34, 4층</li>
						<li>Copyright © 2022 FoodPlanet. All Rights Reserved.</li>
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

	<div class="dim"></div>

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
</body>
</html>
