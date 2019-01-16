<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'status')->radioList([
        0=>'Không kích hoạt',
        1=>'Kích hoạt'

    ]) ?> 

    <div class="form-group">
        <?= Html::submitButton('Cập nhật', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
