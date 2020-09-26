<?php
defined('ROOT') || die();
User::check_permission(1);

$page_id = (isset($parameters[0])) ? (int) $parameters[0] : false;

/* Make sure the page exists before moving forward */
if(!$page = Database::get('*', 'pages', ['page_id' => $page_id])) {
    $_SESSION['error'][] = $language->admin_page_edit->error_message->invalid_page;
    User::get_back('admin/pages-management');
}


if(!empty($_POST)) {
    /* Filter some the variables */
    if(strpos($_POST['url'], 'http://') !== false || strpos($_POST['url'], 'https://') !== false) {
        $_POST['url']	= Database::clean_string($_POST['url']);
    } else {
        $_POST['url']	= generate_slug(Database::clean_string($_POST['url']), '-');
    }
    $_POST['title'] = Database::clean_string($_POST['title']);
    $_POST['position'] = (in_array($_POST['position'], ['1', '0'])) ? $_POST['position'] : '0';
    $_POST['description'] = addslashes($_POST['description']);

    if(!Security::csrf_check_session_token('form_token', $_POST['form_token'])) {
        $_SESSION['error'][] = $language->global->error_message->invalid_token;
    }

    if(empty($_SESSION['error'])) {

        /* Update the database */
        $database->query("UPDATE `pages` SET `title` = '{$_POST['title']}', `url` = '{$_POST['url']}', `description` = '{$_POST['description']}', `position` = '{$_POST['position']}' WHERE `page_id` = {$page_id}");

        /* Set a nice success message */
        $_SESSION['success'][] = $language->global->success_message->basic;

        /* Update the current settings */
        $page = Database::get('*', 'pages', ['page_id' => $page_id]);

    }

    display_notifications();
}
?>

<div class="card card-shadow">
    <div class="card-body">

        <h4 class="d-flex justify-content-between">
            <div class="d-flex">
                <span class="mr-3"><?= $language->admin_page_edit->header ?></span>

                <?= User::admin_generate_buttons('page', $page_id) ?>
            </div>

            <div><?= User::generate_go_back_button('admin/pages-management') ?></div>
        </h4>

        <form action="" method="post" role="form">
            <input type="hidden" name="form_token" value="<?= Security::csrf_get_session_token('form_token') ?>" />

            <div class="form-group">
                <label><?= $language->admin_page_edit->input->title ?></label>
                <input type="text" name="title" class="form-control" value="<?= $page->title ?>" />
            </div>

            <div class="form-group">
                <label><?= $language->admin_page_edit->input->url ?></label>
                <input type="text" name="url" class="form-control" value="<?= $page->url ?>" />
            </div>

            <div class="form-group">
                <label><?= $language->admin_page_edit->input->description ?></label>
                <textarea id="description" name="description" class="form-control"><?= $page->description ?></textarea>
            </div>

            <div class="form-group">
                <label><?= $language->admin_page_edit->input->position ?></label>
                <select class="form-control" name="position">
                    <option value="1" <?php if($page->position == '1') echo 'selected="true"' ?>><?= $language->admin_page_edit->input->position_top ?></option>
                    <option value="0" <?php if($page->position == '0') echo 'selected="true"' ?>><?= $language->admin_page_edit->input->position_bottom ?></option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary"><?= $language->global->submit_button ?></button>
            </div>

        </form>
    </div>
</div>
<script src="template/js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
    tinymce.init({
        selector: '#description',
        plugins: 'preview fullpage autolink directionality code visualblocks visualchars fullscreen image link media codesample table hr pagebreak nonbreaking toc advlist lists imagetools',
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent | removeformat',
    });
</script>
