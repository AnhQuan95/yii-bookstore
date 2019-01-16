<?php 
use yii\helpers\Html;
?>
<header class="main-header">

  <!-- Logo -->
  <a href="../../bookstore/backend/site" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b>LTE</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
       <?php if(!Yii::$app->user->isGuest): ?>
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="./../web/img/user2-160x160.jpg" class="user-image" alt="User Image">
          <span class="hidden-xs">    <?php echo  Yii::$app->user->identity->full_name?>   </span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="./../web/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            <p>
             <?php echo  Yii::$app->user->identity->full_name?> - Admin   

           </p>
         </li>
         <!-- Menu Body -->

        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="pull-left">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
          </div>
         
          <div class="pull-right">
           <?php echo Html::beginForm(['/site/logout'], 'post');
           echo Html::submitButton(
              'Logout (' . Yii::$app->user->identity->full_name . ')',
              ['class' => 'btn btn-default btn-flat']
            );
            echo Html::endForm() ?> 
          </div>
      
        </li>
      </ul>
    </li>
  <?php endif; ?>
  </ul>
</div>
</nav>

</header>

  <!-- =============================================== -->