<?php

/* @var $this yii\web\View */
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Members;
use yii\helpers\Url;

$this->title = "Reg.yi.uz — O'zbekiston yoshlar ittifoqi a'zosini elektron ro'yxatga olish tizimi";
?>
<!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>O'zbekiston yoshlar ittifoqi</strong>  a'zosini elektron ro'yxatga olish sahifasiga xush kelibsiz.</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <p>
                                Hududiy statistika
                            </p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-envelope"></i>
                        </div>
                    </div>
                    <div class="form-bottom contact-form">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                          
                          <?php
                            $id_check = 0;
                            foreach ($dataStatistics as $id_data => $data) {
                                if($data['region_id'] != $id_check){
                                    if($id_check){
                                        echo ' </ul>
                                            </div>
                                        </div>';

                                    }
                                    $count_region = Members::find()->where(['region_id'=>$data['region_id']])->count();
                                    echo '<div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading'.$id_check.'">
                                          <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$id_check.'" aria-expanded="true" aria-controls="collapse'.$id_check.'">
                                              '.$data['region_name'].'<span class="badge" style="float:right;">'.$count_region.'</span>
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="collapse'.$id_check.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$id_check.'">
                                            <ul class="list-group">';
                                
                                    $id_check = $data['region_id'];
                                }
                                $count = $data['count'] != null? $data['count']:0;
                                echo '<li class="list-group-item">'.$data['district_name'].' <span class="badge">'.$count.'</span></li> ';
                                echo $data['org'];
                            }
                          ?>
                                </ul>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>