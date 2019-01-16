<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Publisher;

/**
 * Publisher_search represents the model behind the search form of `backend\models\Publisher`.
 */
class Publisher_search extends Publisher
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publisher_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['publisher_name', 'address'], 'safe'],
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
        $query = Publisher::find();

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
            'publisher_id' => $this->publisher_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'publisher_name', $this->publisher_name])
        ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
