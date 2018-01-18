<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Expense */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-12">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'speciality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'date')->widget(
        DatePicker::className(), [
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
