<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;
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
              <li class="active">Liên hệ</li>
          </ol>
      </div>
      <div class="thumb">
        <img src="<?php echo $baseUrl ?>/images/inner-banner1.png" alt="">
    </div>
</div>
</div>

<div class="kf_content_wrap">
    <section class="contact_outerwrap">
        <div class="container">
            <div class="row">

                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?= Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>
                    <div class="col-md-4">
                        <div class="widget contact-ft">
                            <!--WIDGET HEADING START-->
                            <div class="widget-hd">
                                <h3>Thông tin liên hệ</h3>
                            </div>
                            <!--WIDGET HEADING END-->
                            <ul>
                                <li>
                                    <span>
                                        Địa chỉ: 
                                    </span>
                                    <div class="text">
                                        <address>
                                            83 ngõ 295 Bạch Mai<br> Hà Nội
                                        </address>
                                    </div>
                                </li>
                                <li>
                                    <span>
                                        Phone: 
                                    </span>
                                    <div class="text">
                                        <em>
                                            09.68.68.41.86 - <small>Office</small>
                                        </em>
                                        <em>
                                           09.68.68.41.86 - <small>Fax</small>
                                       </em>
                                   </div>
                               </li>
                               <li>
                                <span>
                                    Email:
                                </span>
                                <div class="text">
                                    <a href="#">anhquan.bookstore@gmail.com</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <!--WIDGET HEADING START-->
                    <div class="widget-hd">
                        <h3>Liên hệ</h3>
                    </div>
                    <!--WIDGET HEADING END-->
                    <!--CINTACT WRAP START-->
                    <div class="contact-wrap">
                     <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                     <div class="col-md-6 col-sm-6">
                        <div class="input-dec3">
                           <?= $form->field($model, 'name')->textInput(['autofocus' => true,'placeholder'=>'Tên'])->label(FALSE) ?>

                           <i class="fa fa-user"></i>
                       </div>
                   </div>
                   <div class="col-md-6 col-sm-6">
                    <div class="input-dec3">
                     <?= $form->field($model, 'email')->textInput(['placeholder' => "Email"])->label(FALSE) ?>

                     <i class="fa fa-envelope-o" aria-hidden="true"></i>
                 </div>
             </div>
             <div class="col-md-12 col-sm-12">
                <div class="input-dec3">
                 <?= $form->field($model, 'subject')->textInput(['placeholder' => "Tiêu đề"])->label(FALSE) ?>
                 <i class="fa fa-pencil " aria-hidden="true"></i>
             </div>
         </div>
         <div class="col-md-12">
            <div class="input-dec3 before-adj">

              <?= $form->field($model, 'body')->textarea(['rows' => 6,'placeholder'=>'Nội dung'])->label(FALSE) ?>
              <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
          </div>
      </div>
  </div>
  <div class="form-group">
    <?= Html::submitButton('Gửi', ['class' => 'btn-2', 'name' => 'contact-button']) ?>
</div>


<?php ActiveForm::end(); ?>

<!--CINTACT WRAP END-->
</div>
</div>
</div>
</section>