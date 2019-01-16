<?php

namespace backend\controllers;

use Yii;
use backend\models\Book;
use backend\models\BookWithAuthor;
use backend\models\Author;
use backend\models\Book_search;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
date_default_timezone_set('Asia/Ho_Chi_Minh');
/**
 * BookController implements the CRUD actions for Book model.
 */


class BookController extends Controller
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
    //                     'access' => [
    //             'class' => AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'actions' => ['login', 'error'],
    //                     'allow' => true,
    //                 ],
    //                 [
    //                     'actions' => ['logout', 'index'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['POST'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Book_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param string $id
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
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $model = new Book();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->book_id]);
        // }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);


    // lấy ra book_id max
        $book_id= Book::find()->select('book_id')->orderBy('book_id DESC')->one();
        if($book_id){
            $book_id_max=$book_id->book_id;

    //book_id max tăng thêm 1
            $subMax=substr($book_id_max,strpos($book_id_max,'-')+1);
            $num=(int)$subMax +1;
            $numToString=(string)$num;
            $zero="";

    //chèn thêm BK- và số 00 đằng trước
            for($i=1;$i<strlen($subMax)+1-strlen($numToString);$i++)
            {
                $zero.='0';
            }
            $book_new_id="BK-".$zero.$numToString;
        }
        

        // Khai báo model 
        $model = new BookWithAuthor();
        $model->book_id=isset($book_new_id)?$book_new_id:'BK-001';


        if ($model->load(Yii::$app->request->post())) {
        // print_r($model->author_ids);
        // die;

           $model->publish_at=date("Y-m-d",strtotime($model->publish_at));


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

         //check sale price
           if($model->sale_price>$model->price):
             Yii::$app->session->addFlash('danger','Giá khuyến mãi không được lớn hơn giá bán');
             return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

         else: 
            if ($model->save()) :

                $model->saveAuthors();
                Yii::$app->session->addFlash('success','Thêm sách thành công');

                return $this->redirect(['view', 'id' => $model->book_id]);
            else:
               Yii::$app->session->addFlash('danger','Thêm sách không thành công');  
               return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
           endif;
       endif;


   }
   return $this->render('create', [
    'model' => $model,
    'authors' => Author::getAvailableAuthors(),
]);

}

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        
        $model = BookWithAuthor::findOne($id);
        $model->loadAuthors();
        if ($model->load(Yii::$app->request->post())) {
            $model->publish_at=date("Y-m-d",strtotime($model->publish_at));
            $model->updated_at=time();

              // http://localhost/
            $host='http://'.$_SERVER['HTTP_HOST'];

        // yiidemo
            $homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

        // http://localhost/yiidemo
            $baseUrl=$host.$homeUrl;

            echo $baseUrl.'/uploads/images/';
            echo '<br>';
            $image= str_replace($baseUrl.'/uploads/images/','',$model->image);
            
            $model->image=$image;

            //check sale price 
            if($model->sale_price>$model->price):
                Yii::$app->session->addFlash('danger','Giá khuyến mãi không được lớn hơn giá bán');
                return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
            else:
                if ($model->save()) :

                // die;
                    $model->saveAuthors();
                    Yii::$app->session->addFlash('success','Cập nhật sách thành công');
                    return $this->redirect(['view', 'id' => $model->book_id]);
                else:
                   Yii::$app->session->addFlash('danger','Cập nhật không thành công');
                   return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
               endif;

           endif;

       }

       return $this->render('update', [
        'model' => $model,
        'authors' => Author::getAvailableAuthors(),
    ]);
   }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BookWithAuthor::findOne($id)) !== null) {
          $model->loadAuthors();
          return $model;
      }

      throw new NotFoundHttpException('The requested page does not exist.');
  }
}


