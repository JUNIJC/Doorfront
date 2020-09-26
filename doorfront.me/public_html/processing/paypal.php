<?php
defined('ROOT') || die();;

if(empty($settings->store_paypal_client_id) || empty($settings->store_paypal_secret)) {
    $_SESSION['info'][] = $language->store->info_message->paypal_not_available;
    User::get_back('store');
}


use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;


if (isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID']) && $_GET['success'] == 'true') {

    $paypal = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential($settings->store_paypal_client_id, $settings->store_paypal_secret)
    );

    $paypal->setConfig(['mode' => $settings->store_paypal_mode]);

    $payment_id = $_GET['paymentId'];
    $payer_id = $_GET['PayerID'];

    /* First make sure the payment is not already existing */
    if(Database::exists(['id'], 'payments', ['payment_id' => $payment_id, 'payer_id' => $payer_id])) {
        redirect('store');
    }

    try {
        $payment = Payment::get($payment_id, $paypal);

        $payer_info = $payment->getPayer()->getPayerInfo();
        $payer_email = $payer_info->getEmail();
        $payer_name = $payer_info->getFirstName() . ' ' . $payer_info->getLastName();

        $transactions = $payment->getTransactions();
        $amount = $transactions[0]->getAmount();
        $amount_total = $amount->getTotal();
        $amount_currency = $amount->getCurrency();

        $execute = new PaymentExecution();
        $execute->setPayerId($payer_id);

        $result = $payment->execute($execute, $paypal);

    } catch (Exception $e) {
        $data = json_decode($e->getData());
    }

    /* If the $data variable is not set, there is no error in the payment processing */
    if (!isset($data)) {
        $date = (new DateTime())->format('Y-m-d H:i:s');

        /* Add a log into the database */
        Database::insert(
            'payments',
            [
                'user_id' => $account_user_id,
                'type' => 'PAYPAL',
                'payment_id' => $payment_id,
                'payer_id' => $payer_id,
                'name' => $payer_name,
                'amount' => $amount_total,
                'currency' => $amount_currency,
                'date' => $date
            ]
        );

        /* Update the users balance */
        $updated_total_points = (int) $account->points + $amount_total;
        Database::update(
            'users',
            [
                'points' => $updated_total_points
            ],
            [
                'user_id' => $account_user_id
            ]
        );

        /* Set a success message */
        $_SESSION['success'][] = $language->store->success_message->paid;

    } /* IF there was an error, display something to the user */
    else {
        $_SESSION['error'][] = $language->store->error_message->normal;
    }
}

/* In case of cancel return url */
if (isset($_GET['success']) && $_GET['success'] == 'false') {
    $_SESSION['info'][] = $language->store->info_message->canceled;
}
