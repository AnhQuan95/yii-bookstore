<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */


$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>




    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
