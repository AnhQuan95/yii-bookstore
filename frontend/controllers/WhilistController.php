<?php

namespace frontend\controllers;
use backend\models\Whilist;
use backend\models\Book;
use yii\web\NotFoundHttpException;
use Yii;
class WhilistController extends \yii\web\Controller
{
	public function actionIndex()
	{
		$this->layout='private';
		if(!Yii::$app->user->isGuest): 
			$model = Whilist::find()->where(['customer_id'=>Yii::$app->user->identity->id])->all();

		else:
			return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
		endif;
		return $this->render('index', [
			'model'=>$model 
		]);
	}

    	//Thêm sản phẩm
	public function actionAddWhilist()
	{
		
		$model = new Whilist();

		if ($model->load(Yii::$app->request->post())):

			$book_id=Whilist::find()->where(['customer_id'=>$model->customer_id,'book_id'=>$model->book_id])->one();

			if($book_id):
				Yii::$app->session->setFlash('exist_whilist','Sản phẩm <strong>'.$book_id->book->book_name.'</strong> đã được bạn yêu thích trước đó rồi');
				
			else:
				$model->save();
				Yii::$app->session->setFlash('success_whilist','Bạn đã yêu thích sản phẩm ');
			endif;


		endif;
	
		return $this->redirect(['index']);
		
	}

	public function actionRemove($id)
	{

		$this->findModel($id)->delete();

		return $this->redirect(['index']);
		
	}

	protected function findModel($id)
	{
		if (($model = Whilist::find()->where(['book_id'=>$id,'customer_id'=>Yii::$app->user->identity->id])->one()) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}

}
?>