<?php 
namespace frontend\controllers;

use yii\web\Controller;
use backend\models\News;
/**
 * 
 */
class NewsController extends Controller
{
	
	public function actionIndex($id)
	{
		$model=new News();
		return $this->render('news-detail', [
			'model' => $this->findModel($id),
		]);
	}
	protected function findModel($id)
	{
		if (($model = news::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}

}
?>