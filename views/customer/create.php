<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = Yii::t('app', 'Create Customer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="customer-create">

   <h1> <center><?= Html::encode($this->title) ?></center></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'first'=>$first
    ]) ?>

</div>
