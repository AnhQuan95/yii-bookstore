<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\components\Cart;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php 
        //trả về host của trang
          //echo $_SERVER['HTTP_HOST'];

    $host='http://'.$_SERVER['HTTP_HOST'].'/';
        // echo $host;
        //trả về đường dẫn từ host đến file php.
        // echo Yii::$app->urlManager->baseUrl;
    $homeUrl=str_replace('/front/web','',Yii::$app->urlManager->baseUrl);
         //echo $homeUrl;
    $baseUrl=$host.$homeUrl;
    //echo $baseUrl;


    ?>
</head>
<body>
    <?php $this->beginBody() ?>


    
    <!--KF KODE WRAPPER WRAP START-->
    <div class="kode_wrapper">
        <!--HEADER START-->
        <header class="header-1" id="myHeader">
            <!--TOP BAR START START-->
            <div class="top-bar">
                <div class="container">
                    <div class="pull-left">
                        <ul>
                            <li><i class="fa fa-paper-plane"></i><a href="#">Free shipping on orders above $100</a></li>
                            <li>
                                <!-- Single button -->
                                <div class="dropdown lang-wrap">
                                  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-globe"></i>
                                    English
                                    <span class="caret"></span>
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li><a href="#"><img src="<?php echo $baseUrl ?>/images/laung-1.jpg" alt="">English (UK)</a></li>
                                    <li><a href="#"><img src="<?php echo $baseUrl ?>/images/laung-2.jpg" alt="">English (US)</a></li>
                                    <li><a href="#"><img src="<?php echo $baseUrl ?>/images/laung-3.jpg" alt="">German</a></li>
                                    <li><a href="#"><img src="<?php echo $baseUrl ?>/images/laung-4.jpg" alt="">Russian</a></li>
                                    <li><a href="#"><img src="<?php echo $baseUrl ?>/images/laung-5.jpg" alt="">Chinese</a></li>
                                    <li><a href="#"><img src="<?php echo $baseUrl ?>/images/laung-6.jpg" alt="">Philippines</a></li>
                                </ul>
                            </div>
                        </li>
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
                                  <em><?php echo Yii::$app->user->identity->email ?></em>

                                  <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li><a href="#">Thông tin đơn hàng</a></li> 
                                    <li><a href="#">Đơn hàng</a></li>
                                    <li>
                                        <?php  echo Html::beginForm(['/site/logout'], 'post')?>
                                        <?php echo Html::submitButton('Thoát') ?>
                                        <?php echo Html::endForm()  ?>

                                        <?php //echo Html::a('Thoát',['/site/logout'],['data-method'=>'post']) ?>
                                    </li>
                                </ul>
                                <?php else: ?>
                                    <?php echo Html::a('ĐĂNG NHẬP /','site/login') ?>
                                    <?php echo Html::a('ĐĂNG KÝ','site/login') ?>

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
                                <li><a href="index-2.html">home</a>
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
                        <i class="icon-shopping-cart"></i>
                        <?php $cart=new Cart() ?>
                        <small id="quantity_in_cart_small"><?php echo $cart->getTotalItem() ?></small>
                    </div>
                    <div class="cart-form">
                        <div class="cart-footer">
                          <?php 
                          echo Html::a('<i class="fa fa-cart-arrow-down"></i>Xem giỏ hàng',
                            ['/cart'],
                            [
                                'class'=>'ad-cart'

                            ])
                            ?>
                            <?php 
                            echo Html::a('<i class="fa fa-mail-forward"></i>Thanh toán',
                                ['/checkout'],
                                [
                                    'class'=>'cart-chekout'

                                ])
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--CART WRAP END-->
            </div>
        </div>
        <!--LOGO WRAP END-->
        <!--NAVIGATION WRAP START-->
        <div class="container">
            <div class="navigation-wrap">
                <!--CATEGORIES WRAP START-->
                <div class="categories-menu">
                    <span>CATEGORIES</span>
                    <i class="fa fa-reorder show"></i>
                    <ul class="categories-ul">
                        <li><a href="#"><i class="fa fa-image"></i>Art & Photography</a>
                            <!--MEGA MENU START-->
                            <div class="mega-menu1">
                                <div class="fetch-book2">
                                    <h4>Featured BOOK</h4>
                                    <figure>
                                        <img src="<?php echo $baseUrl ?>/extra-images/featured-4.jpg" alt="">
                                        <figcaption>
                                            <span class="pricelable">
                                                <sub>$</sub>29.00
                                            </span>
                                        </figcaption>
                                    </figure>
                                    <div class="text">
                                        <h6>He LIE TREE</h6>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laud rem.</p>
                                        <a class="btn-1" href="#">read more</a>
                                        <a class="btn-1 active" href="#">purchase</a>
                                    </div>
                                </div>
                                <div class="fetch-bookmtea">
                                    <ul>
                                        <li class="fetch-book2">
                                            <h4>BIOGRAPHIES</h4>
                                        </li>
                                        <li>
                                            <a href="#">Historical, Political & Military</a>
                                        </li>
                                        <li>
                                            <a href="#">Business & Industry</a>
                                        </li>
                                        <li>
                                            <a href="#">Science, Technology & Medicine</a>
                                        </li>
                                        <li>
                                            <a href="#">Literary</a>
                                        </li>
                                        <li>
                                            <a href="#">individual Composers & Musicians, </a>
                                        </li>
                                        <li>
                                            <a href="#">Specific Bands & Groups</a>
                                        </li>
                                        <li>
                                            <a href="#">Historical, Political & Military</a>
                                        </li>
                                        <li>
                                            <a href="#">More...</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--MEGA MENU END-->
                        </li>
                        <li><a href="#"><i class="icon-ascending-line-graphic-of-business-stats"></i>Business & Investing</a>
                            <!--MEGA MENU START-->
                            <div class="mega-menu1">
                                <div class="fetch-bookmtea">
                                    <ul>
                                        <li class="fetch-book2">
                                            <h4>BIOGRAPHIES</h4>
                                        </li>
                                        <li>
                                            <a href="#">Historical, Political & Military</a>
                                        </li>
                                        <li>
                                            <a href="#">Business & Industry</a>
                                        </li>
                                        <li>
                                            <a href="#">Science, Technology & Medicine</a>
                                        </li>
                                        <li>
                                            <a href="#">Literary</a>
                                        </li>
                                        <li>
                                            <a href="#">individual Composers & Musicians, </a>
                                        </li>
                                        <li>
                                            <a href="#">Specific Bands & Groups</a>
                                        </li>
                                        <li>
                                            <a href="#">Historical, Political & Military</a>
                                        </li>
                                        <li>
                                            <a href="#">More...</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="fetch-book2">
                                    <h4>Featured BOOK</h4>
                                    <figure>
                                        <img src="<?php echo $baseUrl ?>/extra-images/featured-4.jpg" alt="">
                                        <figcaption>
                                            <span class="pricelable">
                                                <sub>$</sub>29.00
                                            </span>
                                        </figcaption>
                                    </figure>
                                    <div class="text">
                                        <h6>He LIE TREE</h6>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laud rem.</p>
                                        <a class="btn-1" href="#">read more</a>
                                        <a class="btn-1 active" href="#">purchase</a>
                                    </div>
                                </div>
                            </div>
                            <!--MEGA MENU END-->
                        </li>
                        <li><a href="#"><i class="fa fa-user"></i>Biographies</a>
                            <!--MEGA MENU START-->
                            <div class="mega-menu1">
                                <div class="fetch-book2 fetch-bookstyle2">
                                    <h4>Featured BOOK</h4>
                                    <figure>
                                        <img src="<?php echo $baseUrl ?>/extra-images/style2.jpg" alt="">
                                        <figcaption>
                                            <span class="ribbon hot">hot</span>
                                        </figcaption>
                                    </figure>
                                    <div class="text">
                                        <h6>He LIE TREE</h6>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem.</p>
                                        <a class="btn-1" href="#">read more</a>
                                        <a class="btn-1 active" href="#">purchase</a>
                                    </div>
                                </div>
                                <div class="fetch-bookmtea">
                                    <ul>
                                        <li class="fetch-book2">
                                            <h4>BIOGRAPHIES</h4>
                                        </li>
                                        <li>
                                            <a href="#">Historical, Political & Military</a>
                                        </li>
                                        <li>
                                            <a href="#">Business & Industry</a>
                                        </li>
                                        <li>
                                            <a href="#">Science, Technology & Medicine</a>
                                        </li>
                                        <li>
                                            <a href="#">Literary</a>
                                        </li>
                                        <li>
                                            <a href="#">individual Composers & Musicians, </a>
                                        </li>
                                        <li>
                                            <a href="#">Specific Bands & Groups</a>
                                        </li>
                                        <li>
                                            <a href="#">Historical, Political & Military</a>
                                        </li>
                                        <li>
                                            <a href="#">More...</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--MEGA MENU END-->
                        </li>
                        <li><a href="#"><i class="fa fa-child"></i>Children Books</a>
                            <!--MEGA MENU START-->
                            <div class="mega-menu1">
                                <div class="col-md-4">
                                    <div class="widget widget-accordian">
                                        <div class="widget-padding">
                                            <!--WIDGET ACCORDIAN START-->
                                            <div class="side_accordian">
                                                <div id="section10" class="accordion accordion-close">
                                                    <span>Our Collection</span>
                                                </div>
                                                <div class="accordion-content" style="display: none;">
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                                </div>
                                            </div>
                                            <!--WIDGET ACCORDIAN END-->
                                            <!--WIDGET ACCORDIAN START-->
                                            <div class="side_accordian">
                                                <div id="section11" class="accordion accordion-close">
                                                    <span>Our Mission</span>
                                                </div>
                                                <div class="accordion-content" style="display: none;">
                                                    <div class="accordion-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--WIDGET ACCORDIAN END-->
                                            <!--WIDGET ACCORDIAN START-->
                                            <div class="side_accordian">
                                                <div id="section12" class="accordion accordion-close">
                                                    <span>Our Philosophy</span>
                                                </div>
                                                <div class="accordion-content" style="display: none;">
                                                    <div class="accordion-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--WIDGET ACCORDIAN END-->
                                            <!--WIDGET ACCORDIAN START-->
                                            <div class="side_accordian">
                                                <div id="section13" class="accordion accordion-close">
                                                    <span>Reviews</span>
                                                </div>
                                                <div class="accordion-content" style="display: none;">
                                                    <div class="accordion-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget widget-featured">
                                        <div class="widget-padding">
                                            <!--FEATURED 3 START-->
                                            <div class="featured-dec3">
                                                <figure>
                                                    <img alt="" src="<?php echo $baseUrl ?>/extra-images/widget-featured1.jpg">
                                                </figure>
                                                <div class="text">
                                                    <div class="rating">
                                                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                                    </div>
                                                    <a href="#">Last Sleep</a>
                                                    <span class="price-tag black">
                                                        <sub>$</sub>259.95
                                                    </span>
                                                </div>
                                            </div>
                                            <!--FEATURED 3 END-->
                                            <!--FEATURED 3 START-->
                                            <div class="featured-dec3">
                                                <figure>
                                                    <img alt="" src="<?php echo $baseUrl ?>/extra-images/widget-featured2.jpg">
                                                </figure>
                                                <div class="text">
                                                    <div class="rating">
                                                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                                    </div>
                                                    <a href="#">Unfriended    </a>
                                                    <span class="price-tag black">
                                                        <del> $96.00</del>
                                                        <sub>$</sub>259.95
                                                    </span>
                                                </div>
                                            </div>
                                            <!--FEATURED 3 END-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fetch-wrap">
                                        <div class="fetch-book2 fetch-bookstyle2">
                                            <h4>Featured BOOK</h4>
                                            <figure>
                                                <img src="<?php echo $baseUrl ?>/extra-images/style2.jpg" alt="">
                                                <figcaption>
                                                    <span class="ribbon hot">hot</span>
                                                </figcaption>
                                            </figure>
                                            <div class="text">
                                                <h6>He LIE TREE</h6>
                                                <p>Sed ut perspiciatis unde ovxxa</p>
                                                <a class="btn-1" href="#">read more</a>
                                                <a class="btn-1 active" href="#">purchase</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--MEGA MENU END-->
                        </li>
                        <li><a href="#"><i class="fa fa-university"></i>College Text & Refrences</a></li>
                        <li><a href="#"><i class="fa fa-laptop"></i>Computers & Internet</a></li>
                        <li><a href="#"><i class="fa fa-spoon"></i>Cooking, Food & Wine</a></li>
                        <li><a href="#"><i class="fa fa-book"></i>Educational & Professional</a></li>
                        <li><a href="#"><i class="fa fa-image"></i>Entertainment</a></li>
                        <li><a href="#"><i class="fa fa-newspaper-o"></i>Entrance Exams</a></li>
                        <li><a href="#">show more categories</a></li>
                    </ul>
                </div>
                <!--CATEGORIES WRAP END-->
                <!--NAVIGATION DEC START-->
                <ul class="nav-dec">
                    <li>
                        <a href="index-2.html">HOME</a>
                        <ul>
                            <li><a href="index-3.html">HOME 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="blog-classic.html">blog</a>
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
                        <a href="#">pages</a>
                        <ul>
                           <li><a href="login-forms.html">login forms</a></li>
                           <li><a href="comingsoon.html">coming soon</a></li>
                           <li><a href="checkout.html">check out</a></li>
                           <li><a href="widgets.html">widgets</a></li>
                           <li><a href="shortcode.html">short code</a></li>
                           <li><a href="header-style.html">header</a></li>
                       </ul>
                   </li>
                   <li>
                    <a href="#">book detail</a>
                    <ul>
                        <li><a href="book-detail.html">book detail 1</a></li>
                        <li><a href="book-detail2.html">book detail 2</a></li>
                        <li><a href="book-detail3.html">book detail 3</a></li>
                        <li><a href="grid_03_columns.html">book 3 col</a></li>
                        <li><a href="grid_04_columns.html">book 4 col</a></li>
                    </ul>
                </li>
                <li>
                    <a href="about-author.html">Author</a>
                </li>
                <li>
                    <a href="404.html">404</a>
                </li>
                <li>
                    <a href="contact-us.html">Contact Us</a>
                </li>
            </ul>
            <!--NAVIGATION DEC END-->
        </div>
    </div>
    <!--NAVIGATION WRAP END-->

</header>
<!--HEADER END-->

<?php echo $content ?>

<!--FOOTER START-->
<footer class="footer-1">
    <div class="container">
        <div class="row">
            <!--WIDGET TEXT START-->
            <div class="col-md-4">
                <div class="widget widget-text">
                    <!--WIDGET HEADING START-->
                    <div class="widget-hd">
                        <h3>KITAAB - The Book Shop</h3>
                    </div>
                    <!--WIDGET HEADING END-->
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl.</p>
                        <a href="#">Read More <i class="fa fa-angle-double-right"></i></a>
                    </div>
                    <div class="news-latter">
                        <h5>Email Newsletters:</h5>
                        <div class="input-dec">
                            <form>
                                <input type="text" placeholder="Email Address">
                                <button><i class="fa fa-envelope"></i></button>
                            </form>
                        </div>
                        <a href="#">Privacy Policy</a>
                    </div>
                </div>
            </div>
            <!--WIDGET TEXT END-->
            <!--WIDGET LATEST NEWS START-->
            <div class="col-md-4">
                <div class="widget new-1">
                    <!--WIDGET HEADING START-->
                    <div class="widget-hd">
                        <h3>Latest News</h3>
                    </div>
                    <!--WIDGET HEADING END-->
                    <ul>
                        <li>
                            <!--NEWS DEC START-->
                            <div class="new-dec">
                                <span class="date">
                                    <b>04</b>FEB
                                </span>
                                <div class="text">
                                    <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium</p>
                                    <a href="#">26 Comments</a>
                                </div>
                            </div>
                            <!--NEWS DEC END-->
                        </li>
                        <li>
                            <!--NEWS DEC START-->
                            <div class="new-dec">
                                <span class="date">
                                    <b>26</b>FEB
                                </span>
                                <div class="text">
                                    <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium</p>
                                    <a href="#">26 Comments</a>
                                </div>
                            </div>
                            <!--NEWS DEC END-->
                        </li>
                        <li>
                            <!--NEWS DEC START-->
                            <div class="new-dec">
                                <span class="date">
                                    <b>03</b>FEB
                                </span>
                                <div class="text">
                                    <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium</p>
                                    <a href="#">26 Comments</a>
                                </div>
                            </div>
                            <!--NEWS DEC END-->
                        </li>
                    </ul>
                </div>
            </div>
            <!--WIDGET LATEST NEWS END-->
            <!--WIDGET CONTACT START-->
            <div class="col-md-4">
                <div class="widget contact-ft">
                    <!--WIDGET HEADING START-->
                    <div class="widget-hd">
                        <h3>Get In Touch</h3>
                    </div>
                    <!--WIDGET HEADING END-->
                    <ul>
                        <li>
                            <span>
                                Address: 
                            </span>
                            <div class="text">
                                <address>
                                    45, 3rd Floor, Loft Towers<br> Media City, Dubai, UAE
                                </address>
                            </div>
                        </li>
                        <li>
                            <span>
                                Phone: 
                            </span>
                            <div class="text">
                                <em>
                                    +971 4 5670980 - <small>Office</small>
                                </em>
                                <em>
                                    +971 5657860 - <small>Fax</small>
                                </em>
                            </div>
                        </li>
                        <li>
                            <span>
                                Email:
                            </span>
                            <div class="text">
                                <a href="#">support@sitename.com</a>
                                <a href="#">info@sitename.com</a>
                            </div>
                        </li>
                        <li>
                            <span>
                                Follow Us:
                            </span>
                            <div class="text">
                                <ul class="social-1">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                    <li><a href="#"><i class="fa fa-spotify"></i></a></li>
                                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!--WIDGET CONTACT END-->
        </div>
    </div>
</footer>
<!--FOOTER END-->
<div class="copy-right copy-right2">
    <div class="container">
        <p>© 2016 , Design by <a href="index.html">kode forest</a></p>
        <ul class="ft-nav">
            <li>
                <a href="#">home</a>
            </li>
            <li>
                <a href="#">About Us</a>
            </li>
            <li>
                <a href="#">Categories</a>
            </li>
            <li>
                <a href="#">Features</a>
            </li>
            <li>
                <a href="#">Blog</a>
            </li>
            <li>
                <a href="#">Shop</a>
            </li>
            <li>
                <a href="#">Contact Us</a>
            </li>
        </ul>
        <ul class="brand-icons">
            <li><a href="#"><i class="icon-visa-pay-logo"></i></a></li>
            <li><a href="#"><i class="icon-master-card-logo"></i></a></li>
            <li><a href="#"><i class=" icon-payoneer-logo"></i></a></li>
            <li><a href="#"><i class="icon-paypal-logo"></i></a></li>
            <li><a href="#"><i class="icon-skrill-pay-logo"></i></a></li>
        </ul>
    </div>
</div>
<!-- START GO UP -->
<div class="go-up">
    <a href="#" ><i class="fa fa-angle-up"></i></a>    
</div>
<!--END GO UP-->
</div>
<!--KF KODE WRAPPER WRAP END-->

<div class="modal fade" id="modal-add-cart">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Thêm vào giỏ hàng</h4>
            </div>
            <div class="modal-body">
             <div class="alert alert-default" id="alert-pro-name"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            <?php echo Html::a('Xem giỏ hàng',['/cart'],['class'=>'btn btn-primary']) ?>
        </div>
    </div>
</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
