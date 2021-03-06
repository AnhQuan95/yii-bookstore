<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\Category_search;
use backend\models\Book;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Category_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        if ($model->load(Yii::$app->request->post())) {
        //     echo '<pre>';
        //    print_r($model);
        // echo '</pre>';     
        // die;
            $model->parent=($model->parent)? $model->parent:0;
            $model->created_at = time();
            $model->updated_at = time();
            if($model->save()){
                Yii::$app->session->addFlash('success','Thêm mới danh mục sản phẩm thành công');
                return $this->redirect(['view', 'id' => $model->cate_id]);
            }
            else{
                Yii::$app->session->addFlash('danger','Thêm mới danh mục sản phẩm không thành công');
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
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->parent=($model->parent)? $model->parent:0;
            $model->updated_at = time();
            if($model->save()){
                Yii::$app->session->addFlash('success','Cập nhật danh mục sản phẩm thành công');
                return $this->redirect(['view', 'id' => $model->cate_id]);
            }
            else{
                Yii::$app->session->addFlash('danger','Cập nhật danh mục sản phẩm không thành công');
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



        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->cate_id]);
        // }

        // return $this->render('update', [
        //     'model' => $model,
        // ]);
  }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {      
        $category=new Category();
        $count=$category->countBooks($id);
        if($count>0)
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
