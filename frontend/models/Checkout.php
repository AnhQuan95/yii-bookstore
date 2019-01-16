<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Customer;
use backend\models\Order;
use backend\models\OrderDetail;
use frontend\components\Cart;
/**
 * ContactForm is the model behind the contact form.
 */
class Checkout extends Model
{
  public $full_name;
  public $email;
  public $address;
  public $phone;
  public $birthday;
  public $order_note;
  public $shipping_method;
  public $payment_method;
  public $total_cost;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
      return [
            // full_name, email, address and phone, shipping_method, payment_method are required
        [['full_name', 'email', 'address', 'phone','shipping_method','payment_method','order_note'], 'required','message'=>'Vui lòng nhập giá trị cho {attribute}.'],
        [['full_name', 'email', 'address', 'phone','shipping_method','payment_method'], 'string'],
        ['total_cost','integer'],
            // email has to be a valid email address
        ['email', 'trim'],
        ['email', 'email', 'message' => 'Địa chỉ email này không hợp lệ'],
        ['email', 'string', 'max' => 255]
      ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
      return [
        'full_name'=>'Họ tên',
        'email'=>'Địa chỉ email',
        'address'=>'Địa chỉ nhân hàng',
        'phone'=>'Số điện thoại liên hệ',
        'order_note'=>'Ghi chú',
        'shipping_method'=>'Phương thức vận chuyển',
        'payment_method'=>'Phương thức thanh toán',
      ];
    }

    //Customer
    public function customer(){

      if(!$this->validate()){
        return null;
      }

      $cus=new Customer;
      $cus->setPassword('123456');
      //$cus->password_reset_token
      $cus->email=$this->email;
      $cus->full_name=$this->full_name;
      $cus->phone=$this->phone;
      $cus->address=$this->address;
      $cus->birthday='2000-01-01';
      $cus->generateAuthKey();
      $cus->status=1;
      $cus->created_at=time();
      $cus->updated_at=time();

      return $cus->save()? $cus : null;
    }


    //Order
    public function order($customer_id){

      if(!$this->validate()){
        return null;
      }

      $order=new Order;
      $order->order_id=$order->getNewOrderId();
      $order->customer_id=$customer_id;
      $order->email=$this->email;
      $order->full_name=$this->full_name;
      $order->delivery_address=$this->address;
      $order->phone=$this->phone;
      $order->order_note=$this->order_note;
      $order->payment_method=$this->payment_method;
      $order->shipping_method=$this->shipping_method;
      $order->total_cost=$this->total_cost;

      $order->status=0;
      $order->created_at=time();
      $order->updated_at=time();

      return $order->save()? $order :null;
    }

    //Order detail
    public function orderDetail($order_id){

      $flat=false;
      //Lấy ra thông tin giỏ hàng trong session
      $cart=new Cart();
      $cart_store=$cart->cart_store;
      $cost=$cart->getCost();

      if(!$this->validate()){
        return null;
      }
      
      foreach ($cart_store as $item) :

        if($item->sale_price==0){
          $book_price=$item->price;
        }
        else{
          $book_price=$item->sale_price;
        } 

        $orderDetail=new OrderDetail();
        $orderDetail->order_id=$order_id;
        $orderDetail->book_id=$item->book_id;
        $orderDetail->price=$book_price;
        $orderDetail->quantity=$item->quantity_in_cart;

            //Từ form lưu thông tin order detail
        if($orderDetail->save())
        {
          $flat=true;
        }

      endforeach;

      return $flat;
    }

      /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
      public function sendEmail($email,$html)
      {
        return Yii::$app->mailer->compose()
        ->setTo([$this->email => $this->full_name])
        ->setFrom($email)
        ->setSubject('ANH QUÂN BOOK STORE - XÁC NHẬN ĐƠN HÀNG CỦA BẠN')
        ->setHtmlBody($html)
        ->send();
      }

    }
