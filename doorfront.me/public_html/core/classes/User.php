<?php

class User {

	public static function delete_user($user_id) {
		global $database;

		$user_avatar = Database::simple_get('avatar', 'users', ['user_id' => $user_id]);

		/* Delete the avatar from the disk */
		@unlink(ROOT . AVATARS_THUMBS_ROUTE . $user_avatar);
        @unlink(ROOT . AVATARS_ROUTE . $user_avatar);


        /* Delete stuff from the database */
		@$database->query("DELETE FROM `users` WHERE `user_id` = {$user_id}");
		@$database->query("DELETE FROM `hits` WHERE `user_id` = {$user_id}");

	}


	public static function login($username, $password) {
		global $database;

		$stmt = $database->prepare("SELECT `user_id`, `password` FROM `users` WHERE `username` = ?");
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$stmt->bind_result($user_id, $hash);
		$stmt->fetch();
		$stmt->close();

		if(is_null($user_id)) {
			return false;
		}

		if(!password_verify($password, $hash)) {
			return false;
		}

		return $user_id;
	}

    public static function logout() {
        global $account_user_id;

        Database::update('users', ['token_code' => ''], ['user_id' => $account_user_id]);

        session_destroy();
        setcookie('username', '', time()-30);
        setcookie('token_code', '', time()-30);

        redirect();
    }

	public static function logged_in_redirect() {
		global $language;

		if(self::logged_in()) {
			$_SESSION['error'][] = $language->global->error_message->page_access_denied;
			redirect();
		}
	}

    public static function logged_in() {
        global $user_logged_in;
        global $account_user_id;


        if($user_logged_in) {
            return $account_user_id;
        } else

        if(isset($_COOKIE['username']) && isset($_COOKIE['token_code']) && strlen($_COOKIE['token_code']) > 0 && $account_user_id = Database::simple_get('user_id', 'users', ['username' => $_COOKIE['username'], 'token_code' => $_COOKIE['token_code']])) {
            $user_logged_in = true;

            return $account_user_id;
        } else

        if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $account_user_id = Database::simple_get('user_id', 'users', ['user_id' => $_SESSION['user_id']])) {
            $user_logged_in = $account_user_id ? true : false;

            return $account_user_id;
        }

        else return false;
    }

	public static function get_back($new_page = '') {
		if(isset($_SERVER['HTTP_REFERER']))
			Header('Location: ' . $_SERVER['HTTP_REFERER']);
		else
			redirect($new_page);
		die();
	}

    public static function get_admin_profile_link($user_id) {
        global $database;
        global $settings;

        $stmt = $database->prepare("SELECT `name` FROM `users` WHERE `user_id` = ?");
        $stmt->bind_param('s', $user_id);
        $stmt->execute();
        $stmt->bind_result($name);
        $stmt->fetch();
        $stmt->close();

        return (!$name) ? 'Non Existent' : '<a href="' . $settings->url . 'admin/user-edit/' . $user_id . '">' . $name . '</a>';
    }



	public static function check_permission($level = 1) {
		global $account;
		global $language;

		if(!self::logged_in() || (self::logged_in() && $account->type < $level)) {
			$_SESSION['error'][] = $language->global->error_message->page_access_denied;

            redirect();
		}
	}


    public static function admin_generate_buttons($type = 'user', $target_id) {
        global $language;

        switch($type) {

            case 'user' :
                return '
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="text-secondary dropdown-toggle dropdown-toggle-simple">
                        <i class="fas fa-ellipsis-v"></i>
                        
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="admin/user-view/' . $target_id . '"><i class="fa fa-eye"></i> ' . $language->global->view . '</a>
                            <a class="dropdown-item" href="admin/user-edit/' . $target_id . '"><i class="fas fa-pencil-alt"></i> ' . $language->global->edit . '</a>
                            <a class="dropdown-item" data-confirm="' . $language->global->info_message->confirm_delete . '" href="admin/users-management/delete/' . $target_id . '/' . Security::csrf_get_session_token('url_token') . '"><i class="fa fa-times"></i> ' . $language->global->delete . '</a>
                        </div>
                    </a>
                </div>';

                break;


            case 'page' :
                return '
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="text-secondary dropdown-toggle dropdown-toggle-simple">
                        <i class="fas fa-ellipsis-v"></i>
                        
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="admin/page-edit/' . $target_id . '"><i class="fas fa-pencil-alt"></i> ' . $language->global->edit . '</a>
                            <a class="dropdown-item" data-confirm="' . $language->global->info_message->confirm_delete . '" href="admin/pages-management/delete/' . $target_id . '/' . Security::csrf_get_session_token('url_token') . '"><i class="fa fa-times"></i> ' . $language->global->delete . '</a>
                        </div>
                    </a>
                </div>';

                break;

        }
    }


	public static function generate_go_back_button($default = 'index') {
		global $language;
		global $settings;

		return '<a href="' . $settings->url . $default . '"><button class="btn btn-outline-primary btn-sm "><i class="fa fa-arrow-left"></i> ' . $language->global->go_back_button . '</button></a>';
	}


	public static function display_image($path, $default = 'template/images/default_avatar.png') {

		return (file_exists(ROOT . $path)) ? $path : $default;

	}

	public static function check_pro($user_id) {
		global $database;
		global $settings;
		global $language;

		$account = $database->query("SELECT `name`, `points`, `email`, `pro_due_date_notified`, DATEDIFF(`pro_due_date`, NOW()) AS `days_left` FROM `users` WHERE `user_id` = {$user_id} AND `pro` = 1")->fetch_object();


		if(is_null($account)) {
			return;
		} else {
			$days_left = $account->days_left;
		}


		if($settings->email_pro_due_date > 0 && $days_left > 0 && $days_left <= $settings->email_pro_due_date && !$account->pro_due_date_notified) {

            sendmail($account->email, sprintf($language->global->email->pro_notification_title, $settings->title), sprintf($language->global->email->pro_notification, $account->name, $days_left));
            Database::update('users', ['pro_due_date_notified' => '1'], ['user_id' => $user_id]);

		} else

		if($days_left < 0) {

			/* check if we remove or continue the subscription */
			if($account->points >= $settings->store_pro_price_month) {
				$database->query("UPDATE `users` SET `pro_due_date` = DATE_ADD(NOW(), INTERVAL 30 DAY), `pro_due_date_notified` = '0', `points` = `points` - {$settings->store_pro_price_month} WHERE `user_id` = {$user_id}");
			} else {
				Database::update('users', ['pro' => '0', 'pro_due_date_notified' => '0'], ['user_id' => $user_id]);
			}

		}
	}

	public static function get_profile_out($user_id, $type, $type_id) {
		global $settings;

		return $settings->url . 'out/' . $user_id . '/' . $type . '/' . $type_id . '/' . Security::csrf_get_session_token('url_token');

	}
}