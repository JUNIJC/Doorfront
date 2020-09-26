<?php
defined('ROOT') || die();
User::check_permission(1);

$type 		= (isset($parameters[0])) ? $parameters[0] : false;
$id 	    = (isset($parameters[1])) ? (int) $parameters[1] : false;
$url_token	= (isset($parameters[2])) ? $parameters[2] : false;

if(isset($type) && $type == 'delete') {

    /* Check for errors and permissions */
    if(!Security::csrf_check_session_token('url_token', $url_token)) {
        $_SESSION['error'][] = $language->global->error_message->invalid_token;
    }


    if(empty($_SESSION['error'])) {
        $database->query("DELETE FROM `main_link_types` WHERE `id` = {$id}");

        $_SESSION['success'][] = $language->global->success_message->basic;

        redirect('admin/extra-settings');
    }
}


if(!empty($_POST)) {
    if(!empty($_POST['type']) && $_POST['type'] == 'edit') {

        /* Define some variables */
        $_POST['id'] = (int)$_POST['id'];
        $_POST['content'] = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
        $_POST['icon'] = filter_var($_POST['icon'], FILTER_SANITIZE_STRING);

        if(!Security::csrf_check_session_token('form_token', $_POST['form_token'])) {
            $_SESSION['error'][] = $language->global->error_message->invalid_token;
        }

        if(empty($_SESSION['error'])) {
            /* Prepare the statement and execute query */
            $stmt = $database->prepare("UPDATE `main_link_types` SET `content` = ?, `icon` = ? WHERE `id` = ?");
            $stmt->bind_param('sss',
                $_POST['content'],
                $_POST['icon'],
                $_POST['id']
            );
            $stmt->execute();
            $stmt->close();

            /* Set message & Redirect */
            $_SESSION['success'][] = $language->global->success_message->basic;
        }

    } else if(!empty($_POST['type']) && $_POST['type'] == 'available_buttons_edit') {

        if(!Security::csrf_check_session_token('form_token', $_POST['form_token'])) {
            $_SESSION['error'][] = $language->global->error_message->invalid_token;
        }

        if(!json_decode($_POST['available_buttons'])) {
            $_SESSION['error'][] = $language->admin_extra_settings->error_message->invalid_json;
        } else {

            $file = @fopen(ROOT . 'core/data/available_buttons.json', 'w');
            if (!$file) {
                $_SESSION['error'][] = sprintf($language->global->error_message->file_not_writeable, ROOT . 'core/data/available_buttons.json');
            }

        }


        if(empty($_SESSION['error'])) {
           /* Save the new data to the file */
           fwrite($file, $_POST['available_buttons']);

            $_SESSION['success'][] = $language->global->success_message->basic;
            fclose($file);
        }


    } else if(!empty($_POST['type']) && $_POST['type'] == 'available_themes_edit') {

        if(!Security::csrf_check_session_token('form_token', $_POST['form_token'])) {
            $_SESSION['error'][] = $language->global->error_message->invalid_token;
        }

        if(!json_decode($_POST['available_themes'])) {
            $_SESSION['error'][] = $language->admin_extra_settings->error_message->invalid_json;
        } else {

            $file = @fopen(ROOT . 'core/data/available_themes.json', 'w');
            if (!$file) {
                $_SESSION['error'][] = sprintf($language->global->error_message->file_not_writeable, ROOT . 'core/data/available_themes.json');
            }

        }

        if(empty($_SESSION['error'])) {
            /* Save the new data to the file */
            fwrite($file, $_POST['available_themes']);
            fclose($file);

            $_SESSION['success'][] = $language->global->success_message->basic;
        }



    } else {

        /* Define some variables */
        $_POST['content'] = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
        $_POST['icon'] = filter_var($_POST['icon'], FILTER_SANITIZE_STRING);

        if(!Security::csrf_check_session_token('form_token', $_POST['form_token'])) {
            $_SESSION['error'][] = $language->global->error_message->invalid_token;
        }

        if(empty($_SESSION['error'])) {
            /* Prepare the statement and execute query */
            $stmt = $database->prepare("INSERT INTO `main_link_types`(`content`, `icon`) VALUES(?, ?)");
            $stmt->bind_param('ss',
                $_POST['content'],
                $_POST['icon']
            );
            $stmt->execute();
            $stmt->close();

            /* Set message & Redirect */
            $_SESSION['success'][] = $language->global->success_message->basic;
        }

    }
}

$result = $database->query("SELECT * FROM `main_link_types`");
