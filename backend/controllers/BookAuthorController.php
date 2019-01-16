<?php

namespace backend\controllers;

use Yii;
use backend\models\BookWithAuthor;
use backend\models\BookAuthor;
use backend\models\Author;
use backend\models\BookAuthor_search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// use backend\models\BookWithAuthor;

/**
 * BookAuthorController implements the CRUD actions for BookAuthor model.
 */
class BookAuthorController extends Controller
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
     * Lists all BookAuthor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookAuthor_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BookAuthor model.
     * @param string $book_id
     * @param integer $author_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($book_id, $author_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($book_id, $author_id),
        ]);
    }

    /**
     * Creates a new BookAuthor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $model = new BookAuthor();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'book_id' => $model->book_id, 'author_id' => $model->author_id]);
        // }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);

     $model = new BookWithAuthor();
    
       
    if ($model->load(Yii::$app->request->post())) {
        // print_r($model->author_ids);
        // die;
        // if ($model->save()) {
            $model->saveAuthors();
            // print_r($model->saveAuthors());
            //     die;
              return $this->redirect(['view', 'book_id' => $model->book_id, 'author_id' => $model->author_id]);
        // }
    }
    return $this->render('create', [
        'model' => $model,
        'authors' => Author::getAvailableAuthors(),
    ]);

    
}
    /**
     * Updates an existing BookAuthor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $book_id
     * @param integer $author_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($book_id, $author_id)
    {
        $model = $this->findModel($book_id, $author_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'book_id' => $model->book_id, 'author_id' => $model->author_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BookAuthor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $book_id
     * @param integer $author_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($book_id, $author_id)
    {
        $this->findModel($book_id, $author_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BookAuthor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $book_id
     * @param integer $author_id
     * @return BookAuthor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($book_id, $author_id)
    {
        if (($model = BookAuthor::findOne(['book_id' => $book_id, 'author_id' => $author_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
