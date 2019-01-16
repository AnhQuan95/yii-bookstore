<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Customer;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Checkout */
/* @var $form ActiveForm */

$this->title ="Thông tin đặt hàng";
$model->total_cost=$cost;
?>


<div class="inner-banner">
    <div class="container">
        <div class="inner-banner-dec">
            <h5>Sách mới</h5>
            <div class="clear"></div>
            <span>Đa dạng về chủ đề , thể loại</span>
            <div class="clear"></div>
            <ol class="breadcrumb">
                <li>
                    <?php echo Html::a('Trang chủ',['/site']) ?>
                </li>
                <li clas
                s="active">Thanh toán</li>
            </ol>
        </div>
        <div class="thumb">
           <img src="<?php echo Yii::$app->urlManager->baseUrl?>/images/inner-banner1.png" alt="">
       </div>
   </div>
</div>

<div class="kf_content_wrap">
    <!--Kiểm tra giỏ hàng có rỗng không-->
    <?php if($cart_store) :  $book_price=0;?>

        <!--ERROR WRAP START-->
        <div class="check-out">
          <?php $form = ActiveForm::begin(
            [
             'action'=>Yii::$app->urlManager->baseUrl.'/checkout/confirm'
         ]); ?>
         <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-6">
                    <div class="row">
                       <?php if(!Yii::$app->user->isGuest): 
                        // $cusModel=$cus->findByEmail(Yii::$app->user->identity->email);
                        $model->email=Yii::$app->user->identity->email; 
                        $model->full_name=Yii::$app->user->identity->full_name;
                        $model->address=Yii::$app->user->identity->address; 
                        $model->phone=Yii::$app->user->identity->phone;  
                    else:?>
                    Bạn đã thành viên ? <?php echo Html::a('Đăng nhập',['/site/login']) ?>
                    <?php endif; ?>
                    
                    <?php if (Yii::$app->session->hasFlash('email_exist')): ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?= Yii::$app->session->getFlash('email_exist') ?>
                        </div>

                    <?php endif; ?> 
                    <div class="col-md-12">
                        <div class="input-dec3">
                           <?= $form->field($model, 'full_name')->textInput(['placeholder'=>'Họ tên']) ?>
                       </div>
                   </div>
               </div>
               <div class="input-dec3 multi">
                  <?= $form->field($model, 'address') ->textInput(['placeholder'=>'Địa chỉ nhận hàng'])?>
              </div>
              <div class="input-dec3 multi">
                <span>Thông tin liên lạc<small>*</small></span>
                <?= $form->field($model, 'email')->textInput(['placeholder'=>'Địa chỉ email']) ?>

                <?= $form->field($model, 'phone')->textInput(['placeholder'=>'Điện thoại']) ?>
            </div>

        </div>



        <div class="col-md-6 col-sm-6">
            <div class="input-dec3">
              <div class="select-menu">
               <?= $form->field($model, 'shipping_method')->dropDownList(
                [ 
                    'Giao hàng tiết kiệm'=>'Giao hàng tiết kiệm',
                    'Giao hàng nhanh'=>'Giao hàng nhanh'
                ]              
            )?>
        </div>
    </div>

    <div class="input-dec3">
      <div class="select-menu">
       <?= $form->field($model, 'payment_method')->dropDownList(
        [ 
            'Chuyển khoản ngân hàng'=>'Chuyển khoản ngân hàng',
            'Thanh toán khi nhận hàng'=>'Thanh toán khi nhận hàng'
        ]              
    )?>
</div>
</div>

<div class="input-dec3">
   <?= $form->field($model, 'order_note')->textarea(['placeholder'=>'Ghi chú']) ?>

   <?= $form->field($model, 'total_cost')->hiddenInput()->label(false); ?>

</div>

</div>


</div>
</div>

</div>

<div class="order-table">
    <div class="container">
        <div class="order-hd">
            <h3>Đơn hàng của bạn đặt ngày <?php echo date('d-m-Y') ?></h3>
            <table class="tbody">
                <thead>
                    <tr>
                        <td class="produt-name">Sản phẩm</td>
                        <td class="produt-price">Giá</td>
                        <td class="produt-quantity">Số lượng </td>
                        <td class="produt-total">Thành tiền</td>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach($cart_store as $item): ?>

                    <tr>

                        <td class="produt-name"><?php echo $item->book_name ?></td>
                        <td class="produt-price">
                            <!--In ra giá sale ( nếu có)-->
                            <?php
                            if($item->sale_price==0){
                                $book_price=$item->price;
                            }
                            else{
                                $book_price=$item->sale_price;
                            } ?>

                            <?php
                            if($item->sale_price==0):   ?>
                                <span class="price-tag">
                                    <sub><?php echo number_format($item->price,0, '', '.')?> ₫</sub>
                                </span>  
                                <?php  else :?>
                                    <span class="price-tag red">
                                        <del><?php echo number_format($item->price,0, '', '.')?> ₫</del>
                                        <sub><?php echo number_format($item->sale_price,0, '', '.')?> ₫</sub>
                                    </span>

                                <?php endif; ?> 




                            </td>
                            <td class="produt-quantity"><?php echo $item->quantity_in_cart ?></td>
                            <td class="produt-total">
                                <span class="price-tag blue">
                                    <sub><?php echo number_format($item->quantity_in_cart * $book_price,0, '', '.')  ?> ₫</sub>
                                </span>

                            </td>

                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6 col-md-offset-6">
                    <ul class="sub-total">
                        <li>
                            <p>Thành tiền</p>
                            <span class="price-tag black">
                                <sub> <?php echo number_format($cost,0, '', '.')  ?> ₫</sub>
                            </span>
                        </li>
                        <li>
                            <p>Phí vận chuyển</p>
                            <span class="price-tag">
                                Theo phí của nhà vận chuyển
                            </span>
                        </li>
                        <li>
                            <p>Tổng tiền</p>
                            <span class="price-tag total-price blue">
                                <sub>
                                    <?php echo number_format($cost,0, '', '.')  ?> ₫</sub>
                                </span>
                            </li>
                        </ul>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- WRAP END-->
    <div class="order-payment">
        <div class="container">
            <div class="order-submit">

               <?= Html::submitButton('Xác nhận đơn hàng', ['class' => 'btn-2']) ?>
           </div>
           <?php ActiveForm::end(); ?>
       </div>
   </div>

   <!--TRACKING BAR END-->
   <?php else : ?>
    <h3 class="text-center m-50">  <strong>Thông báo!</strong> Giỏ hàng đang rỗng. Mời bạn <?php echo Html::a('Mua hàng',['/site'],['class'=>'btn btn-lg btn-success']) ?></h3>
<?php endif; ?>
</div>