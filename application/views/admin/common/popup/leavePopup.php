                <div class="modal inmodal fade" id="leaveModal" tabindex="-1" role="dialog"  aria-hidden="true">
	                <div class="modal-dialog modal-lg">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title msg_title">탈퇴사유 입력</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form id="frmLeave" method="post">
                            	<input type="hidden" name="user_seq" value="" />
                                <div class="form-group  row">
                                	<div class="col-sm-1"></div>
                                    <div class="col-sm-10" id="cancelReason" style="max-height:600px; overflow:auto">
                                    	<textarea id="reason" name="leave_reason_msg" class="form-control" rows="7" style="resize:none"></textarea>
                                    </div>
                                	<div class="col-sm-1"></div>
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                            	<button type="button" class="btn btn-primary" onclick="javascript:fnMemberLeave();" >탈퇴</button>
                            	<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
<script>
function fnMemberLeave()
{
	if($.trim($('#reason').val()) == '') {
		showAlert('error', '탈퇴사유를 입력해 주세요.');
		return;	
	}
	$.ajax({
       	type:'POST',
    	url:'/admin/member/ajaxMemberLeave',
		data : $('#frmLeave').serialize(),
		dataType:"json",
		success:function(data){
       		if(typeof(data.status) == 'login') {
       			showAlert('error', '로그인이 필요합니다.', function() { location.href = "/login"; });
       		}
       		else if(data.status == 'fail') {
				showAlert('error', data.msg);
       		}
       		else {
           		showAlert('success', data.msg, function() { location.reload(); });
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}
</script>