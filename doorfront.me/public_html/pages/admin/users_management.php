<?php
defined('ROOT') || die();
User::check_permission(1);

$type 		= (isset($parameters[0])) ? $parameters[0] : false;
$user_id 	= (isset($parameters[1])) ? $parameters[1] : false;
$url_token 	= (isset($parameters[2])) ? $parameters[2] : false;

if(isset($type) && $type == 'delete') {

    /* Check for errors and permissions */
    if(!Security::csrf_check_session_token('url_token', $url_token)) {
        $_SESSION['error'][] = $language->global->error_message->invalid_token;
    }
    if($user_id == $account_user_id) {
        $_SESSION['error'][] = $language->admin_users_management->error_message->self_delete;
    }
    if(Database::simple_get('type', 'users', ['user_id' => $account_user_id]) < 1) {
        $_SESSION['error'][] = $language->global->error_message->command_denied;
    }

    if(empty($_SESSION['error'])) {
        User::delete_user($user_id);

        $_SESSION['success'][] = $language->global->success_message->basic;
    }

    display_notifications();

}

?>

<div class="card card-shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table id="results" class="table">
                <thead class="thead-dark">
                <tr>
                    <th><?= $language->admin_users_management->table->username ?></th>
                    <th><?= $language->admin_users_management->table->name ?></th>
                    <th><?= $language->admin_users_management->table->email ?></th>
                    <th><?= $language->admin_users_management->table->active ?></th>
                    <th><?= $language->admin_users_management->table->registration_date ?></th>
                    <th></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<input type="hidden" name="url" value="<?= $settings->url . 'processing/admin/users_management_ajax.php' ?>" />
<input type="hidden" name="form_token" value="<?= Security::csrf_get_session_token('form_token') ?>" />


<script>
    $(document).ready(() => {
        let datatable = $('#results').DataTable({
            language: <?= json_encode($language->datatable) ?>,
            serverSide: true,
            processing: true,
            ajax: {
                url: $('[name="url"]').val(),
                type: 'POST'
            },
            lengthMenu: [[25, 50, 100], [25, 50, 100]],
            columns: [
                {
                    data: 'username',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'name',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'email',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'active',
                    searchable: false,
                    sortable: true
                },
                {
                    data: 'date',
                    searchable: false,
                    sortable: true
                },
                {
                    data: 'actions',
                    searchable: false,
                    sortable: false
                }
            ],
            responsive: true,
            drawCallback: () => {
                $('[data-toggle="tooltip"]').tooltip();
            },
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5 text-muted'i><'col-sm-12 col-md-7'p>>"
        });

    });
</script>
