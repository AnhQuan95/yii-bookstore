<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SuitableAge */

$this->title = 'Thêm mới';
$this->params['breadcrumbs'][] = ['label' => 'Độ tuổi đọc sách phù hợp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suitable-age-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
