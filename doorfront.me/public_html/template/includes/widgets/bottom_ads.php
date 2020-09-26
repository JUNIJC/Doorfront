<?php defined('ROOT') || die() ?>

<?php if(!empty($settings->bottom_ads)): ?>
<div class="card my-3">
	<div class="card-body">
		<?= $settings->bottom_ads ?>
	</div>
</div>
<?php endif ?>
