<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Gender */

$this->title = Yii::t('app', 'Create Gender');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Genders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gender-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
