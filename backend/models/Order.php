<?php

namespace backend\models;

use Yii;
use common\models\Customer;

/**
 * This is the model class for table "order".
 *
 * @property string $order_id
 * @property int $customer_id
 * @property string $email
 * @property string $full_name
 * @property string $phone
 * @property string $delivery_address
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
            [['order_id', 'email', 'full_name', 'phone', 'delivery_address'], 'required'],
            [['customer_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['total_cost'], 'number'],
            [['order_id'], 'string', 'max' => 50],
            [['email', 'full_name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['delivery_address', 'payment_method', 'shipping_method', 'order_note'], 'string', 'max' => 255],
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
            'order_id' => 'Mã đơn hàng',
            'customer_id' => 'Khách hàng',
            'email' => 'Email',
            'full_name' => 'Họ tên',
            'phone' => 'Điện thoại',
            'delivery_address' => 'Địa chỉ giao hàng',
            'payment_method' => 'Thanh toán',
            'shipping_method' => 'Vận chuyển',
            'order_note' => 'Ghi chú',
            'total_cost' => 'Tổng tiền',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
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

//Lấy đơn hàng cá nhân
   public function getOrder($customer_id)
   {
       $data=Order::find()->where(['customer_id'=>$customer_id])->orderBy('created_at DESC')->all();
       return $data;
   }
}
