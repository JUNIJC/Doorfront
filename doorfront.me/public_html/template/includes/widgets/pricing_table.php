<?php defined('ROOT') || die() ?>

<?php Security::csrf_set_session_token('url_token') ?>

<div class="d-flex justify-content-around row">

    <div class="col-12 col-md-5 mb-5">
        <div class="card border-0 p-2">
            <div class="card-body text-center">

                <div class="pricing-card-header-text mb-4"><?= $language->pricing_table->display->free_account ?></div>

                <div class="mb-4">
                    <span class="pricing-card-price pricing-card-header-text-free"><?= $language->pricing_table->display->free_account_pricing ?></span>

                    <span class="pricing-card-price-currency">

                    </span>
                </div>

                <div class="mb-5">
                    <span><?= $language->pricing_table->free->one ?></span>
                    <hr />

                    <span><?= $language->pricing_table->free->two ?></span>
                    <hr />

                    <span><?= $language->pricing_table->free->three ?></span>
                    <hr />

                    <span><?= $language->pricing_table->free->four ?></span>
                    <hr />

                    <span><?= $language->pricing_table->free->five ?></span>
                </div>

                <?php if(User::logged_in()): ?>
                    <a href="dashboard" class="btn btn-primary border-0"><?= $language->pricing_table->display->dashboard ?></a>
                <?php else: ?>
                    <a href="register" class="btn btn-primary border-0"><?= $language->pricing_table->display->register ?></a>
                <?php endif ?>
            </div>
        </div>
    </div>


    <div class="col-12 col-md-5">
        <div class="card border-0 p-2 pricing-card-pro text-white">
            <div class="card-body text-center">

                <div class="pricing-card-header-text mb-4"><?= $language->pricing_table->display->pro_account ?></div>

                <div class="mb-4">
                    <span class="pricing-card-price"><?= $settings->store_pro_price_month ?></span>

                    <span class="pricing-card-price-currency">
                        <?= $settings->store_currency ?>
                    </span>
                </div>

                <div class="mb-5">
                    <span><strong><?= $language->pricing_table->pro->zero ?></strong></span>
                    <hr />

                    <span><?= $language->pricing_table->pro->one ?></span>
                    <hr />

                    <span><?= $language->pricing_table->pro->two ?></span>
                    <hr />

                    <span><?= $language->pricing_table->pro->three ?></span>
                    <hr />

                    <span><?= $language->pricing_table->pro->four ?></span>
                </div>


                <div class="d-flex justify-content-around">
                    <div class="input-group">
                        <select id="purchase_package" class="custom-select border-0">
                            <option value="month" selected>
                                <?= sprintf($language->pricing_table->prices->monthly, $settings->store_currency . ' ' . $settings->store_pro_price_month) ?>
                            </option>
                            <option value="year">
                                <?= sprintf($language->pricing_table->prices->yearly, $settings->store_currency . ' ' . $settings->store_pro_price_year) ?>
                            </option>
                        </select>

                        <div class="input-group-append">
                            <a href="" id="purchase_link" data-logged-in="<?= User::logged_in() ? 1 : 0 ?>" data-confirm="<?= User::logged_in() ? $language->store->confirm_purchase : $language->store->logged_out_confirm ?>" class="btn btn-light border-0 bg-white"><i class="fa fa-unlock-alt"></i> <?= $language->pricing_table->display->purchase ?></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
$(document).ready(() => {
    let update_purchase_link = () => {
        let purchase_package = $('#purchase_package').find(':selected').val();
        let purchase_link = `store/purchase/${purchase_package}/<?= Security::csrf_get_session_token('url_token') ?>`;
        let is_logged_in = $('#purchase_link').data('logged-in');

        if(is_logged_in) {
            $('#purchase_link').attr('href', purchase_link);
        }
    }

    update_purchase_link();

    $('#purchase_package').on('change', update_purchase_link);
})
</script>
