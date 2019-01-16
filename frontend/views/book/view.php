<?php 
use backend\models\Author;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\captcha\Captcha;
date_default_timezone_set('Asia/Ho_Chi_Minh');

// echo Yii::$app->controller->route;
$this->title=($model)?$model->book_name:"Not found";

$baseUrl=Yii::$app->urlManager->baseUrl;

//echo Yii::$app->urlManager->baseUrl;
//echo $baseUrl;


// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl2=$host.$homeUrl;
// print_r($Book);

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
				<li class="active">Chi tiết sách</li>
			</ol>
		</div>
		<div class="thumb">
			<img src="<?php echo $baseUrl ?>/images/inner-banner1.png" alt="">
		</div>
	</div>
</div>

<div class="kf_content_wrap">

	<div class="product-detail1">
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="book-view book-view2">
							<div class="row">
								<div class="col-md-7">
									<!--BOOK VIEW THUMB START-->
									<div class="thumb">
										<div class="thumb-slider">

											<li>
												<img src="<?php echo $baseUrl.'/uploads/images/'.$model->image?>" alt="" />
											</li>
											<?php if($model->sale_price > 0): ?>
												<div class="ribbon-wrap">
													<span class="ribbon">Sale</span>
												</div>
											<?php endif; ?>
										</div>
									</div>
									<!--BOOK VIEW THUMB END-->
								</div>

								<div class="col-md-5">
									<!--BOOK TEXT START-->
									<div class="book-text">
										<!--BOOK HEADING START-->
										<div class="book-heading book-padding">
											<span><?php echo $model->cate->cate_name ?></span>
											<br/>
											<span><?php echo $model->age->name_of_age ?></span>
											<h3><?php echo $model->book_name ?></h3>

										</div>
										<!--BOOK HEADING END-->
										<!--BOOK DESCRIPTION START-->
										<div class="book-description book-padding">
											<span>Mô tả ngắn</span>
											<p><?php echo $model->description ?></p>
										</div>
										<!--BOOK DESCRIPTION END-->

										<!--BOOK FILLTER START-->
										<div class="book-fillter book-padding">
											<div class="row">
												<div class="col-md-4">
													Trang : <?php echo $model->pages ?>
												</div>
												<div class="col-md-8">
													Kích Thước : <?php echo $model->size ?>
												</div>
											</div>
										</div>
										<!--BOOK FILLTER END-->

										<!--BOOK FILLTER START-->
										<div class="book-fillter book-padding">
											<div class="row">

												<div class="col-md-12">
													Tác giả :
													<?php 
													$authors=Author::findAll($model->author_ids);
													$author_names='';
													foreach ($authors as $item) {
														$author_names.=$item->author_name.' - ';
													}
													echo substr($author_names, 0, -3);
													?>
												</div>
											</div>
										</div>
										<!--BOOK FILLTER END-->

										<!--BOOK FILLTER START-->
										<div class="book-fillter book-padding">
											<div class="row">
												<div class="col-md-6">P.hành :
													<?php echo date('d-m-Y',strtotime($model->publish_at))?>
												</div>

												<div class="col-md-6">
													<?php echo $model->publisher->publisher_name ?>
												</div>

												
											</div>
										</div>
										<!--BOOK FILLTER END-->

										<!--BOOK PRICE START-->
										<div class="book-price book-padding">
											<span class="price-tag red">
												<?php  if($model->sale_price!=0) :
													$discount_rate=($model->price-$model->sale_price)*100/$model->price;

													?>

													<sub> <?php echo number_format($model->sale_price,0, '', '.')?> ₫</sub>
													<del> <?php echo number_format($model->price,0, '', '.')?> ₫</del> 
													<strong class="discount_rate"> 
														- <?php echo round($discount_rate) ?> % 
													</strong>
													<?php  ?>

													<?php else :?>
														<sub> <?php echo number_format($model->price,0, '', '.')?> ₫</sub> 
													<?php endif; ?>
												</span>
												<br>
												<strong> CÒN : <?php echo $model->quantity ?> QUYỂN </strong>
											</div>
											<!--BOOK PRICE END-->

											<?php if($model->quantity>0): ?>
												<!--BOOK QUANTITY START-->
												<div class="book-quantity book-padding">

													<div class="input-stepper">

														<?php $form=ActiveForm::begin

														(
															[
																'id'=>'cart-form',
																'action'=>Url::to(['/cart/add-cart','id'=>$model->book_id]),
																'options'=>
																[

																	'data-name'=>$model->book_name,
																	'data-quantity'=>$model->quantity
																]

															]
														) 
														?>

														<button type="button" class="button hollow circle" data-quantity="minus" data-field="quantity">
															<i class="fa fa-minus" aria-hidden="true"></i>
														</button>
														<input class="input-group-field" type="tel" id="quantity" name="quantity" value="1" >
														<button type="button" class="button hollow circle" data-quantity="plus" data-field="quantity">
															<i class="fa fa-plus" aria-hidden="true"></i>
														</button>


													</div>
													<button type="submit" name="add" id="btnSubmit"value="" class="cart-3 add-cart submitBtn2"><i class="icon-shopping-cart"></i>mua</button>
													<?php $form=ActiveForm::end(); ?>


												</div>
												<!--BOOK QUANTITY END-->
												<?php else: ?>
													<strong class="message_out_stock">
														Sản phẩm đã hết hàng
													</strong>
												<?php endif; ?>

												<?php if(!Yii::$app->user->isGuest): ?>
													<!--BOOK WISHLIST 2 START-->
													<?php $customer_id=Yii::$app->user->identity->id ?>
													<?php if($whilist): ?>
														<?php $form = ActiveForm::begin(
															[
																'id' => 'form-whilist',
																'action'=>Yii::$app->urlManager->baseUrl.'/whilist/add-whilist',
																'options'=>
																[
																	'data-name'=>$model->book_name
																]
															]); ?>
															<?= $form->field($whilist, 'book_id')->hiddenInput(['value'=>$model->book_id])->label(false) ?>

															<?= $form->field($whilist, 'customer_id')->hiddenInput(['value'=>$customer_id])->label(false) ?>
  														<?php //Check nút thêm vào danh sách .
                                                        if($bookInList==0): ?>
                                                            <?= Html::submitButton('<i class="fa fa-heart"></i> Thêm vào danh sách yêu thích', ['class' => 'like-icon']) ?>
                                                            <?php else: ?>
                                                               <?= Html::submitButton('<i class="fa fa-heart"></i> Sản phẩm đã được bạn yêu thích', ['class' => 'liked-icon']) ?>
                                                           <?php endif; ?>

															<?php ActiveForm::end(); ?>
														<?php endif; ?>

														<!--BOOK WISHLIST 2 END-->
													<?php endif; ?>
												</div>
												<!--BOOK TEXT END-->
											</div>
										</div>
									</div>
									<!--BOOK VIEW WRAP END-->
								</div>
								<aside class="col-md-3">

									<!--WIDGET FEATURESD START-->
									<div class="widget widget-featured">
										<!--WIDGET HEADING START-->
										<div class="aside-widget-hd">
											<h5>Sách nổi bật</h5>
										</div>
										<!--WIDGET HEADING END-->
										<div class="widget-padding">
											<?php if($hot_books): ?>
												<?php foreach($hot_books as $item): ?>
													<!--FEATURED 3 START-->
													<div class="featured-dec3">
														<figure>
															<img src="<?php echo $baseUrl.'/uploads/images/'.$item->image?>" alt=""/>
														</figure>
														<div class="text">
															<small>
																<?php echo Html::a($item->book_name,['book/view','id'=>$item->book_id]); ?>
															</small>
															<span class="price-tag black">
																<?php  if($item->sale_price!=0):

																	$discount_rate=($item->price-$item->sale_price)*100/$item->price;

																	?>

																	<sub>   <?php echo number_format($item->sale_price,0, '', '.')?> ₫</sub> 
																	<del><?php echo number_format($item->price,0, '', '.')?> ₫</del> 
																	<strong class="discount_rate"> 
																		- <?php echo round($discount_rate) ?> % 
																	</strong>
																	<?php else :?>               
																		<sub><?php echo number_format($item->price,0, '', '.')?> ₫</sub>
																	<?php endif; ?>
																</span>
															</div>
														</div>
														<!--FEATURED 3 END-->
													<?php endforeach; ?>
												</div>
											</div>
											<!--WIDGET FEATURESD END-->
										</aside>
									</div>
									<!--BOOK TABS 2 WRAP START-->
								<?php endif; ?>

								<div class="book-tabs2">
									<ul class="nav nav-tabs books-tab" role="tablist">
										<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Mô tả</a></li>
										<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Bình luận (<?php echo count($comments); ?>)</a></li>
										<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Vận chuyển và Trả hàng</a></li>
									</ul>
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="home">
											<!--BOOK RETURN WRAP START-->
											<div class="book-return">
												<h5>Nội dung sách</h5>
												<p><?php echo $model->content ?></p>
												<div class="row">
													<div class="col-md-12"></div>
												</div>

											</div>
											<!--BOOK RETURN WRAP END-->
										</div>
										<div role="tabpanel" class="tab-pane fade" id="profile">
											<!--COMMENTING WRAP START-->
											<div class="commenting-wrap-1 cutomer-reviews">
												<!--HEADING 1 START-->
												<h3>Phản hồi khách hàng</h3>
												<!--HEADING 1 END-->
												<ul>
													<li>

														<?php if($comments): ?>
															<?php foreach($comments as $item) : ?>
																<!--COMMENTING DEC START-->
																<div class="commenting-dec">
																	<figure><img src="<?php echo $baseUrl ?>/extra-images/avatar.png" alt=""></figure>
																	<div class="text">
																		<div class="commenting-hd">
																			<strong><a href="#"><?php echo $item->customer->full_name ?></a></strong>
																			<div class="cutomer-rating">

																				<p>Bình luận vào ngày <?php echo date("d-m-Y H:i:s",$item->cmt_date) ?></p>
																			</div>

																		</div>

																		<p><?php echo $item->content ?></p>
																	</div>
																</div>
																<!--COMMENTING DEC END-->
															<?php endforeach; ?>
														<?php endif; ?>
													</li>



												</ul>
											</div>
											<!--COMMENTING WRAP END-->
											<!--CONTACT US WRAP START-->
											<div class="contact-wrap cutomer-reviews">
												<!--HEADING 1 START-->
												<h3>Bình luận sản phẩm </h3>
												
												<?php if (Yii::$app->session->hasFlash('comment')): ?>
													<div class="alert alert-success alert-dismissable">
														<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
														<?= Yii::$app->session->getFlash('comment') ?>
													</div>
												<?php endif; ?>


												<?php if(!Yii::$app->user->isGuest): ?>
													<?php $customer_id=Yii::$app->user->identity->id ?>
													<!--HEADING 1 END-->

													<?php $form = ActiveForm::begin(
														[
															'id' => 'commnent-form',
															'action'=>Yii::$app->urlManager->baseUrl.'/comment/add-comment',

														]); ?>		
														<div class="row">
															<div class="col-md-12">
																<div class="input-dec3 before-adj">

																	<?= $form->field($comment, 'book_id')->hiddenInput(['value'=>$model->book_id])->label(false) ?>

																	<?= $form->field($comment, 'customer_id')->hiddenInput(['value'=>$customer_id])->label(false) ?>

																	<?= $form->field($comment, 'content')->textarea(['placeholder'=>'Để lại bình luận tại đây'])->label(false) ?>

																	<?= $form->field($comment, 'verifyCode')->widget(Captcha::className(), [
																		'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
																	]) ?>





																</div>
															</div>
														</div>
														<?= Html::submitButton('Bình luận', ['class' => 'btn-2']) ?>
														<?php ActiveForm::end(); ?>

													<?php endif; ?>





												</div>
												<!--CONTACT US WRAP END-->

											</div>
											<div role="tabpanel" class="tab-pane fade" id="messages">
												<!--BOOK RETURN WRAP START-->
												<div class="book-return">
													<h5>CHÍNH SÁCH HOÀN TRẢ - BẢO HÀNH (NẾU CÓ)</h5>
													<p> Đối với khách hàng ở nội thành Hà Nội:

														Với những Đơn hàng giao không đúng với Đơn đặt hàng, khách hàng có thể từ chối không nhận và không phải trả bất kỳ khoản phí nào. 
														Với những Đơn hàng giao đúng với Đơn đặt hàng nhưng bị lỗi kỹ thuật (nhảy trang, trang trắng, CD kèm sách không đọc được), khách hàng có thể mang sản phẩm bị lỗi đến Nhà sách Anh Quân để đổi lại và không phải trả bất kỳ khoản phí nào. 
														Đối với những sản phẩm có phiếu Bảo hành kèm theo (điện tử, kim khí điện máy…), vui lòng liên hệ địa chỉ bảo hành chính hãng in trên phiếu Bảo hành. 
													</p>
													<p>	Đối với khách hàng ở ngoại thành Hà Nội, / Tỉnh / Nước ngoài:

														Với những Đơn hàng gửi không đúng với Đơn đặt hàng, quý khách gửi trả lại cho Anh Quân. Anh Quân sẽ gửi lại các sản phẩm mà quý khách đã đặt và hoàn trả cước phí bưu điện cho quý khách. Sau khi Anh Quân nhận được sản phẩm gửi trả của quý khách, khoảng 5 – 7 ngày sau quý khách sẽ nhận được sản phẩm theo đúng Đơn đặt hàng và cước phí Anh Quân hoàn trả. 
														Với những Đơn hàng gửi đúng theo Đơn đặt hàng nhưng bị lỗi kỹ thuật (nhảy trang, trang trắng, CD kèm sách không đọc được), khách hàng gửi trả sản phẩm bị lỗi cho Anh Quân. Anh Quân sẽ gửi lại sản phẩm khác và hoàn trả cước phí Bưu điện cho Quý khách. Sau khi Anh Quân nhận được sản phẩm bị lỗi, khoảng 5 – 7 ngày sau Quý khách sẽ nhận được sản phẩm mới và cước phí Anh Quân hoàn trả. 
													Đối với những sản phẩm có phiếu Bảo hành kèm theo (điện tử, kim khí điện máy…), vui lòng liên hệ địa chỉ bảo hành chính hãng in trên phiếu Bảo hành. </p>
													<div class="row">

													</div>
												</div>
												<!--BOOK RETURN WRAP END-->
											</div>
										</div>
									</div>
									<!--BOOK TABS 2 WRAP END-->
								</div>
							</div>
							<section>
								<div class="container">
									<div class="heading-inner">
										<h2>Sách cùng tác giả</h2>

									</div>
									<?php if($book_with_author): ?>
										<!--BOOK RELATED START-->
										<div class="tabs-slider-wrap tabs-slider-wrap6">
											<div class="owl-carousel owl-theme" id="tabs-slider7">
												<?php foreach($book_with_author as $item): ?>
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
																	<?php  if($item->sale_price!=0):

																		$discount_rate=($item->price-$item->sale_price)*100/$item->price;

																		?>

																		<sub>   <?php echo number_format($item->sale_price,0, '', '.')?> ₫</sub> 
																		<del><?php echo number_format($item->price,0, '', '.')?> ₫</del> 
																		<strong class="discount_rate"> 
																			- <?php echo round($discount_rate) ?> % 
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
																		</div>
																	</div>
																</div>
																<!--BOOK DEC END-->
															<?php endforeach; ?>
														</div>
													</div>
													<!--BOOK RELATED END-->
												<?php endif; ?>
											</div>
										</section>
									</div>

								</div>



