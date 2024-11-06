                <div class="modal inmodal fade" id="cancelReasonModal" tabindex="-1" role="dialog"  aria-hidden="true">
	                <div class="modal-dialog modal-lg">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title msg_title">취소사유</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form name="cancelFrm" method="post">
                                <div class="form-group  row">
                                	<div class="col-sm-1"></div>
                                    <div class="col-sm-10" id="cancelReason">
                                    	
                                    </div>
                                	<div class="col-sm-1"></div>
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                            	<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
<script>
$(document).ready(function(e) {
    $('#cancelReasonModal').on('show.bs.modal', function(e) {
		var msg = $(e.relatedTarget).data('msg');
		$('#cancelReason').html(msg);
		$('.msg_title').html($(e.relatedTarget).data('title'));
	});
});
</script>