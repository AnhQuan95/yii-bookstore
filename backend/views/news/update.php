<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\news */

$this->title = 'Cập nhật:';
$this->params['breadcrumbs'][] = ['label' => 'Tin tức', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->news_id, 'url' => ['view', 'id' => $model->news_id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
