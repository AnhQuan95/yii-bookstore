<?php 
use yii\helpers\Html;
use frontend\components\Cart;
use backend\models\Category;
use backend\models\SuitableAge;
use yii\bootstrap\ActiveForm;
?>
<header class="header-1">
    <!--TOP BAR START START-->
    <div class="top-bar">
        <div class="container">
            <div class="pull-left">
                <ul>
                    <li><i class="fa fa-paper-plane"></i><a href="#">Anh Quân BookStore - Nơi lưu giữ tri thức</a></li>
                    <li>
                      <i class="fa fa-sign-in"></i>
                      <!-- Single button -->
                      <div class="dropdown lang-wrap">
                          <?php if(!Yii::$app->user->isGuest): ?>
                              <!-- <em>Wishlist:</em> -->
                              <em><?php echo Yii::$app->user->identity->full_name?></em>

                              <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li><?php 
                                echo Html::a('Thông tin cá nhân',
                                    ['/customer/view']
                                )
                                ?></li> 
                                <li>
                                    <?php 
                                    echo Html::a('Đơn hàng cá nhân',
                                        ['/order']
                                    )
                                    ?>
                                </li>
                                <li>
                                    <?php 
                                    echo Html::a('Danh sách yêu thích',
                                        ['/whilist']
                                    )
                                    ?>
                                </li>

                                <li>
                                    <?php  echo Html::beginForm(['/site/logout'], 'post')?>
                                    <?php echo Html::submitButton('Thoát') ?>
                                    <?php echo Html::endForm()  ?>

                                    <?php //echo Html::a('Thoát',['/site/logout'],['data-method'=>'post']) ?>
                                </li>
                            </ul>
                            <?php else: ?>
                                <?php echo Html::a('ĐĂNG NHẬP',Yii::$app->urlManager->baseUrl.'/site/login') ?>


                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--LOGO WRAP START-->
    <div class="logo-wrap">

        <div class="container">
            <!--LOGO DEC START-->
            <div class="logo-dec">

              <img src="<?php echo $baseUrl ?>/images/logo.png" alt=""/>
          </div>
          <!--LOGO DEC END-->
          <!--SEARCH WRAP START-->
          <div class="searh-wrap">
            <ul class="tags-1"></ul>
            <?php $form = ActiveForm::begin(
                [
                    'id' => 'form-search',
                    'method' => 'get',
                    'action'=>Yii::$app->urlManager->baseUrl.'/book/list-by-key-word'

                ]); ?>
                <div class="select-menu">
                    <select name='type'>
                        <option value="book">Sách</option>
                        <option value="author">Tác giả</option>
                        <option value="publisher">NXB</option>   
                    </select>
                </div>
                <div class="text-filed-1">

                    <input type="text" name="keyword" placeholder="Từ khóa...  ">
                    <button><i class="fa fa-search"></i></button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <!--SEARCH WRAP END-->
            <!--CART WRAP START-->
            <div class="cart-wrap">

                <!--DL Menu Start-->
                <div id="kode-responsive-navigation" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                        <li>                   
                          <?php echo Html::a('Trang chủ',['/site']) ?>
                      </li>
                  </li>
                  <li class="menu-item kode-parent-menu"><?php echo Html::a('sách',['/book'])?>
              </li>
              <li class="menu-item kode-parent-menu"><?php echo Html::a('hướng dẫn',['site/guide'])?>
                
            </li>
            <li><?php 
            echo Html::a('Giới thiệu',['/site/about'])?></li>
            <li><?php echo Html::a('Liên hệ',['/site/contact'])?></li>
        </ul>
    </div>
    <!--DL Menu END-->
    <div class="cart">
        <div class="show2">

          <?php 
          echo Html::a('<i class="icon-shopping-cart"></i>',
            ['/cart'])
            ?>

            <?php $cart=new Cart() ?>
            <small id="quantity_in_cart_small"><?php echo $cart->getTotalItem() ?></small>
        </div>

    </div>
</div>
<!--CART WRAP END-->
</div>


<?php $cat=new Category();
$category=$cat->getCategoryBy();
$suitable_age=new SuitableAge();
$age=$suitable_age->getSuitableAgeBy();
?>

</div>
<!--LOGO WRAP END-->
<!--NAVIGATION WRAP START-->
<div class="container">
    <div class="navigation-wrap">
        <!--CATEGORIES WRAP START-->
        <div class="categories-menu">
          <span>Lọc</span>
          <i class="fa fa-reorder show"></i>
          <ul class="categories-ul">
            <li><a href="#"><i class="fa fa-list"></i>Sách theo danh mục</a>
                <!--MEGA MENU START-->
                <div class="mega-menu1">

                    <div class="fetch-bookmtea">
                        <ul>
                            <li class="fetch-book2">
                                <h4>Danh mục sách</h4>
                            </li>
                            <?php 
                            if($category):
                                foreach ($category as $cate) :
                                   ?>
                                   <li>
                                    <?php echo Html::a($cate->cate_name,['/book/list-by-category','id'=>$cate->cate_id]) ?>

                                </li>

                            <?php endforeach; endif; ?>

                            <li> <?php echo Html::a('Xem thêm',['/book'])?></li>
                        </ul>
                    </div>
                </div>
                <!--MEGA MENU END-->
            </li>
            <li><a href="#"><i class="fa fa-child"></i>Sách theo độ tuổi</a>
                <!--MEGA MENU START-->
                <div class="mega-menu1">

                    <div class="fetch-bookmtea">
                        <ul>
                            <li class="fetch-book2">
                                <h4>Danh mục sách</h4>
                            </li>
                            <?php 
                            if($age):
                                foreach ($age as $age) :
                                   ?>
                                   <li>
                                    <?php echo Html::a($age->name_of_age,['/book/list-by-age','id'=>$age->id]) ?>

                                </li>

                            <?php endforeach; endif; ?>

                            <li> <?php echo Html::a('Xem thêm',['/book'])?></li>
                        </ul>
                    </div>
                </div>
                <!--MEGA MENU END-->
            </li>

            <li> <?php echo Html::a('Xem thêm',['/book'])?></li>
        </ul>
    </div>
    <!--CATEGORIES WRAP END-->
    <!--NAVIGATION DEC START-->
    <ul class="nav-dec">
       <li>
          <?php 
          echo Html::a('Trang chủ',
            ['/site'])
            ?>
        </li>
        <li>
          <?php 
          echo Html::a('sách',
            ['/book'])
            ?>
        </li>
        <li><?php echo Html::a('hướng dẫn',['site/guide'])?></li>

        <li>
           <?php echo Html::a('Giới thiệu',['/site/about']) ?>
        </li>
        <li>
          <?php 
          echo Html::a('Liên hệ',
            ['/site/contact'])
            ?>
        </li>
    </ul>
    <!--NAVIGATION DEC END-->
</div>
</div>
<!--NAVIGATION WRAP END-->
</header>