<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Publisher */

$this->title = 'Thêm mới';
$this->params['breadcrumbs'][] = ['label' => 'Nhà xuất bản', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publisher-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
