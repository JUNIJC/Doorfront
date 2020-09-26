<?php
defined('ROOT') || die();

/* Set custom 404 header */
header('HTTP/1.0 404 Not Found');
?>

<div class="card card-shadow">
    <div class="card-body">
        <h5 class="d-flex justify-content-between">
            <?= $language->not_found->content ?>
            <small><?= User::generate_go_back_button('index') ?></small>
        </h5>
    </div>
</div>
