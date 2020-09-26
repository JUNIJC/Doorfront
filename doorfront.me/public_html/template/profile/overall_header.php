<?php defined('ROOT') || die() ?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $page_title ?></title>
    <base href="<?= $settings->url ?>">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="template/images/favicon.ico" rel="shortcut icon" />
    <link href="template/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="template/css/custom.css" rel="stylesheet" media="screen">
    <link href="template/css/animate.min.css" rel="stylesheet" media="screen">
    <link href="template/css/fa-svg-with-js.css" rel="stylesheet" media="screen">
    <script defer src="template/js/fontawesome-all.min.js"></script>

    <?php if(!empty($settings->analytics_code)): ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', '<?= $settings->analytics_code ?>', 'auto');
            ga('send', 'pageview');

        </script>
    <?php endif ?>
</head>
