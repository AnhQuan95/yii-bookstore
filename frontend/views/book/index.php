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
	<div class="col-md-9">

		<?php if($books) : ?>

			<div class="blog-grid3">
				<div class="row">
					<?php foreach($books as $item):?>
						<!--BOOK DEC START-->
						<div class="col-md-4 col-sm-6 pro-item">
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