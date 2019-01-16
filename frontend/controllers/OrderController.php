<?php

namespace frontend\controllers;

use Yii;
use backend\models\Order;
use backend\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\OrderDetail;
use backend\models\BookWithAuthor;
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='private';
        $order=new Order();
        if(!Yii::$app->user->isGuest): 
            $model = $order->getOrder(Yii::$app->user->identity->id);
        else:
            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        endif;
        return $this->render('index', [
            'model'=>$model
        ]);
    }

    /**
     * Displays a single Order model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
       if(!Yii::$app->user->isGuest): 
         $model=$this->findModel($id);
         if($model->customer_id==Yii::$app->user->identity->id):
            return $this->render('view', [
            // 'model' => $this->findModel($id),
                'model'=>$model
            ]);
        else:
           return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
       endif;
   else:
      return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
  endif;

}
public function actionChangeStatus($id,$status)
{
    $model = $this->findModel($id);
    $model->status=$status;
    if($status==3):
        $order_detail=OrderDetail::find()->where(['order_id'=>$id])->all();
        foreach ( $order_detail as $item) :
            $book=BookWithAuthor::findOne($item->book_id);
            $book->quantity=$book->quantity + $item->quantity;
            $book->save();
        endforeach;
    endif;
    if($model->save()) :
        return $this->redirect(['view', 'id' => $model->order_id]);      
    endif;
    return $this->redirect(['view', 'id' => $model->order_id]);    


}


    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    

}
