<?php defined('ROOT') || die() ?>
<div class="card card-shadow">
    <div class="card-body">
        <h4 class="d-flex justify-content-between">
            <?= $language->admin_user_edit->header ?>

            <?= User::generate_go_back_button('admin/users-management') ?>
        </h4>

        <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="form_token" value="<?= Security::csrf_get_session_token('form_token') ?>" />

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label data-toggle="tooltip" title="<?= $language->profile_settings->input->avatar ?>">
                            <img src="<?= User::display_image(AVATARS_THUMBS_ROUTE . $profile_account->avatar) ?>" class="img-rounded profile-settings-avatar" alt="Avatar" />
                            <input id="avatar-file-input" type="file" name="avatar" class="form-control" style="display:none;"/>
                        </label>
                        <p id="avatar-file-status" style="display: none;"><?= $language->profile_settings->input->avatar_selected ?></p>
                        <p class="text-muted"><?= $language->profile_settings->input->avatar_help ?></p>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" class="form-control clickable border-0 disabled" value="<?= $settings->url . $profile_account->username ?>" onclick="this.select();" />
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_user_edit->input->last_activity ?></label>
                        <input type="text" class="form-control" value="<?= (new \DateTime($profile_account->last_activity))->format('Y-m-d H:i:s') ?>" disabled="true" />
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_user_edit->input->username ?></label>
                        <input type="text" class="form-control" name="username" value="<?= $profile_account->username ?>" />
                    </div>

                </div>
            </div>

            <div class="form-group">
                <label><?= $language->admin_user_edit->input->name ?></label>
                <input type="text" name="name" class="form-control" value="<?= $profile_account->name ?>" />
            </div>

            <div class="form-group">
                <label><?= $language->admin_user_edit->input->email ?></label>
                <input type="text" name="email" class="form-control" value="<?= $profile_account->email ?>" />
            </div>

            <div class="form-group">
                <label><?= $language->admin_user_edit->input->status . ' ( <em>' . $language->admin_user_edit->input->status_help . '</em> )' ?></label>

                <select class="custom-select" name="status">
                    <option value="1" <?php if($profile_account->active == 1) echo 'selected' ?>><?= $language->global->yes ?></option>
                    <option value="0" <?php if($profile_account->active == 0) echo 'selected' ?>><?= $language->global->no ?></option>
                </select>
            </div>

            <div class="form-group">
                <label><?= $language->admin_user_edit->input->pro ?></label>

                <select class="custom-select" name="pro">
                    <option value="1" <?php if($profile_account->pro == 1) echo 'selected' ?>><?= $language->global->yes ?></option>
                    <option value="0" <?php if($profile_account->pro == 0) echo 'selected' ?>><?= $language->global->no ?></option>
                </select>
            </div>

            <hr />
            <h4><?= $language->admin_user_edit->header3 ?></h4>
            <p class="text-muted"><?= $language->admin_user_edit->header3_help ?></p>

            <div class="form-group">
                <label><?= $language->admin_user_edit->input->new_password ?></label>
                <input type="password" name="new_password" class="form-control" />
            </div>

            <div class="form-group">
                <label><?= $language->admin_user_edit->input->repeat_password ?></label>
                <input type="password" name="repeat_password" class="form-control" />
            </div>


            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary"><?= $language->global->submit_button ?></button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
	$('.tooltipz').tooltip();

	$('#avatar-file-input').on('change', function() {
		$('#avatar-file-status').fadeIn('fast');

		$('.tooltipz').tooltip();
	});

	$('#avatar-file-remove').on('click', function() {
		$('#avatar-file-input').replaceWith($('#avatar-file-input').val('').clone(true));
		$('#avatar-file-status').fadeOut('fast');
	});
});
</script>
