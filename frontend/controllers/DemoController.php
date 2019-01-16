<?php 
namespace frontend\controllers;

use yii\web\Controller;
/**
 * 
 */
class DemoController extends Controller
{
	
	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionHello()
	{
		return $this->render('hello');
	}

	public function actionHelloWorld()
	{
		return $this->render('hello-world');
	}
}
 ?>