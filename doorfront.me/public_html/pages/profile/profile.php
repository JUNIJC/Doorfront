<?php
defined('ROOT') || die();

switch($profile_account->template) {
    case 'one'      : include_once 'profile_template_one.php'; break;
    case 'two'      : include_once 'profile_template_two.php'; break;
    case 'three'    : include_once 'profile_template_three.php'; break;
}
