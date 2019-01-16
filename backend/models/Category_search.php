<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Category;

/**
 * Category_search represents the model behind the search form of `backend\models\Category`.
 */
class Category_search extends Category
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cate_id', 'parent', 'status', 'created_at', 'updated_at'], 'integer'],
            [['cate_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Category::find();
        // add conditions that should always apply here

          $dataProvider = new ActiveDataProvider([
            'query' => $query,   
            'pagination' => array('pageSize' => 5),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cate_id' => $this->cate_id,
            'parent' => $this->parent,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'cate_name', $this->cate_name]);

        return $dataProvider;
    }
}
