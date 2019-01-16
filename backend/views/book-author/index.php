<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Book;
use backend\models\Author;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookAuthor_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Book Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-author-index">
  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p>
    <?= Html::a('Create Book Author', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn',
        'header'=>'STT'
    ],
    [
        'attribute'=>'book_id',
        'content'=>function($model){

            $book=Book::find()
            ->select('book_name')
            ->where(['delete_logical'=>0,'book_id'=>$model->book_id])
            ->one();
            return $book->book_name;
        }
    ],

    [
        'attribute'=>'author_id',
        'content'=>function($model){

            $author=Author::find()
            ->select('author_name')
            ->where(['delete_logical'=>0,'author_id'=>$model->author_id])
            ->one();
            return $author->author_name;
        }
    ],


    ['class' => 'yii\grid\ActionColumn'],
],
]); ?>
</div>
