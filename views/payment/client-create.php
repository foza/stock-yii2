<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cilent'), 'url' => ['client']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'client-list'), 'url' => ['client-list','id'=>$client_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="box box-info">
        <div class="box-header  with-border">
            <h1 class="box-title"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="box-body">
            <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'options' => ['placeholder' => Yii::t('app', 'Введите дату ...')],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>

            <?= $form->field($model, 'payed_sum')->textInput()->label(false) ?>


            <?/*= $form->field($model, 'type_of_payment_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\TypeOfPayment::find()->where(['status' => 1])->all(), 'id', 'title'),
                'language' => 'en',
                'options' => ['placeholder' => Yii::t('main', 'Select')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) */?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</section>
