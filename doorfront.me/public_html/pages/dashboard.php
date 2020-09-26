<div class="row">
    <div class="col-sm-12">

        <div class="card bg-main border-0 text-white">
            <div class="card-body">
                <h4 class="card-title d-flex justify-content-between">
                    <?= $language->dashboard->display->account_status ?>

                    <?php if(!$account->pro): ?>

                        <a href="pro" class="btn btn-light btn-sm"><i class="fa fa-unlock-alt"></i> <?= $language->store->display->go_pro ?></a>

                    <?php endif ?>
                </h4>

                <ul class="list-unstyled">
                    <li><i class="far fa-calendar mr-3"></i><?= sprintf($language->dashboard->display->joined, (new DateTime($account->date))->format('d, F Y')) ?></li>
                    <li><i class="far fa-credit-card mr-3"></i><a href="store" class="text-white"><?= sprintf($language->dashboard->display->store, $account->points) ?></a></li>

                    <?php if($account->pro): ?>
                    <li><i class="far fa-user mr-3"></i><?= $language->dashboard->display->pro_account ?></li>
                    <li><small><?= sprintf($language->dashboard->display->pro_account_help, $pro_days_left) ?></small></li>
                    <?php endif ?>
                </ul>


                <div class="mt-3">
                    <small class="card-text text-light"><i class="fa fa-arrow-down"></i> <?= $language->dashboard->display->share_url ?></small>

                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control clickable border-0" name="url" value="<?= $settings->url . $account->username ?>"  onclick="this.select();" />
                        </div>

                        <div class="col-sm-3 col-md-2">
                            <a href="<?= $settings->url . $account->username ?>" target="_blank" class="my-2 my-md-0 btn btn-dark btn-sm"><?= $language->dashboard->display->visit_profile ?></a>
                        </div>

                        <div class="col-sm-3 col-md-2">
                            <a href="profile-settings" class="my-2 my-md-0 btn btn-dark btn-sm"><?= $language->dashboard->display->profile_settings ?></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<div class="row mt-5">
    <div class="col-sm-12">

        <div class="card bg-white text-dark">
            <div class="card-body">
                <h4 class="card-title d-flex justify-content-between m-0"><?= $language->dashboard->display->profile_hits ?></h4>
                <small><?= $language->dashboard->display->profile_hits_help ?></small>


                <div class="chart-container">

                    <canvas id="profile_hits_chart"></canvas>

                </div>

            </div>
        </div>

    </div>
</div>


<script src="template/js/Chart.bundle.min.js"></script>

<script>
    let profile_hits_chart = new Chart(document.getElementById('profile_hits_chart').getContext('2d'), {
        type: 'line',
        data: {
            labels: <?= $profile_hits_chart_labels ?>,
            datasets: [
                {
                    label: '<?= $language->dashboard->profile_hits_chart->main_link ?>',
                    data: <?= $profile_hits_chart_main_link ?>,
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    fill: false
                },
                {
                    label: '<?= $language->dashboard->profile_hits_chart->profile ?>',
                    data: <?= $profile_hits_chart_profile ?>,
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    fill: false
                },
                {
                    label: '<?= $language->dashboard->profile_hits_chart->social ?>',
                    data: <?= $profile_hits_chart_social ?>,
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

<div class="row mt-5">
    <div class="col-sm-12">

        <div class="card bg-white text-dark">
            <div class="card-body">
                <h4 class="card-title d-flex justify-content-between m-0"><?= $language->dashboard->display->traffic ?></h4>



                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><?= $language->dashboard->table->type ?></th>
                                <th><?= $language->dashboard->table->today ?></th>
                                <th><?= $language->dashboard->table->yesterday ?></th>
                                <th><?= $language->dashboard->table->month ?></th>
                                <th><?= $language->dashboard->table->total ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php while($statistic = $hits_statistics_result->fetch_object()): ?>

                            <tr>
                                <td>
                                    <?php if($statistic->type != 'profile' && $statistic->type != 'main_link'): ?>
                                        <i class="fab fa-<?= $statistic->type_identifier ?>"></i> <?= $statistic->type_identifier ?>
                                    <?php else: ?>
                                        <?= $language->dashboard->table->{$statistic->type} ?>
                                    <?php endif ?>
                                </td>
                                <td><?= $statistic->today ?></td>
                                <td><?= $statistic->yesterday ?></td>
                                <td><?= $statistic->last_30_days ?></td>
                                <td><?= $statistic->total ?></td>
                            </tr>

                        <?php endwhile ?>

                        </tbody>

                    </table>
                </div>



            </div>
        </div>

    </div>
</div>
