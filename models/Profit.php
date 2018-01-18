<?php

namespace app\models;

use yii\base\Model;
use Yii;

class Profit extends Model
{
    public $select;
    public $date1;
    public $date2;

    public function rules()
    {
        return [
            [['date1', 'date2'], 'required'],
            [['select'], 'integer'],
            [['date1', 'date2'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'select' => Yii::t('app', 'Select'),
            'date1' => Yii::t('app', 'Date1'),
            'date2' => Yii::t('app', 'Date2')
        ];
    }

    public function form($select)
    {

        //product
        if ($select == 1) {
            $model = Product::find()->where(['between', 'date', $this->date1, $this->date2])->orderBy(['date' => SORT_ASC])->all();
            echo '<div class="box">
                    <div class="box-header">
                      <h3 class="box-title">' . Yii::t('app', 'Склад магазина') . '</h3>
                         <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <button class="btn btn-info" onclick="jQuery(\'#table\').print()">
                                    <i class="glyphicon glyphicon-print"></i>
                                </button>
                                <span class="mailbox-read-time pull-right">' . date('d-M-Y') . '</span>
                            </div>
                        </div>
                    </div>
                        <div class="box-body no-padding">
                          <table class="table table-striped" id="table">
                            <tbody><tr>
                              <th style="width: 10px">#</th>
                              <th>' . Yii::t('app', 'Продукт') . '</th>
                              <th>' . Yii::t('app', 'Дата прихода') . '</th>
                              <th>' . Yii::t('app', 'Приход шт') . '</th>
                              <th>' . Yii::t('app', 'Остаток') . '</th>
                              <th>' . Yii::t('app', 'Цена прихода') . '</th>
                              <th>' . Yii::t('app', 'Цена продажи') . '</th>
                              <th>' . Yii::t('app', 'Сумма прихода') . '</th>
                              <th>' . Yii::t('app', 'Сумма продажи') . '</th>
                            
                            </tr>';
            $i = 1;
            foreach ($model as $one) {
                echo '<tr><td>' . $i . '</td>';
                echo '<td>' . $one->category->title . '</td>';
                echo '<td>' . $one->date . '</td>';
                echo '<td>' . $one->first_count . ' шт</td>';
                if ($one->count <= 10){
                    echo '<td><span class="badge bg-red">' . $one->count . ' шт</span></td>';
                }else{
                    echo '<td>' . $one->count . ' шт</td>';
                }


                echo '<td>' . $one->price_come . ' сум</td>';
                echo '<td>' . $one->prise_sale . ' сум</td>';
                echo '<td>' . $one->first_count  * $one->price_come . ' сум</td>';
                $prodaja = ($one->first_count  - $one->count) * $one->prise_sale;
                if ($prodaja <= 0){
                    echo '<td><span class="label label-success">Не было продаж</span></td>';
                }else{
                    echo '<td>' . $prodaja . ' сум</td>';
                }



                $i++;
            }
           /* $sum = Product::find()->where(['between', 'date', $this->date1, $this->date2])->sum('price_come');
            $sum2 = Product::find()->where(['between', 'date', $this->date1, $this->date2])->sum('prise_sale');


            $a = Product::find()->where(['between', 'date', $this->date1, $this->date2])->sum('first_count');
            $b = Product::find()->where(['between', 'date', $this->date1, $this->date2])->sum('count');
            $c = Product::find()->where(['between', 'date', $this->date1, $this->date2])->sum('prise_sale');
            $d = ($a - $b)*$c;
            echo '<tr>
                        <td colspan="5">' . Yii::t('app', 'Total Sum') . '</td>
                        <td>' . $sum . ' сум</td>
                        <td>' . $sum2 . ' сум</td>
                        <td>' . $d . ' сум</td>
                  </tr>';*/

            echo '</tbody></table></div></div>';
        }


        if ($select == 2) {
            $model = Product::find()->where(['between', 'date', $this->date1, $this->date2])->orderBy(['date' => SORT_ASC])->all();
            echo '<div class="box">
                    <div class="box-header">
                      <h3 class="box-title">' . Yii::t('app', 'Склад магазина') . '</h3>
                         <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <button class="btn btn-info" onclick="jQuery(\'#table\').print()">
                                    <i class="glyphicon glyphicon-print"></i>
                                </button>
                                <span class="mailbox-read-time pull-right">' . date('d-M-Y') . '</span>
                            </div>
                        </div>
                    </div>
                        <div class="box-body no-padding">
                          <table class="table table-striped" id="table">
                            <tbody><tr>
                              <th style="width: 10px">#</th>
                              <th>' . Yii::t('app', 'Продукт') . '</th>
                              <th>' . Yii::t('app', 'Дата прихода') . '</th>
                              <th>' . Yii::t('app', 'Приход шт') . '</th>
                              <th>' . Yii::t('app', 'Цена прихода') . '</th>
                              <th>' . Yii::t('app', 'Цена продажи') . '</th>
                            
                            </tr>';
            $i = 1;
            foreach ($model as $one) {
                echo '<tr><td>' . $i . '</td>';
                echo '<td>' . $one->category->title . '</td>';
                echo '<td>' . $one->date . '</td>';
                echo '<td>' . $one->first_count . '</td>';
                echo '<td>' . $one->price_come . '</td>';
                echo '<td>' . $one->prise_sale . '</td>';

                $i++;
            }
            $sum = Product::find()->where(['between', 'date', $this->date1, $this->date2])->sum('price_come');
            $sum2 = Product::find()->where(['between', 'date', $this->date1, $this->date2])->sum('prise_sale');
            echo '<tr><td colspan="4">' . Yii::t('app', 'Total Sum') . '</td><td>' . $sum . ' сум</td><td>' . $sum2 . ' сум</td></tr>';

            echo '</tbody></table></div></div>';
        }
        // bitta ishchini oyligi 5

}}
