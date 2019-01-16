<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\news;

/**
 * News_Search represents the model behind the search form of `backend\models\news`.
 */
class News_Search extends news
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['news_title', 'image', 'description', 'content'], 'safe'],
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
        $query = news::find();

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
            'news_id' => $this->news_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'news_title', $this->news_title])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
