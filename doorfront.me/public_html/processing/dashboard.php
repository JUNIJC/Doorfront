<?php
defined('ROOT') || die();;
User::check_permission(0);


/* Get the days remaining of pro if current account is pro */
if($account->pro) {
   $pro_days_left = $database->query("SELECT DATEDIFF(`pro_due_date`, NOW()) AS `days_left` FROM `users` WHERE `user_id` = {$account_user_id} ")->fetch_object()->days_left;
}

/* Gathering last 30 day stats for profile hits */
$profile_hits_logs = [];
$previous_date = (new DateTime())->modify('-15 day')->format('Y-m-d');
$profile_hits_result = $database->query("SELECT COUNT(`id`) AS `total`, DATE(`date`) AS `date`, `type` FROM `hits` WHERE `user_id` = {$account_user_id} AND `date` > '{$previous_date}' GROUP BY DATE(`date`), `type` ORDER BY `date` DESC");

while($profile_hits_log = $profile_hits_result->fetch_object()) {
    if(!array_key_exists($profile_hits_log->date, $profile_hits_logs)) {
        $profile_hits_logs[$profile_hits_log->date] = ['main_link' => 0, 'social' => 0, 'profile' => 0];
    }

    $profile_hits_logs[$profile_hits_log->date][$profile_hits_log->type] =  $profile_hits_log->total;
}

$profile_hits_chart_main_link_array = $profile_hits_chart_social_array = $profile_hits_chart_profile_array = [];


foreach($profile_hits_logs as $key => $log) {
    $profile_hits_chart_main_link_array[] = $log['main_link'] ;
    $profile_hits_chart_social_array[] = $log['social'] ;
    $profile_hits_chart_profile_array[] = $log['profile'] ;
}


$profile_hits_chart_labels = '["' . implode('", "', array_keys(array_reverse($profile_hits_logs))) . '"]';
$profile_hits_chart_main_link = '["' . implode('", "', array_reverse($profile_hits_chart_main_link_array)) . '"]';
$profile_hits_chart_social = '["' . implode('", "', array_reverse($profile_hits_chart_social_array)) . '"]';
$profile_hits_chart_profile = '["' . implode('", "', array_reverse($profile_hits_chart_profile_array)) . '"]';


/* Get data for the social table */
$date = (new DateTime())->format('Y-m-d');
$hits_statistics_result = $database->query("
    SELECT `type`,
      CASE WHEN `type` = 'profile' OR `type` = 'main_link' THEN '' ELSE `type_id` END AS `type_identifier`,
      IFNULL(SUM(CASE WHEN '{$date}' <= `date` THEN 1 END), '-') AS `today`,
      IFNULL(SUM(CASE WHEN '{$date}' - INTERVAL 1 DAY <= `date` AND `date` < '{$date}' THEN 1 END), '-') AS `yesterday`,
      IFNULL(SUM(CASE WHEN '{$date}' - INTERVAL 30 DAY <= `date` AND `date` <= '{$date}' THEN 1 END), '-') AS `last_30_days`,
      IFNULL(COUNT(`id`), '-') AS `total`
    
    
    FROM `hits`
    WHERE `user_id` = {$account_user_id}
    GROUP BY `type`, `type_identifier`
");
