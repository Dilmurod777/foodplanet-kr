<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>제조사TOP10 관리</h2>
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
		                                    <th class="text-center">로고</th>
		                                    <th class="text-center">업체명</th>
		                                    <th class="text-center">등록자</th>
		                                    <th class="text-center">등록일자</th>
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
													<td class="text-center"><img src="<?php echo $row['logo_img']; ?>" style="max-width:100px; max-height:100px;"></td>
													<td class="text-center"><?php echo $row['company_name']; ?></td>
                                                    <td class="text-center"><?php echo $row['updated_by'] ?></td>
                                                    <td class="text-center"><?php echo $row['updated_at'] ?></td>
													<td class="text-center"><button type="button" class="btn btn-danger" onclick="javascript:fnDelete('<?php echo $row['recommend_seq']; ?>'); return false;">삭제</button></td>
                                                </tr>
                                    <?php
											}
										}
										else {
											echo '<tr><td colspan="100%" class="text-center">검색된 제품이 없습니다.</td></tr>';	
										}
									?>
                                	</tbody>
                            	</table>
                                								
                        	</div>
                    	</div>
                	</div>
            	</div>
                
                <div class="form-group text-center">
                    <button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnShowRegister(); return false;">제조사추가</button>
                </div>
                                
        	</div>
        	
        </div>
    </div>

                <div class="modal inmodal fade" id="registerModal" tabindex="-1" role="dialog"  aria-hidden="true">
					<div class="modal-dialog modal-lg" style="max-width:1200px;">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">제품 선택</h4>
                            </div>
                            <div class="modal-body">
	                       		<form name="frmSearch" class=" form-inline" method="post">
	                       			<input type="hidden" name="offset" value="0" />
	                       			<input type="hidden" name="perpage" value="10" />
	                        		<div class="form-group">
		                            	<input type="text" class="form-control" name="keyword" placeholder="Search">
		                            </div>
	                        		<div class="form-group">
		                            	<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:goPage(0); return false;">검색</button>
		                            </div>
                        		</form>

                            	<table class="footable table table-stripped" id="productList" style="margin-top:15px">
                                	<thead>
                                		<tr>
		                                    <th class="text-center">no</th>
		                                    <th class="text-center">로고</th>
		                                    <th>제조사명</th>
		                                    <th class="text-center">선택</th>
		                                </tr>
        	                        </thead>
            	                    <tbody>
                                	</tbody>
                                	<tfoot>
                                		<tr>
											<td colspan="100%" class="footable-visible" id="product_pagination">
                                    		</td>
                                		</tr>
                                	</tfoot>
                            	</table>

                            </div>

                            <div class="modal-footer">
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
    $('#frmSearch select[name=product_type]').val('1');
    $('#frmSearch input[name=keyword]').val('');
    $('#registerModal').modal('show');
	goPage(0);
}

function fnChangeOrder(code, no, dir)
{
	$.ajax({
	   	type:'POST',
	   	url:'/api/admin/manager/manufacture10/change_order',
		data : {recommend_seq : code, 
				 dir: dir,
		    	 order_no: no,
				keyword_type : '1'},
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
	if(!confirm('추천 제품을 삭제하시겠습니까?')) {
		return;
	}
	$.ajax({
	   	type:'POST',
	   	url:'/api/admin/manager/manufacture10/delete',
		data : { recommend_seq : code },
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
	       		}
	  		}
	   	},
	    error:function(data){
           	alert("오류가 발생하였습니다.");
	    }
	});
}

function fnRegister(seq) {
	$.ajax({
	   	type:'POST',
	   	url:'/api/admin/manager/manufacture10/register',
		data : {biz_no : seq},
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

function goPage(page) {
	$('form[name=frmSearch] input[name=offset]').val(page);
		
	$.ajax({
       	type:'POST',
    	url:'/api/admin/domestic/companym/list',
		data : $('form[name=frmSearch]').serialize(),
		dataType:"json",
       	success:function(data){
       		var product = data.list;

       		var table = '';
       		var page = '';
       		if(product.length <= 0) {
       			table += '<tr><td colspan="100%" class="text-center">정보가 없습니다.</td></tr>';
       		}
       		else {
       			for(var i = 0; i < product.length; i++) {
	       			table += '<tr>'
       					+ ' <td class="text-center">' + (data.total_rows - i - parseInt(data.req.offset)) + '</td>'
       					+ ' <td class="text-center"><img src="' + product[i].logo_img + '" style="max-width:100px; max-height:100px;"></td>'
       					+ ' <td>' + product[i].company_name + '</td>'
       					+ ' <td class="text-center"><button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnRegister(\'' + product[i].biz_no + '\'); return false;">선택</button></td>'
       					+ '</tr>';
       			}

       		}
       		$('#productList tbody').html(table);
       		$('#product_pagination').html(data.pagination);

       	},
        error:function(data){
         	alert("오류가 발생하였습니다.");
        }
   });
}	

</script>