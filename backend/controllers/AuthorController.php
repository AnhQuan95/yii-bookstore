<?php

namespace backend\controllers;

use Yii;
use backend\models\Author;
use backend\models\Author_search;
use backend\models\BookAuthor;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
date_default_timezone_set('Asia/Ho_Chi_Minh');
/**
 * AuthorController implements the CRUD actions for Author model.
 */
class AuthorController extends Controller
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
     * Lists all Author models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Author_search();
        // print_r(Yii::$app->request->queryParams);
        // die;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Author model.
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
     * Creates a new Author model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Author();

        if ($model->load(Yii::$app->request->post())) {
        //     echo '<pre>';
        //    print_r($model);
        // echo '</pre>';     
        // die;
         $model->created_at = time();
         $model->updated_at = time();
         
         if($model->save()){
            // $session = Yii::$app->session;
            // var_dump( $session );
            // die;
            // $session->addFlash('alerts', 'You have successfully deleted your post.');
            // $alerts = $session->getFlash('alerts');

            Yii::$app->session->addFlash('success','Thêm mới tác giả thành công');
            // print_r(Yii::$app->session->getFlash('success'));
            // die;
            return $this->redirect(['view', 'id' => $model->author_id]);
        }
        else{
            Yii::$app->session->addFlash('danger','Thêm mới tác giả không thành công');
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
     * Updates an existing Author model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
;  
        if ($model->load(Yii::$app->request->post())) {
        //     echo '<pre>';
        //    print_r($model);
        // echo '</pre>';     
        // die;
         $model->updated_at = time();
         // var_dump($model->save());
         // die;
         if($model->save()){
            Yii::$app->session->addFlash('success','Cập nhật tác giả thành công');
            return $this->redirect(['view', 'id' => $model->author_id]);
        }
        else{
            Yii::$app->session->addFlash('danger','Cập nhật tác giả không thành công');
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
     * Deletes an existing Author model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $check=BookAuthor::find()->where(['author_id'=>$id])->all();
        if(count($check)>0){
            
        Yii::$app->session->addFlash('danger','Xin lỗi, nhưng vẫn có những mục liên quan!');
       }
       else{
           $model = $this->findModel($id);
           $model->delete();
        //$this->findModel($id)->delete();
       }
       return $this->redirect(['index']);
       
       
   }

    /**
     * Finds the Author model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Author the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Author::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionBulk(){
   // $action=Yii::$app->request->post('action');
    $selection=(array)Yii::$app->request->post('selection');//typecasting
   // var_dump($selection);
   //  die;
    foreach($selection as $id){
        $e=Author::findOne((int)$id);//make a typecasting
        
        $check=BookAuthor::find()->where(['author_id'=>(int)$id])->one();
        if($check){
           Yii::$app->session->addFlash('danger','Xin lỗi, nhưng vẫn có những mục liên quan!');
       }
       else{
           
           $e->delete_logical=time();
           $e->save();
        //$this->findModel($id)->delete();
       }
   }
        //do your stuff
   return $this->redirect(['index']);
}

}
