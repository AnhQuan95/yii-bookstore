<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Whilist */

$this->title = 'Create Whilist';
$this->params['breadcrumbs'][] = ['label' => 'Whilists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="whilist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
