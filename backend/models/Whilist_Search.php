<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Whilist;

/**
 * Whilist_Search represents the model behind the search form of `backend\models\Whilist`.
 */
class Whilist_Search extends Whilist
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'created_at'], 'integer'],
            [['book_id'], 'safe'],
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
        $query = Whilist::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'book_id', $this->book_id]);

        return $dataProvider;
    }
}
