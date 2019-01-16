<?php

namespace backend\controllers;

use Yii;
use backend\models\news;
use backend\models\News_Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
date_default_timezone_set('Asia/Ho_Chi_Minh');
/**
 * NewsController implements the CRUD actions for news model.
 */
class NewsController extends Controller
{
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

    /**
     * {@inheritdoc}
     */
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
     * Lists all news models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new News_Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single news model.
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
     * Creates a new news model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new news();

        if ($model->load(Yii::$app->request->post())){
         $model->created_at=time();
         $model->updated_at=time();

           // http://localhost/
         $host='http://'.$_SERVER['HTTP_HOST'];

        // yiidemo
         $homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

        // http://localhost/yiidemo
         $baseUrl=$host.$homeUrl;
         $image= str_replace($baseUrl.'/uploads/images/','',$model->image);
         $model->image=$image;

         if($model->save()) {
             Yii::$app->session->addFlash('success','Thêm tin tức thành công');
             return $this->redirect(['view', 'id' => $model->news_id]);
         }
         else{
             Yii::$app->session->addFlash('danger','Thêm tin tức không thành công');  
             return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
         }
     }
     else{
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}


    /**
     * Updates an existing news model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

     
        if ($model->load(Yii::$app->request->post())){

         $model->updated_at=time();

           // http://localhost/
         $host='http://'.$_SERVER['HTTP_HOST'];

        // yiidemo
         $homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

        // http://localhost/yiidemo
         $baseUrl=$host.$homeUrl;
         $image= str_replace($baseUrl.'/uploads/images/','',$model->image);
         $model->image=$image;

         if($model->save()) {
             Yii::$app->session->addFlash('success','Cập nhật tin tức thành công');
             return $this->redirect(['view', 'id' => $model->news_id]);
         }
         else{
             Yii::$app->session->addFlash('danger','Cập nhật tin tức không thành công');  
             return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
         }
     }
     else{
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    }

    /**
     * Deletes an existing news model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the news model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return news the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = news::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
