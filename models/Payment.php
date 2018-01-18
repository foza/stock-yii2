<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $cutomer_id
 * @property string $payed_sum
 * @property string $date
 * @property int $client_id
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cutomer_id', 'payed_sum', 'date', 'client_id'], 'required'],
            [['cutomer_id', 'client_id'], 'integer'],
            [['payed_sum'], 'number'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cutomer_id' => Yii::t('app', 'Cutomer ID'),
            'payed_sum' => Yii::t('app', 'Payed Sum'),
            'date' => Yii::t('app', 'Date'),
            'client_id' => Yii::t('app', 'Client ID'),
        ];
    }

    public function getClient(){
        return $this->hasOne(Client::className(),['id'=>'client_id']);
    }
    public function getCustomer(){
        return $this->hasOne(Customer::className(),['id'=>'customer_id']);
    }
}
