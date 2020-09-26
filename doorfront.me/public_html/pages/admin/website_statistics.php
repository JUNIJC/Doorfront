<?php
defined('ROOT') || die();
User::check_permission(1);
Security::csrf_set_session_token('url_token');
?>

<?php $data = $database->query("SELECT SUM(`amount`) AS `earnings`, `currency`, COUNT(`id`) AS `count` FROM `payments` GROUP BY `currency`") ?>

<div class="card bg-dark text-light mb-5">
    <div class="card-body">
        <h4 class="card-title"><i class="fa fa-dollar-sign"></i> Your website's generated sales</h4>

        <?php if(!$data->num_rows): ?>
            You don't have any sales yet.. :(
        <?php else: ?>

            <ul>
                <?php while($sales = $data->fetch_object()): ?>
                    <h6><span class="text-info"><?= $sales->count ?></span> sales and generated a revenue of <span class="text-success"><?= number_format($sales->earnings, 2) ?></span> <?= $sales->currency ?></h6>
                <?php endwhile ?>
            </ul>

        <?php endif ?>
    </div>
</div>


<?php

$hits_logs = [];
$previous_date = (new DateTime())->modify('-30 day')->format('Y-m-d');
$hits_result = $database->query("SELECT COUNT(`id`) AS `total`, DATE(`date`) AS `date`, `type` FROM `hits` WHERE `date` > '{$previous_date}' GROUP BY DATE(`date`), `type` ORDER BY `date` DESC");

while($hits_log = $hits_result->fetch_object()) {
    if(!array_key_exists($hits_log->date, $hits_logs)) {
        $hits_logs[$hits_log->date] = ['main_link' => 0, 'social' => 0, 'profile' => 0];
    }

    $hits_logs[$hits_log->date][$hits_log->type] =  $hits_log->total;
}

$hits_chart_main_link_array = $hits_chart_social_array = $hits_chart_profile_array = [];

foreach($hits_logs as $key => $log) {
    $hits_chart_main_link_array[] = $log['main_link'] ;
    $hits_chart_social_array[] = $log['social'] ;
    $hits_chart_profile_array[] = $log['profile'] ;
}


$hits_chart_labels = '["' . implode('", "', array_keys(array_reverse($hits_logs))) . '"]';
$hits_chart_main_link = '["' . implode('", "', array_reverse($hits_chart_main_link_array)) . '"]';
$hits_chart_social = '["' . implode('", "', array_reverse($hits_chart_social_array)) . '"]';
$hits_chart_profile = '["' . implode('", "', array_reverse($hits_chart_profile_array)) . '"]';


?>
<div class="mb-5 card card-shadow">
    <div class="card-body">
        <h4 class="card-title">Total hits from profiles in the last 30 days</h4>
        <div class="chart-container">

            <canvas id="users_hits_chart"></canvas>

        </div>

    </div>
</div>
<?php
$data = $database->query("
SELECT
(SELECT COUNT(`user_id`) FROM `users` WHERE YEAR(`date`) = YEAR(CURDATE()) AND MONTH(`date`) = MONTH(CURDATE()) AND DAY(`date`) = DAY(CURDATE())) AS `new_users_today`,
(SELECT COUNT(`user_id`) FROM `users` WHERE `type` = '1' OR `type` = '2') AS `admin_users`,
(SELECT COUNT(`user_id`) FROM `users` WHERE `active` = '1') AS `confirmed_users`,
(SELECT COUNT(`user_id`) FROM `users` WHERE `active` = '0') AS `unconfirmed_users`,
(SELECT COUNT(`user_id`) FROM `users` WHERE YEAR(`last_activity`) = YEAR(CURDATE()) AND MONTH(`last_activity`) = MONTH(CURDATE())) AS `active_users`
")->fetch_object();
?>


<div class="mb-5 card card-shadow">
    <div class="card-body">
        <h4 class="card-title">Users statistics</h4>

        <div class="chart-container">
            <canvas id="users_chart"></canvas>
        </div>

    </div>
</div>


<script src="template/js/Chart.bundle.min.js"></script>

<script>
    /* Display chart */
    let users_chart = new Chart(document.getElementById('users_chart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['New Today', 'Admins', 'Confirmed', ' Unconfirmed', 'Active Users'],
            datasets: [{
                label: 'Users stats',
                data: [<?= (int) $data->new_users_today ?>, <?= (int) $data->admin_users ?>, <?= (int) $data->confirmed_users ?>, <?= (int) $data->unconfirmed_users ?>, <?= (int) $data->active_users ?>],
                backgroundColor: ['#714eb7', '#33ba78', '#cd476b', '#0064ce', '#2284ba'],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                text: '',
                display: false
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    let users_hits_chart = new Chart(document.getElementById('users_hits_chart').getContext('2d'), {
        type: 'line',
        data: {
            labels: <?= $hits_chart_labels ?>,
            datasets: [
                {
                    label: 'Main Link',
                    data: <?= $hits_chart_main_link ?>,
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    fill: false
                },
                {
                    label: 'Profile Hits',
                    data: <?= $hits_chart_profile ?>,
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    fill: false
                },
                {
                    label: 'Social Hits',
                    data: <?= $hits_chart_social ?>,
                    backgroundColor: 'rgb(153, 102, 255)',
                    borderColor: 'rgb(153, 102, 255)',
                    fill: false
                }
            ]
        },
        options: {
            title: {
                display: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            tooltips: {
                mode: 'index',
                intersect: false
            },
            responsive: true,
            maintainAspectRatio: false

        }
    });
</script>
