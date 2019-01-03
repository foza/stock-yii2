<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                    <div class="box-tools">
                        <div class="input-group">
                            <?= Html::a(Yii::t('app', 'Create Customer'), ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'client_id',
                'value' => 'client.title',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'client_id',
                    'data' => ArrayHelper::map(\app\models\Client::find()->where(['status' => 1])->all(), 'id', 'title'),
                    //'theme' => Select2::THEME_BOOTSTRAP,
                    //'hideSearch' => true,
                    'options' => [
                        'placeholder' => Yii::t('app', 'Select'),
                    ]
                ]),
            ],
            [
                'attribute' => 'product_id',
                'value' => 'category.title',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'product_id',
                    'data' => ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'title'),
                    //'theme' => Select2::THEME_BOOTSTRAP,
                    //'hideSearch' => true,
                    'options' => [
                        'placeholder' => Yii::t('app', 'Select'),
                    ],
                    'pluginOptions' => [
                        'width' => '400px',
                    ],
                ]),
            ],


            'count',

           // 'client_id',
            'price_sale',
            'total_sum',
                    [
                        'attribute' => 'date_sale',
                        'filter' => DatePicker::widget([
                            'options' => ['width' => '100px'],
                            'model'=>$searchModel,
                            'attribute' => 'date_sale',
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose' => true,
                                'todayHighlight' => true,
                            ]
                        ]),
                    ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
