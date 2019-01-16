	<?php 
	use backend\models\Category;
	use backend\models\SuitableAge;
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use yii\widgets\LinkPager;
	// http://localhost/
	$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
	$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
	$baseUrl=$host.$homeUrl;
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
					<li clas
					s="active">Danh mục sách</li>
				</ol>
			</div>
			<div class="thumb">
				<img src="<?php echo $baseUrl ?>/images/inner-banner1.png" alt="">
			</div>
		</div>
	</div>

	<div class="kf_content_wrap">

		<!--GRID 4 WRAP START-->
		<div class="grid-4">
			<div class="grid3-page">
				<div class="container">
					<div class="row">
												<!--ASIDE BAR WRAP START-->
						<aside class="col-md-3">

							<!--WIDGET CATEGORIES WRAP START-->
							<div class="widget widget-categories">
								<!--WIDGET HEADING START-->
								<div class="aside-widget-hd">
									<h5>Danh mục sách</h5>
								</div>
								<!--WIDGET HEADING END-->
								<div class="widget-padding">
									<?php if($category): ?>
										<?php foreach($category as $category) : ?>
											<?php 
											$dataSub=new Category();
											$dataSub=$dataSub->getCategoryBy($category->cate_id);
											?>
											<!--WIDGET ACCORDIAN START-->
											<div class="side_accordian">
												<?php if($dataSub):?>
													<div class="accordion" id="<?php echo $category->cate_id ?>">
														<span><?php echo $category->cate_name ?></span>
													</div>
													<?php else: ?>
														<div >
															<span><?php echo $category->cate_name ?></span>
														</div>
													<?php endif; ?>
													<?php if($dataSub):?>
														<div class="accordion-content">
															<?php foreach($dataSub as $valueSub): ?>
																<ul class="side-meta">
																	<li>
																		<?php echo Html::a($valueSub->cate_name,['/book/list-by-category','id'=>$valueSub->cate_id]) ?>
																	</li>
																</ul>
															<?php endforeach; ?>
														</div>
													<?php endif; ?>

												</div>
												<!--WIDGET ACCORDIAN END-->
											<?php endforeach; ?>
										<?php endif; ?>
									</div>
								</div>
								<!--WIDGET CATEGORIES WRAP END-->

								<!--WIDGET CATEGORIES WRAP START-->
								<div class="widget widget-categories">
									<!--WIDGET HEADING START-->
									<div class="aside-widget-hd">
										<h5>Sách theo độ tuổi</h5>
									</div>
									<!--WIDGET HEADING END-->
									<div class="widget-padding">
										<?php if($age): ?>
											<?php foreach($age as $age) : ?>
												<!--WIDGET ACCORDIAN START-->
												<div class="side_accordian">
													<div >
														<span>
															<?php echo Html::a($age->name_of_age,['/book/list-by-age','id'=>$age->id],['class'=>'age']) ?>
														</span>
													</div>

												</div>
												<!--WIDGET ACCORDIAN END-->
											<?php endforeach; ?>
										<?php endif; ?>

									</div>
								</div>
								<!--WIDGET CATEGORIES WRAP END-->

								<!--WIDGET RANGE SLIDER START-->
								<div class="side-fillter">
									<!--WIDGET HEADING START-->
									<div class="aside-widget-hd">
										<h5>Tìm kiếm theo giá</h5>
									</div>
									<!--WIDGET HEADING END-->
									<!--WIDGET RANGE SLIDER START-->
									<div class="widget-padding">
										<div class="slider-range"></div>
										<div class="rangsldr-meta">
											<span>Giá:</span>
											<input type="text" class="amount" readonly>
											<a href="#" class="add-cart">Tìm</a>
										</div>
									</div>
									<!--WIDGET RANGE SLIDER END-->
								</div>
								<!--WIDGET RANGE SLIDER END-->
								<div class="widget widget-ad">
									<div class="text">
										<h2>Bộ sưu tập <span>Mới</span></h2>
										<div class="clear"></div>
										<p>Giảm giá đến 50%</p>
									</div>
								</div>
							</aside>
							<!--ASIDE BAR WRAP END-->
						<div class="col-md-9">
							
							<?php if($books) : ?>

								<div class="blog-grid3">
									<div class="row">
										<?php foreach($books as $item):?>
											<!--BOOK DEC START-->
											<div class="col-md-4 col-sm-6">
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
														<h5> <?php echo Html::a($item->book_name,['book/view','id'=>$item->book_id]) ?></h5>

														<span class="price-tag red">
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
									<?php endif; ?>
								</div>
								<!--KODDE PAGINATION START-->
								<div class="col-md-12">
									<!--  -->
									<div class="kf-pagination">
										<?php echo LinkPager::widget
										(
											['pagination'=>$pages,
											'firstPageLabel' => '|<',
											'lastPageLabel' => '>|',
											'prevPageLabel' => '<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>',
											'nextPageLabel' => '<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>',
											'maxButtonCount'=>3
										]

									) ?>
								</div>
							</div>

							<!--KODDE PAGINATION END-->
						</div>
					</div>
				</div>
			</div>
			<!--GRID 4 WRAP END-->
		</div>