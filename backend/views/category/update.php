<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = 'Cập nhật danh mục sách : ';
$this->params['breadcrumbs'][] = ['label' => 'Danh mục', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cate_id, 'url' => ['view', 'id' => $model->cate_id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
