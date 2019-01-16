<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SuitableAge */

$this->title = 'Cập nhật';
$this->params['breadcrumbs'][] = ['label' => 'Độ tuổi đọc sách phù hợp', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="suitable-age-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
