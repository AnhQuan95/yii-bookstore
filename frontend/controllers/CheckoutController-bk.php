<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Checkout;
use frontend\components\Cart;
use common\models\Customer;
use backend\models\Order;
use backend\models\OrderDetail;

class CheckoutController extends Controller
{
	public function actionIndex()
	{
		$model=new Checkout();

    	//Lấy ra thông tin giỏ hàng trong session
		$cart=new Cart();
		$cart_store=$cart->cart_store;
		$cost=$cart->getCost();

		//Nếu đặt hàng 
		if($model->load(Yii::$app->request->post()))
		{
			$post=Yii::$app->request->post()['Checkout'];

			$cus=new Customer;
			$cus->username='username1';
			$cus->password_hash='password_hash';
			//$cus->password_reset_token
			$cus->email=$post['email'];
			$cus->full_name=$post['full_name'];
			$cus->phone=$post['phone'];
			$cus->address=$post['address'];
			$cus->auth_key='auth_key';
			$cus->status=0;
			$cus->created_at=time();
			$cus->updated_at=time();

			//Từ form lưu thông tin khách hàng
			if($cus->save()){
				$order=new Order;
				$order->order_id=$order->getNewOrderId();
				$order->customer_id=$cus->id;
				$order->order_note=$post['phone'];
				$order->payment_method=$post['payment_method'];
				$order->shipping_method=$post['shipping_method'];
				$order->total_cost=$post['total_cost'];
				$order->status=0;
				$order->created_at=time();
				$order->updated_at=time();

				//Từ form lưu thông tin order
				if($order->save()){

					foreach ($cart_store as $item) {
						$orderDetail=new OrderDetail;
						$orderDetail->order_id=$order->order_id;
						$orderDetail->book_id=$item->book_id;
						$orderDetail->price=$item->price;
						$orderDetail->quantity=$item->quantity_in_cart;
						$orderDetail->status=0;

						//Từ form lưu thông tin order detail
						if($orderDetail->save())
						{
							echo 'Ok';
						}
						else{
							print_r($orderDetail->getErrors());
						}

					}

				}
				else{
					print_r($order->getErrors());
				}
			}
			else{
				print_r($cus->getErrors());
			}
		}
		

		return $this->render('index',[
			'model'=>$model,
			'cart_store'=>$cart_store,
			'cost'=>$cost
		]);
	}
	public function actionConfirm(){
		return $this->render('confirm',[]
	}

}
