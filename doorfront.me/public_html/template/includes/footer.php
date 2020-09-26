<?php defined('ROOT') || die() ?>

<div class="container">
    <div class="d-flex justify-content-between sticky-footer">
        <div class="col-md-9 px-0">

            <div>
                <span><?= 'Copyright &copy; ' . date('Y') . ' ' . $settings->title . '. All rights reserved. Product by <a href="http://codecanyon.net/user/altumcode/">AltumCode</a>' ?></span>
            </div>

            <span class="dropdown">
                <a class="dropdown-toggle clickable" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $language->global->language ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                    <h6 class="dropdown-header"><?= $language->global->choose_language ?></h6>
                    <?php
                    foreach($languages as $language_name) {
                        echo '<a class="dropdown-item" href="index.php?language=' . $language_name . '">' . $language_name . '</a>';
                    }
                    ?>
                </div>
            </span>

            <?php
            $bottom_menu_result = $database->query("SELECT `url`, `title` FROM `pages` WHERE `position` = '0'");

            while($bottom_menu = $bottom_menu_result->fetch_object()):

                $link_internal = true;
                if(strpos($bottom_menu->url, 'http://') !== false || strpos($bottom_menu->url, 'https://') !== false) {
                    $link_url = $bottom_menu->url;
                    $link_internal = false;
                } else {
                    $link_url = $settings->url . 'page/' . $bottom_menu->url;
                }

                ?>
                | <a href="<?= $link_url ?>" <?= $link_internal ? null : 'target="_blank"' ?>><?= $bottom_menu->title ?></a>&nbsp;
            <?php endwhile ?>


        </div>

        <div class="col-auto px-0">
            <p class="mt-3 mt-md-0">
                <?php
                if(!empty($settings->facebook))
                    echo '<a href="https://facebook.com/' . $settings->facebook . '"><span class="fa-stack mx-1"><i class="fab fa-facebook "></i></span></a>';

                if(!empty($settings->twitter))
                    echo '<a href="https://twitter.com/' . $settings->twitter . '"><span class="fa-stack mx-1"><i class="fab fa-twitter "></i></span></a>';

                if(!empty($settings->instagram))
                    echo '<a href="https://instagram.com/' . $settings->instagram . '"><span class="fa-stack mx-1"><i class="fab fa-instagram "></i></span></a>';

                if(!empty($settings->youtube))
                    echo '<a href="https://youtube.com/' . $settings->youtube . '"><span class="fa-stack mx-1"><i class="fab fa-youtube "></i></span></a>';
                ?>
            </p>

        </div>
    </div>
</div>
