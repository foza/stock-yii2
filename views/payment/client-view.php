<?php
$this->title = Yii::t('app', 'Платежи клиента');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cilent'), 'url' => ['client']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'client-list'), 'url' => ['client-list','id'=>$client_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Платежи клиента : <b> <?=$client?> </b> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><?= Yii::t('app', 'Date') ?></th>
                                <th><?= Yii::t('app', 'Sum') ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($model as $one) {

                                ?>
                                <tr>
                                    <td><?= $one->date ?></td>
                                    <td><?= $one->payed_sum ?></td>
                                    <td align="center">
                                      <!--   <button onclick="window.location.href='<?= Yii::$app->urlManager->createUrl(['payment-client/client-update', 'id' => $one->id]) ?>'"
                                                type="button" class="btn btn-info"><i class="fa fa-pencil"></i></button> -->

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