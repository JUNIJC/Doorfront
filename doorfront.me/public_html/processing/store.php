<?php
defined('ROOT') || die();;
User::check_permission(0);

$method 	= (isset($parameters[0])) ? $parameters[0] : false;
$package 	= (isset($parameters[1])) ? $parameters[1] : false;
$url_token 	= (isset($parameters[2])) ? $parameters[2] : false;

if($method == 'purchase' && $package && $url) {
    $account->points = (int) $account->points;
    $allowed_packages = ['month', 'year'];

    switch($package) {
        case 'month' :
            $price = $settings->store_pro_price_month;
        break;

        case 'year' :
            $price = $settings->store_pro_price_year;
        break;
    }



    /* Check for other errors and permissions */
    if($account->pro) {
        $_SESSION['info'][] = $language->store->info_message->already_pro;
    }
    if(!in_array($package, $allowed_packages)) {
        $_SESSION['error'][] = $language->store->error_message->allowed_packages;
    }
	if(!Security::csrf_check_session_token('url_token', $url_token)) {
		$_SESSION['error'][] = $language->global->error_message->invalid_token;
	}
    if($account->points < $price) {
        $_SESSION['info'][] = $language->store->error_message->not_enough_funds;
    }

    /* If there are no erros, proceed with the purchasing process */
    if(empty($_SESSION['error']) && empty($_SESSION['info'])) {
        /* Doing the necessary database changes to the database */
        switch($package) {

            /* Monthly package */
            case 'month' :

                Database::update(
                    'users',
                    [
                        'points' => $account->points - $price,
                        'pro' => '1',
                        'pro_due_date' => (new DateTime())->modify('+30 day')->format('Y-m-d H:i:s'),
                        'pro_due_date_notified' => '0'
                    ],
                    ['user_id' => $account_user_id]
                );

            break;

            /* Yearly package */
            case 'year' :

                Database::update(
                    'users',
                    [
                        'points' => $account->points - $price,
                        'pro' => '1',
                        'pro_due_date' => (new DateTime())->modify('+365 day')->format('Y-m-d H:i:s'),
                        'pro_due_date_notified' => '0'
                    ],
                    ['user_id' => $account_user_id]
                );

            break;
        }

        /* Update the account variable */
        $account = Database::get('*', 'users', ['user_id' => $account_user_id]);

        /* Display a success message */
        $_SESSION['success'][] = $language->store->success_message->purchased;
    }

}


/* Get the transactions if any  */
$account_transactions_result = $database->query("SELECT * FROM `payments` WHERE `user_id` = {$account_user_id} ORDER BY `id` DESC");

/* Check for available methods of payment */
$payment_methods = [];

if(!empty($settings->store_paypal_client_id) && !empty($settings->store_paypal_secret)) {
    $payment_methods['paypal'] = '<strong><a href="store-pay-paypal">PayPal</a></strong>';
}

if(!empty($settings->store_stripe_publishable_key) && !empty($settings->store_stripe_secret_key)) {
    $payment_methods['stripe'] = '<strong><a href="store-pay-stripe">Stripe</a></strong>';
}
