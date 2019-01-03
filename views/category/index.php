<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Maxsulotlar');
$this->params['breadcrumbs'][] = $this->title;

?>
<section class="content">
    <div class="row">

        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);
                    ?>
                    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                    <div class="box-tools">

                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div class="box-body">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'title',


                                ['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]); ?>
                        <div class="input-group">
                            <?= Html::a(Yii::t('app', 'Create Customer'), ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>

                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
