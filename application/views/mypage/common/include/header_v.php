<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, viewport-fit=cover">
	<title>FOODPLANET</title>

	<link rel="stylesheet" type="text/css" href="/assets/front/css/common.css" />

    <link rel="icon" type="image/png" sizes="32x32" href="/assets/front/images/favicon32X32.png" />
    <link rel="icon" type="image/png" sizes="196x196" href="/assets/front/images/favicon196X196.png" />

    <script src="/assets/mypage/js/jquery-3.1.1.min.js"></script>
	<script src="/assets/front/js/common.js"></script>
	<script src="/assets/front/js/alert.js"></script>
	<script src="/assets/front/js/script.js"></script>

    <link href="/assets/mypage/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/mypage/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/assets/mypage/css/animate.css" rel="stylesheet">
    <link href="/assets/mypage/css/style.css" rel="stylesheet">
   	<link href="/assets/mypage/css/plugins/sweetalert/sweetalert2.min.css" rel="stylesheet">

    <link href="/assets/mypage/css/plugins/footable/footable.core.css" rel="stylesheet">
    <link href="/assets/mypage/css/plugins/datapicker/bootstrap-datepicker.css" rel="stylesheet">
    <link href="/assets/mypage/css/plugins/iCheck/custom.css" rel="stylesheet">
	
    <link href="/assets/mypage/css/plugins/jsTree/style.min.css" rel="stylesheet">

<!--    <link href="/assets/css/plugins/summernote/summernote-bs4.css" rel="stylesheet"> -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> 

    <link href="/assets/mypage/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Mainly scripts -->
    <script src="/assets/mypage/js/popper.min.js"></script>
    <script src="/assets/mypage/js/bootstrap.js"></script>
    <script src="/assets/mypage/js/plugins/sweetalert/sweetalert2.all.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
    <script src="/assets/mypage/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/assets/mypage/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/assets/mypage/js/inspinia.js"></script>

    <script src="/assets/mypage/js/plugins/pace/pace.min.js"></script>

	<script src="/assets/mypage/js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="/assets/mypage/js/plugins/datapicker/bootstrap-datepicker.ko.min.js"></script>
	<script src="/assets/mypage/js/plugins/iCheck/icheck.min.js"></script>
    <script src="/assets/mypage/js/plugins/jsTree/jstree.min.js"></script>

<!--	<script src="/assets/js/plugins/summernote/summernote-bs4.js"></script> -->
  	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  	<script src=" https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-ko-KR.min.js"></script>
	<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="/assets/mypage/js/plugins/toastr/toastr.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="wrap" style="padding:0">
<style>
.check_wrap input[type=checkbox] {
    width: 1px;
    height: 1px;
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
}
.check_wrap input[type=checkbox]:checked+label {
    color: #00cfca;
}
.check_wrap label {
    position: relative;
    display: block;
    padding-left: 28px;
    font-size: 14px;
}
.check_wrap input:checked+label:before {
    background: url(/assets/front/images/icon_radio_on.svg) 0 0 no-repeat;
}
.check_wrap label:before {
    content: "";
    position: absolute;
    top: 1px;
    left: 0;
    display: block;
    width: 20px;
    height: 20px;
    background: url(/assets/front/images/icon_radio_off.svg) 0 0 no-repeat;
    background-size: 20px !important;
}
.filebox .upload-title {
    display: inline-block;
    box-sizing: border-box;
    padding-right: 56px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
.file-btn-reset {
    position: absolute;
    top: 50%;
    right: 50px;
    transform: translateY(-50%);
    display: block;
}
</style>

