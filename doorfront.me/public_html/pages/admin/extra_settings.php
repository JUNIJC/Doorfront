<?php defined('ROOT') || die() ?>

<h4><?= $language->admin_extra_settings->header ?></h4>

<div class="card card-shadow">
    <div class="card-body">
        <p class="text-muted"><?= $language->admin_extra_settings->display->main_link_types_help ?></p>

        <table class="table table-hover">
            <thead class="thead-inverse">
            <tr>
                <th>#</th>
                <th><?= $language->admin_extra_settings->table->content ?></th>
                <th><?= $language->admin_extra_settings->table->icon ?></th>
                <th><?= $language->admin_extra_settings->table->actions ?></th>
            </tr>
            </thead>
            <tbody id="results">

            <?php while($data = $result->fetch_object()): ?>

                <tr>
                    <td><?= $data->id ?></td>
                    <td><i class="<?= $data->icon ?>"></i> <?= $data->content ?></td>
                    <td><?= $data->icon ?></td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#edit" class="no-underline" data-id="<?= $data->id ?>" data-content="<?= $data->content ?>" data-icon="<?= $data->icon ?>"><?= $language->global->edit ?></a>
                        <a data-confirm="<?= $language->global->info_message->confirm_delete ?>" href="admin/extra-settings/delete/<?= $data->id . '/' . Security::csrf_get_session_token('url_token') ?>" class="no-underline"><?= $language->global->delete ?></a>
                    </td>
                </tr>

            <?php endwhile ?>

            <tr>
                <td colspan="4">
                <form class="form-inline" action="" method="post" role="form">
                    <input type="hidden" name="form_token" value="<?= Security::csrf_get_session_token('form_token') ?>" />

                    <div class="mr-4">
                        <i class="fa fa-plus fa-1x"></i>
                    </div>
                    <div class="form-group mr-4">
                        <input type="text" name="content" class="form-control" placeholder="<?= $language->admin_extra_settings->input->content ?>" value="" />
                    </div>

                    <div class="form-group mr-4">
                        <input type="text" name="icon" class="form-control" placeholder="<?= $language->admin_extra_settings->input->icon ?>" value="" />
                    </div>

                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary btn-sm"><?= $language->global->submit_button ?></button>
                    </div>
                </form>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="card card-shadow mt-3">
    <div class="card-body">
        <h5><?= $language->admin_extra_settings->display->available_buttons ?></h5>
        <p class="text-muted"><?= $language->admin_extra_settings->display->available_buttons_help ?></p>

        <form action="" method="post" role="form">
            <input type="hidden" name="form_token" value="<?= Security::csrf_get_session_token('form_token') ?>" />

            <input type="hidden" name="type" value="available_buttons_edit" />

            <div class="form-group">
                <textarea class="form-control" name="available_buttons" style="height: 15rem;"><?= file_get_contents(ROOT . 'core/data/available_buttons.json') ?></textarea>
            </div>

            <div class="text-center mt-5">
                <button type="submit" name="submit" class="btn btn-primary btn-sm"><?= $language->global->submit_button ?></button>
            </div>
        </form>
    </div>
</div>

<div class="card card-shadow mt-3">
    <div class="card-body">
        <h5><?= $language->admin_extra_settings->display->available_themes ?></h5>
        <p class="text-muted"><?= $language->admin_extra_settings->display->available_themes_help ?></p>

        <form action="" method="post" role="form">
            <input type="hidden" name="form_token" value="<?= Security::csrf_get_session_token('form_token') ?>" />

            <input type="hidden" name="type" value="available_themes_edit" />

            <div class="form-group">
                <textarea class="form-control" name="available_themes" style="height: 15rem;"><?= file_get_contents(ROOT . 'core/data/available_themes.json') ?></textarea>
            </div>

            <div class="text-center mt-5">
                <button type="submit" name="submit" class="btn btn-primary btn-sm"><?= $language->global->submit_button ?></button>
            </div>
        </form>
    </div>
</div>
