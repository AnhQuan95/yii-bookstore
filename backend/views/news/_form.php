<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\news */
/* @var $form yii\widgets\ActiveForm */

// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;

?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'news_title')->textInput(['maxlength' => true]) ?>

    <div class="row">
      <div class="col-md-2">

        <?= $form->field($model, 'image')->hiddeninput(['id' => 'image']) ?>
        <a href="#" title="Chọn hình ảnh" class="btn btn-info btn-sm" id="select-img">Chọn ảnh</a>
        <a href="#" title="Xóa hình ảnh" class="btn btn-danger btn-sm" id="delete-img">Xóa ảnh</a>

    </div>
    <div class="col-md-3">
        <img src="<?php echo $baseUrl.'/uploads/images/'.$model->image; ?>" id="show-img" width="160" height="200" alt="Ảnh tin tức" >
    </div>

    <div class="col-md-7">

    </div>


</div>

<?= $form->field($model, 'description')->textarea(['id'=>'description']) ?>

<?= $form->field($model, 'content')->textarea(['id'=>'content']) ?>

<?= $form->field($model, 'status')->radioList([
    0=>'Không kích hoạt',
    1=>'Kích hoạt'

]) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord?'Thêm':'Cập nhật',['class' => $model->isNewRecord ?'btn btn-success':'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
