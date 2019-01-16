<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Checkout;
use frontend\components\Cart;
use common\models\Customer;
use backend\models\Order;
use backend\models\OrderDetail;
use backend\models\BookWithAuthor;
date_default_timezone_set('Asia/Ho_Chi_Minh');

class CheckoutController extends Controller
{
	public function actionIndex()
	{
		 //Lấy ra thông tin giỏ hàng trong session
		$cart=new Cart();
		$cart_store=$cart->cart_store;
		$cost=$cart->getCost();
		$model=new Checkout();
		return $this->render('index',[
			'model'=>$model,
			'cart_store'=>$cart_store,
			'cost'=>$cost
		]);
	}

	public function actionConfirm(){
		$cart=new Cart();
		$cart_store=$cart->cart_store;
		$cost=$cart->getCost();
		$model=new Checkout();
		


		//Nếu đặt hàng 
		if($model->load(Yii::$app->request->post())):
				//Nếu là thành viên
			if(!Yii::$app->user->isGuest):
				
				//Từ form lưu thông tin order
				if($order=$model->order(Yii::$app->user->identity->id)):

					//Từ form lưu thông tin order_detail
					if($model->orderDetail($order->order_id)):

					//Đặt hàng thành công . Trừ đi số lượng sản phẩm trong kho
						$order_detail=OrderDetail::find()->where(['order_id'=>$order->order_id])->all();
						foreach ( $order_detail as $item) :
							$book=BookWithAuthor::findOne($item->book_id);
							$book->quantity=$book->quantity - $item->quantity;
							$book->save();
						endforeach;

					endif;

				endif;


				//Là khách
			else:
				$cus_exist=Customer::findByEmail($model->email);
				//Email đã đăng ký
				if($cus_exist):
					Yii::$app->session->addFlash('danger','Tài khoản email của bạn đã được đăng ký. Vui lòng đăng nhập để tiếp tục mua hàng.');
					return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

					//Còn không 
				else:

					//Từ form lưu thông tin khách hàng
					if($cus=$model->customer()):

						//Từ form lưu thông tin order
						if($order=$model->order($cus->id)):

						//Từ form lưu thông tin order_detail
							if($model->orderDetail($order->order_id)):

								//Đặt hàng thành công . Trừ đi số lượng sản phẩm trong kho
								$order_detail=OrderDetail::find()->where(['order_id'=>$order->order_id])->all();
								foreach ( $order_detail as $item) :
									$book=BookWithAuthor::findOne($item->book_id);
									$book->quantity=$book->quantity - $item->quantity;
									$book->save();
								endforeach;


							endif;

						endif;

					endif;

				endif;
			endif;

			
			//Gửi gmail
			$html='<b>Cảm ơn bạn '.$order->full_name.' đã đặt hàng tại Anh Quân Book Store</b>';
			$html.='<p>Anh Quân Book Store rất vui thông báo đơn hàng #'.$order->order_id.' của bạn đã được tiếp nhận và đang trong quá trình xử lý. Chúng tôi sẽ thông báo đến quý khách nay khi hàng chuẩn bị được giao'.'</p>';

			$html.='<b>THÔNG TIN ĐƠN HÀNG '.$order->order_id.' (Ngày đặt : '.date("d-m-Y H:i:s",($order->created_at)).' )</b>';

			$html.='<p><b> Địa chỉ giao hàng :</b></p>';
			$html.='<p>'.$order->full_name.'</p>';
			$html.='<p>'.$order->email.'</p>';
			$html.='<p>'.$order->delivery_address.'</p>';
			$html.='<p>'.$order->phone.'</p>';
			$html.='<p><b> Ghi chú đơn hàng :</b></p>';
			$html.=$order->order_note;
			$html.='<p><b> Phương thức thanh toán :</b></p>';
			$html.='<p>'.$order->payment_method.'</p>';
			$html.='<p><b> Phương thức vận chuyển :</b></p>';
			$html.='<p>'.$order->shipping_method.'</p>';
			$html.='<p><b>Chi tiết đơn hàng : </b></p>';
			$html .= '<table border="1" cellspacing="0" cellpadding="10" >

			<thead>
			<tr>
			<th>STT</th>
			<th>Tên</th>
			<th>Giá</th>
			<th>Số lượng</th>
			<th>Thành Tiền</th>
			</tr>
			</thead>
			<tbody>';

			$n=1;foreach ($order_detail as $order_detail):
			$html .= '<tr>';
			$html .= '<td>'.$n.'</td>';
			$html .='<td>'.
			$order_detail->book->book_name
			.'</td>';
			$html .='<td>'.number_format($order_detail->price,0, '', '.').'</td>';
			$html .='<td>'.$order_detail->quantity.'</td>';
			$html .='<td>'.number_format($order_detail->price* $order_detail->quantity,0, '', '.').'</td>';
			$html .='</tr>';
			$n++; endforeach; 


			$html .= '</tbody>';
			$html .= ' </table>';

			$html.='<br><h3><b>Tổng tiền '.number_format($order->total_cost,0, '', '.').' VNĐ</b></h3>';
			$html .='<br> <i> Lưu ý : Nếu bạn thanh toán qua ngân hàng . Vui lòng chuyển khoản tới TK : <strong>109005337706 - Đào Anh Quân Vietin Bank</strong> với cú pháp : Thanh toán - #mã_đơn_hàng .</i>';

			$model->sendEmail(Yii::$app->params['storeEmail'],$html);

			//Xóa giỏ hàng 
			$cart->removeAll();
				//Xác nhận thành công
			return $this->render('confirm',[
				'model'=>$model,
				'cart_store'=>$cart_store,
				'cost'=>$cost,
				'order_id'=>$order->order_id,
			]);
		//Còn không đặt hàng
		else:
			return $this->render('confirm',[
				'model'=>$model,
				'cart_store'=>$cart_store,
				'cost'=>$cost,
			]);
		endif;




	}
}

