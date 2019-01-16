<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Comment;

/**
 * CommentSearch represents the model behind the search form of `backend\models\Comment`.
 */
class CommentSearch extends Comment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmt_id', 'customer_id', 'status', 'cmt_date'], 'integer'],
            [['book_id', 'content'], 'safe'],
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
        $query = Comment::find();

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
            'cmt_id' => $this->cmt_id,
            'customer_id' => $this->customer_id,
            'status' => $this->status,
            'cmt_date' => $this->cmt_date,
        ]);

        $query->andFilterWhere(['like', 'book_id', $this->book_id])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
