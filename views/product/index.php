<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sklad');
$this->params['breadcrumbs'][] = $this->title; 
 
$this->registerJs('js/myjsfile.js', $this::POS_HEAD);

?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                    <div class="box-tools">
                        <div class="input-group">
                            <?= Html::a(Yii::t('app', 'Skladga maxsulot qo\'shish'), ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                    <!-- $this->render('_search', ['model' => $searchModel]); -->
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // [
            //     'attribute' =>'category_id',
            //     'format' => 'html',
            //     'label' => 'Ижоброжение',
            //     'value' => function ($data) {
            //         return Html::a(Html::img('../' . $data->category->img,
            //             ['width' => '60px','class' => 'fancy-box']), [$data->category->img],['class'=>'fanacy-box']);
            //     },
            //     //'filter' => ArrayHelper::map(app\models\Category::find()->all(),'id','img')
            // ],

            // return Html::a(Html::img(Yii::getAlias('@web') . '/file/' . $data->bukti, ['alt' => 'some', 'class' => 'fancy-box', 'height' => '100px', 'width' => '100px']), ['site/zoom']);

            [
                'attribute' => 'category',
                'label'=>'Maxsulot nomi',
                'value' => 'category.title',
                'format'=>'text',
            ],
            'artikul',

            // [
            //     'attribute'=>'gender_id',
            //     'format'=>'text', // Возможные варианты: raw, html
            //     'content'=>function($data){
            //         return  $data->getGenderName();
            //     },
            //     'filter' => ArrayHelper::map(app\models\Gender::find()->all(),'id','title')
            // ],
            [
                'attribute'=>'material_id',
                'value'=> 'material.title',
                /*'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return  $data->getMaterialName();
                },
                'filter' => ArrayHelper::map(app\models\Material::find()->all(),'id','title')*/
            ],
            'count',
            // 'price_come',
            // 'prise_sale',
            //'first_count',

            //'material_id',
            //'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
