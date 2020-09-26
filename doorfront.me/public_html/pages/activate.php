<?php
defined('ROOT') || die();

$email = (isset($parameters[0])) ? $parameters[0] : false;
$activation_code = (isset($parameters[1])) ? $parameters[1] : false;

if(!$email || !$activation_code) redirect();

/* Check if the activation code is correct */
$stmt = $database->prepare("SELECT `user_id` FROM `users` WHERE `email` = ? AND `email_activation_code` = ?");
$stmt->bind_param('ss', $email, $activation_code);
$stmt->execute();
$stmt->store_result();
$num_rows = $stmt->num_rows;
$stmt->fetch();
$stmt->close();

if($num_rows > 0) {
    $stmt = $database->prepare("UPDATE `users` SET `active` = 1 WHERE `email` = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->close();

    $_SESSION['success'][] = $language->global->success_message->account_activated;

    redirect('login');
} else {
    redirect();
}
