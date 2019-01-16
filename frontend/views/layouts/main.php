<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\components\Cart;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <title>Anh Quân Book Store</title>
  <?php $this->head() ?>

  <?php 

        //trả về host của trang
          //echo $_SERVER['HTTP_HOST'];

  $host='http://'.$_SERVER['HTTP_HOST'].'/';
        // echo $host;

        //trả về đường dẫn từ host đến file php :yiidemo
       //echo Yii::$app->urlManager->baseUrl; 

  $homeUrl=str_replace('/front/web','',Yii::$app->urlManager->baseUrl);
        // echo $homeUrl;
  $baseUrl=$host.$homeUrl;
    //echo $baseUrl;

  ?>

</head>
<body>
  <?php $this->beginBody() ?>

  <!--KF KODE WRAPPER WRAP START-->
  <div class="kode_wrapper">
    <?php include('header.php') ?>

    <?php
    echo $content ;
    ?>
  
    </div>

    
   

    <?php include('footer.php') ?>
  </div>
  <!--KF KODE WRAPPER WRAP END-->

  <div class="modal fade" id="modal-add-cart">
    <div class="modal-dialog">
      <div class="modal-content m-50">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div class="modal-title">
           <div class="alert alert-default" id="alert-pro-name"></div>
         </div>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <?php echo Html::a('Xem giỏ hàng',['/cart'],['class'=>'btn btn-primary']) ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-whilist">
  <div class="modal-dialog">
    <div class="modal-content m-50">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="modal-title">
         <div class="alert alert-default" id="alert-pro-like"></div>
       </div>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      <?php echo Html::a('Xem sản phẩm yêu thích',['/whilist'],['class'=>'btn btn-success']) ?>
    </div>
  </div>
</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
