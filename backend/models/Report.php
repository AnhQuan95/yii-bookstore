<?php

namespace backend\models;


use Yii;
use backend\models\Whilist;
use backend\models\Order;
use backend\models\OrderDetail;


class Report extends \yii\db\ActiveRecord
{
	
	public function getFavouriteBooks()
	{
		$data=Whilist::find()->select(['book_id','count(book_id) AS quantity'])->groupBy('book_id')->orderBy('quantity DESC')->limit(10)->all();
		// $query=Whilist::find()->select(['book_id','count(book_id) AS sl'])->groupBy('book_id')->orderBy('sl DESC')->limit(10);
		//  echo $query->createCommand()->getRawSql(); 
		return $data;
	}

	public function getBestsellerBooks()
	{
		$data=OrderDetail::find()->select(['book_id','quantity'])->join('INNER JOIN','order','order.order_id=order_detail.order_id')->where(['status'=>2])->groupBy('book_id')->orderBy('quantity DESC')->limit(10)->all();
		return $data;
	}
}
