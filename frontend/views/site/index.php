<?php

use yii\helpers\Html;
use backend\models\Book;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';

// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;
// print_r($Book);
?>


<div class="main-banner">
    <ul class="bxslider">
        <li>
            <div class="slider-outer">
                <div class="bx-slider-wrap">
                    <div class="container">
                        <img class="image-1" src="images/slider-1-1.png" alt=""/>
                        <div class="slider-caption">
                            <div class="caption-dec">
                                <h5>Giá sách ưu đãi</h5>
                                <h3>Giảm tới 50%</h3>
                                <h4>+ Quà tặng</h4>
                                
                            </div>
                            <?php echo Html::a('Mua ngay',['/book']) ?>
                        </div>
                        <img class="image-2" src="images/slider-1-2.png" alt=""/>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="slider-outer">
                <div class="bx-slider-wrap">
                    <div class="container">
                        <img class="image-1" src="images/slider-1-1.png" alt=""/>
                        <div class="slider-caption">
                            <div class="caption-dec">
                                <h5>Giá sách ưu đãi</h5>
                                <h3>Giảm tới 50%</h3>
                                <h4>+ Quà tặng</h4>
                            </div>
                            <?php echo Html::a('Mua ngay',['/book']) ?>
                        </div>
                        <img class="image-2" src="images/slider-1-2.png" alt=""/>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="slider-outer">
                <div class="bx-slider-wrap">
                    <div class="container">
                        <img class="image-1" src="images/slider-1-1.png" alt=""/>
                        <div class="slider-caption">
                            <div class="caption-dec">
                             <h5>Giá sách ưu đãi</h5>
                             <h3>Giảm tới 50%</h3>
                             <h4>+ Quà tặng</h4>
                         </div>
                         <?php echo Html::a('Mua ngay',['/book']) ?>
                     </div>
                     <img class="image-2" src="images/slider-1-2.png" alt=""/>
                 </div>
             </div>
         </div>
     </li>
 </ul>
</div>
<!--CUSTOMER CARE WRAP START-->
<div class="cstmr-cre-wrap">
    <div class="container">
        <div class="row">
            <!--CUSTOMER CARE DEC START-->
            <div class="col-md-3 col-sm-6">
                <div class="cstmr-dec">
                    <span class="icon-truck-icon"></span>
                    <div class="text">
                        <h5>Trả hàng 30 ngày</h5>
                        <p>Cam kết hoàn tiền</p>
                    </div>
                </div>
            </div>
            <!--CUSTOMER CARE DEC END-->
            <!--CUSTOMER CARE DEC START-->
            <div class="col-md-3 col-sm-6">
                <div class="cstmr-dec">
                    <span class="icon-phone-call"></span>
                    <div class="text">
                        <h5>Miễn phí ship</h5>
                        <p>Hóa đơn trên 2 triệu</p>
                    </div>
                </div>
            </div>
            <!--CUSTOMER CARE DEC END-->
            <!--CUSTOMER CARE DEC START-->
            <div class="col-md-3 col-sm-6">
                <div class="cstmr-dec">
                    <span class="icon-calendar-1"></span>
                    <div class="text">
                        <h5>C.S khách hàng</h5>
                        <p>Chăm sóc và phản hồi</p>
                    </div>
                </div>
            </div>
            <!--CUSTOMER CARE DEC END-->
            <!--CUSTOMER CARE DEC START-->
            <div class="col-md-3 col-sm-6">
                <div class="cstmr-dec">
                    <span class="icon-security"></span>
                    <div class="text">
                        <h5>Vận chuyển nhanh</h5>
                        <p>Cam kết nhanh</p>
                    </div>
                </div>
            </div>
            <!--CUSTOMER CARE DEC END-->
        </div>
    </div>
</div>
<!--CUSTOMER CARE WRAP START-->

<div class="kf_content_wrap">
    <?php if($suitable_books) :?>
        <section>
            <div class="container">
                <!--HEADING 1 START-->
                <div class="heading-1">
                    <h2>Sách phù hợp với độ tuổi của bạn</h2>
                    <span>Có thể bạn quan tâm</span>
                </div>
                <!--HEADING 1 END-->
                <div class="featured-slider">
                    <div class="row">
                        <div id="owl-demo-featured" class="owl-carousel owl-theme">
                            <?php foreach($suitable_books as $item): ?>
                                <!--FEATURED DEC START-->
                                <div class="item">
                                    <div class="featured-dec">
                                        <figure>
                                            <img src="<?php echo $baseUrl.'/uploads/images/'.$item->image?>" alt=""/>
                                        </figure>
                                        <div class="text">
                                            <div class="text-dec">
                                                <ul class="tags-2">
                                                    <li>Danh mục : <a href="#"><?php echo $item->cate->cate_name ?></a></li>
                                                </ul>
                                                <h5>
                                                    <?php echo Html::a($item->book_name,['book/view','id'=>$item->book_id]) ?>

                                                </h5>
                                                <p><?php echo $item->description
                                                ?></p>
                                            </div>
                                            <div class="featured-footer">
                                                <span class="price-tag">
                                                    <?php  if($item->sale_price!=0):

                                                        //$discount_rate=($item->price-$item->sale_price)*100/$item->price;

                                                        ?>

                                                        <sub>   <?php echo number_format($item->sale_price,0, '', '.')?> ₫</sub> 
                                                        <del><?php echo number_format($item->price,0, '', '.')?> ₫</del> 
                                                        <strong class="discount_rate"> 
                                                            - <?php echo round($item->discount_rate) ?> % 
                                                        </strong>
                                                        <?php else :?>               
                                                            <sub><?php echo number_format($item->price,0, '', '.')?> ₫</sub>
                                                        <?php endif; ?>
                                                    </span>

                                                    <div class="cart-2">


                                                      <?php if(!Yii::$app->user->isGuest): ?>
                                                        <?php $customer_id=Yii::$app->user->identity->id ?>
                                                        <?php $form = ActiveForm::begin(
                                                            [
                                                              'id' => 'form-whilist',
                                                              'action'=>Yii::$app->urlManager->baseUrl.'/whilist/add-whilist',
                                                              'options'=>
                                                              [
                                                                'data-name'=>$item->book_name
                                                            ]
                                                        ]); ?>
                                                        <?= $form->field($whilist, 'book_id')->hiddenInput(['value'=>$item->book_id])->label(false) ?>

                                                        <?= $form->field($whilist, 'customer_id')->hiddenInput(['value'=>$customer_id])->label(false) ?>

                                                        <?php //Check nút thêm vào danh sách .
                                                        if($whilist->getBookInList($item->book_id)==0): ?>
                                                            <?= Html::submitButton('<i class="fa fa-heart"></i> Thêm vào danh sách yêu thích', ['class' => 'like-icon']) ?>
                                                            <?php else: ?>
                                                               <?= Html::submitButton('<i class="fa fa-heart"></i> Sản phẩm đã được bạn yêu thích', ['class' => 'liked-icon']) ?>
                                                           <?php endif; ?>
                                                           <?php ActiveForm::end(); ?>

                                                       <?php endif; ?>
                                                       <?php 
                                                       if($item->quantity>0):
                                                        echo Html::a('Chi tiết sản phẩm',['book/view','id'=>$item->book_id],['class'=>'add-cart']);
                                                        ?>
                                                        <?php else:?>
                                                            <?php   echo Html::a('Đã hết hàng',['book/view','id'=>$item->book_id],['class'=>'out_of_stock']);?>
                                                            
                                                        <?php endif;?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FEATURED DEC END-->
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <section>
            <div class="container">
                <div class="featured2-wrap">
                    <div class="row">
                        <!--FEATURED2 DEC START-->
                        <div class="col-md-6">
                            <div class="featured2-dec">
                                <figure><img src="extra-images/bookstore4.png" alt=""></figure>
                                <div class="text">
                                    <h2>Kỉ niệm sách mới ra mắt</h2>
                                    <p>Năm 2018</p>

                                </div>
                            </div>
                        </div>
                        <!--FEATURED2 DEC END-->
                        <!--FEATURED2 DEC START-->
                        <div class="col-md-6">
                            <div class="featured-style2">
                                <figure><img src="extra-images/bookstore5.png" alt=""></figure>
                                <div class="text">
                                    <h2>Giảm giá đến 40%</h2>
                                    <h5>Trên các sách mới về</h5>
                                    <div class="clear"></div>

                                </div>
                            </div>
                        </div>
                        <!--FEATURED2 DEC END-->
                    </div>
                </div>
            </div>
        </section>


        <section>
            <div class="container">
                <div class="tabs-wrap1">
                    <ul class="nav nav-tabs books-tab" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Sách mới về</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Sách khuyến mãi </a></li>
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Sách nổi bật</a></li>
                    </ul>
                    <div class="tab-content">



                        <div role="tabpanel" class="tab-pane fade in active" id="home">

                         <?php if($new_books):
                            ?>

                            <!--TABS SLIDER START-->
                            <div class="tabs-slider-wrap">
                                <div class="row">
                                    <div id="tabs-slider" class="owl-carousel owl-theme">
                                        <?php foreach($new_books as $item): ?>
                                            <!--BOOK DEC START-->
                                            <div class="item">
                                                <div class="book-tab-dec">
                                                    <figure>
                                                       <img src="<?php echo $baseUrl.'/uploads/images/'.$item->image?>" alt=""/>
                                                       <figcaption class="ribbon-wrap">

                                                        <span class="ribbon new">Mới</span>
                                                        <?php  if($item->sale_price!=0):?>
                                                            <div class="clear"></div>
                                                            <span class="ribbon">Khuyến mãi</span>
                                                        <?php endif; ?>

                                                    </figcaption>
                                                </figure>
                                                <div class="text">
                                                    <small><?php echo $item->cate->cate_name ?></small>
                                                    <h5>
                                                      <?php echo Html::a($item->book_name,['book/view','id'=>$item->book_id]) ?>
                                                  </h5>
                                                  <span class="price-tag">
                                                    <?php  if($item->sale_price!=0): ?>

                                                        <sub>   <?php echo number_format($item->sale_price,0, '', '.')?> ₫</sub> 
                                                        <del><?php echo number_format($item->price,0, '', '.')?> ₫</del> 
                                                        <strong class="discount_rate"> 
                                                            - <?php echo round($item->discount_rate) ?> % 
                                                        </strong>
                                                        <?php else :?>               
                                                            <sub><?php echo number_format($item->price,0, '', '.')?> ₫</sub>
                                                        <?php endif; ?>
                                                    </span>

                                                    <?php if(!Yii::$app->user->isGuest): ?>
                                                        <?php $customer_id=Yii::$app->user->identity->id ?>
                                                        <?php $form = ActiveForm::begin(
                                                            [
                                                              'id' => 'form-whilist',
                                                              'action'=>Yii::$app->urlManager->baseUrl.'/whilist/add-whilist',
                                                              'options'=>
                                                              [
                                                                'data-name'=>$item->book_name
                                                            ]
                                                        ]); ?>
                                                        <?= $form->field($whilist, 'book_id')->hiddenInput(['value'=>$item->book_id])->label(false) ?>

                                                        <?= $form->field($whilist, 'customer_id')->hiddenInput(['value'=>$customer_id])->label(false) ?>

                                                       <?php //Check nút thêm vào danh sách .
                                                        if($whilist->getBookInList($item->book_id)==0): ?>
                                                            <?= Html::submitButton('<i class="fa fa-heart"></i> Thêm vào danh sách yêu thích', ['class' => 'like-icon']) ?>
                                                            <?php else: ?>
                                                               <?= Html::submitButton('<i class="fa fa-heart"></i> Sản phẩm đã được bạn yêu thích', ['class' => 'liked-icon']) ?>
                                                           <?php endif; ?>

                                                    <?php ActiveForm::end(); ?>

                                                <?php endif; ?>


                                                <?php 
                                                if($item->quantity>0):
                                                    echo Html::a('Chi tiết sản phẩm',['book/view','id'=>$item->book_id],['class'=>'add-cart']);
                                                    ?>
                                                    <?php else:?>
                                                        <?php   echo Html::a('Đã hết hàng',['book/view','id'=>$item->book_id],['class'=>'out_of_stock']);?>

                                                    <?php endif;?>




                                                    <!--  <a class="cart-icon" href="#"><i class="fa fa-shopping-cart"></i></a> -->

                                                </div>
                                            </div>
                                        </div>
                                        <!--BOOK DEC END-->
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <!--TABS SLIDER END-->

                    <?php endif; ?>
                </div>


                <div role="tabpanel" class="tab-pane fade" id="profile">
                 <?php if($sale_books): ?>
                    <!--TABS SLIDER START-->
                    <div class="tabs-slider-wrap">
                        <div class="row">
                            <div id="tabs-slider" class="owl-carousel owl-theme">
                                <?php foreach($sale_books as $item): ?>
                                    <!--BOOK DEC START-->
                                    <div class="item">
                                        <div class="book-tab-dec">
                                            <figure>
                                               <img src="<?php echo $baseUrl.'/uploads/images/'.$item->image?>" alt=""/>
                                               <figcaption class="ribbon-wrap">
                                                <span class="ribbon">Khuyến mãi</span>
                                            </figcaption>
                                        </figure>
                                        <div class="text">
                                            <small><?php echo $item->cate->cate_name ?></small>
                                            <h5>
                                              <?php echo Html::a($item->book_name,['book/view','id'=>$item->book_id]) ?>
                                          </h5>
                                          <span class="price-tag">
                                            <?php  if($item->sale_price!=0):?>

                                                <sub>   <?php echo number_format($item->sale_price,0, '', '.')?> ₫</sub> 
                                                <del><?php echo number_format($item->price,0, '', '.')?> ₫</del> 
                                                <strong class="discount_rate"> 
                                                    - <?php echo round($item->discount_rate) ?> % 
                                                </strong>
                                                <?php else :?>               
                                                    <sub><?php echo number_format($item->price,0, '', '.')?> ₫</sub>
                                                <?php endif; ?>
                                            </span>

                                            <?php if(!Yii::$app->user->isGuest): ?>
                                                <?php $customer_id=Yii::$app->user->identity->id ?>
                                                <?php $form = ActiveForm::begin(
                                                    [
                                                      'id' => 'form-whilist',
                                                      'action'=>Yii::$app->urlManager->baseUrl.'/whilist/add-whilist',
                                                      'options'=>
                                                      [
                                                        'data-name'=>$item->book_name
                                                    ]
                                                ]); ?>
                                                <?= $form->field($whilist, 'book_id')->hiddenInput(['value'=>$item->book_id])->label(false) ?>

                                                <?= $form->field($whilist, 'customer_id')->hiddenInput(['value'=>$customer_id])->label(false) ?>


                                                 <?php //Check nút thêm vào danh sách .
                                                        if($whilist->getBookInList($item->book_id)==0): ?>
                                                            <?= Html::submitButton('<i class="fa fa-heart"></i> Thêm vào danh sách yêu thích', ['class' => 'like-icon']) ?>
                                                            <?php else: ?>
                                                               <?= Html::submitButton('<i class="fa fa-heart"></i> Sản phẩm đã được bạn yêu thích', ['class' => 'liked-icon']) ?>
                                                           <?php endif; ?>

                                                <?php ActiveForm::end(); ?>

                                            <?php endif; ?>



                                            <?php 
                                            if($item->quantity>0):
                                                echo Html::a('Chi tiết sản phẩm',['book/view','id'=>$item->book_id],['class'=>'add-cart']);
                                                ?>
                                                <?php else:?>
                                                    <?php   echo Html::a('Đã hết hàng',['book/view','id'=>$item->book_id],['class'=>'out_of_stock']);?>

                                                <?php endif;?>



                                                <!--  <a class="cart-icon" href="#"><i class="fa fa-shopping-cart"></i></a> -->

                                            </div>
                                        </div>
                                    </div>
                                    <!--BOOK DEC END-->
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!--TABS SLIDER END-->

                <?php endif; ?>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="messages">
             <?php if($hot_books): ?>
                <!--TABS SLIDER START-->
                <div class="tabs-slider-wrap">
                    <div class="row">
                        <div id="tabs-slider" class="owl-carousel owl-theme">
                            <?php foreach($hot_books as $item): ?>
                                <!--BOOK DEC START-->
                                <div class="item">
                                    <div class="book-tab-dec">
                                        <figure>
                                           <img src="<?php echo $baseUrl.'/uploads/images/'.$item->image?>" alt=""/>
                                           <figcaption class="ribbon-wrap">

                                            <span class="ribbon hot">Nổi bật</span>    
                                            <?php  if($item->sale_price!=0):?>
                                                <div class="clear"></div>
                                                <span class="ribbon">Khuyến mãi</span>
                                            <?php endif; ?>

                                        </figcaption>
                                    </figure>
                                    <div class="text">
                                        <small><?php echo $item->cate->cate_name ?></small>
                                        <h5>
                                          <?php echo Html::a($item->book_name,['book/view','id'=>$item->book_id]) ?>
                                      </h5>
                                      <span class="price-tag">
                                        <?php  if($item->sale_price!=0):

                                            //$discount_rate=($item->price-$item->sale_price)*100/$item->price;

                                            ?>

                                            <sub>   <?php echo number_format($item->sale_price,0, '', '.')?> ₫</sub> 
                                            <del><?php echo number_format($item->price,0, '', '.')?> ₫</del> 
                                            <strong class="discount_rate"> 
                                                 - <?php echo round($item->discount_rate) ?> % 
                                            </strong>
                                            <?php else :?>               
                                                <sub><?php echo number_format($item->price,0, '', '.')?> ₫</sub>
                                            <?php endif; ?>
                                        </span>

                                        <?php if(!Yii::$app->user->isGuest): ?>
                                            <?php $customer_id=Yii::$app->user->identity->id ?>
                                            <?php $form = ActiveForm::begin(
                                                [
                                                  'id' => 'form-whilist',
                                                  'action'=>Yii::$app->urlManager->baseUrl.'/whilist/add-whilist',
                                                  'options'=>
                                                  [
                                                    'data-name'=>$item->book_name
                                                ]
                                            ]); ?>
                                            <?= $form->field($whilist, 'book_id')->hiddenInput(['value'=>$item->book_id])->label(false) ?>

                                            <?= $form->field($whilist, 'customer_id')->hiddenInput(['value'=>$customer_id])->label(false) ?>


                                       <?php //Check nút thêm vào danh sách .
                                                        if($whilist->getBookInList($item->book_id)==0): ?>
                                                            <?= Html::submitButton('<i class="fa fa-heart"></i> Thêm vào danh sách yêu thích', ['class' => 'like-icon']) ?>
                                                            <?php else: ?>
                                                               <?= Html::submitButton('<i class="fa fa-heart"></i> Sản phẩm đã được bạn yêu thích', ['class' => 'liked-icon']) ?>
                                                           <?php endif; ?>



                                            <?php ActiveForm::end(); ?>

                                        <?php endif; ?>



                                        <?php 
                                        if($item->quantity>0):
                                            echo Html::a('Chi tiết sản phẩm',['book/view','id'=>$item->book_id],['class'=>'add-cart']);
                                            ?>
                                            <?php else:?>
                                                <?php   echo Html::a('Đã hết hàng',['book/view','id'=>$item->book_id],['class'=>'out_of_stock']);?>

                                            <?php endif;?>




                                            <!--  <a class="cart-icon" href="#"><i class="fa fa-shopping-cart"></i></a> -->

                                        </div>
                                    </div>
                                </div>
                                <!--BOOK DEC END-->
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!--TABS SLIDER END-->

            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</section>
<section class="order-bar">
    <div class="container">
        <div class="text">
            <h5>Miễn phí vận chuyển với đơn hàng trên 2 triệu</h5>
            <span>Và rất nhiều quà tặng và ưu đãi khác</span>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <!--HEADING 1 START-->
        <div class="heading-1">
            <h2>Bản tin Anh Quân Book Store</h2>
        </div>
        <!--HEADING 1 END-->
        <?php if($news): ?>
            <div class="row">
                <?php foreach ($news as $new) : ?>
                    <!--FEATURED BOLG 1 START-->
                    <div class="col-md-4 col-sm-6">
                        <div class="featured-blog1">
                            <figure>
                                <img src="<?php echo $baseUrl.'/uploads/images/'.$new->image?>" alt="" width=360 height=245/>
                                <figcaption class="date-wrap">
                                    <span class="date">
                                        <b><?php echo date("d-m-Y",($new->created_at)) ?></b>
                                    </span>
                                </figcaption>
                            </figure>
                            <div class="text">
                                <h5><?php echo Html::a($new->news_title,['/news','id'=>$new->news_id]) ?></h5>
                                <p><?php echo $new->description ?></p>
                            </div>
                            
                        </div>
                    </div>
                    <!--FEATURED BOLG 1 END-->
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
</div>



