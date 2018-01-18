<?php
$this->title = Yii::t('app', 'Client');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Client'), 'url' => ['client']];
$this->params['breadcrumbs'][] = $this->title;

?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">

                        <h3 class="box-title"><?=$client?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><?= Yii::t('app', 'Product') ?></th>
                                <th><?= Yii::t('app', 'Date') ?></th>
                                <th><?= Yii::t('app', 'Count') ?></th>
                                <th><?= Yii::t('app', 'Price Sale') ?></th>
                                <th><?= Yii::t('app', 'Общая сумма') ?></th>
                                <th><?= Yii::t('app', 'Qarz') ?></th>
                                <th><?= Yii::t('app', '') ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($model as $one) {
                                $payment = \app\models\Payment::find()->where(['client_id' => $one->client_id,'cutomer_id'=>$one->id])->all();
                                $sum2 = 0;
                                foreach ($payment as $p) {

                                    $sum2 += $p->payed_sum;

                                    $sum = $one->total_sum-$sum2;

                                }
                                ?>
                                <tr>
                                    <td><?= $one->category->title ?></td>
                                    <td><?= $one->date_sale ?></td>
                                    <td><?= $one->count ?></td>
                                    <td><?= $one->price_sale ?></td>
                                    <td><?= $one->total_sum ?></td>
                                    <td><?= $sum ?> so'm</td>
                                    <td align="center">
                                        <button onclick="window.location.href='<?= Yii::$app->urlManager->createUrl(['payment/client-view', 'client_id' => $one->client_id,'cutomer_id'=>$one->id]) ?>'"
                                                type="button" class="btn btn-info"><i class="fa fa-eye"></i></button>
                                        <button onclick="window.location.href='<?= Yii::$app->urlManager->createUrl(['payment/client-create', 'client_id' => $one->client_id,'cutomer_id'=>$one->id]) ?>'"
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