<?php 
use yii\helpers\Html;
use frontend\components\Cart;
use backend\models\Category;
use backend\models\SuitableAge;
?>
<!--HEADER START-->
<header class="header-1">
    <!--TOP BAR START START-->
    <div class="top-bar">
        <div class="container">
            <div class="pull-left">
                <ul>
                    <li><i class="fa fa-paper-plane"></i><a href="#">Free shipping on orders above $100</a></li>
                </ul>
            </div>
            <div class="pull-right">
                <div class="user-wrap">
                    <div class="wishlist-wrap">
                        <i class="fa fa-sign-in"></i>
                        <!-- Single button -->
                        <div class="dropdown">
                          <?php if(!Yii::$app->user->isGuest): ?>
                              <!-- <em>Wishlist:</em> -->
                              <em><?php echo Yii::$app->user->identity->full_name?></em>

                              <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li><a href="#">Thông tin cá nhân</a></li> 
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
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--TOP BAR END-->
    <!--LOGO WRAP START-->
    <div class="logo-wrap">

        <div class="container">
            <!--LOGO DEC START-->
            <div class="logo-dec">
                <a href="index.html"><img src="<?php echo $baseUrl ?>/images/logo.png" alt=""/></a>
            </div>
            <!--LOGO DEC END-->
            <!--SEARCH WRAP START-->
            <div class="searh-wrap">
                <ul class="tags-1">
                    <li><a href="#">How to Order</a></li>
                    <li><a href="#">Payment</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Return</a></li>
                    <li><span>Call Us: +92 42 588 6785</span></li>
                </ul>
                <form>
                    <div class="select-menu">
                        <select>
                            <option value="1">book</option>
                            <option value="9">novel</option>
                            <option value="2">books</option>
                            <option value="3">Select 4</option>
                            <option value="6">Select 5</option>
                            <option value="8">Select 6</option>
                        </select>
                    </div>
                    <div class="text-filed-1">
                        <input type="text" placeholder="Search by title, author, subject or ISBN here...  ">
                        <button><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            <!--SEARCH WRAP END-->
            <!--CART WRAP START-->
            <div class="cart-wrap">

                <!--DL Menu Start-->
                <div id="kode-responsive-navigation" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                        <li>
                            <a href="index-2.html">Lọc</a>
                            <ul class="dl-submenu">
                               <li><a href="index-3.html">index 2</a></li>
                           </ul>
                       </li>
                       <li class="menu-item kode-parent-menu"><a href="#">Pages</a>
                        <ul class="dl-submenu">
                           <li><a href="login-forms.html">login forms</a></li>
                           <li><a href="comingsoon.html">coming soon</a></li>
                           <li><a href="checkout.html">check out</a></li>
                           <li><a href="404.html">404</a></li>
                           <li><a href="widgets.html">widgets</a></li>
                           <li><a href="shortcode.html">shortcode</a></li>
                       </ul>
                   </li>
                   <li class="menu-item kode-parent-menu"><a href="about-author.html">about author</a>
                   </li>
                   <li class="menu-item kode-parent-menu"><a href="#">products</a>
                    <ul class="dl-submenu">
                        <li><a href="product-detail.html">product detail</a></li>
                        <li><a href="product-detail2.html">product detail 2</a></li>
                        <li><a href="product-detail3.html">product detail 3</a></li>
                        <li><a href="grid_03_columns.html">product 3 col</a></li>
                        <li><a href="grid_04_columns.html">product 4 col</a></li>
                    </ul>
                </li>
                <li class="menu-item kode-parent-menu"><a href="#">blog</a>
                    <ul class="dl-submenu">
                        <li><a href="blog-classic.html">blog-classic</a></li>
                        <li><a href="blog-detail.html">blog-detail</a></li>
                        <li><a href="blog-detail-fullwidth.html">blog detail 2</a></li>
                        <li><a href="blog-full-width.html">blog full width</a></li>
                        <li><a href="blog_masonry_2_columns.html">blog masonry</a></li>
                        <li><a href="blog-grid2.html">blog 2</a></li>
                        <li><a href="list-style_01_columns.html">list style 1</a></li>
                        <li><a href="list-style_01_sidebar.html">list style sidebar</a></li>
                    </ul>
                </li>
                <li><a href="contact-us.html">Contact Us</a></li>
            </ul>
        </div>
        <!--DL Menu END-->
        <a href="#"><i class="fa fa-truck"></i></a>
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

</div>
<!--LOGO WRAP END-->
<?php $cat=new Category();
$category=$cat->getCategoryBy();
$suitable_age=new SuitableAge();
$age=$suitable_age->getSuitableAgeBy();
?>

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
                                <h4>Độ tuổi</h4>
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
        <li>
            <a href="blog-classic.html">Tin tức</a>
            <ul>
                <li><a href="blog-classic.html">blog-classic</a></li>
                <li><a href="blog-detail.html">blog-detail</a></li>
                <li><a href="blog-detail-fullwidth.html">blog detail 2</a></li>
                <li><a href="blog-full-width.html">blog full width</a></li>
                <li><a href="blog_masonry_2_columns.html">blog masonry</a></li>
                <li><a href="blog-grid2.html">blog 2</a></li>
                <li><a href="list-style_01_columns.html">list style 1</a></li>
                <li><a href="list-style_01_sidebar.html">list style sidebar</a></li>
            </ul>
        </li>
        <li>
            <a href="about-author.html">Tác giả</a>
        </li>
           <li>
            <a href="#">Hướng dẫn</a>
            <ul>
                <li><a href="book-detail.html">book detail 1</a></li>
                <li><a href="book-detail2.html">book detail 2</a></li>
                <li><a href="book-detail3.html">book detail 3</a></li>
                <li><a href="grid_03_columns.html">book 3 col</a></li>
                <li><a href="grid_04_columns.html">book 4 col</a></li>
            </ul>
        </li>
         <li>
            <a href="about-author.html">Giới thiệu</a>
        </li>
        <li>
            <a href="contact-us.html">Liên hệ</a>
        </li>
    </ul>
<!--NAVIGATION DEC END-->
</div>
</div>
<!--NAVIGATION WRAP END-->
</header>