<?php defined('ROOT') || die() ?>

<body style="<?= $profile_body_style ?>">

    <?php if(!$profile_account->pro): ?>
    <div class="d-flex justify-content-center mt-5 mb-3">
        <a href="<?= $settings->url ?>" class="profile-header-title-text"><?= $settings->title ?></a>
    </div>
    <?php endif ?>

    <div class="container my-3 my-md-5">
        <div class="row h-100 profile-two-row mx-2">

            <div class="col-sm-12 col-md-5 h-100 profile-two-image" style="background: url(<?= User::display_image(AVATARS_ROUTE . $profile_account->avatar) ?>);">

            </div>

            <div class="col profile-two-content">

                <div class="my-4">
                    <div class="d-flex justify-content-between">
                        <h3>
                            <?= $profile_account->name ?>

                            <?php if($profile_account->pro): ?>
                                <span data-toggle="tooltip" title="<?= $language->global->verified ?>"><i class="far fa-check-circle profile-verified-badge"></i></span>
                            <?php endif ?>
                        </h3>

                        <?php if(User::logged_in() && $account_user_id == $profile_account->user_id): ?>
                            <div>
                                <a class="nav-link" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h profile-settings-button"></i></a>
                                <div class="dropdown-menu">
                                    <a href="<?= $settings->url . 'profile-settings' ?>" class="dropdown-item"><i class="fa fa-edit"></i> <?= $language->profile->display->edit_profile ?></a>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>

                    <span class="profile-subtitle">
                        <?php if(isset($profile_account->occupations_array)): ?>
                            <?= '<strong>'. implode('</strong>, <strong>', $profile_account->occupations_array) . '</strong>' ?>
                        <?php endif ?>

                        <?php if(!empty($profile_account->location)): ?>
                            <?= (isset($profile_account->occupations_array) ? ' in ' : null) . '<i class="fas fa-location-arrow"></i> <strong>' . $profile_account->location . '</strong>' ?>
                        <?php endif ?>
                    </span>

                </div>

                <?php if(!empty($profile_account->main_link) && $main_link): ?>
                    <a href="<?= User::get_profile_out($profile_account->user_id, 'main_link', $main_link->id) ?>" class="btn btn-block btn-primary border-0 profile-button-addition" rel="nofollow" style="<?= $profile_button_style ?>">
                        <i class="<?= $main_link->icon ?>"></i> <?= $main_link->content ?>
                    </a>
                <?php endif ?>


                <section class="mt-2 mb-5 profile-description-text"><?= nl2br($profile_account->description) ?></section>


                <?php if(isset($profile_account->companies_array) || isset($profile_account->knowledge_array)): ?>
                    <section class="mt-2 mb-5 d-flex justify-content-start profile-companies flex-wrap">

                        <?php if(isset($profile_account->companies_array)): ?>
                            <section class="mr-5">
                                <p class="m-0 profile-companies-title"><?= $language->profile->display->companies ?></p>

                                <?= '<div>' . implode('</div><div>', $profile_account->companies_array) . '</div>' ?>
                            </section>
                        <?php endif ?>

                        <?php if(isset($profile_account->knowledge_array)): ?>
                            <section class="mr-5">
                                <p class="m-0 profile-knowledge-title"><?= $language->profile->display->knowledge ?></p>

                                <?= '<div>' . implode('</div><div>', $profile_account->knowledge_array) . '</div>' ?>
                            </section>
                        <?php endif ?>
                    </section>
                <?php endif ?>

                <section class="mt-3 mb-2 d-flex justify-content-between flex-wrap">

                    <?php foreach($profile_buttons as $key => $button):  ?>
                        <a href="<?= User::get_profile_out($profile_account->user_id, 'social', $key) ?>" data-toggle="tooltip" title="<?= $button->title ?>" class="text-dark mx-2 mt-1"><i class="<?= $button->icon ?> fa-2x"></i></a>
                    <?php endforeach ?>

                </section>
            </div>
        </div>

        <?php if(!$profile_account->pro): ?>
        <div class="d-flex justify-content-center mt-2">
            <?= $settings->profile_ads ?>
        </div>
        <?php endif ?>
    </div>

    <?php if(!$profile_account->pro): ?>
    <div class="profile-sticky-footer">
        <div class="d-flex justify-content-center">
            <span class="text-white profile-sticky-footer-text">⚡️ by <a href="http://codecanyon.net/user/grohsfabian/" class="text-white">phpConnectMe</a></span>
        </div>
    </div>
    <?php endif ?>
</body>
