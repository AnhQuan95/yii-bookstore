<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
  <div class="row">
    <div class="modal-dialog login1 login6">
      <div role="tabpanel">
        <div class="modal-content m-50"">
          <div class="user-box">
           <!--FORM FIELD START-->
           <?php $form = ActiveForm::begin(
            [
              'id' => 'form-update',
              'action'=>Yii::$app->urlManager->baseUrl.'/site/update'
            ]); ?>

            <div class="input-dec3">
             <i class="fa fa-envelope-o"></i>
             <?= $form->field($model, 'email')->textInput(['placeholder'=>'Email'])->label(false) ?>
           </div>
           <div class="input-dec3">

             <?= $form->field($model, 'full_name')->textInput(['placeholder'=>'Tên'])->label(false) ?>
             <i class="fa fa-lock"></i>
           </div>
           <div class="input-dec3">

             <?= $form->field($model, 'phone')->textInput(['placeholder'=>'Số điện thoại'])->label(false) ?>
             <i class="fa fa-lock"></i>
           </div>
           <div class="input-dec3">

             <?= $form->field($model, 'address')->textInput(['placeholder'=>'Địa chỉ'])->label(false) ?>
             <i class="fa fa-lock"></i>
           </div>
           <div class="input-dec3">

             <?= $form->field($model, 'birthday')->widget(\yii\jui\DatePicker::class,
               [
                'dateFormat' => 'dd-MM-yyyy',
                'language' => 'vi',
                'options' => ['class' => 'form-control','placeholder'=>'Ngày sinh : dd-MM-yyyy'],
                'clientOptions'=>[                                       
                  'changeMonth'=>TRUE ,                                 
                  'changeYear'=>TRUE ,    
                  'showButtonPanel'=>TRUE,
                  'showOn' => 'button',
                  'buttonImage' => Yii::$app->urlManager->baseUrl.'/images/calendar.png',
                  'buttonImageOnly' => true,                    
                  'yearRange' => '1918:2008',                                                   
                ],
              ])->label(false)?> 

              <i class="fa fa-lock"></i>
            </div>
            <div class="dialog-footer">
             <div class="form-group">
              <?= Html::submitButton('Cập nhật thông tin', ['class' => 'dialog-button', 'name' => 'signup-button']) ?>
            </div>
          </div>
          <?php ActiveForm::end(); ?>
          <!--FORM FIELD END-->
        </div>
      </div>   
    </div>
  </div>
</div>
</div>
</div>