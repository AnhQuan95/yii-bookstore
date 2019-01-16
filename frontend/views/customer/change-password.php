<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Đổi mật khẩu';
/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal-dialog login1 login6">

	<div class="user-box">

		<?php if (Yii::$app->session->hasFlash('change_password')): ?>
			<div class="alert alert-success alert-dismissable">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<?= Yii::$app->session->getFlash('change_password') ?>
			</div>		


		<?php endif; ?>
		<h3><?= Html::encode($this->title) ?></h3>
		<?= Html::a('Quay lại',['view'],['class' => 'btn btn-primary']) ?>

		<!--FORM FIELD START-->
		<?php $form = ActiveForm::begin(); ?>

		<div class="input-dec3">
			<?= $form->field($user, 'currentPassword')->passwordInput(['placeholder'=>'Mật khẩu'])->label(false) ?>
			<i class="fa fa-lock"></i>
		</div>
		<div class="input-dec3">


			<?= $form->field($user, 'newPassword')->passwordInput(['placeholder'=>'Mật khẩu mới'])->label(false) ?>
			<i class="fa fa-lock"></i>
		</div>
		<div class="input-dec3">

			<?= $form->field($user, 'newPasswordConfirm')->passwordInput(['placeholder'=>' Xác nhận mật khẩu'])->label(false) ?>
			<i class="fa fa-lock"></i>
		</div>
		<div class="dialog-footer">
			<div class="form-group">
				<?= Html::submitButton('Cập nhật mật khẩu', ['class' => 'dialog-button', 'name' => 'signup-button']) ?>
			</div>
		</div>
		<?php ActiveForm::end(); ?>
		<!--FORM FIELD END-->
	</div>
</div>   



