<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense".
 *
 * @property int $id
 * @property string $speciality
 * @property string $sum
 * @property string $date
 * @property string $comment
 */
class Expense extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['speciality', 'sum', 'date', 'comment'], 'required'],
            [['speciality', 'comment'], 'string'],
            [['sum'], 'number'],
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
            'speciality' => Yii::t('app', 'Для чего'),
            'sum' => Yii::t('app', 'Сумма расхода'),
            'date' => Yii::t('app', 'Дата'),
            'comment' => Yii::t('app', 'Заметки'),
        ];
    }
}
