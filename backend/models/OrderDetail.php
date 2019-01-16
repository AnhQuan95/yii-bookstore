<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property int $id
 * @property string $order_id
 * @property string $book_id
 * @property int $quantity
 * @property double $price
 *
 * @property Order $order
 * @property Book $book
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'book_id', 'quantity', 'price'], 'required'],
            [['quantity'], 'integer'],
            [['price'], 'number'],
            [['order_id', 'book_id'], 'string', 'max' => 50],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'order_id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'book_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'book_id' => 'Book ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['book_id' => 'book_id']);
    }
}
