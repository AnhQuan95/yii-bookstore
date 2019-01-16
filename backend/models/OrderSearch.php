<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Order;

/**
 * OrderSearch represents the model behind the search form of `backend\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'email', 'full_name', 'phone', 'delivery_address', 'payment_method', 'shipping_method', 'order_note','customer_id'], 'safe'],
            [[ 'status', 'created_at', 'updated_at'], 'integer'],
            [['total_cost'], 'number'],
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
        $query = Order::find();

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

        $query->joinWith('customer');

        // grid filtering conditions
        $query->andFilterWhere([
            'total_cost' => $this->total_cost,
            'order.status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id])
        ->andFilterWhere(['like', 'email', $this->email])
        ->andFilterWhere(['like', 'full_name', $this->full_name])
        ->andFilterWhere(['like', 'phone', $this->phone])
        ->andFilterWhere(['like', 'delivery_address', $this->delivery_address])
        ->andFilterWhere(['like', 'payment_method', $this->payment_method])
        ->andFilterWhere(['like', 'shipping_method', $this->shipping_method])
        ->andFilterWhere(['like', 'order_note', $this->order_note])
        ->andFilterWhere(['like', 'customer.email', $this->customer_id]);
        return $dataProvider;
    }
}
