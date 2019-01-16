<?php

namespace backend\models;
use common\models\Customer;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $order_id
 * @property int $customer_id
 * @property string $payment_method
 * @property string $shipping_method
 * @property string $order_note
 * @property double $total_cost
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Customer $customer
 * @property OrderDetail[] $orderDetails
 * @property Book[] $books
 */
class Order extends \yii\db\ActiveRecord
{
    public $order_new_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'status'], 'required'],
            [['customer_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['total_cost'], 'number'],
            [['order_id'], 'string', 'max' => 50],
            [['payment_method', 'shipping_method', 'order_note'], 'string', 'max' => 255],
            [['order_id'], 'unique'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'customer_id' => 'Customer ID',
            'payment_method' => 'Payment Method',
            'shipping_method' => 'Shipping Method',
            'order_note' => 'Order Note',
            'total_cost' => 'Total Cost',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['book_id' => 'book_id'])->viaTable('order_detail', ['order_id' => 'order_id']);
    }

    //Lấy  new order_id
    public function getNewOrderId()
    {
           // lấy ra book_id max
        $order= Order::find()->select('order_id')->orderBy('order_id DESC')->one();
        if($order){
            $order_id_max=$order->order_id;

    //order_id_max max tăng thêm 1
            $subMax=substr($order_id_max,strpos($order_id_max,'-')+1);
            $num=(int)$subMax +1;
            $numToString=(string)$num;
            $zero="";

    //chèn thêm OD- và số 00 đằng trước
            for($i=1;$i<strlen($subMax)+1-strlen($numToString);$i++)
            {
                $zero.='0';
            }
            $order_new_id="OD-".$zero.$numToString;
        }
        else{
         $order_new_id='OD-001';
     }

     return $order_new_id;
 }
}
