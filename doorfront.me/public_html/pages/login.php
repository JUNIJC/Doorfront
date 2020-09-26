<?php
defined('ROOT') || die();
User::logged_in_redirect();

$login_type	= (isset($parameters[0])) ? $parameters[0] : false;

/* Default values */
$login_username = '';

/* instagram login / register handler */
if($settings->instagram_login) {

    $instagram = new MetzWeb\Instagram\Instagram([
        'apiKey'      => $settings->instagram_client_id,
        'apiSecret'   => $settings->instagram_client_secret,
        'apiCallback' => $settings->url . 'login/instagram'
    ]);

    $instagram_login_url = $instagram->getLoginUrl();

    if($login_type == 'instagram') {
        $instagram_data = $instagram->getOAuthToken($_GET['code']);

        if(isset($instagram_data->error_message)) {
            $_SESSION['error'][] = 'Instagram Auth Error: ' . $instagram_data->error_message;
        }

        if(empty($_SESSION['error'])) {

            /* If the user is already in the system, log him in */
            if ($account = Database::get(['user_id'], 'users', ['instagram_id' => $instagram_data->user->id])) {
                $_SESSION['user_id'] = $account->user_id;
                redirect('dashboard');
            } /* Create a new account */
            else {
                /* Generate a random username */
                $username = generate_slug($instagram_data->user->username, '_');

                /* Error checks */

                /* If the user already exists, generate a new username with some random characters */
                while (Database::exists('username', 'users', ['username' => $username])) {
                    $username = generate_slug($instagram_data->user->username, '_') . rand(100, 999);
                }


                if (empty($_SESSION['error'])) {
                    $generated_password = generate_string(8);
                    $password = password_hash($generated_password, PASSWORD_DEFAULT);
                    $description = $instagram_data->user->bio;
                    $name = $instagram_data->user->full_name;
                    $date = (new DateTime())->format('Y-m-d H:i:s');
                    $email = '';
                    $active = 1;

                    /* Try to get the profile image and save it */
                    $instagram_image = file_get_contents($instagram_data->user->profile_picture);
                    $avatar_name = md5(time() . rand()) . '.jpg';

                    file_put_contents(AVATARS_THUMBS_ROUTE . $avatar_name, $instagram_image);
                    file_put_contents(AVATARS_ROUTE . $avatar_name, $instagram_image);

                    /* Insert the user into the database */
                    $stmt = $database->prepare("INSERT INTO `users` (`username`, `password`, `email`, `name`, `active`, `date`, `avatar`, `instagram_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param('ssssssss', $username, $password, $email, $name, $active, $date, $avatar_name, $instagram_data->user->id);
                    $stmt->execute();
                    $stmt->close();

                    /* Send the user an email with his new details */
                    sendmail(
                        $email,
                        sprintf($language->register->email_new_account->title, $settings->title),
                        sprintf($language->register->email_new_account->content, $username, $generated_password)
                    );
                    //printf($language->register->email_new_account->content, $username, $generated_password);

                    /* Log the user in and redirect him */
                    $_SESSION['user_id'] = Database::simple_get('user_id', 'users', ['instagram_id' => $instagram_data->user->id]);
                    $_SESSION['success'][] = $language->register->success_message->login;
                    redirect();
                }
            }
        }

    }
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

	if($login_type == 'facebook') {
        try {
            $facebook_access_token = $facebook_helper->getAccessToken($settings->url . 'login/facebook');
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            $_SESSION['error'][] = 'Graph returned an error: ' . $e->getMessage();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            $_SESSION['error'][] = 'Facebook SDK returned an error: ' . $e->getMessage();
        }
    }

	if(isset($facebook_access_token)) {

		/* The OAuth 2.0 client handler helps us manage access tokens */
		$facebook_oAuth2_client = $facebook->getOAuth2Client();

		/* Get the access token metadata from /debug_token */
		$facebook_token_metadata = $facebook_oAuth2_client->debugToken($facebook_access_token);

		/* Validation */
		$facebook_token_metadata->validateAppId($settings->facebook_app_id);
		$facebook_token_metadata->validateExpiration();

		if (!$facebook_access_token->isLongLived()) {
			/* Exchanges a short-lived access token for a long-lived one */
			try {
				$facebook_access_token = $facebook_oAuth2_client->getLongLivedAccessToken($facebook_access_token);
			} catch (Facebook\Exceptions\FacebookSDKException $e) {
				$_SESSION['error'][] = 'Error getting long-lived access token: ' . $facebook_helper->getMessage();
			}
		}

		try {
			$response = $facebook->get('/me?fields=id,name,email', $facebook_access_token);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			$_SESSION['error'][] = 'Graph returned an error: ' . $e->getMessage();
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			$_SESSION['error'][] = 'Facebook SDK returned an error: ' . $e->getMessage();
		}

		if(isset($response)) {
			$facebook_user = $response->getGraphUser();
			$facebook_user_id = $facebook_user->getId();

			/* If the user is already in the system, log him in */
			if($account = Database::get(['user_id'], 'users', ['facebook_id' => $facebook_user_id])) {
				$_SESSION['user_id'] = $account->user_id;
				redirect('dashboard');
			}

			/* Create a new account */
			else {
				/* Generate a random username */
				$username = generate_slug($facebook_user->getName(), '_');
				$email = $facebook_user->getProperty('email');

				/* Error checks */
				if(Database::exists('email', 'users', ['email' => $email])) {
					$_SESSION['error'][] = $language->register->error_message->email_exists;
				}

				/* If the user already exists, generate a new username with some random characters */
				while(Database::exists('username', 'users', ['username' => $username])) {
					$username = generate_slug($facebook_user->getName(), '_') . rand(100,999);
				}


				if(empty($_SESSION['error'])) {
					$generated_password = generate_string(8);
					$password 	= password_hash($generated_password, PASSWORD_DEFAULT);
					$name = $facebook_user->getName();
					$date = new DateTime();
					$date = $date->format('Y-m-d H:i:s');
					$active = 1;

					/* Try to get the profile image and save it */
					$facebook_image = file_get_contents('https://graph.facebook.com/' . $facebook_user_id . '/picture?width=165&height=165');
					$facebook_image_large = file_get_contents('https://graph.facebook.com/' . $facebook_user_id . '/picture?type=large');
					$avatar_name = md5(time().rand()) . '.jpg';

					file_put_contents(AVATARS_THUMBS_ROUTE . $avatar_name, $facebook_image);
					file_put_contents(AVATARS_ROUTE . $avatar_name, $facebook_image_large);

					/* Insert the user into the database */
					$stmt = $database->prepare("INSERT INTO `users` (`username`, `password`, `email`, `name`, `active`, `date`, `avatar`, `facebook_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
					$stmt->bind_param('ssssssss', $username, $password, $email, $name, $active, $date, $avatar_name, $facebook_user_id);
					$stmt->execute();
					$stmt->close();

					/* Send the user an email with his new details */
					sendmail(
						$email,
						sprintf($language->register->email_new_account->title, $settings->title),
						sprintf($language->register->email_new_account->content, $username, $generated_password)
					);
					//printf($language->register->email_new_account->content, $username, $generated_password);

					/* Log the user in and redirect him */
					$_SESSION['user_id'] = Database::simple_get('user_id', 'users', ['facebook_id' => $facebook_user_id]);
					$_SESSION['success'][] = $language->register->success_message->login;
					redirect();
				}
			}
		}
	}
}


if(!empty($_POST)) {
	/* Clean username and encrypt the password */
	$_POST['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $login_username = $_POST['username'];

    /* Check for any errors */
    if(empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['error'][] = $language->global->error_message->empty_fields;
    }

	/* Try to get the user from the database */
    if(filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
        $result = $database->query("SELECT `user_id`, `username`, `active`, `password`, `token_code` FROM `users` WHERE `email` = '{$_POST['username']}'");
    } else {
        $result = $database->query("SELECT `user_id`, `username`, `active`, `password`, `token_code` FROM `users` WHERE `username` = '{$_POST['username']}'");
    }
    $login_account = $result->num_rows ? $result->fetch_object() : false;

    if(!$login_account) {
        $_SESSION['error'][] = $language->login->error_message->wrong_login_credentials;
    } else {

	    if(!$login_account->active) {
            $_SESSION['error'][] = $language->login->error_message->user_not_active;
        }

        if(!password_verify($_POST['password'], $login_account->password)) {
            $_SESSION['error'][] = $language->login->error_message->wrong_login_credentials;
        }

    }


    if(empty($_SESSION['error'])) {
        /* If remember me is checked, log the user with cookies for 30 days else, remember just with a session */
        if(isset($_POST['rememberme'])) {
            $token_code = $login_account->token_code;

            /* Generate a new token */
            if(empty($login_account->token_code)) {
                $token_code = md5($_POST['username'] . microtime());
                Database::update('users', ['token_code' => $token_code], ['user_id' => $login_account->user_id]);
            }

            setcookie('username', $_POST['username'], time()+60*60*24*30);
            setcookie('token_code', $token_code, time()+60*60*24*30);

        } else {
            $_SESSION['user_id'] = $login_account->user_id;
        }

        /* We also need to check the status of the account on login */
        User::check_pro($login_account->user_id);

        $_SESSION['info'][] = $language->login->info_message->logged_in;
        redirect('dashboard');
    }


}

display_notifications();

?>

<div class="d-flex justify-content-center">
	<div class="card card-shadow col-md-5 border-0">
		<div class="card-body">

			<h4 class="card-title"><?= $language->login->header ?></h4>
            <small><a href="lost-password" class="text-muted" role="button"><?= $language->login->button->lost_password ?></a> / <a href="resend-activation" class="text-muted" role="button"><?= $language->login->button->resend_activation ?></a></small>

			<form action="" method="post" role="form">
				<div class="form-group mt-5">
					<label class="text-muted"><small><?= $language->login->input->username ?></small></label>
					<input type="text" name="username" class="form-control" value="<?= $login_username ?>" placeholder="<?= $language->login->input->username ?>" />
				</div>

				<div class="form-group">
					<label class="text-muted"><small><?= $language->login->input->password ?></small></label>
					<input type="password" name="password" class="form-control" placeholder="<?= $language->login->input->password ?>" />
				</div>

				<div class="form-check">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input" name="rememberme">
						<?= $language->login->input->remember_me ?>
					</label>
				</div>


				<div class="form-group mt-5">
                    <button type="submit" name="submit" class="btn btn-default btn-block my-1"><?= $language->login->button->login ?></button>
				</div>

                <div class="row">
                    <?php if($settings->facebook_login): ?>
                        <div class="col-sm mt-1">
                            <a href="<?= $facebook_login_url ?>" class="btn btn-primary btn-block"><?= $language->login->button->facebook ?></a>
                        </div>
                    <?php endif ?>

                    <?php if($settings->instagram_login): ?>
                        <div class="col-sm mt-1">
                            <a href="<?= $instagram_login_url ?>" class="btn btn-primary bg-instagram btn-block"><?= $language->login->button->instagram ?></a>
                        </div>
                    <?php endif ?>
                </div>


			</form>
		</div>
	</div>
</div>
