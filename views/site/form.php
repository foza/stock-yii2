<?php
$this->title = Yii::t('app', 'Form');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= Yii::t('app', 'Form') ?></h3>
                </div>
                <div class="box-body">
                    <a href="/site/material"
                       class="btn btn-block btn-default btn-lg"><h1><?= Yii::t('app', 'Material Form') ?></h1></a>
                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/site/all-product"
                               class="btn btn-block btn-default btn-lg"><h1><?= Yii::t('app', 'All Product') ?></h1>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="/site/product"
                               class="btn btn-block btn-default btn-lg"><h1><?= Yii::t('app', 'One Product') ?></h1>
                            </a>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/site/all-salary"
                               class="btn btn-block btn-default btn-lg"><h1><?= Yii::t('app', 'All Salary') ?></h1></a>
                        </div>
                        <div class="col-md-6">
                            <a href="/site/salary"
                               class="btn btn-block btn-default btn-lg"><h1><?= Yii::t('app', 'One Salary') ?></h1></a>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/site/material"
                               class="btn btn-block btn-default btn-lg"><h1><?= Yii::t('app', 'All Client') ?></h1></a>
                        </div>
                        <div class="col-md-6">
                            <a href="/site/material"
                               class="btn btn-block btn-default btn-lg"><h1><?= Yii::t('app', 'One Client') ?></h1></a>
                        </div>
                    </div>
                    <br/>
                    <a href="/site/material"
                       class="btn btn-block btn-default btn-lg"><h1><?= Yii::t('app', 'Profit') ?></h1></a>

                </div>
            </div>
        </div>
    </div>
</section>