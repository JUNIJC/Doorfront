<?php defined('ROOT') || die() ?>

<head>
	<title><?= $page_title ?></title>
	<base href="<?= $settings->url ?>">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="template/images/favicon.ico" rel="shortcut icon" />
	<?php
	if(!empty($settings->meta_description))
		echo '<meta name="description" content="' . $settings->meta_description . '" />';
	?>

    <?php
    if(!empty($settings->keywords))
        echo '<meta name="keywords" content="' . $settings->keywords . '" />';
    ?>

	<link href="template/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="template/css/custom.css" rel="stylesheet" media="screen">
	<link href="template/css/fa-svg-with-js.css" rel="stylesheet" media="screen">
	<link href="template/css/animate.min.css" rel="stylesheet" media="screen">

	<script src="template/js/jquery-3.2.1.min.js"></script>
	<script src="template/js/popper.min.js"></script>
	<script src="template/js/bootstrap.min.js"></script>
    <script src="template/js/main.js"></script>
	<script src="template/js/functions.js"></script>
    <script defer src="template/js/fontawesome-all.min.js"></script>

    <?php if(!empty($settings->analytics_code)): ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $settings->analytics_code ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?= $settings->analytics_code ?>');
        </script>
    <?php endif ?>

	<?php if($settings->recaptcha): ?>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	<?php endif ?>

	<?php if(User::logged_in()): ?>
		<script>
			csrf_dynamic = '<?= Security::csrf_get_session_token('dynamic') ?>';

			$.ajaxSetup({
				headers: {
					'CSRF-Token-dynamic': csrf_dynamic
				}
			});
		</script>
	<?php endif ?>
</head>
