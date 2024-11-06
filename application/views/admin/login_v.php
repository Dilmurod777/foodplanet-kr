<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FOODPLANET | ADMIN </title>
	<meta name="description" content="">

    <link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/assets/admin/css/animate.css" rel="stylesheet">
    <link href="/assets/admin/css/style.css" rel="stylesheet">
   	<link href="/assets/admin/css/plugins/sweetalert/sweetalert2.min.css" rel="stylesheet">

    <link href="/assets/admin/css/plugins/footable/footable.core.css" rel="stylesheet">
    <link href="/assets/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/assets/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    
    <!-- Mainly scripts -->
    <script src="/assets/admin/js/jquery-3.1.1.min.js"></script>
    <script src="/assets/admin/js/popper.min.js"></script>
    <script src="/assets/admin/js/bootstrap.js"></script>
    <script src="/assets/admin/js/plugins/sweetalert/sweetalert2.all.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
    <script src="/assets/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/assets/admin/js/inspinia.js"></script>

    <script src="/assets/admin/js/plugins/pace/pace.min.js"></script>

	<script src="/assets/admin/js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="/assets/admin/js/plugins/iCheck/icheck.min.js"></script>
</head>

<body class="white-bg" style="background:#fff;">

    <div class="middle-box text-center loginscreen animated fadeInDown" style="max-width:500px; width:600px; padding-top:150px;">
        <div>
            <h3><img src="/assets/front/images/logo_m1.svg" style="width:300px"></h3>
            <div>
                <h1 class="logo-name" style="font-size:60px; letter-spacing:1px;">ADMIN</h1>
            </div>
            <p>Login in. To see it in action.</p>
            <form class="m-t" role="form" >
            	<div class="form-group  row">
	            	<div class="col-sm-8">
		                <div class="form-group">
		                    <input type="text" class="form-control" placeholder="ID" required="" name="adminId">
		                </div>
		                <div class="form-group">
		                    <input type="password" class="form-control" placeholder="Password" required="" name="adminPw">
		                </div>
	            	</div>
	            	<div class="col-sm-4 form-group">
		                <button type="button" class="btn btn-primary block full-width full-height m-b" onclick="javascript:fnLogin(); return false;">Login</button>
	            	</div>
				</div>
            </form>
            <h3>Copyright © 2022 foodplanet. All Rights Reserved.</h3>
        </div>
    </div>
<script>
$(document).ready(function(){
	$("input[type='password']").keypress(function(event){
	     if ( event.which == 13 ) {
	    	 fnLogin();
	         return false;
	     }
	});
});

function fnLogin()
{
	$.ajax({
       	type:'POST',
    	url:'/admin/login/ajaxLoginAction',
		data : {
			adminId : $("input[name=adminId]").val()
			, adminPw : $("input[name=adminPw]").val()
		},
		dataType:"json",
       	success:function(data){
       		if(data.result == 'fail') {
       	   		alert(data.msg);
       		}
       		else {
       			location.href='/admin/dashboard';
       		}
       	},
        error:function(data){
         	alert("오류가 발생하였습니다.");
        }
   });
}
</script>
</body>

</html>
