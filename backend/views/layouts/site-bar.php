<?php  
use yii\helpers\Html;
?>
       <?php if(!Yii::$app->user->isGuest): ?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="./../web/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo  Yii::$app->user->identity->full_name?> </p>
        <a href="#"><i class="fa fa-circle text-success"></i> Đang hoạt động</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li>
       <?=Html::a('<i class=" fa fa-home"></i> Trang chủ',['/site'],['class'=>''])?>

     </li>
      <li class="treeview">
        <a href="#">
          <?php 
          $route=Yii::$app->controller->route;
                        // echo $route;
                        // $route=explore('/',$route);
          $control=Yii::$app->controller->id;
                        // echo $control;
          ?>
          


          <i class="fa fa-bar-chart"></i> <span>Thống kê</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <?php echo Html::a(' Top 10 sản phẩm yêu thích',['report/favourite-books'],['class'=>'fa fa-circle-o']) ?>
          </li>
           <li>
            <?php echo Html::a(' Top 10 sản phẩm bán chạy',['report/bestseller-books'],['class'=>'fa fa-circle-o']) ?>
          </li>
        </ul>
      </li>

      <li>
       <?=Html::a('<i class=" fa fa-picture-o"></i> Quản lý file',['/file'],['class'=>''])?>

     </li>

     <li>
      <?=Html::a('<i class="fa fa-vcard-o"></i> Quản lý tác giả',['/author'],['class'=>''])?>

    </li>
     <li>
    <?=Html::a('<i class="fa fa-child"></i> Quản lý độ tuổi đọc sách',['/suitable-age'],['class'=>''])?>

  </li>
  <li>
   <?=Html::a('<i class="fa fa-university"></i> Quản lý nhà xuất bản',['/publisher'],['class'=>''])?>

 </li>
    <li>
     <?=Html::a('<i class="fa fa-list"></i> Quản lý danh mục sách',['/category'],['class'=>''])?>

   </li>



 <li>
   <?=Html::a('<i class="fa fa-book"></i> Quản lý sách',['/book'],['class'=>''])?>

 </li>

 <li>
   <?=Html::a('<i class="fa fa-user"></i> Quản lý khách hàng',['/customer'],['class'=>''])?>

 </li>

 <li>
   <?=Html::a('<i class="fa fa-shopping-cart"></i> Quản lý đơn hàng',['/order'],['class'=>''])?>

 </li>

 <li>
   <?=Html::a('<i class="fa fa-commenting "></i> Quản lý bình luận',['/comment'],['class'=>''])?>

 </li>
 <li>
   <?=Html::a('<i class="fa fa-envelope-open-o  "></i> Quản lý phản hồi',['/contact'],['class'=>''])?>

 </li>
 <li>
   <?=Html::a('<i class="fa fa-newspaper-o  "></i> Quản lý tin tức ',['/news'],['class'=>''])?>

 </li>

 
 
</ul>
</section>
<!-- /.sidebar -->
</aside>
  <?php endif; ?>
