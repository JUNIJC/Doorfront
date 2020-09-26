<?php
include '../../core/init.php';
User::check_permission(0);
Security::csrf_check_session_token('dynamic');

if(!empty($_POST)) {
    $is_manual_post = isset($_POST['manual_post']);


    $available_templates = get_json_data('available_templates');
    $available_background_types = ['background', 'gradient', 'color'];

    /* Define some variables */
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    $avatar = (!empty($_FILES['avatar']['name']));

    /* Clean some posted variables */
    $_POST['description']		= filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $_POST['name']		        = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $_POST['location']		    = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
    $_POST['occupations']	    = explode(',', trim(filter_var($_POST['occupations'], FILTER_SANITIZE_STRING)));
    $_POST['occupations']       = implode(',', array_slice($_POST['occupations'], 0, 3));
    $_POST['companies']	        = explode(',', trim(filter_var($_POST['companies'], FILTER_SANITIZE_STRING)));
    $_POST['companies']         = implode(',', array_slice($_POST['companies'], 0, 3));
    $_POST['knowledge']	        = explode(',', trim(filter_var($_POST['knowledge'], FILTER_SANITIZE_STRING)));
    $_POST['knowledge']         = implode(',', array_slice($_POST['knowledge'], 0, 5));
    $_POST['template']          = (isset($_POST['template']) && in_array($_POST['template'], array_keys((array) $available_templates))) ? $_POST['template'] : 'one';
    $_POST['main_link']         = isset($_POST['main_link']) ? filter_var($_POST['main_link'], FILTER_SANITIZE_URL) : $account->main_link;
    $_POST['main_link_type']    = (int) $_POST['main_link_type'];
    $_POST['background_type']   = (in_array($_POST['background_type'], $available_background_types)) ? $_POST['background_type'] : 'color';
    $_POST['background_value']	= filter_var($_POST['background_value'], FILTER_SANITIZE_STRING);
    $_POST['buttons']           = json_encode(Database::clean_array($_POST['buttons']));

    switch($_POST['background_type']) {
        case 'background':

        break;

        case 'gradient':

        break;

        case 'color':

        break;
    }

    /* Check for any errors */
    if(!Security::csrf_check_session_token('form_token', $_POST['form_token'])) {
        if($is_manual_post) {
            $_SESSION['error'][] = $language->global->error_message->invalid_token;
        } else {
            die(Response::json($language->global->error_message->invalid_token, 'error'));
        }
    }

    if(strlen($_POST['description']) > 1024) {
        if($is_manual_post) {
            $_SESSION['error'][] = $language->register->error_message->long_about;
        } else {
            die(Response::json($language->register->error_message->long_about, 'error'));
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

        if(!is_writeable(ROOT . AVATARS_ROUTE) || !is_writeable(ROOT . AVATARS_THUMBS_ROUTE)) {
            if($is_manual_post) {
                $_SESSION['error'][] = $account->type > 0 ? $language->profile_settings->error_message->not_writeable : $language->global->error_message->system_issues;
            } else {
                die(Response::json($account->type > 0 ? $language->profile_settings->error_message->not_writeable : $language->global->error_message->system_issues, 'error'));
            }
        }
        if(in_array($avatar_file_extension, $allowed_extensions) !== true) {
            if($is_manual_post) {
                $_SESSION['error'][] = $language->global->error_message->invalid_file_type;
            } else {
                die(Response::json($language->global->error_message->invalid_file_type, 'error'));
            }
        }
        if($avatar_width < 165 || $avatar_height < 165) {
            if($is_manual_post) {
                $_SESSION['error'][] = $language->profile_settings->error_message->small_avatar;
            } else {
                die(Response::json($language->profile_settings->error_message->small_avatar, 'error'));
            }
        }
        if($avatar_file_size > $settings->avatar_max_size) {
            if($is_manual_post) {
                $_SESSION['error'][] = sprintf($language->global->error_message->invalid_image_size, formatBytes($settings->avatar_max_size));
            } else {
                die(Response::json(sprintf($language->global->error_message->invalid_image_size, formatBytes($settings->avatar_max_size)), 'error'));
            }
        }
    }

    /* If there are no errors continue the updating process */
    if(empty($_SESSION['error'])) {
        /* Prepare the statement and execute query */
        $stmt = $database->prepare("UPDATE `users` SET `name` = ?, `description` = ?, `location` = ?, `occupations` = ?, `companies` = ?, `knowledge` = ?, `template` = ?, `main_link_type` = ?, `main_link` = ?, `background_type` = ?, `background_value` = ?, `buttons` = ? WHERE `user_id` = {$account_user_id}");
        $stmt->bind_param('ssssssssssss', $_POST['name'], $_POST['description'], $_POST['location'], $_POST['occupations'], $_POST['companies'], $_POST['knowledge'], $_POST['template'], $_POST['main_link_type'], $_POST['main_link'], $_POST['background_type'], $_POST['background_value'], $_POST['buttons']);
        $stmt->execute();
        $stmt->close();

        /* Avatar update process */
        if($avatar) {
            /* Delete current avatar & thumbnail */
            @unlink(ROOT . AVATARS_ROUTE.$account->avatar);
            @unlink(ROOT . AVATARS_THUMBS_ROUTE.$account->avatar);

            /* Generate new name for avatar */
            $avatar_new_name = md5(time().rand()) . '.' . $avatar_file_extension;

            /* Make a thumbnail and upload the original */
            resize($avatar_file_temp, ROOT . AVATARS_THUMBS_ROUTE . $avatar_new_name, '165', '165');
            move_uploaded_file($avatar_file_temp, ROOT . AVATARS_ROUTE .$avatar_new_name);

            /* Execute query */
            $database->query("UPDATE `users` SET `avatar` = '{$avatar_new_name}' WHERE `user_id` = {$account_user_id}");
        }

        /* Set the success message & Refresh users data */
        if($is_manual_post) {
            $_SESSION['success'][] = $language->profile_settings->success_message->profile_updated;

            redirect('profile-settings');
        } else {
            die(Response::json($language->profile_settings->success_message->profile_updated, 'success'));
        }
    }

}