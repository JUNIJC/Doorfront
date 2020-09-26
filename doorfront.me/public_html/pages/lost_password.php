<?php
defined('ROOT') || die();
User::logged_in_redirect();

/* Initiate captcha */
$captcha = new Captcha($settings->recaptcha, $settings->public_key, $settings->private_key);


if(!empty($_POST)) {
	/* Clean the posted variable */
	$_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

	/* Check for any errors */
	if(!$captcha->is_valid()) {
		$_SESSION['error'][] = $language->global->error_message->invalid_captcha;
	}

	/* If there are no errors, resend the activation link */
	if(empty($_SESSION['error'])) {

		if(Database::exists('user_id', 'users', ['email' => $_POST['email']])) {
			/* Define some variables */
			$user_id 			= Database::simple_get('user_id', 'users', ['email' => $_POST['email']]);
			$lost_password_code = md5($_POST['email'] . microtime());

			/* Update the current activation email */
			$database->query("UPDATE `users` SET `lost_password_code` = '{$lost_password_code}' WHERE `user_id` = {$user_id}");

			/* Send the email */
			sendmail($_POST['email'], $language->lost_password->email->title, sprintf($language->lost_password->email->content, $settings->url, $_POST['email'], $lost_password_code));
			//printf($language->lost_password->email->content, $settings->url, $_POST['email'], $lost_password_code);
		}

		/* Set success message */
		$_SESSION['success'][] = $language->lost_password->notice_message->success;
	}

	display_notifications();

}

?>

<div class="d-flex justify-content-center">
    <div class="card card-shadow col-md-5 border-0">
        <div class="card-body">

            <h4 class="card-title d-flex justify-content-between">
                <?= $language->lost_password->header ?>

                <small><?= User::generate_go_back_button('login') ?></small>
            </h4>

            <form action="" method="post" role="form">
                <div class="form-group mt-5">
                    <label class="text-muted"><small><?= $language->lost_password->input->email ?></small></label>
                    <input type="text" name="email" class="form-control" />
                </div>

                <div class="form-group">
                      <?php $captcha->display() ?>
                </div>

                <div class="form-group mt-5">
                    <button type="submit" name="submit" class="btn btn-default btn-block my-1"><?= $language->global->submit_button ?></button>
                </div>

            </form>

        </div>
    </div>
</div>
