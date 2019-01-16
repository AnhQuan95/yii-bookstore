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
     <body>
      <?php $this->beginBody() ?>

      <div class="wrap bg-info">
        <?php
        NavBar::begin([
          'brandLabel' => Yii::$app->name,
          'brandUrl' => Yii::$app->homeUrl,
          'options' => [
            'class' => 'navbar-inverse navbar-static-top',
          ],
        ]);
        $menuItems = [
          ['label' => 'Home', 'url' => ['/site/index']],
        ];
        if (Yii::$app->user->isGuest) {
          $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
          $menuItems[] = '<li>'
          . Html::beginForm(['/site/logout'], 'post')
          . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
          )
          . Html::endForm()
          . '</li>';
        }
        echo Nav::widget([
          'options' => ['class' => 'navbar-nav navbar-right'],
          'items' => $menuItems,
        ]);
        NavBar::end();
        ?>

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3 aside-left bg-info">
              <div class="panel panel-primary">
                <div class="panel-body">
                 <?php 
                 $route=Yii::$app->controller->route;
                        // echo $route;
                        // $route=explore('/',$route);
                 $control=Yii::$app->controller->id;
                        // echo $control;
                 ?>
                 <ul class="list-group" id="manager-menu">
                  <?=Html::a('<span class="glyphicon glyphicon-home"></span> Index',['/site'],['class'=>($control=='site')?'list-group-item active':'list-group-item'])?>
                  <?=Html::a('<span class="glyphicon glyphicon-th-list"></span> Manage Category',['/category'],['class'=>($control=='category')?'list-group-item active':'list-group-item'])?>
                  <?=Html::a('<span class="glyphicon glyphicon-th-list"></span> Manage Book',['/book'],['class'=>($control=='book')?'list-group-item active':'list-group-item'])?>
                  <?=Html::a('<span class="glyphicon glyphicon-th-list"></span> Manage Images',['/file'],['class'=>($control=='file')?'list-group-item active':'list-group-item'])?>
                  <?=Html::a('<span class="glyphicon glyphicon-th-list"></span> Manage Posts',['/post'],['class'=>($control=='post')?'list-group-item active':'list-group-item'])?>
                </ul>

              </div>
            </div>
          </div>
          <div class="col-md-9 admin-right"> 
            <?= Breadcrumbs::widget([
             'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
           ]) ?>
           <?= Alert::widget() ?>
           <?= $content ?>
           
         </div>
       </div>
     </div>
   </div>

   <footer class="footer">
    <div class="container">
      <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

      <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
  </footer>

  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
