<?php

namespace backend\controllers;

use Yii;
use backend\models\Publisher;
use backend\models\Publisher_search;
use backend\models\Book;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
date_default_timezone_set('Asia/Ho_Chi_Minh');


/**
 * PublisherController implements the CRUD actions for Publisher model.
 */
class PublisherController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['POST'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all Publisher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Publisher_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Publisher model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Publisher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publisher();


        if ($model->load(Yii::$app->request->post())) {
        //     echo '<pre>';
        //    print_r($model);
        // echo '</pre>';     
        // die;
           $model->created_at = time();
           $model->updated_at = time();
           if($model->save()){
            Yii::$app->session->addFlash('success','Thêm mới nhà xuất bản thành công');
            return $this->redirect(['view', 'id' => $model->publisher_id]);
        }
        else{
            Yii::$app->session->addFlash('danger','Thêm mới nhà xuất bản không thành công');
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }
    else{
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}

    /**
     * Updates an existing Publisher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        //     echo '<pre>';
        //    print_r($model);
        // echo '</pre>';     
        // die;
           $model->updated_at = time();
           if($model->save()){
            Yii::$app->session->addFlash('success','Cập nhật nhà xuất bản thành công');
            return $this->redirect(['view', 'id' => $model->publisher_id]);
        }
        else{
            Yii::$app->session->addFlash('danger','Cập nhật nhà xuất bản không thành công');
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }
    else{
        return $this->render('update', [
            'model' => $model,
        ]);
    }
}

    /**
     * Deletes an existing Publisher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $check= Book::find()->where(['publisher_id'=>$id])->all();
        if(count($check)>0)
        {
           Yii::$app->session->addFlash('danger','Xin lỗi, nhưng vẫn có những mục liên quan!');
       }
       else{
        $model = $this->findModel($id);
        $model->delete();
    }
    return $this->redirect(['index']);
}


    /**
     * Finds the Publisher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Publisher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publisher::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
