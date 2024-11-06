                <div class="modal inmodal fade" id="statusRequestModal" tabindex="-1" role="dialog"  aria-hidden="true">
	                <div class="modal-dialog modal-lg">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title msg_title">취소사유</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form id="frmStatusRequest" method="post">
                            	<input type="hidden" name="status" value="" />
                                <input type="hidden" name="order_id" value="" />
                                <div class="form-group  row">
                                	<div class="col-sm-1"></div>
                                    <div class="col-sm-10" id="cancelReason">
                                    	<textarea id="reason" name="reason" class="form-control" rows="7" style="resize:none"></textarea>
                                    </div>
                                	<div class="col-sm-1"></div>
                                </div>
                                <div class="form-group  row">
                                	<div class="col-sm-1"></div>
                                    <div class="col-sm-10" style="font-size:14px; color:#F30C10; ">
                                    	* 여러 주문을 선택하셨을 경우 <span class="msg_title">취소사유</span>가 일괄 적용됩니다.
                                    </div>
                                	<div class="col-sm-1"></div>
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                            	<button type="button" class="btn btn-primary" onclick="javascript:fnOrderCancel();" >수정</button>
                            	<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
<script>
function fnOrderCancel()
{
	$.ajax({
       	type:'POST',
    	url:'/order/common/ajaxOrderCancel',
		data : $('#frmStatusRequest').serialize(),
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