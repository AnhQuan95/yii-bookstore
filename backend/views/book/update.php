<?php

use yii\helpers\Html;
use backend\models\Author;
/* @var $this yii\web\View */
/* @var $model backend\models\Book */

$this->title = 'Cập nhật';
$this->params['breadcrumbs'][] = ['label' => 'Sách', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->book_id, 'url' => ['view', 'id' => $model->book_id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 
     	'authors' => Author::getAvailableAuthors(),

    ]) ?>

</div>
