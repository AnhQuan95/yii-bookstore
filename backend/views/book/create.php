<?php

use yii\helpers\Html;
use backend\models\Author;


/* @var $this yii\web\View */
/* @var $model backend\models\Book */

$this->title = 'Thêm mới';
$this->params['breadcrumbs'][] = ['label' => 'Sách', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'authors' => Author::getAvailableAuthors(),
    ]) ?>

</div>
