<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    public $category;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count', 'first_count', 'gender_id', 'material_id'], 'integer'],
            [[ 'category','category_id','date'], 'safe'],
            [['price_come', 'prise_sale'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();
        $query->joinWith(['category']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['category'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['category.title' => SORT_ASC],
            'desc' => ['category.title' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'count' => $this->count,
            'price_come' => $this->price_come,
            'prise_sale' => $this->prise_sale,
            'first_count' => $this->first_count,
            'gender_id' => $this->gender_id,
            'material_id' => $this->material_id,
            'date' => $this->date,
        ])
        ->andFilterWhere(['like', 'category.title', $this->category]);
        return $dataProvider;
    }
}
