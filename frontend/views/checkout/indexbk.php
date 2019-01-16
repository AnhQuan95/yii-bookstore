<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Checkout */
/* @var $form ActiveForm */

$this->title ="Thông tin đặt hàng";
$model->total_cost=$cost;
?>

<div class="container">
    <?php if($cart_store) : $n=1; $book_price=0;?>
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">

            <div class="col-md-5">
             <?= $form->field($model, 'full_name')->textInput() ?>
             <?= $form->field($model, 'email')->textInput() ?>
             <?= $form->field($model, 'address') ->textInput()?>
             <?= $form->field($model, 'phone')->textInput() ?>
             <?= $form->field($model, 'shipping_method')->textInput() ?>
             <?= $form->field($model, 'payment_method')->textInput() ?>
             <?= $form->field($model, 'order_note')->textArea() ?>
              <?= $form->field($model, 'total_cost')->textInput() ?>

             <input type="number" name="total_cost" value="<?php echo $cost?>">

         </div>

         <div class="col-md-7">
            <h3>Thông tin sản phẩm</h3>
            <div class="table-responsive text-center">          
                <table class="table">

                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh></th>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cart_store as $item): ?>

                            <tr>
                                <?php
                                if($item->sale_price==0){
                                    $book_price=$item->price;
                                }
                                else{
                                    $book_price=$item->sale_price;
                                } ?>
                                <td><?php echo $n; ?></td>
                                <td>
                                    <img src="<?php echo $item->image?>" alt="" height="100px" width="80">
                                </td>
                                <td><?php echo $item->book_name ?></td>
                                <?php
                                ?>
                                <td><?php echo number_format($book_price,0, '', '.');?> ₫</td>
                                <td>

                                    <?php echo $item->quantity_in_cart ?>

                                </td>
                                <td><?php echo number_format($item->quantity_in_cart * $book_price,0, '', '.')  ?> ₫</td>

                                    </tr>
                                    <?php $n++; endforeach; ?>
                                    <tr>
                                        <td colspan="5" align="right">Tổng tiền </td>
                                        <td> <?php echo number_format($cost,0, '', '.')  ?> ₫</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <div class="form-group pull-right">
                            <?= Html::submitButton('Xác nhận đơn hàng', ['class' => 'btn btn-primary']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>
