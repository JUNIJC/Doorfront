<?php
defined('ROOT') || die();

display_notifications();
?>

<div class="card card-shadow">
    <div class="card-body">

        <h4 class="d-flex justify-content-between">
            <?= $language->store->header ?>

            <?php if(!$account->pro): ?>

                <a href="pro" class="btn btn-primary btn-sm"><i class="fa fa-unlock-alt"></i> <?= $language->store->display->go_pro ?></a>

            <?php endif ?>
        </h4>

        <div>
            <?= sprintf($language->store->display->state, $account->points) ?>

            <?php if(!empty($payment_methods)): ?>
                <?= sprintf($language->store->display->add_funds, implode(', ', $payment_methods)) ?>
            <?php endif ?>
        </div>

        <small class="text-muted"><?= sprintf($language->store->display->info, $settings->store_currency) ?></small>

    </div>
</div>

<div class="card card-shadow mt-3">
    <div class="card-body">

        <h4><?= $language->store->header_transactions ?></h4>

        <?php if($account_transactions_result->num_rows): ?>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th><?= $language->store->table->nr ?></th>
                        <th><?= $language->store->table->type ?></th>
                        <th><?= $language->store->table->email ?></th>
                        <th><?= $language->store->table->name ?></th>
                        <th><?= $language->store->table->amount ?></th>
                        <th><?= $language->store->table->date ?></th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php $nr = 1; while($data = $account_transactions_result->fetch_object()): ?>
                        <tr>
                            <td><?= $nr++ ?></td>
                            <td><?= $data->type ?></td>
                            <td><?= $data->email ?></td>
                            <td><?= $data->name ?></td>
                            <td><span class="text-success"><?= $data->amount ?></span> <?= $data->currency ?></td>
                            <td><span data-toggle="tooltip" title="<?= $data->date ?>"><?= (new DateTime($data->date))->format('Y-m-d') ?></span></td>
                        </tr>
                    <?php endwhile ?>

                    </tbody>
                </table>
            </div>

        <?php else: ?>
            <?= $language->store->info_message->no_transactions ?>
        <?php endif ?>

    </div>
</div>

