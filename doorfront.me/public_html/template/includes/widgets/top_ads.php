<?php defined('ROOT') || die() ?>

<?php if(!empty($settings->top_ads)): ?>
<div class="card my-3">
	<div class="card-body">
		<?= $settings->top_ads ?>
	</div>
</div>
<?php endif ?>
