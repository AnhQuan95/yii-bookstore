<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Author */

$this->title = 'Cập nhật : ';
$this->params['breadcrumbs'][] = ['label' => 'Tác giả', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->author_id, 'url' => ['view', 'id' => $model->author_id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
