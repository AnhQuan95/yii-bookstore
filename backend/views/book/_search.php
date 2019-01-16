<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Book_search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'book_id') ?>

    <?= $form->field($model, 'book_name') ?>

    <?= $form->field($model, 'cate_id') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'sale_price') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'pages') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'publisher_id') ?>

    <?php // echo $form->field($model, 'publish_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'delete_logical') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
