<?php
defined('ROOT') || die();
User::check_permission(1);

$user_id = (int) $parameters[0];
$profile_account = Database::get('*', 'users', ['user_id' => $user_id]);

/* Check if user exists */
if(!Database::exists('user_id', 'users', ['user_id' => $user_id])) {
    $_SESSION['error'][] = $language->admin_user_edit->error_message->invalid_account;
    User::get_back('admin/users-management');
}

if(!empty($_POST)) {
    /* Define some variables */
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    $avatar = (!empty($_FILES['avatar']['name'])) ? true : false;

    /* Filter some the variables */
    $_POST['username']	= generate_slug(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $_POST['name']		= filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $_POST['email']		= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $_POST['status']	= (int) $_POST['status'];
    $_POST['pro']	    = (int) $_POST['pro'];

    if(!Security::csrf_check_session_token('form_token', $_POST['form_token'])) {
        $_SESSION['error'][] = $language->global->error_message->invalid_token;
    }
    if(strlen($_POST['username']) < 3 || strlen($_POST['username']) > 32) {
        $_SESSION['error'][] = $language->admin_user_edit->error_message->username_length;
    }
    if(Database::exists('user_id', 'users', ['username' => $_POST['username']]) && $_POST['username'] !== $profile_account->username) {
        $_SESSION['error'][] = sprintf($language->admin_user_edit->error_message->user_exists, $_POST['username']);
    }
    if(strlen($_POST['name']) < 3 || strlen($_POST['name']) > 32) {
        $_SESSION['error'][] = $language->admin_user_edit->error_message->name_length;
    }
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
        $_SESSION['error'][] = $language->admin_user_edit->error_message->invalid_email;
    }

    if(Database::exists('user_id', 'users', ['email' => $_POST['email']]) && $_POST['email'] !== $profile_account->email) {
        $_SESSION['error'][] = $language->admin_user_edit->error_message->email_exists;
    }

    if(!empty($_POST['new_password']) && !empty($_POST['repeat_password'])) {
        if(strlen(trim($_POST['new_password'])) < 6) {
            $_SESSION['error'][] = $language->admin_user_edit->error_message->short_password;
        }
        if($_POST['new_password'] !== $_POST['repeat_password']) {
            $_SESSION['error'][] = $language->admin_user_edit->error_message->passwords_not_matching;
        }
    }

    /* Check for any errors on the avatar image */
    if($avatar) {
        $avatar_file_name		= $_FILES['avatar']['name'];
        $avatar_file_extension	= explode('.', $avatar_file_name);
        $avatar_file_extension	= strtolower(end($avatar_file_extension));
        $avatar_file_temp		= $_FILES['avatar']['tmp_name'];
        $avatar_file_size		= $_FILES['avatar']['size'];
        list($avatar_width, $avatar_height)	= getimagesize($avatar_file_temp);

        if(in_array($avatar_file_extension, $allowed_extensions) !== true) {
            $_SESSION['error'][] = $language->global->error_message->invalid_file_type;
        }
        if($avatar_width < 165 || $avatar_height < 165) {
            $_SESSION['error'][] = $language->profile_settings->error_message->small_avatar;
        }
        if($avatar_file_size > $settings->avatar_max_size) {
            $_SESSION['error'][] = sprintf($language->global->error_message->invalid_image_size, formatBytes($settings->avatar_max_size));
        }
    }


    if(empty($_SESSION['error'])) {

        /* Update the basic user settings */
        $stmt = $database->prepare("
			UPDATE
				`users`
			SET
			    `username` = ?,
				`name` = ?,
				`email` = ?,
				`active` = ?,
				`pro` = ?
			WHERE
				`user_id` = {$user_id}
		");
        $stmt->bind_param(
            'sssss',
            $_POST['username'],
            $_POST['name'],
            $_POST['email'],
            $_POST['status'],
            $_POST['pro']
        );
        $stmt->execute();
        $stmt->close();

        /* Update the password if set */
        if(!empty($_POST['new_password']) && !empty($_POST['repeat_password'])) {
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            $stmt = $database->prepare("UPDATE `users` SET `password` = ?  WHERE `user_id` = {$user_id}");
            $stmt->bind_param('s', $new_password);
            $stmt->execute();
            $stmt->close();
        }

        /* Avatar update process */
        if($avatar) {
            /* Delete current avatar & thumbnail */
            unlink(AVATARS_ROUTE . $profile_account->avatar);
            unlink(AVATARS_THUMBS_ROUTE . $profile_account->avatar);

            /* Generate new name for avatar */
            $avatar_new_name = md5(time().rand()) . '.' . $avatar_file_extension;

            /* Make a thumbnail and upload the original */
            resize($avatar_file_temp, AVATARS_THUMBS_ROUTE . $avatar_new_name, '165', '165');
            move_uploaded_file($avatar_file_temp, AVATARS_ROUTE . $avatar_new_name);

            /* Execute query */
            $database->query("UPDATE `users` SET `avatar` = '{$avatar_new_name}' WHERE `user_id` = {$user_id}");
        }

        $profile_account = Database::get('*', 'users', ['user_id' => $user_id]);

        $_SESSION['success'][] = $language->global->success_message->basic;
    }

}
