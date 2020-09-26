<?php
ob_start();
session_start();

/* Initialize some needed constants */
define('SCRIPT_VERSION', '1.5.0');
define('DEBUG', 0);
define('MYSQL_DEBUG', 0);
define('ROOT', realpath(__DIR__ . '/..') . '/');
define('PAGES_ROUTE', 'pages/');
define('TEMPLATE_ROUTE', 'template/');
define('PROCESSING_ROUTE', 'processing/');
define('UPLOADS_ROUTE', 'uploads/');
define('AVATARS_ROUTE', UPLOADS_ROUTE . 'avatars/');
define('AVATARS_THUMBS_ROUTE', UPLOADS_ROUTE . 'avatars/thumbs/');

/* Error reportings */
if(DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

/* Includes */
require_once 'config/config.php';
require_once 'classes/Database.php';
require_once 'database/connect.php';
require_once 'functions/general.php';
require_once 'classes/User.php';
require_once 'classes/Csrf.php';
require_once 'classes/Security.php';
require_once 'classes/Response.php';
require_once 'classes/Captcha.php';
require_once 'classes/DataTable.php';
require_once ROOT . 'vendor/autoload.php';

/* Mysql profiling */
if(MYSQL_DEBUG) {
    $database->query("set profiling_history_size=100");
    $database->query("set profiling=1");
}

/* Initialize variables */
$url 					= parse_url_parameters();
$errors 				= [];
$settings 				= $database->query("SELECT * FROM `settings` WHERE `id` = 1")->fetch_object();
$settings->url          = $config['url'];
$container_fluid_pages  = ['profile_settings'];
$dark_pages             = ['login', 'register', 'index', 'lost_password', 'resend_activation', 'pro'];
$pre_processing_pages	= ['extra_settings', 'out', 'account_settings', 'dashboard', 'page', 'profile', 'pages_management', 'index', 'paypal', 'store', 'stripe', 'user_edit'];
$user_logged_in			= false;
$account_user_id        = '';
$route = '';

/* Language processing */
require_once 'functions/language.php';

/* Determine the route */
if(isset($url[0])) {

	if($url[0] == 'admin') {
		$route = 'admin/';
		unset($url[0]);
		define('ADMIN_PAGE', true);
	} else {
		$route = '';
	}

}

/* Get all the available pages in the specific route */
$pages = glob(PAGES_ROUTE . $route . '*.php');
$pages = preg_replace('(' . PAGES_ROUTE . $route . '|.php)', '', $pages);

$page = (isset($url[key($url)])) ? htmlspecialchars(current($url), ENT_QUOTES) : 'index';


/* Custom pages names */
$custom_pages = [
	'account-settings'		=>	'account_settings',
	'profile-settings'		=>	'profile_settings',
	'store-pay-paypal'		=>	'paypal',
	'store-pay-stripe'		=> 	'stripe',
	'lost-password'			=>	'lost_password',
	'reset-password'		=>  'reset_password',
	'resend-activation'		=>	'resend_activation',

    'payments-list'		    =>	'payments_list',
    'users-management'		=>	'users_management',
	'user-edit'				=>	'user_edit',
    'user-view'				=>	'user_view',
    'pages-management'		=>	'pages_management',
	'page-edit'				=>	'page_edit',
	'photos-management'		=>	'photos_management',
	'website-settings'		=>	'website_settings',
    'extra-settings'        =>  'extra_settings',
	'website-statistics'	=>	'website_statistics',
];

/* Determine if the current page has a custom url and change it if needed */
$page = (array_key_exists($page, $custom_pages)) ? $custom_pages[$page] : $page;

/* Determine if the page is available or not */
if(!in_array($page, $pages)) {

	/* If the page is not available, check if it's a profile page */
	if(Database::exists('username', 'users', ['username' => $page])) {
        $profile_username = Database::clean_string($page);
		$page = 'profile';
		$route = 'profile/';
	}

	else {
        $route = '';
        $page = 'not_found';
    }
}

/* Get the rest of the parameters, if any */
unset($url[key($url)]);
$parameters = $url ? array_values($url) : [];

/* Set the default timezone */
date_default_timezone_set($settings->time_zone);

/* Other useful vars */
$date = (new \DateTime())->format('Y-m-d H:i:s');

/* If user is logged in get his data */
if(User::logged_in()) {

	$account = Database::get('*', 'users', ['user_id' => $account_user_id]);

	if(!$account) {
	    User::logout();
    }

    /* Update last activity */
    Database::update('users', ['last_activity' => $date], ['user_id' => $account_user_id]);

    /* Generate the login csrf token */
    if($page !== 'not_found') Security::csrf_set_session_token('dynamic');


    Security::csrf_set_session_token('url_token');
    Security::csrf_set_session_token('form_token');
}

/* Include the preprocessing if needed */
if(in_array($page, $pre_processing_pages)) include PROCESSING_ROUTE . $route . $page . '.php';

/* Establish the title of the page */
require_once 'functions/titles.php';
