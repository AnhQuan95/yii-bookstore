<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Whilist */

$this->title = 'Update Whilist: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Whilists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="whilist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
