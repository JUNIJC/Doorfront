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
		$user_id = Database::simple_get('user_id', 'users', ['email' => $_POST['email']]);

		if($user_id && !(bool) Database::simple_get('active', 'users', ['user_id' => $user_id])) {
			/* Define some variables */
			$email_code = md5($_POST['email'] . microtime());

			/* Update the current activation email */
			$database->query("UPDATE `users` SET `email_activation_code` = '{$email_code}' WHERE `user_id` = {$user_id}");

			/* Send the email */
			sendmail($_POST['email'], $language->resend_activation->email->title, sprintf($language->resend_activation->email->content, $settings->url, $_POST['email'], $email_code));
			//printf($language->resend_activation->email->content, $settings->url, $_POST['email'], $email_code);
		}

		/* Store success message */
		$_SESSION['success'][] = $language->resend_activation->notice_message->success;
	}

	display_notifications();

}


?>

<div class="d-flex justify-content-center">
    <div class="card card-shadow col-md-5 border-0">
        <div class="card-body">

            <h4 class="card-title d-flex justify-content-between">
                <?= $language->resend_activation->header ?>

                <small><?= User::generate_go_back_button('login') ?></small>
            </h4>

            <form action="" method="post" role="form">
                <div class="form-group mt-5">
                    <label class="text-muted"><small><?= $language->resend_activation->input->email ?></small></label>
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
