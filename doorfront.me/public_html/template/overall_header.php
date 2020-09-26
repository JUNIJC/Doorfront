<?php defined('ROOT') || die() ?>

<!DOCTYPE html>
<html>
	<?php include 'includes/head.php' ?>
	<body <?php if(in_array($page, $dark_pages)) echo 'class="body-bg-dark"' ?>>

		<?php include 'includes/menu.php' ?>

		<div class="container<?php if(in_array($page, $container_fluid_pages)) echo '-fluid' ?> animated fadeIn "><!-- Start Container -->

			<?php display_notifications() ?>

			<?php include 'includes/widgets/top_ads.php' ?>
