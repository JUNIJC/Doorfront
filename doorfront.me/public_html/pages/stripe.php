<?php
defined('ROOT') || die();

/* Init stripe */
\Stripe\Stripe::setApiKey($settings->store_stripe_secret_key);

?>

<div class="d-flex justify-content-center">
    <div class="card card-shadow animated fadeIn col-xs-12 col-sm-10 col-md-5">
        <div class="card-body">


            <h4 class="d-flex justify-content-between">
                <?= $language->store->stripe->header ?>
                <small><?= User::generate_go_back_button('store') ?></small>
            </h4>


            <form id="stripe_form" action="store-pay-stripe" method="post" role="form">
                <div class="form-group mt-5">
                    <label><?= $language->store->stripe->amount ?></label>

                    <input type="hidden" name="stripeToken" />
                    <input type="hidden" name="stripeEmail" />

                    <select class="form-control" name="amount">
                        <option value="1">1</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>

                <button id="pay" class="mt-5 btn btn-default btn-block"><?= $language->store->button->pay ?></button>
            </form>


        </div>
    </div>
</div>

<script src="https://checkout.stripe.com/checkout.js"></script>

<script>
    let stripe = StripeCheckout.configure({
        key: '<?= $settings->store_stripe_publishable_key ?>',
        description: '<?= $language->store->stripe->description ?>',
        currency: '<?= $settings->store_currency ?>',
        locale: 'auto',
        name: '<?= $settings->title ?>',
        token: (token) => {
            $('input[name="stripeToken"]').val(token.id);
            $('input[name="stripeEmail"]').val(token.email);

            $('#stripe_form')[0].submit();
        }
    });

    $('#pay').on('click', event => {

        let amount = $('select[name="amount"]').val();

        stripe.open({
            amount: amount * 100
        });

        event.preventDefault();
    })
</script>
