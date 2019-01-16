<?php 
namespace frontend\components;


use Yii;
/**
 * Xử lý giỏ hàng :
 Gồm các phương thức :

 */
 class Cart
 {
	/*
		Phương thức thêm vào giỏ hàng có các tham số sau
		@data  = sẽ lấy theo id hoặc slug
		@quantity = số lượng mỗi lần thêm vào giỏ hàng . Thông thường là 1
	*/

		/*
		Khởi tạo session trong yii sử dụng Yii::$app->session['tên_session']=Giá trị
		Lấy giá trị của session sử dụng $session = Yii::$app->session['tên_session']
		*/

		public $cart_store;
		public $total=0;
		public $totalItem=0;
		
		public function __construct()
		{
			$this->cart_store=Yii::$app->session['cart'];
		}


		//Thêm sản phẩm vào giỏ hàng 
		public function add($data,$quantity_in_cart,$quantity=1)
		{

			if(isset($this->cart_store[$data->book_id]))
			{
			//Nếu tồn tại sản phẩm , +1 vào số lượng 
				if($quantity_in_cart==0){
					$this->cart_store[$data->book_id]->quantity_in_cart+=$quantity;
					Yii::$app->session['cart']=$this->cart_store;
				}
				else{
					$this->cart_store[$data->book_id]->quantity_in_cart+=$quantity_in_cart;
					Yii::$app->session['cart']=$this->cart_store;
					// print_r(Yii::$app->session['cart']);
					// die;
				}

			}
			//Không tồn tại sản phẩm trong giỏ hàng, khởi tạo sản phẩm
			else{
					//$data-> id : quản lý theo mã sách
				$this->cart_store[$data->book_id]=$data;
				if($quantity_in_cart==0){
					$this->cart_store[$data->book_id]->quantity_in_cart=$quantity;
					Yii::$app->session['cart']=$this->cart_store;
				}
				else{
					
					$this->cart_store[$data->book_id]->quantity_in_cart=$quantity_in_cart;
					Yii::$app->session['cart']=$this->cart_store;
					// print_r(Yii::$app->session['cart']);
					// die;
				}
				
				

			}
		}



		//Xóa sản phẩm khỏi giỏ hàng
		public function remove($data)
		{
			unset($this->cart_store[$data->book_id]);
			Yii::$app->session['cart']=$this->cart_store;
		}

		//Cập nhật giỏ hàng
		public function update($id,$quantity){
			$this->cart_store[$id]->quantity_in_cart=$quantity;
			Yii::$app->session['cart']=$this->cart_store;

		}

		//Lấy tổng tiền giỏ hàng
		public function getCost()
		{

			if($this->cart_store){
				foreach ($this->cart_store as $item) {
					if($item->sale_price==0){
						$this->total+=$item->quantity_in_cart*$item->price;
					}
					else{
						$this->total+=$item->quantity_in_cart*$item->sale_price;
					}

				}
			}
			return $this->total;
		}

		// Lấy tổng số sản phẩm
		public function getTotalItem()
		{

			if($this->cart_store){
				foreach ($this->cart_store as $item) {
					$this->totalItem+=$item->quantity_in_cart;

				}
			}
			return $this->totalItem;
		}

		// Trả lại toàn bộ sản phẩm
		public function removeAll()
		{
			$this->cart_store=[];
			Yii::$app->session['cart']=$this->cart_store;
		}

	}

