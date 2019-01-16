<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

LoginAsset::register($this);
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
         // echo $_SERVER['HTTP_HOST'];

  $host='http://'.$_SERVER['HTTP_HOST'].'/';
        // echo $host;
        //trả về đường dẫn từ host đến file php.
        // echo Yii::$app->urlManager->baseUrl;
  $homeUrl=str_replace('/frontend/web','',Yii::$app->urlManager->baseUrl);
        // echo $homeUrl;

  ?>
  <script type="text/javascript">
   function homeUrl() {
     return '<?php echo $host.$homeUrl;?>';
   }
         // alert(homeUrl());
       </script>
     </head>
     <body>
      <?php $this->beginBody() ?>
      <div class="container">
        <div class="card card-container">
          <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
          <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
          <p id="profile-name" class="profile-name-card"></p>
          <?= Alert::widget() ?>
          <?= $content ?>
        </div><!-- /card-container -->
      </div><!-- /container -->




      <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
