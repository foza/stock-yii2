<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property int $product_id
 * @property int $count
 * @property int $client_id
 * @property string $price_sale
 * @property string $total_sum
 * @property string $date_sale
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'count', 'client_id', 'total_sum', 'date_sale'], 'required'],
            [['product_id', 'count', 'client_id'], 'integer'],
            [['price_sale', 'total_sum'], 'number'],
            [['date_sale'], 'safe'],
            //[['product_id'],'checkCount']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'count' => Yii::t('app', 'Count'),
            'client_id' => Yii::t('app', 'Client ID'),
            'price_sale' => Yii::t('app', 'Цена продукта'),
            'total_sum' => Yii::t('app', 'Общая сумма'),
            'date_sale' => Yii::t('app', 'Дата продажи'),
        ];
    }

    public function getProduct(){
        return $this->hasOne(Product::className(),['id'=>'product_id']);
    }
    public function getProductName(){
        $product = $this->product;
        return $product? $product->category_id : '';
    }

    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'product_id']);
    }


    public function getClient(){
        return $this->hasOne(Client::className(),['id'=>'client_id']);
    }
    public function getClientName(){
        $client = $this->client;
        return $client ? $client->title : '';
    }

//    public function checkCount($attribute, $params, $validator)
//    {
//        $model = Product::find()->where(['category_id'=>$this->product_id])->sum("count");
//        if($model - $this->count <= 0){
//            $this->addError($attribute, 'Sizda tavar yetarli emas');
//        }
//    }
}
