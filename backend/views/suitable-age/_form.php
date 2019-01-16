<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SuitableAge */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suitable-age-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_of_age')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'status')->radioList(
        [
            0=>'Không kích hoạt',
            1=>'Kích hoạt',
            
        ]
    ) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord?'Thêm':'Cập nhật',['class' => $model->isNewRecord ?'btn btn-success':'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
