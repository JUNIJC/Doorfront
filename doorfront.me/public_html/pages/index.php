
<div class="my-6 text-white text-center">
    <h1 class="font-weight-light"><?= $language->index->display->header ?></h1>

    <div class="mt-3"><?= $language->index->display->subheader ?></div>
</div>

<div class="row">
    <div class="col-sm-5 col-md-3 mb-5">
        <div class="card border-0 zoomer">
            <div class="card-body text-center">
                <i class="fas fa-object-group fa-4x mb-4"></i>

                <div class="card-index-title"><?= $language->index->display->feature1 ?></div>
            </div>
        </div>
    </div>

    <div class="col-sm-5 col-md-3 mb-5">
        <div class="card border-0 zoomer">
            <div class="card-body text-center">
                <i class="fas fa-mobile-alt fa-4x mb-4"></i>

                <div class="card-index-title"><?= $language->index->display->feature2 ?></div>
            </div>
        </div>
    </div>

    <div class="col-sm-5 col-md-3 mb-5">
        <div class="card border-0 zoomer">
            <div class="card-body text-center">
                <i class="fab fa-simplybuilt fa-4x mb-4"></i>

                <div class="card-index-title"><?= $language->index->display->feature3 ?></div>
            </div>
        </div>
    </div>

    <div class="col-sm-5 col-md-3 mb-5">
        <div class="card border-0 zoomer">
            <div class="card-body text-center">
                <i class="fab fa-accusoft fa-4x mb-4"></i>

                <div class="card-index-title"><?= $language->index->display->feature4 ?></div>
            </div>
        </div>
    </div>

    <div class="col-sm-5 col-md-3 mb-5">
        <div class="card border-0 zoomer">
            <div class="card-body text-center">
                <i class="fas fa-users fa-4x mb-4"></i>

                <div class="card-index-title"><?= $language->index->display->feature5 ?></div>
            </div>
        </div>
    </div>

    <div class="col-sm-5 col-md-3 mb-5">
        <div class="card border-0 zoomer">
            <div class="card-body text-center">
                <i class="fas fa-chart-line fa-4x mb-4"></i>

                <div class="card-index-title"><?= $language->index->display->feature6 ?></div>
            </div>
        </div>
    </div>

    <div class="col-sm-5 col-md-3 mb-5">
        <div class="card border-0 zoomer">
            <div class="card-body text-center">
                <i class="fas fa-link fa-4x mb-4"></i>

                <div class="card-index-title"><?= $language->index->display->feature7 ?></div>
            </div>
        </div>
    </div>

    <div class="col-sm-5 col-md-3 mb-5">
        <div class="card border-0 zoomer">
            <div class="card-body text-center">
                <i class="fab fa-gratipay fa-4x mb-4"></i>

                <div class="card-index-title"><?= $language->index->display->feature8 ?></div>
            </div>
        </div>
    </div>

</div>

<div class="my-6 text-white text-center">
    <h1 class="font-weight-light"><?= $language->index->display->header2 ?></h1>
    <div class="mt-3"><?= $language->index->display->subheader2 ?></div>
</div>

<?php include TEMPLATE_ROUTE . 'includes/widgets/pricing_table.php' ?>
