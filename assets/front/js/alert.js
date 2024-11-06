function showAlert(msg, okCallback = null) {
	var d = new Date(2018, 3, 1); // Your date
	var dStart = new Date(1970, 1, 1);
	var dateDifference = ((d.getTime() - dStart.getTime()) * 10000);
	var id = 'alert_' + dateDifference;

	var html = '<div id="' + id + '"><div style="display: block; z-index: 1099;position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5);"></div>'
			+	'<div id="layer-alert" class="layerpop type-center layer-nodata layer-alert" style="display:block">'
            +   '   <div class="layer-container">'
            +   '   	<dl class="nodata">'
            +   '           <dt>' + msg + '</dt>'
            +   '           <dd>'
            +   '               <div class="btn-area">'
            +   '                   <a href="javascript:;" class="btn-type2" id="alert_ok_' + id + '">확인</a>'
            +   '               </div>'
            +   '           </dd>'
            +   '       </dl>'
            +   '       <a href="#" onclick="javascript:closeAlert(\'' + id + '\'); return false;" class="layer-close"><span class="blind">닫기</span></a>'
            +   '   </div>'
            +   '</div></div>';
	
	$('body').append(html);
//	layer_OPEN('#' + id);
	
	$('#alert_ok_' + id).on('click', function() {
	    if(okCallback == null ||  typeof okCallback !== 'function' ) {
	    	closeAlert(id);
	    }
	    else {
	    	closeAlert(id);
			okCallback(id);
		}
		return false;
	});
}

function showConfirm(msg, okCallback = null, cancelCallback = null) {
	var d = new Date(2018, 3, 1); // Your date
	var dStart = new Date(1970, 1, 1);
	var dateDifference = ((d.getTime() - dStart.getTime()) * 10000);
	var id = 'alert_' + dateDifference;

	var html = '<div id="' + id + '"><div style="display: block; z-index: 1099;position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5);"></div>'
			+	'<div id="layer-alert" class="layerpop type-center layer-nodata layer-alert" style="display:block">'
            +   '   <div class="layer-container">'
            +   '   	<dl class="nodata">'
            +   '           <dt>' + msg + '</dt>'
            +   '           <dd>'
            +   '               <div class="btn-area">'
            +   '                   <a href="javascript:;" class="btn-type2 btn-disabled" id="alert_cancel_' + id + '">취소</a>'
            +   '                   <a href="javascript:;" class="btn-type2" id="alert_ok_' + id + '">확인</a>'
            +   '               </div>'
            +   '           </dd>'
            +   '       </dl>'
            +   '       <a href="#" onclick="javascript:closeAlert(\'' + id + '\'); return false;" class="layer-close"><span class="blind">확인</span></a>'
            +   '   </div>'
            +   '</div></div>';
	
	$('body').append(html);
	
	$('#alert_ok_' + id).on('click', function() {
	    if(okCallback == null ||  typeof okCallback !== 'function' ) {
	    	closeAlert(id);
	    }
	    else {
	    	closeAlert(id);
			okCallback(id);
		}
		return false;
	});

	$('#alert_cancel_' + id).on('click', function() {
	    if(cancelCallback == null ||  typeof cancelCallback !== 'function' ) {
	    	closeAlert(id);
	    }
	    else {
			cancelCallback(id);
	    	closeAlert(id);
		}
		return false;
	});
}

function closeAlert(id) {
	$('#' + id).remove();
}

