<?php
$this->title = Yii::t('app', 'Отчёт');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= Yii::t('app', 'Отчёт') ?></h3>
                </div>
                <div class="box-body">
                    <a href="<?= Yii::$app->homeUrl ?>site/material"
                       class="btn btn-block btn-default btn-lg"><h1><?= Yii::t('app', 'Отчёт склада') ?></h1></a>

                    <br/>
                </div>
            </div>
        </div>
    </div>
</section>