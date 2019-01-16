<?php

namespace frontend\controllers;
use backend\models\Comment;
use Yii;
date_default_timezone_set('Asia/Ho_Chi_Minh');

class CommentController extends \yii\web\Controller
{
	public function actionIndex()
	{
		return $this->render('index');
	}


     	//Thêm comment
	public function actionAddComment()
	{
		
		$model = new Comment();
		if ($model->load(Yii::$app->request->post())){
			$model->cmt_date =time();
			if($model->save()) {
				Yii::$app->session->setFlash('comment','<strong> Bình luận của bạn đang được xử lý</strong> . Vui lòng đợi !!!');
			}
		  return $this->refresh();

		}
		return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
	}

}

