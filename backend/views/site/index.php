<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
   <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-number"> <?=Html::a('Đơn hàng mới',['/order'],['class'=>''])?></span>
            
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-number"><?=Html::a('Sách mới',['/book'],['class'=>''])?></span>
            
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-envelope-open-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-number"> <?=Html::a('Phản hồi mới',['/contact'],['class'=>''])?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-commenting"></i></span>

            <div class="info-box-content">
              <span class="info-box-number"><?=Html::a('Bình luận mới',['/comment'],['class'=>''])?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
