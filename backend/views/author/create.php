<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Author */

$this->title = 'Thêm mới';
$this->params['breadcrumbs'][] = ['label' => 'Tác giả', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
