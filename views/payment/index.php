<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaymenclientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Paymenclients');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?=Yii::t('app','Долги')?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?= Yii::t('app', 'Provider') ?></th>
                            <th><?= Yii::t('app', 'payments') ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>


                        <? foreach ($model as $one) {
                            $debt = \app\models\Customer::find()->where(['client_id'=>$one->id])->all();
                            $sum=0;
                            foreach($debt as $d){

                                $sum +=$d->total_sum;

                            }
                            $payment = \app\models\Payment::find()->where(['client_id' => $one->id])->all();
                            $sum2 = 0;
                            foreach ($payment as $p) {

                                $sum2 += $p->payed_sum;


                            }
                            $sum = $sum - $sum2;
                            ?>
                            <tr>
                                <td><?= $one->title ?></td>
                                <td><?= $sum?> UZS</td>
                                <td align="center">
                                    <button onclick="window.location.href='<?= Yii::$app->urlManager->createUrl(['payment/view', 'id' => $one->id]) ?>'"
                                            type="button" class="btn btn-info"><i class="fa fa-plus"></i></button>

                                </td>
                            </tr>
                        <? } ?>







                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<?php
$js = <<<JS
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>
