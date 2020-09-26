<?php
/* Check if the page has a custom title and use if, if not proceed with the default process */
switch($page) {
	case 'profile'	:	$page_title = $profile_account->name . ' ( ' . $profile_account->username . ' )';	break;
	case 'page'		:	$page_title = $custom_page->title;	break;

	default:
		/* Check if we are going to use a prefix for the language or not */
		$language_string = (defined('ADMIN_PAGE')) ? 'admin_' . $page : $page;

		/* Check if the default is viable and use it */
		$page_title = (isset($language->$language_string->title)) ? $language->$language_string->title : $page;
}

$page_title .= ' - ' . $settings->title;
