<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Checkout */
/* @var $form ActiveForm */

$this->title ="Thông tin đặt hàng";
$model->total_cost=$cost;
?>


<div class="inner-banner">
    <div class="container">
        <div class="inner-banner-dec">
            <h5>Brand new books</h5>
            <div class="clear"></div>
            <span>ALL CATEGORIES</span>
            <div class="clear"></div>
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li><a href="#">Shop</a></li>
              <li class="active">cart</li>
          </ol>
      </div>
      <div class="thumb">
        <img src="images/inner-banner1.png" alt="">
    </div>
</div>
</div>

<div class="kf_content_wrap">
  <?php if($cart_store) :  $book_price=0;?>

    <!--ERROR WRAP START-->
    <div class="check-out">
       <?php $form = ActiveForm::begin(); ?>
       <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">

                <div class="row">
                    <div class="col-md-12">
                        <div class="input-dec3">
                            <span>Họ tên<small>*</small></span>
                            <input type="text" placeholder="First Name">
                        </div>
                    </div>
                </div>
                <div class="input-dec3 multi">
                    <span>Địa chỉ<small>*</small></span>
                    <input type="text" placeholder="Street Address">
                </div>
                <div class="input-dec3 multi">
                    <span>Thông tin liên lạc<small>*</small></span>
                    <input type="text" placeholder="Email Address">
                    <input type="text" placeholder="Phone Number">
                </div>

            </div>
            <div class="col-md-6 col-sm-6">
                <div class="input-dec3">
                    <span> Phương thức thanh toán<small>*</small></span>
                    <div class="select-menu">
                        <select>
                            <option value="1">Thanh toán khi nhận hàng</option>
                            <option value="9">Thanh toán chuyển khoản ngân hàng</option>
                        </select>
                    </div>
                </div>
                <div class="input-dec3">
                    <span> Phương thức giao hàng<small>*</small></span>
                    <div class="select-menu">
                        <select>
                            <option value="1">Giao hàng tiết kiệm</option>
                            <option value="9">Giao hàng nhanh</option>
                        </select>
                    </div>
                </div>

                <div class="input-dec3">
                    <span>Ghi chú đơn hàng</span>
                    <textarea placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                </div>

            </div>
        </div>
    </div>

</div>
<div class="order-table">
    <div class="container">
        <div class="order-hd">
            <h3>Đơn hàng của bạn</h3>
            <table class="tbody">
                <thead>
                    <tr>
                        <td class="produt-name">Product Name</td>
                        <td class="produt-price">Price</td>
                        <td class="produt-quantity">Quantity</td>
                        <td class="produt-total">Total</td>
                    </tr>
                </thead>
                <tbody>
                 <?php foreach($cart_store as $item): ?>

                    <tr>

                        <td class="produt-name"><?php echo $item->book_name ?></td>
                        <td class="produt-price">

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
                        <p>Cart Subtotal</p>
                        <span class="price-tag black">
                            <sub> <?php echo number_format($cost,0, '', '.')  ?> ₫</sub>
                        </span>
                    </li>
                    <li>
                        <p>Shipping and Handling</p>
                        <span class="price-tag">
                            Theo phí của nhà vận chuyển
                        </span>
                    </li>
                    <li>
                        <p>Order Total</p>
                        <span class="price-tag total-price blue">
                            <sub>
                                <?php echo number_format($cost,0, '', '.')  ?> ₫</sub>
                            </span>
                        </li>
                        <li>
                          <div class="order-submit">
                            <?= Html::submitButton('Xác nhận đơn hàng', ['class' => 'btn-2']) ?>
                        </div>
                    </li>
                </ul>

            </div>

        </div>

    </div>
</div>
</div>
<?php ActiveForm::end(); ?>
<!-- WRAP END-->
<?php endif; ?>
</div>





  
        






        <div class="kf_content_wrap">
              <?php if($cart_store) :  $book_price=0;?>

            <!--ERROR WRAP START-->
            <div class="check-out">
               <?php $form = ActiveForm::begin(); ?>
                    <div class="container">
                        <div class="row">
                            
            <div class="col-md-6 col-sm-6">

                <div class="row">
                    <div class="col-md-12">
                        <div class="input-dec3">
                            <span>Họ tên<small>*</small></span>
                            <input type="text" placeholder="First Name">
                        </div>
                    </div>
                </div>
                <div class="input-dec3 multi">
                    <span>Địa chỉ<small>*</small></span>
                    <input type="text" placeholder="Street Address">
                </div>
                <div class="input-dec3 multi">
                    <span>Thông tin liên lạc<small>*</small></span>
                    <input type="text" placeholder="Email Address">
                    <input type="text" placeholder="Phone Number">
                </div>

            </div>
            <div class="col-md-6 col-sm-6">
                <div class="input-dec3">
                    <span> Phương thức giao hàng<small>*</small></span>
                    <div class="select-menu">
                        <select>
                            <option value="1">Giao hàng tiết kiệm</option>
                            <option value="9">Giao hàng nhanh</option>
                        </select>
                    </div>
                </div>

                <div class="input-dec3">
                    <span>Ghi chú đơn hàng</span>
                    <textarea placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                </div>

            </div>
        

                        </div>
                    </div>
             
            </div>

            <div class="order-table">
                <div class="container">
                    <div class="order-hd">
            <h3>Đơn hàng của bạn</h3>
            <table class="tbody">
                <thead>
                    <tr>
                        <td class="produt-name">Product Name</td>
                        <td class="produt-price">Price</td>
                        <td class="produt-quantity">Quantity</td>
                        <td class="produt-total">Total</td>
                    </tr>
                </thead>
                <tbody>
                 <?php foreach($cart_store as $item): ?>

                    <tr>

                        <td class="produt-name"><?php echo $item->book_name ?></td>
                        <td class="produt-price">

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
                        <p>Cart Subtotal</p>
                        <span class="price-tag black">
                            <sub> <?php echo number_format($cost,0, '', '.')  ?> ₫</sub>
                        </span>
                    </li>
                    <li>
                        <p>Shipping and Handling</p>
                        <span class="price-tag">
                            Theo phí của nhà vận chuyển
                        </span>
                    </li>
                    <li>
                        <p>Order Total</p>
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
                    <ul>
                        <li>
                            <div class="payment-method method1">
                                <div class="payment-hd">
                                    <span>Chuyển khoản ngân hàng</span>
                                </div>
                                <div class="payment-text payment1">
                                    <p>Chi phí giao hàng sẽ được thông báo cụ thể qua email ngay khi chúng tôi nhận được Đơn đặt hàng của quý khách.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="payment-method method2">
                                <div class="payment-hd">
                                    <span>Thanh toán khi nhận hàng</span>
                                </div>
                                <div class="payment-text payment2">
                                    <p>Chi phí giao hàng sẽ được thông báo cụ thể qua email ngay khi chúng tôi nhận được Đơn đặt hàng của quý khách.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="order-submit">
                        
                         <?= Html::submitButton('Xác nhận đơn hàng', ['class' => 'btn-2']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <?php endif; ?>
            <!--TRACKING BAR START-->
            <div class="tracking-bar">
                <div class="container">
                    <div class="text">
                        <i class="icon-clock"></i>
                        <h3>Where is my order/shipment?</h3>
                    </div>
                    <div class="text2">
                        <div class="input-text">
                            <input type="text" placeholder="Email id">
                        </div>
                        <div class="input-text">
                            <input type="text" placeholder="Purchase id">
                        </div>
                        <a class="track" href="#">TRACK MY ORDER</a>
                    </div>
                </div>
            </div>
            <!--TRACKING BAR END-->
        </div>