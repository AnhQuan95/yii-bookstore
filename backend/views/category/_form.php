<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Category;
/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
<?php $cat=new Category; ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cate_name')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'parent')->dropDownList(
                // ArrayHelper::map($cat->getParent1(),'id','name'),
                $cat->getParent(),
            
                ['prompt'=>'Danh mục cha']
            ) ?>

      <?= $form->field($model, 'status')->radioList([
        0=>'Không kích hoạt',
        1=>'Kích hoạt'

    ]) ?>


    <div class="form-group">
       <?= Html::submitButton($model->isNewRecord?'Thêm':'Cập nhật',['class' => $model->isNewRecord ?'btn btn-success':'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
