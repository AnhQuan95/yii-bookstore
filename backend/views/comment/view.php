<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Comment */

$this->title = $model->cmt_id;
$this->params['breadcrumbs'][] = ['label' => 'Bình luận', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;
?>
<div class="comment-view">
 <div class="row">
  <div class="col-md-4">
    <h3>Tên sách : <?php echo $model->book->book_name ?><h3>
  </div>
  <div class="col-md-8">
    <img src="<?php echo $baseUrl.'/uploads/images/'.$model->book->image?>" alt=""  height="150" width="200">
  </div>
 
  </div>

  <p><h3>Bình luận</h3></p>
  <div class="text">
    <div class="row">
      <div class="col-md-1">
       <figure><img src="<?php echo $baseUrl ?>/extra-images/avatar.png" alt="" height="70" width="70"></figure>

     </div>

     <div class="col-md-5">
       <div class="cutomer-rating">
        <strong><?php echo $model->customer->email ?></strong>
        <br>

        <p><?php  echo $model->content ?></p>
      </div>
    </div>
    <div class="col-md-3">
      <p><strong>Bình luận ngày</strong> <?php echo date('d-m-Y H:i:s', $model->cmt_date)?></p>
    </div>
     <div class="col-md-3">
   <p>
    Trạng thái bình luận : 
    <?php if($model ->status==0):?>
      <span class="label label-warning">Chưa duyệt</span>
      <p>
        Thay đổi trạng thái :&nbsp; 
        <?php echo Html::a('Duyệt',['comment/change-status','id'=>$model->cmt_id,'status'=>1],['class'=>'label label-success']) ;?></p>

        <?php else: ?>

          <span class="label label-primary">Đã duyệt</span>
        <?php endif; ?>
        <p>
         &nbsp;  &nbsp; &nbsp; &nbsp; Xóa bình luận :&nbsp; 
          <?= Html::a('Xóa', ['delete', 'id' => $model->cmt_id], [
            'class' => 'label label-danger',
            'data' => [
              'confirm' => 'Bạn có muốn xóa bình luận này không ??',
              'method' => 'post',
            ],
          ]) ?>
        </p>
      </p>
    </div>
  </div>





</div>


</div>
