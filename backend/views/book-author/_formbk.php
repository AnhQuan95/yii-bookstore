<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Book;
use backend\models\Author;

/* @var $this yii\web\View */
/* @var $model backend\models\BookAuthor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-author-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'book_id')->dropDownList(
        ArrayHelper::map(Book::find()->where(['delete_logical'=>0])->all(),'book_id','book_name'),
        ['prompt'=>'Chọn sách']) ?>

    <?= $form->field($model, 'author_id')->dropDownList(
        ArrayHelper::map(Author::find()->where(['delete_logical'=>0])->all(),'author_id','author_name'));
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
