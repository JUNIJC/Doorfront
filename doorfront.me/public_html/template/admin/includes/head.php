<?php defined('ROOT') || die() ?>

<head>
	<title><?= $page_title ?></title>
	<base href="<?= $settings->url ?>">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="template/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="template/css/custom.css" rel="stylesheet" media="screen">
    <link href="template/css/fa-svg-with-js.css" rel="stylesheet" media="screen">
	<link href="template/css/animate.min.css" rel="stylesheet" media="screen">
    <link href="template/css/datatables.min.css" rel="stylesheet" media="screen">

	<script src="template/js/jquery-3.2.1.min.js"></script>
	<script src="template/js/popper.min.js"></script>
	<script src="template/js/bootstrap.min.js"></script>
    <script defer src="template/js/fontawesome-all.min.js"></script>
    <script src="template/js/main.js"></script>
	<script src="template/js/functions.js"></script>
    <script src="template/js/datatables.min.js"></script>

    <link href="template/images/favicon.ico" rel="shortcut icon" />

	<script>
	/* Setting a global csrf token from the login for extra protection */
	csrf_dynamic = '<?= Security::csrf_get_session_token('dynamic') ?>';

	$.ajaxSetup({
		headers: {
			'CSRF-Token-dynamic': csrf_dynamic
		}
	});

	</script>
</head>
