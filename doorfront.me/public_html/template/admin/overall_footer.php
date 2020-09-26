<?php defined('ROOT') || die() ?>

        <hr />

        <div class="mb-5">
            <span class="text-muted"><?= 'Copyright &copy; ' . date('Y') . ' ' . $settings->title . '. All rights reserved. Product by <a href="https://codecanyon.net/user/altumcode">AltumCode</a>' ?></span>
        </div>

        </div>
    </body>
</html>





<?php if($page == 'extra_settings'): ?>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" role="form">
                <div class="modal-header">
                    <h5 class="modal-title"><?= $language->admin_extra_settings->edit_modal_header ?></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" value="" />
                    <input type="hidden" class="form-control" name="type" value="edit" />
                    <input type="hidden" name="form_token" value="<?= Security::csrf_get_session_token('form_token') ?>" />

                    <div class="form-group">
                        <input type="text" class="form-control" name="content" placeholder="<?= $language->admin_extra_settings->input->content ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="icon" placeholder="<?= $language->admin_extra_settings->input->icon ?>">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language->global->close ?></button>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary"><?= $language->global->submit_button ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#edit').on('show.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let content = button.data('content');
        let icon = button.data('icon');
        let id = button.data('id');
        let modal = $(event.currentTarget);

        modal.find('.modal-body input[name="id"]').val(id);
        modal.find('.modal-body input[name="content"]').val(content);
        modal.find('.modal-body input[name="icon"]').val(icon);
    })
</script>
<?php endif ?>

	</body>
</html>
