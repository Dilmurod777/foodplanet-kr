                <div class="modal inmodal fade" id="deliveryModal" tabindex="-1" role="dialog"  aria-hidden="true">
	                <div class="modal-dialog modal-lg">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title msg_title">송장번호 입력</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form id="frmDelivery" method="post">
                            	<input type="hidden" name="status" value="" />
                                <div class="form-group  row">
                                	<div class="col-sm-1"></div>
                                    <div class="col-sm-10" id="cancelReason" style="max-height:600px; overflow:auto">
                                    	<table class="footable table table-stripped">
                                        	<colgroup>
                                            	<col style="width:40%">
                                                <col />
                                            </colgroup>
                                            <thead>
                                            	<tr>
                                                	<th>주문번호</th>
                                                    <th>송장번호</th>
                                                </tr>
                                            </thead>
                                            <tbody id="invoice_number">
                                            </tbody>
                                        </table>
                                    </div>
                                	<div class="col-sm-1"></div>
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                            	<button type="button" class="btn btn-primary" onclick="javascript:fnOrderDelivery();" >등록</button>
                            	<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
<script>
function fnOrderDelivery()
{
	$.ajax({
       	type:'POST',
    	url:'/order/common/ajaxOrderDelivery',
		data : $('#frmDelivery').serialize(),
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