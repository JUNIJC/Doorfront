<?php
defined('ROOT') || die();
User::check_permission(1);
?>

<div class="card card-shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table id="results" class="table">
                <thead class="thead-dark">
                <tr>
                    <th><?= $language->admin_payments_list->table->username ?></th>
                    <th><?= $language->admin_payments_list->table->type ?></th>
                    <th><?= $language->admin_payments_list->table->email ?></th>
                    <th><?= $language->admin_payments_list->table->name ?></th>
                    <th><?= $language->admin_payments_list->table->amount ?></th>
                    <th><?= $language->admin_payments_list->table->date ?></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>


<input type="hidden" name="url" value="<?= $settings->url . 'processing/admin/payments_list_ajax.php' ?>" />
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
                    data: 'type',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'email',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'name',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'amount',
                    searchable: false,
                    sortable: true
                },
                {
                    data: 'date',
                    searchable: false,
                    sortable: true
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

