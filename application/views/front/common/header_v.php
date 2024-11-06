<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, viewport-fit=cover">

	<?php
		if(!empty($meta)) {
	?>
	<title><?php echo $meta['title']; ?></title>
	<meta name="apple-mobile-web-app-title" content="<?php echo $meta['title']; ?>">
	<meta name=”title” content="<?php echo $meta['title']; ?>" />
	<meta name=”description” content="<?php echo $meta['desc']; ?>" />
    <meta name="keywords" content="<?php echo $meta['keyword']; ?>" />

	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php echo $meta['title'];  ?>">
	<meta property="og:image" content="<?php echo $meta['img']; ?>">
	<meta property="og:url" content="<?php echo $meta['url']; ?>">
	<meta property="og:description" content="<?php echo $meta['desc'];  ?>">
	<?php
		}
	?>

    <link rel="icon" type="image/png" sizes="32x32" href="/assets/front/images/favicon32X32.png" />
    <link rel="icon" type="image/png" sizes="196x196" href="/assets/front/images/favicon196X196.png" />

	<link rel="stylesheet" type="text/css" href="/assets/front/css/swiper.jquery.min.css" />
	<link rel="stylesheet" type="text/css" href="/assets/front/css/common.css?ver=20230622" />

	<script src="/assets/front/js/jquery-3.6.0.min.js"></script>
	<script src="/assets/front/js/swiper-bundle.min.js"></script>
	<script src="/assets/front/js/common.js?ver=2023072502"></script>
	<script src="/assets/front/js/alert.js?ver=2023072501"></script>
	<script src="/assets/front/js/script.js?ver=2023072501"></script>

	<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

</head>
<body>
	<div class="wrap">

