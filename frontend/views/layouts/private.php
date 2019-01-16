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
  <title>Private</title>
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

   <div class="container">
    <?php echo  Alert::widget(); ?>
  </div>
  <div class="kf_content_wrap">
    
  <div class="container m-50">
      <div class="row">
        <div class="col-md-3">
          <?php include'site-bar-private.php' ?>
        </div>

        <div class="col-md-9">
         <?php
         echo $content ;
         ?>
       </div>
     </div>

  </div>

<?php include('footer.php') ?>
</div>
<!--KF KODE WRAPPER WRAP END-->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
