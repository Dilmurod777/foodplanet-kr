<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>FAQ 카테고리 관리</h2>
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
		                                    <th class="text-center">카테고리코드</th>
		                                    <th class="text-center">카테고리명</th>
		                                    <th class="text-center">사용여부</th>
		                                    <th class="text-center">등록된FAQ수</th>
		                                    <th class="text-center">등록자</th>
		                                    <th class="text-center">등록일자</th>
		                                    <th class="text-center">수정</th>
		                                    <th class="text-center">삭제</th>
		                                </tr>
        	                        </thead>
            	                    <tbody>
                                    <?php
										if(count($category) > 0) {
											$idx = 1;
											foreach($category as $row) {
									?>
                                                <tr>
													<td class="text-center"><?php echo $idx++; ?></td>
													<td class="text-center">
                                                        <button type="button" class="btn" onclick="javascript:fnChangeOrder('<?php echo $row['sub_code']; ?>','<?php echo $row['order_no']; ?>', 'up');"><i class="fa fa-arrow-up"></i></button>
    	                                               	<button type="button" class="btn" onclick="javascript:fnChangeOrder('<?php echo $row['sub_code']; ?>','<?php echo $row['order_no']; ?>', 'down');"><i class="fa fa-arrow-down"></i></button>
													</td>
													<td class="text-center">
														<a href="/admin/board/faq/<?php echo $row['sub_code']; ?>">
															<?php echo $row['sub_code']; ?>
														</a>
													</td>
													<td class="text-center">
                                                        <a href="/admin/board/faq/<?php echo $row['sub_code']; ?>">
															<?php echo $row['code_name']; ?>
														</a>
													</td>
													<td class="text-center"><?php echo $row['is_use'] === 'y' ? '사용' : '미사용'; ?></td>
                                                    <td class="text-center"><?php echo $row['faq_cnt'] ?></td>
                                                    <td class="text-center"><?php echo $row['updated_by'] ?></td>
                                                    <td class="text-center"><?php echo $row['updated_at'] ?></td>
													<td class="text-center"><button type="button" class="btn btn-primary" onclick="javascript:fnShowUpdate('<?php echo $row['sub_code']; ?>', '<?php echo $row['code_name']; ?>', '<?php echo $row['is_use']; ?>'); return false;">수정</button></td>
													<td class="text-center"><button type="button" class="btn btn-danger" onclick="javascript:fnDelete('<?php echo $row['sub_code']; ?>'); return false;">삭제</button></td>
                                                </tr>
                                    <?php
												$idx++;
											}
										}
										else {
											echo '<tr><td colspan="100%" class="text-center">검색된 카테고리가 없습니다.</td></tr>';	
										}
									?>
                                	</tbody>
                            	</table>
                                								
                        	</div>
                    	</div>
                	</div>
            	</div>
                
                <div class="form-group text-center">
                    <button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnShowRegister(); return false;">카테고리추가</button>
                </div>
                                
        	</div>
        	
        </div>
    </div>

                <div class="modal inmodal fade" id="updateModal" tabindex="-1" role="dialog"  aria-hidden="true">
	                <div class="modal-dialog modal-lg">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title msg_title">카테고리 수정</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form id="frmUpdate" method="post">
                            	<input type="hidden" name="sub_code" value="" />
                                <div class="form-group  row">
                                	<div class="col-sm-2">사용여부</div>
                                    <div class="col-sm-2 check_wrap" >
                                        <input type="radio" class="" value="y" id="is_use1" name="is_use"><label for="is_use1" class="form-label">사용</label>
                                    </div>
                                    <div class="col-sm-2 check_wrap" >
                                        <input type="radio" class="" value="n" id="is_use2" name="is_use"><label for="is_use2" class="form-label">미사용</label>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                	<div class="col-sm-2">카테고리명</div>
                                    <div class="col-sm-10" >
                                        <input type="text" name="code_name" value="" class="form-control" />
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
                                <h4 class="modal-title msg_title">카테고리 등록</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form id="frmRegister" method="post">
                                <div class="form-group  row">
                                    <div class="col-sm-2">카테고리코드</div>
                                    <div class="col-sm-10" >
                                        <input type="text" name="sub_code" value="" class="form-control" />
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                	<div class="col-sm-2">카테고리명</div>
                                    <div class="col-sm-10" >
                                        <input type="text" name="code_name" value="" class="form-control" />
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
function fnShowUpdate(cd, name, use) {
    $('#frmUpdate input[name=sub_code]').val(cd);
    $('#frmUpdate input[name=code_name]').val(name);
    $('#frmUpdate input[name=is_use][value=' + use).prop('checked', true);
    $('#updateModal').modal('show');
}

function fnShowRegister() {
    $('#frmRegister input[name=code_name]').val('');
    $('#registerModal').modal('show');
}

function fnChangeOrder(code, no, dir)
{
	$.ajax({
	   	type:'POST',
	   	url:'/api/board/faq/category/change_order',
		data : {sub_code : code, 
				 dir: dir,
		    	 order_no: no},
		dataType:"json",
       	success:function(data){
       		if(typeof(data.result) == 'login') {
       			showAlert('error', '로그인이 필요합니다.', function() { location.href = "/login"; });
       		}
      		else {
	       		if(data.result == 'fail') {
                    alert(data.msg);
	      		}
	       		else {
	      			location.reload();
//	       		           		showAlert('success', data.result.msg, function() {  });
	       		}
	  		}
	   	},
	    error:function(data){
           	alert("오류가 발생하였습니다.");
	    }
	});
}

function fnDelete(code) {
	$.ajax({
	   	type:'POST',
	   	url:'/api/board/faq/category/delete',
		data : { sub_code : code },
		dataType:"json",
       	success:function(data){
       		if(typeof(data.result) == 'login') {
                location.href = "/admin/login";
       		}
      		else {
	       		if(data.result == 'fail') {
	           		alert(data.msg);
	      		}
	       		else {
                    alert(data.msg);
	      			location.reload();
//	       		           		showAlert('success', data.result.msg, function() {  });
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
	   	url:'/api/board/faq/category/update',
		data : $('#frmUpdate').serialize(),
		dataType:"json",
       	success:function(data){
       		if(typeof(data.result) == 'login') {
                alert(data.msg);
       			location.href = "/admin/login";
       		}
      		else {
	       		if(data.result == 'fail') {
	           		alert(data.msg);
	      		}
	       		else {
	      			location.reload();
//	       		           		showAlert('success', data.result.msg, function() {  });
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
	   	url:'/api/board/faq/category/register',
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