<?php
defined('ROOT') || die();;

/* If user exists -> get his profile data | if not, set an error */
if(!$profile_account = Database::get('*', 'users', ['username' => $profile_username])) {
	$_SESSION['error'][] = $language->global->error_message->invalid_account;
}

if(!empty($_SESSION['error'])) User::get_back();


/* Check pro account status */
User::check_pro($profile_account->user_id);

/* Hits */
$date = (new DateTime())->format('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];

$hit = $database->query("SELECT `date` FROM `hits` WHERE `type` = 'profile' AND `user_id` = {$profile_account->user_id} ORDER BY `id` DESC")->fetch_object();


/* Insert hit into database if no errors */
if(!$hit || ($hit && (new \DateTime())->modify('-'.$settings->profile_hit_timing.' hours') > (new \DateTime($hit->date)))) {

    $database->query("INSERT INTO `hits` (`type`, `user_id`, `date`, `ip`) VALUES ('profile', {$profile_account->user_id}, '{$date}', '{$ip}')");

}

/* Get needed json data */
$available_buttons = get_json_data('available_buttons');
$available_themes = get_json_data('available_themes');

/* Process profile buttons */
$profile_buttons = json_decode($profile_account->buttons);

if($profile_buttons) {
    foreach ($profile_buttons as $key => $value) {
        if(empty(trim($value)) || !isset($available_buttons->{$key})) {
            unset($profile_buttons->{$key});
        } else {

            /* Get it from the mysql */
            $profile_buttons->{$key} = (object) array_merge(['user' => $profile_buttons->{$key}], (array)$available_buttons->{$key});

        }
    }
} else {
    $profile_buttons = [];
}


/* Process profile background */
switch($profile_account->background_type) {
    case 'gradient':
        if(!property_exists($available_themes, $profile_account->background_value)) {
            /* If there is no background available, fall back to the default one */
            Database::update('users', ['background_value' => 'default'], ['user_id' => $profile_account->user_id]);
            $profile_account->background_value = 'default';
        };

        $profile_body_style = 'background: linear-gradient(135deg, ' . $available_themes->{$profile_account->background_value}->color1 . ' 0%, '. $available_themes->{$profile_account->background_value}->color2 . ' 100%);';
        $profile_button_style = 'background: linear-gradient(165deg, ' . $available_themes->{$profile_account->background_value}->color1 . ' 0%, ' . $available_themes->{$profile_account->background_value}->color2 . ' 100%);';
    break;

    case 'background':
        $background_path = 'template/images/available_backgrounds/'.$profile_account->background_value;

        if(!file_exists($background_path)) {
            /* If there is no background available, fall back to the default one */
            Database::update('users', ['background_value' => '#000', 'background_type' => 'color'], ['user_id' => $profile_account->user_id]);
            $profile_account->background_value = '#000';
            $profile_account->background_type = 'color';
        }

    break;

    case 'color':

        /* Check if input color is hex color */
        if(!preg_match('/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $profile_account->background_value)) {
            Database::update('users', ['background_value' => '#000', 'background_type' => 'color'], ['user_id' => $profile_account->user_id]);
            $profile_account->background_value = '#000';
            $profile_account->background_type = 'color';
        }

    break;
}

switch($profile_account->background_type) {
    case 'gradient':
        $profile_body_style = 'background: linear-gradient(135deg, ' . $available_themes->{$profile_account->background_value}->color1 . ' 0%, '. $available_themes->{$profile_account->background_value}->color2 . ' 100%);';
        $profile_button_style = 'background: linear-gradient(165deg, ' . $available_themes->{$profile_account->background_value}->color1 . ' 0%, ' . $available_themes->{$profile_account->background_value}->color2 . ' 100%);';
    break;

    case 'background':

        $profile_body_style = 'background: url(' . $background_path . ');background-size: cover;';
        $profile_button_style = '';


        break;

    case 'color':

        $profile_body_style = 'background: ' . $profile_account->background_value;
        $profile_button_style = 'background: ' . $profile_account->background_value;

    break;
}

/* Parse occupations */
if(!empty($profile_account->occupations)) {
    $profile_account->occupations_array = explode(',', $profile_account->occupations);
}

/* Parse work */
if(!empty($profile_account->companies)) {
    $profile_account->companies_array = explode(',', $profile_account->companies);
}

/* Parse knowledge */
if(!empty($profile_account->knowledge)) {
    $profile_account->knowledge_array = explode(',', $profile_account->knowledge);
}

/* Get the main link data */
$main_link = false;

if(!empty($profile_account->main_link)) {
    $main_link = Database::get(['content', 'icon', 'id'], 'main_link_types', ['id' => $profile_account->main_link_type]);

    if(!$main_link) {
        Database::update('users', ['main_link_type' => 0], ['user_id' => $profile_account->user_id]);
    }
}

Security::csrf_set_session_token('url_token');
