<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Cập nhật thông tin ';
/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */


$this->title = 'Thay đổi thông tin cá nhân';
?>
<div class="modal-dialog login1 login6">
	<div class="user-box">
		<!--FORM FIELD START-->
		<h3><?= Html::encode($this->title) ?></h3>
		<?= Html::a('Quay lại',['view'],['class' => 'btn btn-primary']) ?>
		<?php $form = ActiveForm::begin(
		); ?>

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

