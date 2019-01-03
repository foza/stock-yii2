<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $title
 * @property string $phone
 * @property string $email
 * @property string $comment
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'phone'], 'required'],
            [['comment'], 'string'],
            [['title', 'phone', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'СTitle'),
            'phone' => Yii::t('app', 'СPhone'),
            'email' => Yii::t('app', 'Долг'),
            'comment' => Yii::t('app', 'Долг'),
        ];
    }

    public function getCustomer(){
        return $this->hasOne(Customer::className(),['product_id'=>'id']);
    }
}
