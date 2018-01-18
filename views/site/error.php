<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>


<!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>ВЫ попли не туда ))) </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <p>
                            <?= Html::encode($this->title) ?>
                            </p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-envelope"></i>
                        </div>
                    </div>
                    <div class="form-bottom contact-form">
                        <div class="alert alert-danger">
                          <strong>Xato!</strong> 
                          <?= nl2br(Html::encode($message)) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>