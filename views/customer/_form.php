<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="col-md-12">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($first, 'client_id')->dropDownList(
        ArrayHelper::map(\app\models\Client::find()->asArray()->all(), 'id', 'title')
        , ['prompt'=>'--Клиент--']
    ); ?>

    <?php echo $form->field($first, 'date_sale')->widget(
        DatePicker::className(), [
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

</br>

    <div class="col-md-12">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 100, // the maximum times, an element can be added (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $model[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'product_id',
                'count'
            ],
        ]); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>
                    <i class="fa fa-user"></i> Customer
                    <button type="button" class="add-item btn btn-success btn-sm pull-right"><i
                                class="glyphicon glyphicon-plus"></i> Customer
                    </button>
                </h4>
            </div>
            <div class="panel-body">
                <div class="container-items"><!-- widgetBody -->
                    <?php foreach ($model as $i => $modelAddress): ?>
                        <div class="item panel panel-default"><!-- widgetItem -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Customer</h3>
                                <div class="pull-right">
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                                class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]product_id")->widget(Select2::classname(), [
                                            'data' => ArrayHelper::map(\app\models\Category::find()->all(), 'id','title'),
                                            'language' => 'en',
                                            'options' => ['placeholder' => 'Select'],
                                            'pluginOptions' => [
                                                'allowClear' => true

                                            ],
                                        ]) ?>
                                    </div>


                                    <div class="col-sm-4">
                                        <?= $form->field($modelAddress, "[{$i}]count")->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div><!-- .row -->

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div><!-- .panel -->
        <?php DynamicFormWidget::end(); ?>

        <div class="form-group">
            <?= Html::submitButton($first->isNewRecord ? 'Create' : 'Update', ['class' => $first->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
