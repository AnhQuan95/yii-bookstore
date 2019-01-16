<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Publisher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publisher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'publisher_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->radioList(
        [
            1=>'Kích hoạt',
            0=>'Không kích hoạt'
        ]
    ) ?>
 

    <div class="form-group">
         <?= Html::submitButton($model->isNewRecord?'Thêm':'Cập nhật',['class' => $model->isNewRecord ?'btn btn-success':'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
