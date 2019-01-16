<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <div class="modal-dialog login1 login5 login5-1">
            <div class="modal-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#sign-In1" aria-controls="sign-In1" role="tab" data-toggle="tab">Đăng nhập</a></li>
                    <li role="presentation"><a href="#sign-up2" aria-controls="sign-up2" role="tab" data-toggle="tab">Đăng ký</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="sign-In1">
                        <div class="modal-content mb-50">
                            <div class="user-box">
                                <!--FORM FIELD START-->
                                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                <div class="input-dec3">
                                 <?= $form->field($model, 'email')->textInput(['placeholder'=>'Email'])->label(false) ?>
                             </div>
                             <div class="input-dec3">
                                 <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Mật khẩu'])->label(false) ?>
                             </div>
                             <div class="dialog-footer">
                                <div class="input-container">
                                    <label>
                                       <?= $form->field($model, 'rememberMe')->checkbox(['class'=>'radio-value']) ?>

                                   </label>

                                   <?php echo Html::a('Forgot Password <i class="fa fa-question-circle"></i>', ['site/request-password-reset']) ?>

                               </div>
                               <div class="form-group">
                                <?= Html::submitButton('Đăng nhập', ['class' => 'dialog-button', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <!--FORM FIELD END-->
                    </div>
                </div>   
            </div>
            <div role="tabpanel" class="tab-pane" id="sign-up2">
                <div class="modal-content mb-50"">
                    <div class="user-box">
                       <!--FORM FIELD START-->
                       <?php $form = ActiveForm::begin(
                        [
                        'id' => 'form-signup',
                        'action'=>Yii::$app->urlManager->baseUrl.'/site/signup'
                    ]); ?>

                    <div class="input-dec3">
                        <?= $form->field($modelRegister, 'email')->textInput(['placeholder'=>'Email'])->label(false) ?>
                    </div>
                    <div class="input-dec3">
                     <?= $form->field($modelRegister, 'password')->passwordInput(['placeholder'=>'Mật khẩu'])->label(false) ?>
                 </div>
                 <div class="dialog-footer">
                   <div class="form-group">
                    <?= Html::submitButton('Đăng ký', ['class' => 'dialog-button', 'name' => 'signup-button']) ?>
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