<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
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
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
  <?php 
        //trả về host của trang
         // echo $_SERVER['HTTP_HOST'];

  $host='http://'.$_SERVER['HTTP_HOST'].'/';
        // echo $host;
        //trả về đường dẫn từ host đến file php.
        // echo Yii::$app->urlManager->baseUrl;
  $homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);
        // echo $homeUrl;
  

  ?>
  <script type="text/javascript">
   function homeUrl() {
     return '<?php echo $host.$homeUrl;?>';
   }
         // alert(homeUrl());
       </script>
     </head>

     <body class="hold-transition skin-blue sidebar-mini">
      <?php $this->beginBody() ?>

<div class="wrapper">

      <?php include 'header.php' ?>


      <?php include 'site-bar.php' ?>

  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1>
        Anh Quan Bookstore
        <small>Quản trị</small>
      </h1>
         <ol class="breadcrumb">
          <li><?= Breadcrumbs::widget([
           'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
           ]) ?></li>
         </ol>
       </section>
       <!-- Main content -->
       <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
  
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include 'footer.php' ?>
</div>
    <div class="modal fade" id="modal-media-image">
      <div class="modal-dialog model-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Thư viện ảnh</h4>
          </div>
          <div class="modal-body">
            <iframe src="<?php echo $homeUrl?>/file/dialog.php?field_id=image"" style="border: none;width: 100%;height: 500px"></iframe>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>

    <?php $this->endBody() ?>
  </body>
  </html>
  <?php $this->endPage() ?>

