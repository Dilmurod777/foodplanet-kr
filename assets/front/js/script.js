
var kakao_key = "b6ee50f35cc26d79c1ea19af35d09536";
var bSetLike = false;

function fnCheckPw(str) {
	var chk = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
	if(!chk.test(str)) {
		return false;	
	}
	else {
		return true;
	}
}

function fnCheckEmail(str) {
	var chk = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,5}$/;
	if(!chk.test(str)) {
		return false;	
	}
	else {
		return true;
	}
}

function fnCheckPhone(str) {
//	var chk = /^01([0|1|6|7|8|9])?([0-9]{3,4})?([0-9]{4})$/;
    var chk = /^\d{2,3}-?\d{3,4}-?\d{4}$/;
	if(!chk.test(str) || str.length < 11) {
		return false;	
	}
	else {
		return true;
	}
}

function fnCheckBizno(str) {
        var chk = /^\d{3}-?\d{2}-?\d{5}$/;
        if(!chk.test(str) || str.length < 12) {
            return false;	
        }
        else {
            return true;
        }
    }
    
function commify(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function setCookie(cName, cValue, cDay){
      var expire = new Date();
      expire.setDate(expire.getDate() + cDay);
      cookies = cName + '=' + escape(cValue) + '; path=/ '; // 한글 깨짐을 막기위해 escape(cValue)를 합니다.
      if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
      document.cookie = cookies;
}

function getCookie(cName) {
      cName = cName + '=';
      var cookieData = document.cookie;
      var start = cookieData.indexOf(cName);
      var cValue = '';
      if(start != -1){
        start += cName.length;
        var end = cookieData.indexOf(';', start);
        if(end == -1)end = cookieData.length;
        cValue = cookieData.substring(start, end);
      }
      return unescape(cValue);
}

function deleteCookie(cName) {
    var expire = new Date();
    expire.setDate(expire.getDate() - 1);
	document.cookie = cName + '=; path=/;expires=' + expire.toGMTString() + ';';
}

function fnChkByte(obj, maxByte, byte)
{
    var str = $(obj).val();
    var str_len = str.length;


    var rbyte = 0;
    var rlen = 0;
    var one_char = "";
    var str2 = "";


    for(var i=0; i<str_len; i++)
    {
        one_char = str.charAt(i);
        if(escape(one_char).length > 4) {
            rbyte += 2;                                         //한글2Byte
        }else{
            rbyte++;                                            //영문 등 나머지 1Byte
        }
        if(rbyte <= maxByte){
            rlen = i+1;                                          //return할 문자열 갯수
        }
     }
     if(rbyte > maxByte)
     {
        // alert("한글 "+(maxByte/2)+"자 / 영문 "+maxByte+"자를 초과 입력할 수 없습니다.");
        alert(maxByte + "byte를 초과할 수 없습니다.")
        str2 = str.substr(0,rlen);                                  //문자열 자르기
        $(obj).val(str2);
        document.getElementById(byte).innerText = maxByte;
        fnChkByte(obj, maxByte);
     }
     else
     {
        document.getElementById(byte).innerText = rbyte;
     }
     return rbyte;
}

function fnChkChar(obj, maxLen, byte)
{
    var str = $(obj).val();
    var str_len = str.length;


    var rbyte = 0;
    var rlen = 0;
    var one_char = "";
    var str2 = "";


     if(str_len > maxLen)
     {
        // alert("한글 "+(maxByte/2)+"자 / 영문 "+maxByte+"자를 초과 입력할 수 없습니다.");
        alert(maxLen + "자를 초과할 수 없습니다.")
        str2 = str.substr(0,maxLen);                                  //문자열 자르기
        $(obj).val(str2);
        document.getElementById(byte).innerText = maxLen;
     }
     else
     {
        document.getElementById(byte).innerText = str_len;
     }
     return rbyte;
}

function fnMakeUrl(str)
{
	var link = '';
	if(str.substr(0, 1) == '/') link = str;
	else if(str.substr(0, 7) == 'http://') link = str;
	else if(str.substr(0, 8) == 'https://') link = str;
	else link = 'https://' + str;
	
	return '<a href="' + link + '" target="_blank">' + str + '</a>';
}

function fnMakePhone(value)
{
    if(value == '') return '';
    
	let result = [];
    let restNumber = "";

    // 지역번호와 나머지 번호로 나누기
    if (value.startsWith("02")) {
        // 서울 02 지역번호
        result.push(value.substr(0, 2));
        restNumber = value.substring(2);
    } 
    else if (value.startsWith("1")) {
        // 지역 번호가 없는 경우
        // 1xxx-yyyy
        restNumber = value;
    } 
    else {
        // 나머지 3자리 지역번호
        // 0xx-yyyy-zzzz
        result.push(value.substr(0, 3));
        restNumber = value.substring(3);
    }

    if (restNumber.length === 7) {
        // 7자리만 남았을 때는 xxx-yyyy
        result.push(restNumber.substring(0, 3));
        result.push(restNumber.substring(3));
    } 
    else {
        result.push(restNumber.substring(0, 4));
        result.push(restNumber.substring(4));
    }

    return result.filter((val) => val).join("-");
}

function fnMakeBizno(value)
{
    if(value == '') return '';
    
	let result = [];
    let restNumber = "";

    result.push(value.substr(0, 3));
    restNumber = value.substring(3);
    result.push(restNumber.substring(0, 2));
    result.push(restNumber.substring(2));


    return result.filter((val) => val).join("-");
}

function execDaumPostcode(zip, road) {
	new daum.Postcode({
		shorthand : false,
		oncomplete: function(data) {
        	var roadAddr = ''; // 최종 주소 변수
          	var extraAddr = ''; // 조합형 주소 변수
          	var newAddr = data.roadAddress;

          	roadAddr = data.roadAddress;
          	if(data.bname !== ''){
            	extraAddr += data.bname;
          	}
              // 건물명이 있을 경우 추가한다.
          	if(data.buildingName !== ''){
            	extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
          	}
              // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
          	roadAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			$(zip).val(data.zonecode);
//			$(jibun).val((data.jibunAddress !== '' ? data.jibunAddress : data.autoJibunAddress));
			$(road).val(roadAddr);
			
		}
	}).open('psnm_addr');
}

function execDaumPostcode2(zip, road, func) {
	new daum.Postcode({
		shorthand : false,
		oncomplete: function(data) {
        	var roadAddr = ''; // 최종 주소 변수
          	var extraAddr = ''; // 조합형 주소 변수
          	var newAddr = data.roadAddress;

          	roadAddr = data.roadAddress;
          	if(data.bname !== ''){
            	extraAddr += data.bname;
          	}
              // 건물명이 있을 경우 추가한다.
          	if(data.buildingName !== ''){
            	extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
          	}
              // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
          	roadAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			$(zip).val(data.zonecode);
//			$(jibun).val((data.jibunAddress !== '' ? data.jibunAddress : data.autoJibunAddress));
			$(road).val(roadAddr);
			if(typeof(func) === 'function') {
                func();
            }
		}
	}).open('psnm_addr');
}

function fnPaging(page, callback) {
	var str = '';
	
	if(page.pageNo != page.firstPageNo) {
		str += '<div class="pg_first">'
			+	'	<button type="button" onclick="' + callback + '(' + page.firstPageNo + ');"><span class="blind">처음으로</span></button>'
			+	'</div>';
	}
	if(page.pageNo != page.prevPageNo) {
		str += '<div class="pg_prev">'
			+	'	<button type="button" onclick="' + callback + '(' + page.prevPageNo + ');"><span class="blind">이전으로</span></button>'
			+ 	'</div>';
	}
	str += '<ul>';
	for(var i = page.startPageNo; i <= page.endPageNo; i++) {
		if(i == page.pageNo) {
			str += '<li class="active">' + i + '</li>';
		}
		else {
			str += '<li onclick="javascript:' + callback + '(' + i + ');">' + i + '</i>';
		}
	}
	str += '</ul>';
	if(page.pageNo != page.nextPageNo) {
		str += '<div class="pg_next">'
			+	'	<button type="button" onclick="' + callback + '(' + page.nextPageNo + ');"><span class="blind">처음으로</span></button>'
			+	'</div>';
	}
	if(page.pageNo != page.finalPageNo) {
		str += '<div class="pg_last">'
			+	'	<button type="button" onclick="' + callback + '(' + page.finalPageNo + ');"><span class="blind">이전으로</span></button>'
			+ 	'</div>';
	}
	return str;
}

function nl2br(str){  
    return str.replace(/\n/g, "<br />");  
}

function br2nl(str) {
	return str.replace(/(<br>|<br\/>|<br \/>)/g, '\r\n');
}

function convertHtml(str){
    if(str == null)
        return null;

        //특수문자
    var returnStr = str;
    returnStr = returnStr.replace(/<br>/g,"\n");
    returnStr = returnStr.replace(/&gt;/g,">");
    returnStr = returnStr.replace(/&lt;/g,"<");
    returnStr = returnStr.replace(/&quot;/g,"\"");
    returnStr = returnStr.replace(/&apos;/g,"\'");
    returnStr = returnStr.replace(/&nbsp;/g," ");
    returnStr = returnStr.replace(/&amp;/g, "&");
    returnStr = returnStr.replace(/&lsquo;/g, "\‘");
    returnStr = returnStr.replace(/&rsquo;/g, "\’");

    return returnStr;
}

function fnCopyUrl(url) {
    const $input = document.createElement("input");

    document.body.appendChild($input);
    
    $input.value = location.href + url;
    $input.select();
    
    document.execCommand('copy');
    document.body.removeChild($input);
    showAlert('URL 복사가 완료되었습니다. 원하는 곳에 링크를 붙여넣기하여 공유해 보세요!.');
}

function getDomain() {
	var url = location.href;
    if(url.indexOf("local") > 0) {
    	return "http://localhost:8080";
    } 
    else if(url.indexOf("dev.basket.fund") > 0) {
        return "https://dev.basket.fund";
    } 
    else 
    {
        return "https://basket.fund";
    }
}

function getDevice() {
	var UserAgent = navigator.userAgent;

	if (UserAgent.match(/iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i) != null || UserAgent.match(/LG|SAMSUNG|Samsung/) != null)
	{
		return 'mobile'; // 모바일
	}
	else{
		return 'pc'; // PC
	}
}

function videoEditorTemplate(youtubeId){
    return '<div class="story_movie_wrap">'
    		+ '<iframe src="https://www.youtube.com/embed/' + youtubeId + '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
    		+ '</div>';
}

function youtubeConvertor(url) {
    var ytRegExp = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
    var ytMatch = url.match(ytRegExp);
    if (ytMatch && ytMatch[1].length === 11) {
        return ytMatch[1];
    } else {
        return '';
    }
}

$(document).on('input', '.onlyNumber', function() {
    var str = $(this).val();
    str = str.replace(/\s/gi, "").replace(/[^0-9]/g, "");
    $(this).val(str);
});

$(document).on('input', '.commifyNumber', function() {
    var str = $(this).val();
    str = str.replace(/\s/gi, "").replace(/[^0-9]/g, "");
    $(this).val(commify(str));
});
