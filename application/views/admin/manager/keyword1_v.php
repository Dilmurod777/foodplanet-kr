<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>인기키워드TOP10 제품 관리</h2>
                </div>
            </div>

        	<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
                	<div class="col-lg-12">
                    	<div class="ibox ">
                        	<div class="ibox-content">

                            	<table class="footable table table-stripped">
                                	<thead>
                                		<tr>
                                            <th class="text-center">번호</th>
		                                    <th class="text-center">순서변경</th>
		                                    <th class="text-center">키워드</th>
		                                    <th class="text-center">등록자</th>
		                                    <th class="text-center">등록일자</th>
		                                    <th class="text-center">수정</th>
		                                    <th class="text-center">삭제</th>
		                                </tr>
        	                        </thead>
            	                    <tbody>
                                    <?php
										if(count($list) > 0) {
											$idx = 1;
											foreach($list as $row) {
									?>
                                                <tr>
													<td class="text-center"><?php echo $idx++; ?></td>
													<td class="text-center">
                                                        <button type="button" class="btn" onclick="javascript:fnChangeOrder('<?php echo $row['recommend_seq']; ?>','<?php echo $row['order_no']; ?>', 'up');"><i class="fa fa-arrow-up"></i></button>
    	                                               	<button type="button" class="btn" onclick="javascript:fnChangeOrder('<?php echo $row['recommend_seq']; ?>','<?php echo $row['order_no']; ?>', 'down');"><i class="fa fa-arrow-down"></i></button>
													</td>
													<td class="text-center"><?php echo $row['keyword']; ?></td>
                                                    <td class="text-center"><?php echo $row['updated_by'] ?></td>
                                                    <td class="text-center"><?php echo $row['updated_at'] ?></td>
													<td class="text-center"><button type="button" class="btn btn-primary" onclick="javascript:fnShowUpdate('<?php echo $row['recommend_seq']; ?>', '<?php echo $row['keyword']; ?>'); return false;">수정</button></td>
													<td class="text-center"><button type="button" class="btn btn-danger" onclick="javascript:fnDelete('<?php echo $row['recommend_seq']; ?>'); return false;">삭제</button></td>
                                                </tr>
                                    <?php
											}
										}
										else {
											echo '<tr><td colspan="100%" class="text-center">검색된 키워드가 없습니다.</td></tr>';	
										}
									?>
                                	</tbody>
                            	</table>
                                								
                        	</div>
                    	</div>
                	</div>
            	</div>
                
                <div class="form-group text-center">
                    <button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnShowRegister(); return false;">키워드추가</button>
                </div>
                                
        	</div>
        	
        </div>
    </div>

                <div class="modal inmodal fade" id="updateModal" tabindex="-1" role="dialog"  aria-hidden="true">
	                <div class="modal-dialog modal-lg">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title msg_title">검색어 수정</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form id="frmUpdate" method="post">
                            	<input type="hidden" name="recommend_seq" value="" />
                            	<input type="hidden" name="keyword_type" value="2" />
                                <div class="form-group  row">
                                	<div class="col-sm-2">검색어</div>
                                    <div class="col-sm-10" >
                                        <input type="text" name="keyword" value="" class="form-control" />
                                    </div>
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                            	<button type="button" class="btn btn-primary" onclick="javascript:fnUpdate();" >수정</button>
                            	<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal inmodal fade" id="registerModal" tabindex="-1" role="dialog"  aria-hidden="true">
	                <div class="modal-dialog modal-lg">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title msg_title">검색어 등록</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form id="frmRegister" method="post">
							   	<input type="hidden" name="keyword_type" value="2" />
                                <div class="form-group  row">
                                	<div class="col-sm-2">검색어</div>
                                    <div class="col-sm-10" >
                                        <input type="text" name="keyword" value="" class="form-control" />
                                    </div>
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                            	<button type="button" class="btn btn-primary" onclick="javascript:fnRegister();" >등록</button>
                            	<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                
<script>
function fnShowUpdate(cd, name) {
    $('#frmUpdate input[name=recommend_seq]').val(cd);
    $('#frmUpdate input[name=keyword]').val(name);
    $('#updateModal').modal('show');
}

function fnShowRegister() {
	var cnt = <?php echo count($list); ?>;
	if(cnt >= 10) {
		alert('최대 10개까지만 등록가능합니다.');
		return;
	}
    $('#frmRegister input[name=keyword]').val('');
    $('#registerModal').modal('show');
}

function fnChangeOrder(code, no, dir)
{
	$.ajax({
	   	type:'POST',
	   	url:'/api/admin/manager/search10/change_order',
		data : {recommend_seq : code, 
				 dir: dir,
		    	 order_no: no,
				keyword_type : '2'},
		dataType:"json",
       	success:function(data){
			console.log(data);
       		if(data.result == 'login') {
       			alert('로그인이 필요합니다.');
				location.href = "/admin/login";
       		}
      		else {
	       		if(data.result == 'fail') {
                    alert(data.msg);
	      		}
	       		else {
	      			location.reload();
	       		}
	  		}
	   	},
	    error:function(data){
           	alert("오류가 발생하였습니다.");
	    }
	});
}

function fnDelete(code) {
	if(!confirm('추천 검색어를 삭제하시겠습니까?')) {
		return;
	}
	$.ajax({
	   	type:'POST',
	   	url:'/api/admin/manager/search10/delete',
		data : { recommend_seq : code },
		dataType:"json",
       	success:function(data){
       		if(data.result == 'login') {
                location.href = "/admin/login";
       		}
      		else {
	       		if(data.result == 'fail') {
	           		alert(data.msg);
	      		}
	       		else {
                    alert(data.msg);
	      			location.reload();
	       		}
	  		}
	   	},
	    error:function(data){
           	alert("오류가 발생하였습니다.");
	    }
	});
}

function fnUpdate() {
	$.ajax({
	   	type:'POST',
	   	url:'/api/admin/manager/search10/update',
		data : $('#frmUpdate').serialize(),
		dataType:"json",
       	success:function(data){
       		if(data.result == 'login') {
                alert(data.msg);
       			location.href = "/admin/login";
       		}
      		else {
	       		if(data.result == 'fail') {
	           		alert(data.msg);
	      		}
	       		else {
                    alert(data.msg);
	      			location.reload();
	       		}
	  		}
	   	},
	    error:function(data){
           	alert("오류가 발생하였습니다.");
	    }
	});
}

function fnRegister() {
	$.ajax({
	   	type:'POST',
	   	url:'/api/admin/manager/search10/register',
		data : $('#frmRegister').serialize(),
		dataType:"json",
       	success:function(data){
       		if(typeof(data.result) == 'login') {
                alert(data.msg);
       			location.href = "/admin/login";
       		}
      		else {
                alert(data.msg);
	       		if(data.result == 'succ') {
	      			location.reload();
	       		}
	  		}
	   	},
	    error:function(data){
           	alert("오류가 발생하였습니다.");
	    }
	});
}

</script>