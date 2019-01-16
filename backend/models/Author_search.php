<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Author;

/**
 * Author_search represents the model behind the search form of `backend\models\Author`.
 */
class Author_search extends Author
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['author_name', 'address'], 'safe'],
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
        $query = Author::find();

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
            'author_id' => $this->author_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'author_name', $this->author_name])
        ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
