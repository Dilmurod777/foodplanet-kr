<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>FAQ 관리 > <?php echo $category_name; ?></h2>
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
		                                    <th class="text-center">FAQ 제목</th>
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
                                                        <button type="button" class="btn" onclick="javascript:fnChangeOrder('<?php echo $row['faq_seq']; ?>','<?php echo $row['order_no']; ?>', 'up');"><i class="fa fa-arrow-up"></i></button>
    	                                               	<button type="button" class="btn" onclick="javascript:fnChangeOrder('<?php echo $row['faq_seq']; ?>','<?php echo $row['order_no']; ?>', 'down');"><i class="fa fa-arrow-down"></i></button>
													</td>
													<td class="text-center"><?php echo $row['title']; ?></td>
                                                    <td class="text-center"><?php echo $row['updated_by'] ?></td>
                                                    <td class="text-center"><?php echo $row['updated_at'] ?></td>
													<td class="text-center"><button type="button" class="btn btn-primary" onclick="javascript:fnShowUpdate('<?php echo $row['faq_seq']; ?>'); return false;">수정</button></td>
													<td class="text-center"><button type="button" class="btn btn-danger" onclick="javascript:fnDelete('<?php echo $row['faq_seq']; ?>'); return false;">삭제</button></td>
                                                </tr>
                                    <?php
												$idx++;
											}
										}
										else {
											echo '<tr><td colspan="100%" class="text-center">검색된 FAQ가 없습니다.</td></tr>';	
										}
									?>
                                	</tbody>
                            	</table>
                                								
                        	</div>
                    	</div>
                	</div>
            	</div>
                
                <div class="form-group text-center">
                    <button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnShowRegister(); return false;">FAQ등록</button>
                    <button type="button" class="btn btn-w-m btn-white" onclick="javascript:location.href='/admin/board/category'; return false;">카테고리 목록으로</button>
                </div>
                                
        	</div>
        	
        </div>
    </div>

                <div class="modal inmodal fade" id="updateModal" tabindex="-1" role="dialog"  aria-hidden="true">
	                <div class="modal-dialog modal-lg" style="max-width:1200px">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title msg_title">FAQ 수정</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form id="frmUpdate" method="post">
                            	<input type="hidden" name="faq_seq" value="" />
                                <div class="form-group  row">
                                	<div class="col-sm-2">카테고리 선택</div>
                                    <div class="col-sm-10 row" >
                                    <?php 
                                        foreach($category as $row) {
                                            echo '<div class="col-lg-4 check_wrap">';
                                            echo '<input type="checkbox" id="cate1_' . $row['sub_code'] . '" value="' . $row['sub_code'] . '" name="category[]" />';
                                            echo '<label for="cate1_' . $row['sub_code'] . '">' . $row['code_name'] . '</label>';
                                            echo '</div>';
                                        }
                                    ?>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                	<div class="col-sm-2">제목</div>
                                    <div class="col-sm-10" >
                                        <input type="text" class="form-control" value="" name="title">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                	<div class="col-sm-2">내용</div>
                                    <div class="col-sm-10" >
                                        <textarea name="contents" class="form-control" rows="15"></textarea>
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
	                <div class="modal-dialog modal-lg" style="max-width:1200px">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title msg_title">FAQ 등록</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form id="frmRegister" method="post">
                               <div class="form-group  row">
                                	<div class="col-sm-2">카테고리 선택</div>
                                    <div class="col-sm-10 row" >
                                    <?php 
                                        foreach($category as $row) {
                                            echo '<div class="col-lg-4 check_wrap">';
                                            echo '<input type="checkbox" id="cate2_' . $row['sub_code'] . '" value="' . $row['sub_code'] . '" name="category[]" />';
                                            echo '<label for="cate2_' . $row['sub_code'] . '">' . $row['code_name'] . '</label>';
                                            echo '</div>';
                                        }
                                    ?>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                	<div class="col-sm-2">제목</div>
                                    <div class="col-sm-10" >
                                        <input type="text" class="form-control" value="" name="title">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                	<div class="col-sm-2">내용</div>
                                    <div class="col-sm-10" >
                                        <textarea name="contents" class="form-control" rows="15"></textarea>
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
function fnShowRegister() {
    $('#frmRegister input[name=title]').val('');
    $('#frmRegister textarea[name=contents]').val('');
    $('#frmRegister input[name="category[]"]').prop('checked', false);
    $('#frmRegister input[name="category[]"][value=<?php echo $selected_category; ?>]').prop('checked', true);
    $('#registerModal').modal('show');
}

function fnShowUpdate(seq) {
	$.ajax({
	   	type:'POST',
	   	url:'/api/board/faq/info',
		data : { faq_seq : seq },
		dataType:"json",
       	success:function(data){
       		if(typeof(data.status) == 'login') {
                location.href = "/admin/login";
       		}
      		else {
	       		if(data.result == 'fail') {
	           		alert(data.msg);
	      		}
	       		else {
                    $('#frmUpdate input[name=faq_seq]').val(data.data.faq_seq);
                    $('#frmUpdate input[name=title]').val(data.data.title);
                    $('#frmUpdate textarea[name=contents]').val(data.data.contents);
                    $('#frmUpdate input[name="category[]"]').prop('checked', false);
                    var category = data.data.category.split(',');
                    for(var i = 0; i < category.length; i++) {
                        $('#frmUpdate input[name="category[]"][value=' + category[i] + ']').prop('checked', true);
                    }
                    $('#updateModal').modal('show');

	       		}
	  		}
	   	},
	    error:function(data){
           	alert("오류가 발생하였습니다.");
	    }
	});

}

function fnChangeOrder(code, no, dir)
{
	$.ajax({
	   	type:'POST',
	   	url:'/api/board/faq/change_order',
		data : {faq_seq : code, 
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

function fnDelete(seq) {
	$.ajax({
	   	type:'POST',
	   	url:'/api/board/faq/delete',
		data : { faq_seq : seq },
		dataType:"json",
       	success:function(data){
       		if(typeof(data.status) == 'login') {
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
	   	url:'/api/board/faq/update',
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
	   	url:'/api/board/faq/register',
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