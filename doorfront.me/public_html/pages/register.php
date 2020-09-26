<?php
defined('ROOT') || die();
User::logged_in_redirect();

/* instagram login / register handler */
if($settings->instagram_login) {

    $instagram = new MetzWeb\Instagram\Instagram([
        'apiKey' => $settings->instagram_client_id,
        'apiSecret' => $settings->instagram_client_secret,
        'apiCallback' => $settings->url . 'login/instagram'
    ]);

    $instagram_login_url = $instagram->getLoginUrl();
}

/* Facebook Login / Register */
if($settings->facebook_login) {

    $facebook = new Facebook\Facebook([
        'app_id' => $settings->facebook_app_id,
        'app_secret' => $settings->facebook_app_secret,
        'default_graph_version' => 'v2.2',
    ]);

    $facebook_helper = $facebook->getRedirectLoginHelper();
    $facebook_login_url = $facebook->getRedirectLoginHelper()->getLoginUrl($settings->url . 'login/facebook', ['email', 'public_profile']);
}

/* Initiate captcha */
$captcha = new Captcha($settings->recaptcha, $settings->public_key, $settings->private_key);

if(!empty($_POST)) {
	/* Clean some posted variables */
    $_POST['username']	= generate_slug(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
	$_POST['name']		= filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$_POST['email']		= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

	/* Define some variables */
	$fields = ['username', 'name', 'email' ,'password'];

	/* Check for any errors */
	foreach($_POST as $key=>$value)  {
		if(empty($value) && in_array($key, $fields) == true) {
			$_SESSION['error'][] = $language->global->error_message->empty_fields;
			break 1;
		}
	}
	if(!$captcha->is_valid()) {
		$_SESSION['error'][] = $language->global->error_message->invalid_captcha;
	}
	if(strlen($_POST['username']) < 3 || strlen($_POST['username']) > 32) {
		$_SESSION['error'][] = $language->register->error_message->username_length;
	}
	if(strlen($_POST['name']) < 3 || strlen($_POST['name']) > 32) {
		$_SESSION['error'][] = $language->register->error_message->name_length;
	}
	if(Database::exists('user_id', 'users', ['username' => $_POST['username']])) {
		$_SESSION['error'][] = sprintf($language->register->error_message->user_exists, $_POST['username']);
	}
	if(Database::exists('user_id', 'users', ['email' => $_POST['email']])) {
		$_SESSION['error'][] = $language->register->error_message->email_exists;
	}
	if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
		$_SESSION['error'][] = $language->register->error_message->invalid_email;
	}
	if(strlen(trim($_POST['password'])) < 6) {
		$_SESSION['error'][] = $language->register->error_message->short_password;
	}
	$regex = '/^[A-Za-z0-9]+[A-Za-z0-9_.]*[A-Za-z0-9]+$/';
	if(!preg_match($regex, $_POST['username'])) {
		$_SESSION['error'][] = $language->register->error_message->username_characters;
	}


	/* If there are no errors continue the registering process */
	if(empty($_SESSION['error'])) {
		/* Define some needed variables */
		$password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$active 	= ($settings->email_confirmation == 0) ? '1' : '0';
		@$email_code = md5($_POST['email'] + microtime());
		$date = (new DateTime())->format('Y-m-d H:i:s');

		/* Add the user to the database */
		$stmt = $database->prepare("INSERT INTO `users` (`username`, `password`, `email`, `email_activation_code`, `name`, `active`, `date`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param('sssssss', $_POST['username'], $password, $_POST['email'], $email_code, $_POST['name'], $active, $date);
		$stmt->execute();
		$registered_user_id = $stmt->insert_id;
		$stmt->close();

		/* If active = 1 then login the user, else send the user an activation email */
		if($active == '1') {
			$_SESSION['user_id'] = $registered_user_id;
			$_SESSION['success'] = $language->register->success_message->login;
			redirect();
		} else {
			$_SESSION['success'][] = $language->register->success_message->registration;
			sendmail($_POST['email'], sprintf($language->register->email->title, $settings->title), sprintf($language->register->email->content, $settings->url, $_POST['email'], $email_code));
			//printf($language->register->email->content, $settings->url, $_POST['email'], $email_code);
		}
	}

	display_notifications();

}

?>


<div class="d-flex justify-content-center">
	<div class="card card-shadow col-md-5 border-0">
		<div class="card-body">

			<h4 class="card-title"><?= $language->register->header ?></h4>
            <small><a href="login" class="text-muted" role="button"><?= $language->register->subheader ?></a></small>

			<form action="register" method="post" role="form">
				<div class="form-group mt-5">
					<label class="text-muted"><small><?= $language->register->input->username ?></small></label>
					<input type="text" name="username" class="form-control" placeholder="<?= $language->register->input->username ?>" />
				</div>

				<div class="form-group">
					<label class="text-muted"><small><?= $language->register->input->name ?></small></label>
					<input type="text" name="name" class="form-control" placeholder="<?= $language->register->input->name ?>" />
				</div>

				<div class="form-group">
					<label class="text-muted"><small><?= $language->register->input->email ?></small></label>
					<input type="text" name="email" class="form-control" placeholder="<?= $language->register->input->email ?>" />
				</div>

				<div class="form-group">
					<label class="text-muted"><small><?= $language->register->input->password ?></small></label>
					<input type="password" name="password" class="form-control" placeholder="<?= $language->register->input->password ?>" />
				</div>

				<div class="form-group">
					  <?php $captcha->display() ?>
				</div>

				<div class="form-group mt-5">
                    <button type="submit" name="submit" class="btn btn-default btn-block"><?= $language->global->submit_button ?></button>
                </div>
			</form>
		</div>
	</div>
</div>
