<?php

namespace frontend\controllers;

use Yii;
use common\models\Customer;
use backend\models\Customer_search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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

    public function actionView()
    {
        $this->layout='private';
        return $this->render('view', [
            'model' => $this->findModel(Yii::$app->user->identity->id),
        ]);
    }


    public function actionChangePassword()
    {
        $this->layout='private';
        $user=Yii::$app->user->identity;
        $loadedPost=$user->load(Yii::$app->request->post());

        if($loadedPost && $user->validate()){
            $user->password=$user->newPassword;
            $user->save(false);
            Yii::$app->session->setFlash('change_password','Lưu ý! Mật khẩu đã thay đổi');
            return $this->refresh();
        }
        return $this->render('change-password',[
            'user'=>$user
        ]);
    }
    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $this->layout='private';
        $model = $this->findModel(Yii::$app->user->identity->id);

        if ($model->load(Yii::$app->request->post())) {
           // $model->full_name=Yii::$app->request->post()['Customer']['full_name'];

            $post=Yii::$app->request->post()['Customer'];
            $model->full_name=$post['full_name'];
            $model->phone=$post['phone'];
            $model->address=$post['address'];
            $model->birthday= date("Y-m-d",strtotime($post['birthday']));

            if($model->save()) {
                return $this->redirect(['view']);
            }
            else{
                echo '<pre>';
                print_r($model->getErrors());
                die;
            }

        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
