<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Comment;

/**
 * Comment_search represents the model behind the search form of `backend\models\Comment`.
 */
class Comment_search extends Comment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
      return [
        [['cmt_id', 'status', 'cmt_date'], 'integer'],
        [['book_id', 'content','customer_id'], 'safe'],
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
        'pagination' => array('pageSize' => 5),
      ]);

      $dataProvider->setSort([
        'defaultOrder' => [
          'cmt_date' => SORT_DESC
        ]
      ]);

      $this->load($params);

      if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
        return $dataProvider;
      }

      $query->joinWith('book');
      $query->joinWith('customer');
        // grid filtering conditions
      $query->andFilterWhere([
        'cmt_id' => $this->cmt_id,
        'comment.status' => $this->status,
        'cmt_date' => $this->cmt_date,
      ]);

      $query->andFilterWhere(['like', 'book.book_name', $this->book_id])
      ->andFilterWhere(['like', 'content', $this->content])
       ->andFilterWhere(['like', 'customer.email', $this->customer_id]);

      return $dataProvider;
    }
  }
