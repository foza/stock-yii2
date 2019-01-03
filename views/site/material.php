<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use app\models\Product;

$this->title = Yii::t('app', 'Склад магазина');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form'), 'url' => ['form']];
$this->params['breadcrumbs'][] = $this->title;
?>


<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app', 'Склад магазина') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <?php $form = ActiveForm::begin(['class' => "form-horizontal"]) ?>
                <div class="box-body">
                    <div class="col-md-6">
                        <?= $form->field($model, 'date1')->widget(DatePicker::classname(), [
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'options' => ['placeholder' => Yii::t('app', 'Enter date ...')],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'date2')->widget(DatePicker::classname(), [
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'options' => ['placeholder' => Yii::t('app', 'Enter date ...')],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]); ?>
                    </div>
                </div>
                <!-- /.box-body -->
                <?php ActiveForm::end() ?>
                <div class="box-footer text-center">
                    <button class="btn btn-info " id="btn"><?= Yii::t('app', 'Сформировать') ?></button>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1" id="check-status"></div>
    </div>
</section>

<?php
$js = <<<JS
    $('#btn').on('click',function(){
        $.ajax({
            url:'/site/test?select=1',
            data:{
                date1:$('#profit-date1').val(),
                date2:$('#profit-date2').val()},
            type:'POST',
            success:function(res){
                $('#check-status').html(res);
            },
            error:function(res){
                console.log(res);

            }
        });
    });
JS;
$this->registerJs($js);
?>

