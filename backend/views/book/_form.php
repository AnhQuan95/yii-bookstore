<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Category;
use backend\models\Publisher;
use backend\models\SuitableAge;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\BookWithAuthor;
use backend\models\BookAuthor;
use softark\duallistbox\DualListbox;



// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;

/* @var $this yii\web\View */
/* @var $model backend\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">
 <?php 
 $cat=new Category;
 $age=new SuitableAge;
 ?>
 <?php $form = ActiveForm::begin(); ?>
 <div class="row">
  <div class="col-md-2">
   <?= $form->field($model, 'book_id')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
 </div>

 <div class="col-md-10">
   <?= $form->field($model, 'book_name')->textInput(['maxlength' => true]) ?>
 </div>

 

</div>




<div class="row">

  <div class="col-md-2">
   <?= $form->field($model, 'cate_id')->dropDownList(
    $cat->getParent(),
    ['prompt'=>'Chọn danh mục']
  ) ?>
</div>

<div class="col-md-2">
 <?= $form->field($model, 'age_id')->dropDownList(
   ArrayHelper::map(SuitableAge::find()->where(['status'=>1])->all(),'id','name_of_age'),
   ['prompt'=>'Chọn độ tuổi đọc sách phù hợp']
 ) ?>
</div>

<div class="col-md-2">  
 <?= $form->field($model, 'publisher_id')->dropDownList(
  ArrayHelper::map(Publisher::find()->where(['status'=>1])->all(),'publisher_id','publisher_name'),
  ['prompt'=>'Chọn nhà xuất bản']) ?>
</div>

<div class="col-md-3">
  <?= $form->field($model, 'publish_at')->widget(\yii\jui\DatePicker::class,
   [
    'dateFormat' => 'dd-MM-yyyy',
    'language' => 'vi',
    'options' => ['class' => 'form-control'],
    'clientOptions'=>[                                       
      'changeMonth'=>TRUE ,                                 
      'changeYear'=>TRUE ,    
      'showButtonPanel'=>TRUE,
      'showOn' => 'button',
      'buttonImage' => 'images/calendar.png',
      'buttonImageOnly' => true,                    
      'yearRange' => '2000:2018',                                                   
    ],
  ])?>  

</div>

<div class="col-md-3">
  <?= $form->field($model, 'quantity')->textInput() ?>

</div>
</div>


<div class="row">
  <div class="col-md-2">

    <?= $form->field($model, 'image')->hiddeninput(['id' => 'image']) ?>
    <a href="#" title="Chọn hình ảnh" class="btn btn-info btn-sm" id="select-img">Chọn ảnh</a>
    <a href="#" title="Xóa hình ảnh" class="btn btn-danger btn-sm" id="delete-img">Xóa ảnh</a>

  </div>
  <div class="col-md-3">
    <img src="<?php echo $baseUrl.'/uploads/images/'.$model->image; ?>" id="show-img" width="160" height="200" alt="Ảnh sách" >
  </div>

  <div class="col-md-7">

  </div>


</div>
<div class="row">
  <div class="col-md-3">
    <?= $form->field($model, 'price')->textInput() ?>

  </div>

  <div class="col-md-3">
    <?= $form->field($model, 'sale_price')->textInput() ?>
  </div>

  <div class="col-md-3">
    <?= $form->field($model, 'pages')->textInput() ?>
  </div>

  <div class="col-md-3">
    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>
  </div>
</div>




<?php
$options = [
  'multiple' => true,
  'size' => 20,
];
    // echo $form->field($model, $attribute)->listBox($items, $options);
echo $form->field($model, 'author_ids')->widget(DualListbox::className(),[

  'items' => $authors,
  'options' => $options,
  'clientOptions' => [
    'moveOnSelect' => false,
    'selectedListLabel' => 'Tác giả được chọn',
    'nonSelectedListLabel' => '-',
    'filterPlaceHolder'=>'Lọc tác giả'
  ],
]);
?>


<?= $form->field($model, 'description')->textarea(['id'=>'description']) ?>

<?= $form->field($model, 'content')->textarea(['id'=>'content']) ?>


<?= $form->field($model, 'status')->radioList([
  0=>'Không kích hoạt',
  1=>'Kích hoạt',
  2=>'Nổi bật'
]) ?>

<div class="form-group">
  <?= Html::submitButton($model->isNewRecord?'Thêm':'Cập nhật',['class' => $model->isNewRecord ?'btn btn-success':'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>


