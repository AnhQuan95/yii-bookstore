<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->radioList([
        0=>'Chưa ghi nhận',
        1=>'Đã ghi nhận'

    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord?'Thêm':'Cập nhật',['class' => $model->isNewRecord ?'btn btn-success':'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
