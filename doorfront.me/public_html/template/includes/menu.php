<?php defined('ROOT') || die() ?>

<?php if(User::logged_in() && $account->type > 0): ?>

    <nav class="navbar navbar-expand-lg navbar-small-admin-menu navbar-admin-menu-dark">
        <div class="container">

            <a class="navbar-brand navbar-small-admin-brand" href="admin"><?= $language->global->menu->admin ?></a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav navbar-small-admin-nav">

                    <li class="nav-item"><a class="nav-link" href="admin/users-management"><?= $language->admin_users_management->menu ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="admin/pages-management"><?= $language->admin_pages_management->menu ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="admin/payments-list"><?= $language->admin_payments_list->menu ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="admin/website-settings"><?= $language->admin_website_settings->menu ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="admin/extra-settings"><?= $language->admin_extra_settings->menu ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="admin/website-statistics"><?= $language->admin_website_statistics->menu ?></a></li>

                </ul>
            </div>

        </div>
    </nav>

<?php endif ?>

<nav class="navbar navbar-main navbar-expand-lg navbar-light bg-white">
	<div class="container">
		<a class="navbar-brand" href="<?= $settings->url ?>">
            <?php if($settings->logo != ''): ?>
                <img src="<?= $settings->url . UPLOADS_ROUTE . 'logo/' . $settings->logo ?>" class="img-fluid" style="max-height: 2em;" />
            <?php else: ?>
                <?= $settings->title ?>
            <?php endif ?>
        </a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
			<ul class="navbar-nav ">
                <?php
                $top_menu_result = $database->query("SELECT `url`, `title` FROM `pages` WHERE `position` = '1'");

                while($top_menu = $top_menu_result->fetch_object()):

                    $link_internal = true;
                    if(strpos($top_menu->url, 'http://') !== false || strpos($top_menu->url, 'https://') !== false) {
                        $link_url = $top_menu->url;
                        $link_internal = false;
                    } else {
                        $link_url = $settings->url . 'page/' . $top_menu->url;
                    }

                    ?>
                    <li class="nav-item"><a class="nav-link" href="<?= $link_url ?>" <?= $link_internal ? null : 'target="_blank"' ?>><?= $top_menu->title ?></a></li>
                <?php endwhile ?>

				<?php if(!User::logged_in()): ?>

				<li class="nav-item active"><a class="nav-link" href="login"><i class="fa fa-sign-in-alt"></i> <?= $language->login->menu ?></a></a></li>
				<li class="nav-item active"><a class="nav-link" href="register"><i class="fa fa-plus"></i> <?= $language->register->menu ?></a></li>

				<?php else: ?>
					<li class="nav-item"><a class="nav-link" href="dashboard"> <?= $language->dashboard->menu ?></a></a></li>

					<li class="dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false"><img src="<?= User::display_image(AVATARS_THUMBS_ROUTE . $account->avatar) ?>" class="img-circle navbar-avatar-image"> <?= $account->username ?> <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="store"><i class="fa fa-credit-card"></i> <?= $language->store->menu ?></a>
						<a class="dropdown-item" href="profile-settings"><i class="fa fa-sliders-h"></i> <?= $language->profile_settings->menu ?></a>
						<a class="dropdown-item" href="account-settings"><i class="fa fa-wrench"></i> <?= $language->account_settings->menu ?></a>
						<a class="dropdown-item" href="<?= $settings->url . $account->username ?>" target="_blank"><i class="fa fa-user"></i> <?= $language->global->menu->my_profile ?></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="logout"><i class="fa fa-sign-out-alt"></i> <?= $language->global->menu->logout ?></a>
					</div>
				</li>

				<?php endif ?>

			</ul>
		</div>
	</div>
</nav>
