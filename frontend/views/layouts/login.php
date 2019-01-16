<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\LoginAppAsset;
use common\widgets\Alert;

LoginAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
      <?php $this->head() ?>

    <?php 
        //trả về host của trang
          //echo $_SERVER['HTTP_HOST'];

    $host='http://'.$_SERVER['HTTP_HOST'].'/';
        // echo $host;
        //trả về đường dẫn từ host đến file php.
        // echo Yii::$app->urlManager->baseUrl;
    $homeUrl=str_replace('/front/web','',Yii::$app->urlManager->baseUrl);
         //echo $homeUrl;
    $baseUrl=$host.$homeUrl;
    //echo $baseUrl;
    ?>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    
   
<!--KF KODE WRAPPER WRAP START-->
  <div class="kode_wrapper">
    <?php include('header.php') ?>
    <div class="kf_content_wrap">
         <?php
    echo $content ;
    ?>
    </div>
  <?php include('footer.php') ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
