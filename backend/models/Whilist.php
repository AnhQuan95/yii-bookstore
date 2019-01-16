<?php

namespace backend\models;


use Yii;
use common\models\Customer;


/**
 * This is the model class for table "whilist".
 *
 * @property int $id
 * @property string $book_id
 * @property int $customer_id
 * @property int $created_at
 *
 * @property Book $book
 * @property Customer $customer
 */
class Whilist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $quantity;
    public static function tableName()
    {
        return 'whilist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'created_at'], 'integer'],
            [['book_id'], 'string', 'max' => 50],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'book_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'customer_id' => 'Customer ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['book_id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function getBookInList($book_id)
    {
        $data= count(Whilist::find()->where(['book_id'=>$book_id])->andWhere(['customer_id'=>Yii::$app->user->identity->id])->all());
        return $data;

    }
}
