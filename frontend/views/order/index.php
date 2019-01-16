<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Đơn hàng cá nhân';
$this->params['breadcrumbs'][] = $this->title;

?>


        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Chi tiết đơn hàng</h3>
          </div>
          <div class="panel-body">
           <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Mã đơn hàng</th>
                  <th>Tổng tiền</th>
                  <th>Ngày đặt</th>
                  <th>Trạng thái</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $n=1;foreach ($model as $order): ?>
                <tr>
                  <td><?php echo $n ?></td>
                  <td>
                   <?php echo $order->order_id ?>
                 </td>      
                   <td><?php echo number_format( $order->total_cost,0, '', '.') ?> ₫</td>
             
          <td><?php echo date("d-m-Y H:i:s",($order->created_at)); ?></td>
                <td>
                  <?php  if($order->status==0)
                  {
                    echo '<span class="label label-danger">Chưa duyệt</span>';
                  }
                  elseif($order->status==1)
                  {
                    echo '<span class="label label-success">Đã duyệt</span>';
                  }
                  elseif($order->status==2)
                  {
                    echo '<span class="label label-primary">Đã giao hàng</span>';
                  }
                  else{
                    echo '<span class="label label-default">Đã hủy</span>';
                  } ?>

                </td>
                <td> 
                  
                  <?php echo Html::a('Xem',['/order/view','id'=>$order->order_id],['class'=>'btn btn-xs btn-success']) ?>

                </td>              
              </tr>
              <?php $n++; endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

