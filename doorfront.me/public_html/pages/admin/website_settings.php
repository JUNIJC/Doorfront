<?php
defined('ROOT') || die();
User::check_permission(1);

$method     = (isset($parameters[0]) && $parameters[0] == 'remove-logo') ? $parameters[0] : false;
$url_token 	= (isset($parameters[1])) ? $parameters[1] : false;

if($method && $url_token && Security::csrf_check_session_token('url_token', $url_token)) {

    /* Delete the current log */
    unlink(ROOT . UPLOADS_ROUTE . 'logo/' . $settings->logo);

    /* Remove it from db */
    $database->query("UPDATE `settings` SET `logo` = '' WHERE `id` = 1");

    /* Set message & Redirect */
    $_SESSION['success'][] = $language->global->success_message->basic;
    redirect('admin/website-settings');
}

if(!empty($_POST)) {
	/* Define some variables */
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    $logo = (!empty($_FILES['logo']['name']));
    $logo_name = $logo ? '' : $settings->logo;

	$_POST['title']				 		= filter_var($_POST['title'], FILTER_SANITIZE_STRING);
	$_POST['meta_description']	 		= filter_var($_POST['meta_description'], FILTER_SANITIZE_STRING);
    $_POST['keywords']	 		        = filter_var($_POST['keywords'], FILTER_SANITIZE_STRING);
	$_POST['time_zone']					= filter_var($_POST['time_zone'], FILTER_SANITIZE_STRING);
	$_POST['email_confirmation']	 	= (int) ($_POST['email_confirmation'] == 1) ? 1 : 0;
    $_POST['email_pro_due_date']	 	= (int) $_POST['email_pro_due_date'];
    $_POST['avatar_max_size']	 		= (int) $_POST['avatar_max_size'];
    $_POST['profile_hit_timing']	    = (int) $_POST['profile_hit_timing'];
    $_POST['profile_settings_autosave']	= (int) $_POST['profile_settings_autosave'];

	$_POST['store_paypal_client_id']	= filter_var($_POST['store_paypal_client_id'], FILTER_SANITIZE_STRING);
	$_POST['store_paypal_secret'] 		= filter_var($_POST['store_paypal_secret'], FILTER_SANITIZE_STRING);
	$_POST['store_currency']		 	= filter_var($_POST['store_currency'], FILTER_SANITIZE_STRING);

	$_POST['public_key']				= filter_var($_POST['public_key'], FILTER_SANITIZE_STRING);
	$_POST['private_key']				= filter_var($_POST['private_key'], FILTER_SANITIZE_STRING);
	$_POST['facebook_app_id']			= filter_var($_POST['facebook_app_id'], FILTER_SANITIZE_STRING);
	$_POST['facebook_app_secret']		= filter_var($_POST['facebook_app_secret'], FILTER_SANITIZE_STRING);
    $_POST['instagram_client_id']		= filter_var($_POST['instagram_client_id'], FILTER_SANITIZE_STRING);
    $_POST['instagram_client_secret']	= filter_var($_POST['instagram_client_secret'], FILTER_SANITIZE_STRING);
	$_POST['analytics_code']	 		= filter_var($_POST['analytics_code'], FILTER_SANITIZE_STRING);

	$_POST['facebook']					= filter_var($_POST['facebook'], FILTER_SANITIZE_STRING);
	$_POST['twitter']					= filter_var($_POST['twitter'], FILTER_SANITIZE_STRING);
	$_POST['instagram']				    = filter_var($_POST['instagram'], FILTER_SANITIZE_STRING);
    $_POST['youtube']				    = filter_var($_POST['youtube'], FILTER_SANITIZE_STRING);

    $_POST['smtp_from']				    = filter_var($_POST['smtp_from'], FILTER_SANITIZE_STRING);
    $_POST['smtp_host']					= filter_var($_POST['smtp_host'], FILTER_SANITIZE_STRING);
    $_POST['smtp_port']					= (int) $_POST['smtp_port'];
    $_POST['smtp_encryption']			= filter_var($_POST['smtp_encryption'], FILTER_SANITIZE_STRING);
    $_POST['smtp_user']					= filter_var($_POST['smtp_user'] ?? '', FILTER_SANITIZE_STRING) ;
    $_POST['smtp_pass']                 = $_POST['smtp_pass'] ?? '';
    $_POST['smtp_auth']	 	            = (isset($_POST['smtp_auth'])) ? '1' : '0';

    /* Check for any errors on the logo image */
    if ($logo) {
        $logo_file_name = $_FILES['logo']['name'];
        $logo_file_extension = explode('.', $logo_file_name);
        $logo_file_extension = strtolower(end($logo_file_extension));
        $logo_file_temp = $_FILES['logo']['tmp_name'];
        $logo_file_size = $_FILES['logo']['size'];
        list($logo_width, $logo_height) = getimagesize($logo_file_temp);

        if(!in_array($logo_file_extension, $allowed_extensions)) {
            $_SESSION['error'][] = $language->global->error_message->invalid_file_type;
        }

        if(!is_writable(ROOT . UPLOADS_ROUTE . 'logo/')) {
            $_SESSION['error'][] = sprintf($language->global->error_message->directory_not_writeable, ROOT . UPLOADS_ROUTE . 'logo/');
        }

        if(empty($_SESSION['error'])) {

            /* Delete current logo */
            unlink(ROOT . UPLOADS_ROUTE . 'logo/' . $settings->logo);

            /* Generate new name for logo */
            $logo_new_name = md5(time() . rand()) . '.' . $logo_file_extension;

            /* Upload the original */
            move_uploaded_file($logo_file_temp, ROOT . UPLOADS_ROUTE . 'logo/' . $logo_new_name);

            /* Execute query */
            $database->query("UPDATE `settings` SET `logo` = '{$logo_new_name}' WHERE `id` = 1");

        }
    }

    if(!Security::csrf_check_session_token('form_token', $_POST['form_token'])) {
        $_SESSION['error'][] = $language->global->error_message->invalid_token;
    }

    if(empty($_SESSION['error'])) {
        /* Prepare the statement and execute query */
        $stmt = $database->prepare("
            UPDATE
                `settings`
            SET
                `title` = ?,
                `default_language` = ?,
                `meta_description` = ?,
                `keywords` = ?,
                `time_zone` = ?,
                `email_confirmation` = ?,
                `avatar_max_size` = ?,
    
                `store_paypal_client_id` = ?,
                `store_paypal_secret` = ?,
                `store_paypal_mode` = ?,
                `store_stripe_publishable_key` = ?,
                `store_stripe_secret_key` = ?,
    
                `store_currency` = ?,
                `store_pro_price_month` = TRUNCATE(?, 2),
                `store_pro_price_year` = TRUNCATE(?, 2),
                `email_pro_due_date` = ?,
    
                `top_ads` = ?,
                `bottom_ads` = ?,
                `profile_ads` = ?,
    
                `recaptcha` = ?,
                `public_key` = ?,
                `private_key` = ?,
                `facebook_login` = ?,
                `facebook_app_id` = ?,
                `facebook_app_secret` = ?,
                `instagram_login` = ?,
                `instagram_client_id` = ?,
                `instagram_client_secret` = ?,
                `analytics_code` = ?,
    
                `facebook` = ?,
                `twitter` = ?,
                `youtube` = ?,
                `instagram` = ?,
    
                `smtp_host` = ?,
                `smtp_port` = ?,
                `smtp_encryption` = ?,
                `smtp_auth` = ?,
                `smtp_user` = ?,
                `smtp_pass` = ?,
                `smtp_from` = ?,
                
                `profile_hit_timing` = ?,
                `profile_settings_autosave` = ?
    
            WHERE `id` = 1
        ");
        $stmt->bind_param('ssssssssssssssssssssssssssssssssssssssssss',
            $_POST['title'],
            $_POST['default_language'],
            $_POST['meta_description'],
            $_POST['keywords'],
            $_POST['time_zone'],
            $_POST['email_confirmation'],
            $_POST['avatar_max_size'],
            $_POST['store_paypal_client_id'],
            $_POST['store_paypal_secret'],
            $_POST['store_paypal_mode'],
            $_POST['store_stripe_publishable_key'],
            $_POST['store_stripe_secret_key'],
            $_POST['store_currency'],
            $_POST['store_pro_price_month'],
            $_POST['store_pro_price_year'],
            $_POST['email_pro_due_date'],
            $_POST['top_ads'],
            $_POST['bottom_ads'],
            $_POST['profile_ads'],
            $_POST['recaptcha'],
            $_POST['public_key'],
            $_POST['private_key'],
            $_POST['facebook_login'],
            $_POST['facebook_app_id'],
            $_POST['facebook_app_secret'],
            $_POST['instagram_login'],
            $_POST['instagram_client_id'],
            $_POST['instagram_client_secret'],
            $_POST['analytics_code'],
            $_POST['facebook'],
            $_POST['twitter'],
            $_POST['youtube'],
            $_POST['instagram'],
            $_POST['smtp_host'],
            $_POST['smtp_port'],
            $_POST['smtp_encryption'],
            $_POST['smtp_auth'],
            $_POST['smtp_user'],
            $_POST['smtp_pass'],
            $_POST['smtp_from'],
            $_POST['profile_hit_timing'],
            $_POST['profile_settings_autosave']
        );
        $stmt->execute();
        $stmt->close();

        /* Refresh data */
        $settings = $database->query("SELECT * FROM `settings` WHERE `id` = 1")->fetch_object();

        /* Set message */
        $_SESSION['success'][] = $language->global->success_message->basic;

        display_notifications();
    }

}

?>
<div class="card card-shadow">
    <div class="card-body">

        <h4><?= $language->admin_website_settings->header ?></h4>

        <ul class="nav nav-pills nav-fill mt-2 mb-3" role="tablist">
            <li class="nav-item"><a class="nav-link active" href="#main" data-toggle="pill" role="tab"><?= $language->admin_website_settings->tab->main ?></a></li>
            <li class="nav-item"><a class="nav-link" href="#store" data-toggle="pill" role="tab"><?= $language->admin_website_settings->tab->store ?></a></li>
            <li class="nav-item"><a class="nav-link" href="#ads" data-toggle="pill" role="tab"><?= $language->admin_website_settings->tab->ads ?></a></li>
            <li class="nav-item"><a class="nav-link" href="#api" data-toggle="pill" role="tab"><?= $language->admin_website_settings->tab->api ?></a></li>
            <li class="nav-item"><a class="nav-link" href="#social" data-toggle="pill" role="tab"><?= $language->admin_website_settings->tab->social ?></a></li>
            <li class="nav-item"><a class="nav-link" href="#email" data-toggle="pill" role="tab"><?= $language->admin_website_settings->tab->email ?></a></li>
        </ul>


        <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="form_token" value="<?= Security::csrf_get_session_token('form_token') ?>" />

            <div class="tab-content">
                <div class="tab-pane fade show active" id="main">
                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->title ?></label>
                        <input type="text" name="title" class="form-control" value="<?= $settings->title ?>" />
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->default_language ?></label>
                        <select name="default_language" class="form-control">
                            <?php foreach($languages as $value) echo '<option value="' . $value . '" ' . (($settings->default_language == $value) ? 'selected' : null) . '>' . $value . '</option>' ?>
                        </select>
                        <small class="text-muted"><?= $language->admin_website_settings->input->default_language_help ?></small>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->logo ?></label>
                        <?php if($settings->logo != ''): ?>
                            <div class="m-1">
                                <img src="<?= $settings->url . UPLOADS_ROUTE . 'logo/' . $settings->logo ?>" class="img-fluid" />
                            </div>
                        <?php endif ?>
                        <input id="logo-file-input" type="file" name="logo" class="form-control" />
                        <small class="text-muted"><?= $language->admin_website_settings->input->logo_help ?></small>
                        <small class="text-muted"><a href="admin/website-settings/remove-logo/<?= Security::csrf_get_session_token('url_token') ?>"><?= $language->admin_website_settings->input->logo_remove ?></a></small>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->meta_description ?></label>
                        <input type="text" name="meta_description" class="form-control" value="<?= $settings->meta_description ?>" />
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->keywords ?></label>
                        <input type="text" name="keywords" class="form-control" value="<?= $settings->keywords ?>" />
                    </div>


                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->time_zone ?></label>
                        <select name="time_zone" class="form-control">
                            <?php foreach(DateTimeZone::listIdentifiers() as $time_zone) echo '<option value="' . $time_zone . '" ' . (($settings->time_zone == $time_zone) ? 'selected' : null) . '>' . $time_zone . '</option>' ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->avatar_max_size ?></label>
                        <input type="text" name="avatar_max_size" class="form-control" value="<?= $settings->avatar_max_size ?>" />
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->profile_settings_autosave ?></label>

                        <select class="form-control" name="profile_settings_autosave">
                            <option value="1" <?php if($settings->profile_settings_autosave == 1) echo 'selected' ?>><?= $language->global->yes ?></option>
                            <option value="0" <?php if($settings->profile_settings_autosave == 0) echo 'selected' ?>><?= $language->global->no ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->profile_hit_timing ?></label>
                        <input type="text" name="profile_hit_timing" class="form-control" value="<?= $settings->profile_hit_timing ?>" />
                        <small class="form-text text-muted"><?= $language->admin_website_settings->input->profile_hit_timing_help ?></small>
                    </div>

                </div>


                <div class="tab-pane fade" id="store">
                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->store_paypal_mode ?></label>

                        <select name="store_paypal_mode" class="custom-select form-control">
                            <option value="live" <?= ($settings->store_paypal_mode == 'live') ? 'selected' : null ?>>live</option>
                            <option value="sandbox" <?= ($settings->store_paypal_mode == 'sandbox') ? 'selected' : null ?>>sandbox</option>
                        </select>

                        <small class="text-muted"><?= $language->admin_website_settings->input->store_paypal_mode_help ?></small>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->store_paypal_client_id ?></label>
                        <input type="text" name="store_paypal_client_id" class="form-control" value="<?= $settings->store_paypal_client_id ?>" />
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->store_paypal_secret ?></label>
                        <input type="text" name="store_paypal_secret" class="form-control" value="<?= $settings->store_paypal_secret ?>" />
                    </div>

                    <hr />

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->store_stripe_publishable_key ?></label>
                        <input type="text" name="store_stripe_publishable_key" class="form-control" value="<?= $settings->store_stripe_publishable_key ?>" />
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->store_stripe_secret_key ?></label>
                        <input type="text" name="store_stripe_secret_key" class="form-control" value="<?= $settings->store_stripe_secret_key ?>" />
                    </div>

                    <hr />

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->store_currency ?></label>
                        <input type="text" name="store_currency" class="form-control" value="<?= $settings->store_currency ?>" />
                        <small class="form-text text-muted"><?= $language->admin_website_settings->input->store_currency_help ?></small>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->store_pro_price_month ?></label>
                        <input type="text" name="store_pro_price_month" class="form-control" value="<?= $settings->store_pro_price_month ?>" />
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->store_pro_price_year ?></label>
                        <input type="text" name="store_pro_price_year" class="form-control" value="<?= $settings->store_pro_price_year ?>" />
                    </div>
                </div>

                <div class="tab-pane fade" id="ads">
                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->top_ads ?></label>
                        <textarea class="form-control" name="top_ads" style="height: 5rem;"><?= $settings->top_ads ?></textarea>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->bottom_ads ?></label>
                        <textarea class="form-control" name="bottom_ads" style="height: 5rem;"><?= $settings->bottom_ads ?></textarea>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->side_ads ?></label>
                        <textarea class="form-control" name="profile_ads" style="height: 5rem;"><?= $settings->profile_ads ?></textarea>
                    </div>
                </div>

                <div class="tab-pane fade" id="api">
                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->recaptcha ?></label>

                        <select class="custom-select" name="recaptcha">
                            <option value="1" <?php if($settings->recaptcha) echo 'selected' ?>><?= $language->global->yes ?></option>
                            <option value="0" <?php if(!$settings->recaptcha) echo 'selected' ?>><?= $language->global->no ?></option>
                        </select>
                        <small class="text-muted"><?= $language->admin_website_settings->input->recaptcha_help ?></small>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->public_key ?></label>
                        <input type="text" name="public_key" class="form-control" value="<?= $settings->public_key ?>" />
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->private_key ?></label>
                        <input type="text" name="private_key" class="form-control" value="<?= $settings->private_key ?>" />
                    </div>

                    <hr />

                    <h5>Facebook Login</h5>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->facebook_login ?></label>

                        <select class="custom-select" name="facebook_login">
                            <option value="1" <?php if($settings->facebook_login) echo 'selected' ?>><?= $language->global->yes ?></option>
                            <option value="0" <?php if(!$settings->facebook_login) echo 'selected' ?>><?= $language->global->no ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->facebook_app_id ?></label>
                        <input type="text" name="facebook_app_id" class="form-control" value="<?= $settings->facebook_app_id ?>" />
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->facebook_app_secret ?></label>
                        <input type="text" name="facebook_app_secret" class="form-control" value="<?= $settings->facebook_app_secret ?>" />
                    </div>

                    <hr />

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->instagram_login ?></label>

                        <select class="custom-select" name="instagram_login">
                            <option value="1" <?php if($settings->instagram_login) echo 'selected' ?>><?= $language->global->yes ?></option>
                            <option value="0" <?php if(!$settings->instagram_login) echo 'selected' ?>><?= $language->global->no ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->instagram_client_id ?></label>
                        <input type="text" name="instagram_client_id" class="form-control" value="<?= $settings->instagram_client_id ?>" />
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->instagram_client_secret ?></label>
                        <input type="text" name="instagram_client_secret" class="form-control" value="<?= $settings->instagram_client_secret ?>" />
                    </div>

                    <hr />

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->analytics_code ?></label>
                        <input type="text" name="analytics_code" class="form-control" value="<?= $settings->analytics_code ?>" />
                        <small class="text-muted"><?= $language->admin_website_settings->input->analytics_code_help ?></small>
                    </div>

                </div>

                <div class="tab-pane fade" id="social">
                    <small class="form-text text-muted"><?= $language->admin_website_settings->input->social_help ?></small>

                    <div class="form-group">
                        <label><i class="fab fa-facebook"></i> <?= $language->admin_website_settings->input->facebook ?></label>
                        <input type="text" name="facebook" class="form-control" value="<?= $settings->facebook ?>" />
                    </div>

                    <div class="form-group">
                        <label><i class="fab fa-twitter"></i> <?= $language->admin_website_settings->input->twitter ?></label>
                        <input type="text" name="twitter" class="form-control" value="<?= $settings->twitter ?>" />
                    </div>

                    <div class="form-group">
                        <label><i class="fab fa-instagram"></i> <?= $language->admin_website_settings->input->instagram ?></label>
                        <input type="text" name="instagram" class="form-control" value="<?= $settings->instagram ?>" />
                    </div>

                    <div class="form-group">
                        <label><i class="fab fa-youtube"></i> <?= $language->admin_website_settings->input->youtube ?></label>
                        <input type="text" name="youtube" class="form-control" value="<?= $settings->youtube ?>" />
                    </div>

                </div>

                <div class="tab-pane fade" id="email">

                    <h5>SMTP</h5>
                    <small class="form-text text-muted"><?= $language->admin_website_settings->input->smtp_help ?></small>



                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->smtp_host ?></label>
                        <input type="text" name="smtp_host" class="form-control" value="<?= $settings->smtp_host ?>" />
                        <small class="form-text text-muted"><?= $language->admin_website_settings->input->smtp_help ?></small>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->smtp_from ?></label>
                        <input type="text" name="smtp_from" class="form-control" value="<?= $settings->smtp_from ?>" />
                        <small class="form-text text-muted"><?= $language->admin_website_settings->input->smtp_from_help ?></small>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?= $language->admin_website_settings->input->smtp_encryption ?></label>
                                <select name="smtp_encryption" class="form-control form-control">
                                    <option value="0" <?= ($settings->smtp_encryption == '0') ? 'selected' : null ?>>None</option>
                                    <option value="ssl" <?= ($settings->smtp_encryption == 'ssl') ? 'selected' : null ?>>SSL</option>
                                    <option value="tls" <?= ($settings->smtp_encryption == 'tls') ? 'selected' : null ?>>TLS</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label><?= $language->admin_website_settings->input->smtp_port ?></label>
                                <input type="text" name="smtp_port" class="form-control" value="<?= $settings->smtp_port ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" name="smtp_auth" type="checkbox" value="" <?= ($settings->smtp_auth) ? 'checked' : null ?>>
                            <?= $language->admin_website_settings->input->smtp_auth ?>
                        </label>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->smtp_user ?></label>
                        <input type="text" name="smtp_user" class="form-control" value="<?= $settings->smtp_user ?>" <?= ($settings->smtp_auth) ? null : 'disabled' ?>/>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->smtp_pass ?></label>
                        <input type="text" name="smtp_pass" class="form-control" value="<?= $settings->smtp_pass ?>" <?= ($settings->smtp_auth) ? null : 'disabled' ?>/>
                    </div>

                    <hr />

                    <h5>Other</h5>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->email_confirmation ?></label>

                        <select class="form-control" name="email_confirmation">
                            <option value="1" <?php if($settings->email_confirmation == 1) echo 'selected' ?>><?= $language->global->yes ?></option>
                            <option value="0" <?php if($settings->email_confirmation == 0) echo 'selected' ?>><?= $language->global->no ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?= $language->admin_website_settings->input->email_pro_due_date ?> </label>
                        <input type="text" name="email_pro_due_date" class="form-control" value="<?= $settings->email_pro_due_date ?>" />
                        <small class="form-text text-muted"><?= $language->admin_website_settings->input->email_pro_due_date_help ?></small>
                    </div>

                </div>


                <div class="text-center mt-5">
                    <button type="submit" name="submit" class="btn btn-primary"><?= $language->global->submit_button ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(() => {

    $('input[name="cron_queries"]').on('keyup keypress blur change', (event) => {
        $('#queries_per_day').html(parseInt($(event.currentTarget).val()) * 1440);
    })

    $('input[name="smtp_auth"]').on('change', (event) => {

        if($(event.currentTarget).is(':checked')) {
            $('input[name="smtp_user"],input[name="smtp_pass"]').removeAttr('disabled');
        } else {
            $('input[name="smtp_user"],input[name="smtp_pass"]').attr('disabled', 'true');
        }

    })
})
</script>
