<?php /* input Name được tự động xác định từ tên của
model(LoginForm) và tên attribute. Ví dụ , tên của các trường input dành cho
attribute username là LoginForm[username]. Tên này sẽ dẫn đến 1 mảng 
của tất cả các thuộc tính  cho form hoạt động $_POST['LoginForm'].
*/
 ?>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <?php if(isset($_POST['LoginForm'])) {
	echo '<pre>';
	print_r($_POST['LoginForm']); 
	echo '</pre>';
}?> -->
<?php $form = ActiveForm::begin(['id' => 'login-form']) ?>
<span id="reauth-email" class="reauth-email"></span>


<?= $form->field($model, 'email')->textInput(['id' => 'inputEmail','placeholder'=>'Email address','class'=>'form-control'])->label(false) ?>

<?= $form->field($model, 'password')->passwordInput(['id'=>'inputPassword','placeholder'=>'Password','class'=>'form-control'])->label(false) ?>

<?= $form->field($model, 'rememberMe')->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton('Sign in', ['class' => 'btn btn-lg btn-primary btn-block btn-signin']) ?>
</div>
<div>
   <a href="#" class="forgot-password">
    Forgot the password?
</a> 
</div>

<?php ActiveForm::end(); ?>



    