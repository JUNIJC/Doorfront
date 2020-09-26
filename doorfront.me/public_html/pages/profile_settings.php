<?php
defined('ROOT') || die();
User::check_permission(0);

$available_themes = get_json_data('available_themes');
$available_templates = get_json_data('available_templates');
$available_buttons = get_json_data('available_buttons');
$available_background_types = ['background', 'gradient', 'color'];

$unprocessed_files = glob(ROOT . 'template/images/available_backgrounds/*.{jpg,jpeg,png}', GLOB_BRACE);
$available_background_images = [];
foreach($unprocessed_files as $file) {
    $file = explode('/', $file);
    $available_background_images[] = end($file);
}

$available_main_link_types_result = $database->query("SELECT * FROM `main_link_types`");
while($data = $available_main_link_types_result->fetch_object()) $available_main_link_types[] = $data;

/* Process profile buttons */
$profile_buttons = json_decode($account->buttons) ?? [];

foreach ($available_buttons as $key => $value) {
    /* Get it from the mysql */
    $available_buttons->{$key} = (object) array_merge(['user' => ($profile_buttons->{$key} ?? '')], (array) $available_buttons->{$key});
}

?>

<input id="profile_settings_autosave" value="<?= $settings->profile_settings_autosave ?>" type="hidden" />

<ul class="nav nav-pills mb-3" id="main_tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-main" role="tab" aria-selected="true"><?= $language->profile_settings->display->main ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-template" role="tab" aria-selected="false"><?= $language->profile_settings->display->template ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-socials" role="tab" aria-selected="false"><?= $language->profile_settings->display->socials ?></a>
    </li>
</ul>

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-body">

                <h4 class="d-flex justify-content-between mb-5">
                    <span id="title"><?= $account->name ?></span>

                    <div class="col-sm-3">
                        <a href="<?= $settings->url . $account->username ?>" target="_blank" class="btn btn-dark btn-sm"><?= $language->profile_settings->display->visit_profile ?></a>
                    </div>
                </h4>

                <form action="<?= 'processing/process/profile_settings.php'?>" method="post" role="form" enctype="multipart/form-data">
                    <input type="hidden" name="form_token" value="<?= Security::csrf_get_session_token('form_token') ?>" />

                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-main" role="tabpanel">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label data-toggle="tooltip" title="<?= $language->profile_settings->input->avatar ?>">
                                            <img id="avatar-file-img" src="<?= User::display_image(AVATARS_THUMBS_ROUTE . $account->avatar) ?>" class="profile-settings-avatar" alt="Profile Avatar" />
                                            <input id="avatar-file-input" type="file" name="avatar" class="form-control" style="display:none;"/>
                                        </label>
                                        <p id="avatar-file-status" style="display: none;"><?= $language->profile_settings->input->avatar_selected ?></p>
                                        <div>
                                            <small class="text-muted"><?= $language->profile_settings->input->avatar_help ?></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label><?= $language->profile_settings->input->name ?></label>
                                        <input type="text" name="name" class="form-control" value="<?= $account->name ?>" />
                                    </div>

                                    <div class="form-group">
                                        <label><?= $language->profile_settings->input->about ?></label>
                                        <input type="text" name="description" class="form-control" value="<?= $account->description ?>" />
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label><?= $language->profile_settings->input->location ?></label>
                                <input type="text" name="location" class="form-control" value="<?= $account->location ?>" />
                            </div>

                            <div class="form-group">
                                <label><?= $language->profile_settings->input->occupations ?></label>
                                <input type="text" name="occupations" class="form-control" value="<?= $account->occupations ?>" data-role="tagsinput" data-maxtags="3" />
                                <small class="form-text text-muted"><?= $language->profile_settings->input->occupations_help ?></small>
                            </div>

                            <div class="form-group">
                                <label><?= $language->profile_settings->input->companies ?></label>
                                <input type="text" name="companies" class="form-control" value="<?= $account->companies ?>" data-role="tagsinput" data-maxtags="3" />
                                <small class="form-text text-muted"><?= $language->profile_settings->input->companies_help ?></small>
                            </div>

                            <div class="form-group">
                                <label><?= $language->profile_settings->input->knowledge ?></label>
                                <input type="text" name="knowledge" class="form-control" value="<?= $account->knowledge ?>" data-role="tagsinput" data-maxtags="5" />
                                <small class="form-text text-muted"><?= $language->profile_settings->input->knowledge_help ?></small>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="pills-template">
                            <div class="form-group">
                                <label><?= $language->profile_settings->input->template ?></label>

                                <select class="custom-select" name="template">
                                    <?php foreach($available_templates as $key => $object): ?>
                                        <option value="<?= $key ?>" <?php if($account->template == $key) echo 'selected' ?>><?= $object->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?= $language->profile_settings->input->main_link_type ?></label>

                                <select class="custom-select" name="main_link_type">
                                    <option value="0" <?php if($account->main_link_type == 0) echo 'selected' ?>><?= $language->profile_settings->input->disabled ?></option>
                                    <?php foreach($available_main_link_types as $main_link): ?>
                                        <option value="<?= $main_link->id ?>" <?php if($account->main_link_type == $main_link->id) echo 'selected' ?>><?= $main_link->content ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?= $language->profile_settings->input->main_link ?></label>

                                <input type="text" name="main_link" class="form-control" value="<?= $account->main_link ?>" <?php if($account->main_link_type == 0) echo 'disabled' ?>/>
                            </div>

                            <div class="form-group">
                                <label><?= $language->profile_settings->input->background_type ?></label>

                                <select class="custom-select" name="background_type">
                                    <?php foreach($available_background_types as $type): ?>
                                        <option value="<?= $type ?>" <?php if($account->background_type == $type) echo 'selected' ?>><?= $language->profile_settings->input->{$type} ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>



                            <div class="form-group" id="background_type_color" <?php if($account->background_type != 'color') echo 'style="display: none"' ?>>
                                <label><?= $language->profile_settings->input->background_value_color ?></label>

                                <input type="color" name="background_value" class="form-control" id="color_input" value="<?= $account->background_value ?>" <?php if($account->background_type != 'color') echo 'disabled' ?> />
                            </div>


                            <div class="form-group" id="background_type_background" <?php if($account->background_type != 'background') echo 'style="display: none"' ?>>
                                <label><?= $language->profile_settings->input->background_value_background ?></label>

                                <select class="custom-select" name="background_value" <?php if($account->background_type != 'background') echo 'disabled' ?>>
                                    <?php foreach($available_background_images as $image): ?>
                                        <option value="<?= $image ?>" <?php if($account->background_type == $image) echo 'selected' ?>><?= $image ?></option>
                                    <?php endforeach ?>
                                </select>

                                <div class="mt-3 d-flex flex-wrap">
                                    <?php foreach($available_background_images as $image): ?>
                                        <div class="card card-profile-background mr-2 mb-2">
                                            <img class="card-img card-profile-background-image" data-value="<?= $image ?>" src="template/images/available_backgrounds/<?= $image ?>" alt="">
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>


                            <div class="form-group" id="background_type_gradient" <?php if($account->background_type != 'gradient') echo 'style="display: none"' ?>>
                                <label><?= $language->profile_settings->input->background_value_gradient ?></label>

                                <select class="custom-select" name="background_value" <?php if($account->background_type != 'gradient') echo 'disabled' ?>>
                                    <?php foreach($available_themes as $key => $value): ?>
                                        <option value="<?= $key ?>" <?php if($account->background_value == $key) echo 'selected' ?>><?= $value->title ?></option>
                                    <?php endforeach ?>
                                </select>

                                <div class="mt-3 d-flex flex-wrap">
                                    <?php foreach($available_themes as $key => $value): ?>
                                        <div class="card card-profile-gradient-background border-0 mr-2 mb-2" style="<?= 'background: linear-gradient(135deg, ' . $value->color1 . ' 0%, '. $value->color2 . ' 100%);' ?>" data-value="<?= $key ?>">

                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>



                        </div>

                        <div class="tab-pane fade" id="pills-socials">
                            <small class="form-text text-muted mb-2"><?= $language->profile_settings->input->social_buttons_help ?></small>

                            <div class="row">

                                <?php foreach($available_buttons as $key => $button):  ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label data-toggle="tooltip" title="<?= sprintf($language->profile_settings->input->social_button_help, sprintf($button->url, $language->profile_settings->input->social_button_id_help)) ?>"><i class="<?= $button->icon ?> mr-2"></i> <?= $button->title ?></label>
                                            <input type="text" name="buttons[<?= $key ?>]" class="form-control" value="<?= $button->user ?>" />
                                        </div>
                                    </div>

                                <?php endforeach ?>
                            </div>
                        </div>

                        <div class="form-group text-center mt-5">
                            <button type="submit" name="ajax_submit" class="btn btn-dark"><?= $language->profile_settings->input->save ?></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">

                <div class="embed-responsive embed-responsive-1by1">
                    <iframe class="embed-responsive-item" id="profile_iframe" src="<?= $settings->url . $account->username ?>"></iframe>
                </div>

            </div>
        </div>

    </div>
</div>



<script src="template/js/tagsinput.js"></script>
<script src="template/js/notifyjs.js"></script>

<script>

    document.getElementById('avatar-file-input').onchange = (elm) => {
        let reader = new FileReader();

        reader.onload = (e) => {
            // get loaded data and render thumbnail.
            document.getElementById('avatar-file-img').src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(elm.target.files[0]);
    };


    $(document).ready(() => {
        let profile_settings_autosave = parseInt($('#profile_settings_autosave').val());
        let current_avatar_src = $('#avatar-file-img').attr('src');
        let timer = null;
        let not_ios = !(navigator.platform.indexOf('iPhone') != -1) && !(navigator.platform.indexOf('iPod') != -1);


        if(not_ios) {
            $('form').on('change submit', function (e) {
                let target = e.target.id;

                if ((e.type == 'change' && profile_settings_autosave) || e.type == 'submit') {

                    /* We want to delay submission of the form when color input changes, because it changes super fast generating a lot of unneeded request */
                    if (target == 'color_input') {
                        if (timer) clearTimeout(timer);

                        timer = setTimeout(() => {
                                submit_form()
                            }, 500
                        )
                    } else {
                        submit_form()
                    }

                }

                e.preventDefault();
            })
        } else {
            $('<input>').attr({
                type: 'hidden',
                name: 'manual_post',
                value: 'true'
            }).appendTo('form');
        }


        /* Form submission function */
        let submit_form = () => {
            $('button[name="ajax_submit"]').attr('disabled', 'disabled');

            let form_data = new FormData($('form')[0]);

            $.ajax({
                url: 'processing/process/profile_settings.php',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: (data) => {

                    /* Parse the response */
                    let response = notify_data(data);

                    /* Enable button again */
                    $('button[name="ajax_submit"]').removeAttr('disabled');

                    /* Refresh iframe */
                    $('#profile_iframe').animateCss('fadeOut', function () {

                        $('#profile_iframe').hide().attr('src', (index, attr) => {
                            return attr;
                        });

                        document.getElementById('profile_iframe').onload = function() {
                            $('#profile_iframe').fadeIn('slow')
                        }

                    });


                    /* Save new avatar as new default and reset */
                    current_avatar_src = $('#avatar-file-img').attr('src');
                }
            });
        }


        /* Match name with title */
        $('input[name="name"]').on('keyup', function () {
            $('#title').html($(this).val());
        })

        /* Background Image Event */
        $('.card-profile-background-image').on('click', function () {
            $('select[name="background_value"]').val($(this).data('value'));
            $('form').trigger('change');
        });

        /* Gradient Background Event */
        $('.card-profile-gradient-background').on('click', function () {
            $('select[name="background_value"]').val($(this).data('value'));
            $('form').trigger('change');
        });

        /* Main Link Type */
        let main_link_type = $('select[name="main_link_type"]').find(':selected').val();
        $('select[name="main_link_type"]').on('change', function () {
            if($(this).find(':selected').val() != 0) {
                $('input[name="main_link"]').removeAttr('disabled');
            } else {
                $('input[name="main_link"]').attr('disabled', 'disabled');
            }
        })


        /* Background selectors */
        let current_background_type = $('select[name="background_type"]').find(':selected').val();
        $('select[name="background_type"]').on('change', function () {
            let background_type = $(this).val();


            $('#background_type_' + current_background_type).hide();
            $('#background_type_' + current_background_type).find('[name="background_value"]').attr('disabled', 'disabled');

            switch(background_type) {
                case 'gradient':
                    $('#background_type_gradient').fadeIn();
                    $('#background_type_gradient').find('[name="background_value"]').removeAttr('disabled');
                    current_background_type = 'gradient';
                break;

                case 'color':
                    $('#background_type_color').fadeIn();
                    $('#background_type_color').find('[name="background_value"]').removeAttr('disabled');
                    current_background_type = 'color';
                break;

                case 'background':
                    $('#background_type_background').fadeIn();
                    $('#background_type_background').find('[name="background_value"]').removeAttr('disabled');
                    current_background_type = 'background';
                break;
            }


        })
    });
</script>
