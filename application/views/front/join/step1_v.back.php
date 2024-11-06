<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="join-area step1">
				<div class="inner">
					<h2>회원가입</h2>
					<div class="h2-desc"><span>이용에 있어 회원 타입에 따른 차이가 없습니다. </span>다만 회원 가입 시 입력하는 정보와 <br class="pc-only" />맞춤 제공 정보 등에 차이가 있으니 본인의 기업에 적합한 유형을 반드시 선택해주세요.</div>
					<ul class="join-step clear">
						<li class="on"><div><div>1</div></div><span>TYPE SELECT</span></li>
						<li><div><div>2</div></div><span>BASIC INFO</span></li>
<!--						<li><div><div>3</div></div><span>BASIC INFO</span></li> -->
					</ul>
					<ul class="join-type clear">
						<li>
							<input type="radio" name="chkType" id="chkType1" value="1" />
							<label for="chkType1">
								<dl>
									<dt>제조사</dt>
									<dd>가공식품을 제조하기 위해 연구개발을 <div>중심으로 품질관리와 생산관리를 </div>진행하는 기업을 말합니다.</dd>
								</dl>
							</label>
						</li>
						<li>
							<input type="radio" name="chkType" id="chkType2" value="2" />
							<label for="chkType2">
								<dl>
									<dt>유통사</dt>
									<dd>제조된 가공식품을 생산자에서 소비자, <div>수요자에 도달하기까지 여러 단계에서 </div>교환되고 분배되는 활동을 하는 <div>기업을 말합니다.</div></dd>
								</dl>
							</label>
						</li>
						<li>
							<input type="radio" name="chkType" id="chkType3" value="3" />
							<label for="chkType3">
								<dl>
									<dt>브랜드사</dt>
									<dd>자사 상표권 등의 브랜드를 가지고 <div>있으나, 가공식품을 대량 제조하거나 </div>유통 활동이 불가능한 소규모 기업이나 <div>개인사업자 등의 기업을 말합니다.</div></dd>
								</dl>
							</label>
						</li>
					</ul>
					<div class="btn-area-center">
						<a href="#" onclick="javascript:fnNext(); return false;" id="nextBtn" class="btn-type4 btn-disabled">다음으로</a><!-- class="btn-disabled" 버튼활성화시 삭제 -->
					</div>
				</div>
			</div>
		</div>
	</div>
<form id="frmNext" method="post" action="/join/step2">
    <input type="hidden" name="member_type" />
</form>

<script>
$(document).ready(function() {
    $('input[name=chkType]').on('click', function() {
        $('#nextBtn').removeClass('btn-disabled');
    });
});

function fnNext() {
    if($('input[name=chkType]:checked').val() == 'undefined' || $('input[name=chkType]:checked').val() == '') {
        alert('가입하실 회원종류를 선택해 주세요.');
        return;
    }
    $('#frmNext input[name=member_type]').val($('input[name=chkType]:checked').val());
    $('#frmNext').submit();
}
</script>