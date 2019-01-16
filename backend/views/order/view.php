<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = 'Mã đơn hàng : '.$model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Đơn hàng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// print_r($model);
$orderDetails=$model->orderDetails;

// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;

?>


<h1><?= Html::encode($this->title) ?></h1>



<div class="row">
  <div class="col-md-6">
    <h3>Thông tin đơn hàng</h3>
    <table class="table table-hover">
     <tr>
       <th>Ngày đặt</th>

       <td><?php echo date("d-m-Y H:i:s",($model->created_at)); ?></td>
     </tr>
     <tr>
       <th>Tổng tiền</th>
       <td>
        <?php echo number_format($model->total_cost,0, '', '.')  ?> ₫

      </td>
    </tr>
    <tr>
     <th>Trạng thái <br> Thay đổi trạng thái</th>
     <td>
       <?php if($model ->status==2):?>
        <span class="label label-primary">Đã giao hàng</span>
        <?php elseif ($model ->status==1) : ?>
          <span class="label label-success">Đã duyệt</span> 

          <p> 
            <?php echo Html::a('Bỏ duyệt',['order/change-status','id'=>$model->order_id,'status'=>0],['class'=>'label label-danger']) ;?>
            <?php echo Html::a('Đã giao hàng',['order/change-status','id'=>$model->order_id,'status'=>2],['class'=>'label label-primary']) ;?>
            <?php echo Html::a('HỦY ĐƠN HÀNG',
              ['order/change-status','id'=>$model->order_id,'status'=>3],
              [
                'class' => 'label label-default',
                'data' => [
                  'confirm' => 'Đơn hàng của bạn sẽ bị hủy. Bạn có chắc chắc hủy không??',
                  'method' => 'post',
                ],
              ]) ?>
            </p>

            <?php elseif ($model ->status==3) : ?>
              <span class="label label-default">Đã hủy</span>

              <?php else : ?>
               <span class="label label-danger">Chưa duyệt</span>
               <p>
                 
                <?php echo Html::a('Duyệt',['order/change-status','id'=>$model->order_id,'status'=>1],['class'=>'label label-success']) ;?>
                <?php echo Html::a('HỦY ĐƠN HÀNG',
                  ['order/change-status','id'=>$model->order_id,'status'=>3],
                  [
                    'class' => 'label label-default',
                    'data' => [
                      'confirm' => 'Đơn hàng này sẽ bị hủy. Bạn có chắc chắc hủy không??',
                      'method' => 'post',
                    ],
                  ]) ?>
                </p>

              <?php endif ?>
            </td>
          </tr>

        </table>
      </div>
      <div class="col-md-6">
        <h3>Thông tin người mua</h3>
        <table class="table table-hover">
         <tr>
           <th>Họ Tên</th>
           <td><?php echo $model ->full_name ?></td>
         </tr>
         <tr>
           <th>Email</th>
           <td><?php echo $model ->email ?></td>
         </tr>
         <tr>
           <th>Điện thoại</th>
           <td><?php echo ($model ->phone)?></td>
         </tr>
         <tr>
           <th>Địa chỉ</th>
           <td><?php echo ($model ->delivery_address)?></td>
         </tr>

         <tr>
           <th>Ghi chú đơn hàng</th>
           <td><?php echo ($model ->order_note)?></td>
         </tr>

       </table>
     </div>
   </div>
   <h3>Chi tiết sản phẩm</h3>
   <table class="table table-hover">
    <thead>
      <tr>
        <th>STT</th>
        <th>Ảnh</th>
        <th>Tên sản phẩm</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Thành Tiền</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php $n=1; foreach($orderDetails as $orderdetail) : ?>
      <tr>
        <td><?php echo $n ?></td>
        <td>
          <img src="<?php echo $baseUrl.'/uploads/images/'.$orderdetail->book->image ?>
          " alt="" width="50px">

        </td>
        <td><?php echo $orderdetail->book->book_name ?></td>
        <td><?php echo number_format($orderdetail->price,0, '', '.')?> ₫</td>
        <td><?php echo $orderdetail->quantity ?> </td>
        <td><?php echo number_format( $orderdetail->quantity * $orderdetail->price,0, '', '.') ?> ₫</td>

      </tr>
      <?php $n++; endforeach; ?>
    </tbody>
  </table>





