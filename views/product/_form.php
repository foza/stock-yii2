<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-12">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

   <!-- --><?/*= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(\app\models\Gender::find()->asArray()->all(), 'id', 'title')
        , ['prompt'=>'--Категория--']
    ); */?>

    <?=  $form->field($model, 'category_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'title'),
        'language' => 'ru',
        'options' => ['placeholder' => ' '],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>


    <?= $form->field($model, 'artikul')->textInput() ?>
    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'price_come')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prise_sale')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'gender_id')->dropDownList(
        ArrayHelper::map(\app\models\Gender::find()->asArray()->all(), 'id', 'title')
        , ['prompt'=>'----']
    ); ?>

    <?=  $form->field($model, 'material_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Material::find()->all(), 'id', 'title'),
        'language' => 'ru',
        'options' => ['placeholder' => ' '],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?php echo $form->field($model, 'date')->widget(
        DatePicker::className(), [
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Qo\'shish'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
