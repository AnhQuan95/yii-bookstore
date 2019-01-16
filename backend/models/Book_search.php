<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Book;
use backend\models\BookWithAuthor;

/**
 * Book_search represents the model behind the search form of `backend\models\Book`.
 */
class Book_search extends Book
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'book_name', 'image', 'description', 'content', 'size', 'publish_at','publisher_id','cate_id'], 'safe'],
            [[ 'quantity', 'pages',  'status', 'created_at', 'updated_at'], 'integer'],
            [['price', 'sale_price'], 'number'],
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
        $query = BookWithAuthor::find();

        // add conditions that should always apply here

           $dataProvider = new ActiveDataProvider([
            'query' => $query,   
            'pagination' => array('pageSize' => 5),
        ]);
            $dataProvider->setSort([
            'defaultOrder' => [
                'created_at' => SORT_DESC
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('publisher');
        $query->joinWith('cate');
        // grid filtering conditions
        $query->andFilterWhere([
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'quantity' => $this->quantity,
            'pages' => $this->pages,
            'publish_at' => $this->publish_at,
            'book.status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ]);

        $query->andFilterWhere(['like', 'book_id', $this->book_id])
            ->andFilterWhere(['like', 'book_name', $this->book_name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'publisher.publisher_name', $this->publisher_id])
            ->andFilterWhere(['like', 'category.cate_name', $this->cate_id]);

        return $dataProvider;
    }
}
