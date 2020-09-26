<?php
$user_id = (isset($parameters[0])) ? (int) $parameters[0] : false;
$type = (isset($parameters[1]) && in_array($parameters[1], ['main_link', 'social'])) ? $parameters[1] : false;
$type_id = (isset($parameters[2])) ?  $parameters[2] : false;
$url_token = (isset($parameters[3])) ?  $parameters[3] : false;


if(!$user_id || !$type || !$type_id || !$url_token || ($url_token && !Security::csrf_check_session_token('url_token', $url_token))) {
    redirect();
}

/* Get the user's details */
switch($type) {
    case 'main_link':

        $type_id = (int) $type_id;
        $redirect_url = Database::simple_get('main_link', 'users', ['user_id' => $user_id]);

        if(!$redirect_url) {
            redirect();
        }

    break;

    case 'social':

        $available_buttons = get_json_data('available_buttons');

        if(array_key_exists($type_id, $available_buttons)) {
            $type_id = Database::clean_string($type_id);
        } else {
            redirect();
        }

        /* Get the proper redirect url */
        $profile_buttons = json_decode(Database::simple_get('buttons', 'users', ['user_id' => $user_id]));

        if($profile_buttons) {
            foreach ($profile_buttons as $key => $value) {
                /* Get it from the mysql */
                $profile_buttons->{$key} = (object) array_merge(['user' => $profile_buttons->{$key}], (array) $available_buttons->{$key});
            }
        } else {
            redirect();
        }

        /* Generate the redirect url */

        $redirect_url = sprintf($profile_buttons->{$type_id}->url, $profile_buttons->{$type_id}->user);


    break;
}

/* Some needed vars */
$date = (new DateTime())->format('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];

$hit = $database->query("SELECT `date` FROM `hits` WHERE `type` = '{$type}' AND `type_id` = '{$type_id}' AND `user_id` = {$user_id} ORDER BY `id` DESC")->fetch_object();


/* Insert hit into database if no errors */
if(!$hit || ($hit && (new \DateTime())->modify('-'.$settings->profile_hit_timing.' hours') > (new \DateTime($hit->date)))) {

    $database->query("INSERT INTO `hits` (`type`, `type_id`, `user_id`, `date`, `ip`) VALUES ('{$type}', '{$type_id}', {$user_id}, '{$date}', '{$ip}')");

}


if(isset($redirect_url) && $redirect_url != '') {
    header('Location: '. $redirect_url);
} else {
    redirect();
}