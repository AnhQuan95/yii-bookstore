<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderDetail */

// $this->title = $model->order_id;
// print_r($model);
// die;
$this->params['breadcrumbs'][] = ['label' => 'Order Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?php echo $model->order->email ?></h3>

</div>
