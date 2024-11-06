                <div class="modal inmodal fade" id="cancelReasonModal2" tabindex="-1" role="dialog"  aria-hidden="true">
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
                                <div class="form-group  row">
                                	<div class="col-sm-1"></div>
                                    <div class="col-sm-10" id="fileList" style="max-height:600px; overflow-y:auto;">
                                    	
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
    $('#cancelReasonModal2').on('show.bs.modal', function(e) {
		var data = $(e.relatedTarget).data('msg');
		data = data.replace(/(\n|\r\n)/g, '<br>').replace(/\'/gi, "\"");
		data = JSON.parse(data);
		console.log(data);
		$('#cancelReason').html(data.reason_msg + '<br>' + data.reason_etc);
		
		var str = '';
		for(var i = 0; i < data.files.length; i++) {
			str += '<div><a class="btn-under" href="/common/img_view?img_path=' + data.files[i].new_filepath + '&img_file=' + data.files[i].new_filename + '" target="_blank">'
				+ '<img src="/common/img_view?img_path=' + data.files[i].new_filepath + '&img_file=' + data.files[i].new_filename + '" style="max-width:100%">'
				+ '</a></div>';	
		}
		$('#fileList').html(str);
	});
});
</script>