<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Publisher */

$this->title = 'Cập nhật : ';
$this->params['breadcrumbs'][] = ['label' => 'Nhà xuất bản', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->publisher_id, 'url' => ['view', 'id' => $model->publisher_id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="publisher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
