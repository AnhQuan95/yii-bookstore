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
        <div class="modal-dialog login1 login6">
            <div class="modal-content mb-50">
                <div class="user-box">

                    <!--FORM FIELD START-->
                    <?php $form = ActiveForm::begin(
                        [
                            'id' => 'login-form',
                            'action'=>Yii::$app->urlManager->baseUrl.'/site/login'
                        ]); ?>
                        <div class="input-dec3">
                         <?= $form->field($model, 'email')->textInput(['placeholder'=>'Email'])->label(false) ?>
                         <i class="fa fa-envelope-o"></i>
                     </div>
                     <div class="input-dec3">
                        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Mật khẩu'])->label(false) ?>
                        <i class="fa fa-lock"></i>
                    </div>
                    <div class="dialog-footer">
                        <div class="input-container">
                            <label>
                               <?= $form->field($model, 'rememberMe')->checkbox(['class'=>'radio-value']) ?>
                           </label>
                           <?php echo Html::a('Quên mật khẩu <i class="fa fa-question-circle"></i>', ['site/request-password-reset']) ?>
                       </div>
                       <?= Html::submitButton('Đăng nhập', ['class' => 'dialog-button', 'name' => 'login-button']) ?>
                   </div>
                   <?php ActiveForm::end(); ?>
                   <!--FORM FIELD END-->

               </div>

           </div>   
           <div class="clear"></div>
           <?php echo Html::a('<span>Bạn chưa có tài khoản?</span> Tạo tài khoản',['/site/signup'],['class'=>'new-account']) ?>
          
       </div>


   </div>
</div>
