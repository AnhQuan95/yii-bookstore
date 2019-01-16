<?php

namespace backend\controllers;

use Yii;
use backend\models\Report;
use backend\models\Book;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
date_default_timezone_set('Asia/Ho_Chi_Minh');
/**
 * AuthorController implements the CRUD actions for Author model.
 */
class ReportController extends Controller
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

    public function actionFavouriteBooks()
    {
        $fBooks=new Report();
        $book=$fBooks->getFavouriteBooks();
        return $this->render('favourite-book', ['book'=>$book]);
    }

     public function actionBestsellerBooks()
    {
        $fBooks=new Report();
        $book=$fBooks->getBestsellerBooks();
        return $this->render('bestseller-book', ['book'=>$book]);
    }
    
    public function actionChangeStatus($id,$status)
    {
        //Cập nhật trạng thái
        if($status==2):
            $book=Book::findOne($id);
            $book->status=$status;
            $book->save();
        endif;
        return $this->redirect(['favourite-books']); 
    }

       public function actionChangeStatus2($id,$status)
    {
        //Cập nhật trạng thái
        if($status==2):
            $book=Book::findOne($id);
            $book->status=$status;
            $book->save();
        endif;
        return $this->redirect(['bestseller-books']); 
    }

}
