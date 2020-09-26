<?php
defined('ROOT') || die();
User::check_permission(1);

$user_id = (isset($parameters[0])) ? (int) $parameters[0] : false;

/* Check if user exists */
if(!$profile_account = Database::get('*', 'users', ['user_id' => $user_id])) {
    $_SESSION['error'][] = $language->admin_user_edit->error_message->invalid_account;
    User::get_back('admin/users-management');
}

$profile_transactions = $database->query("SELECT * FROM `payments` WHERE `user_id` = {$user_id} ORDER BY `id` DESC");

?>

<div class="card card-shadow">
    <div class="card-body">

        <h4 class="d-flex justify-content-between">
            <div class="d-flex">
                <span class="mr-3"><?= $language->admin_user_view->header ?></span>

                <?= User::admin_generate_buttons('user', $profile_account->user_id) ?>
            </div>

            <div><?= User::generate_go_back_button('admin/users-management') ?></div>
        </h4>

        <div class="row mt-md-3">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold"><?= $language->admin_user_view->input->username ?></label>
                    <input type="text" class="form-control-plaintext" value="<?= $profile_account->username ?>" readonly />
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold"><?= $language->admin_user_view->input->name ?></label>
                    <input type="text" class="form-control-plaintext" value="<?= $profile_account->name ?>" readonly />
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold"><?= $language->admin_user_view->input->email ?></label>
                    <input type="text" class="form-control-plaintext" value="<?= $profile_account->email ?>" readonly />
                </div>
            </div>
        </div>

        <div class="row mt-md-3">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold"><?= $language->admin_user_view->input->last_activity ?></label>
                    <input type="text" class="form-control-plaintext" value="<?= $profile_account->last_activity ? (new \DateTime($profile_account->last_activity))->format('Y-m-d H:i:s') : '-' ?>" readonly />
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold"><?= $language->admin_user_view->input->status ?></label>
                    <input type="text" class="form-control-plaintext" value="<?= $profile_account->active ? $language->admin_user_view->input->status_active : $language->admin_user_view->input->status_disabled ?>" readonly />
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold"><?= $language->admin_user_view->input->points ?></label>
                    <input type="text" class="form-control-plaintext" value="<?= $profile_account->points ?>" readonly />
                </div>
            </div>
        </div>


        <div class="row mt-md-3">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold"><?= $language->admin_user_view->input->pro ?></label>
                    <input type="text" class="form-control-plaintext" value="<?= $profile_account->pro ? $language->global->yes : $language->global->no ?>" readonly />
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold"><?= $language->admin_user_view->input->pro_due_date ?></label>
                    <input type="text" class="form-control-plaintext" value="<?= $profile_account->pro_due_date ?>" readonly />
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold"><?= $language->admin_user_view->input->pro_trial_done ?></label>
                    <input type="text" class="form-control-plaintext" value="<?= $profile_account->pro_trial_done ? $language->global->yes : $language->global->no ?>" readonly />
                </div>
            </div>
        </div>

    </div>
</div>


<div class="card card-shadow mt-3">
    <div class="card-body">

        <h4><?= $language->admin_user_view->header_transactions ?></h4>

        <?php if($profile_transactions->num_rows): ?>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th><?= $language->admin_user_view->table->nr ?></th>
                        <th><?= $language->admin_user_view->table->type ?></th>
                        <th><?= $language->admin_user_view->table->email ?></th>
                        <th><?= $language->admin_user_view->table->name ?></th>
                        <th><?= $language->admin_user_view->table->amount ?></th>
                        <th><?= $language->admin_user_view->table->date ?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $nr = 1; while($data = $profile_transactions->fetch_object()): ?>
                        <tr>
                            <td><?= $nr++ ?></td>
                            <td><?= $data->type ?></td>
                            <td><?= $data->email ?></td>
                            <td><?= $data->name ?></td>
                            <td><span class="text-success"><?= $data->amount ?></span> <?= $data->currency ?></td>
                            <td><span data-toggle="tooltip" title="<?= $data->date ?>"><?= (new DateTime($data->date))->format('Y-m-d H:i:s') ?></span></td>
                        </tr>
                    <?php endwhile ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>
            <?= $language->admin_user_view->info_message->no_transactions ?>
        <?php endif ?>

    </div>
</div>
