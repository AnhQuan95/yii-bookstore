<?php 
namespace frontend\controllers;

use yii\web\Controller;
use frontend\components\Cart;
use backend\models\Book;
use Yii;

/**
 * Class quản lý giỏ hàng
 */
class CartController extends Controller
{
	
	function actionIndex()
	{
		$cart=new Cart();
		//Lấy session['cart'];
		$cart_store=$cart->cart_store;
		$cost=$cart->getCost();
		$totalItem=$cart->getTotalItem();
		return $this->render('index',[
			'cart_store'=>$cart_store,
			'cost'=>$cost,
			'totalItem'=>$totalItem
		]);
	}

	//Thêm sản phẩm
	public function actionAddCart($id)
	{
		$cart=new Cart();

		$model=Book::findOne(['book_id'=>$id]);

				// var_dump($model);		
		if(Yii::$app->request->post())
		{
			$quantity_in_cart=$_POST['quantity'];
			$quantity_in_cart=($quantity_in_cart==''||$quantity_in_cart==0)? 1: $quantity_in_cart;
			// var_dump($quantity_in_cart);
			// die;
			$cart->add($model,$quantity_in_cart);
			if($cart->flat):
				echo 'ok';
			else:
				echo 'not ok';
			endif;
		}

		
		
		//return $this->redirect(['/cart']);
	}

	//Xóa sản phẩm
	public function actionRemove($id)
	{
		$cart=new Cart();

		$model=Book::findOne(['book_id'=>$id]);
		// var_dump($model);

		$cart->remove($model);
		return $this->redirect(['/cart']);
	}

	//cập nhật
	public function actionUpdateCart(){
		$cart=new Cart();
		$cart_store=$cart->cart_store;
		
		if(Yii::$app->request->post())
		{
			$quantity_in_cart=$_POST['quantity'];
			$id=$_POST['id'];		
			$book=Book::findOne($id);
			$quantity=$book->quantity;
			$name=$book->book_name;
			$cart->update($id,$quantity_in_cart,$quantity);
			if(!$cart->check):
				Yii::$app->session->setFlash('out_of_stock','Sản phẩm <strong>'.$name.'</strong> chỉ còn '.$quantity.' sản phẩm');
				return $this->refresh();
			endif;

			

		}
		
		return $this->redirect(['/cart']);


	}

	//Xóa toàn bộ 
	public function actionClear()
	{
		$cart=new Cart();
		$cart->removeAll();
		return $this->redirect(['/cart']);
	}


}
?>