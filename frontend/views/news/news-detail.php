
<?php 
use yii\helpers\Html; 
$baseUrl=Yii::$app->urlManager->baseUrl;

//echo Yii::$app->urlManager->baseUrl;
//echo $baseUrl;


// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl2=$host.$homeUrl;
// print_r($Book);?>
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
				s="active">Tin tức</li>
			</ol>
		</div>
		<div class="thumb">
			<img src="<?php echo $baseUrl ?>/images/inner-banner1.png" alt="">
		</div>
	</div>
</div>

<div class="kf_content_wrap">
	<div class="blog-detail-page">
		<div class="section">
			<div class="container">
				<?php if($model): ?>
					<div class="row">
						<div class="col-md-9">
							<!--BLOG DETAIL WRAP START-->
							<div class="blog-detail-wrap">
								<!--BOLG CLASSIC DEC START-->
								<div class="blog-classic-dec blog-detail-dec">
									<div class="bxclassic-blog">
										<ul class="bxslider">
											<li>
												<img src="<?php echo $baseUrl.'/uploads/images/'.$model->image?>" alt="" width= 845 height=483/>
											</li>
											<li>
												<img src="<?php echo $baseUrl.'/uploads/images/'.$model->image?>" alt="" width= 845 height=483/>
											</li>
										</ul>
									</div>
									<div class="text">
										<ul class="blog-meta">
											
											<li><?php echo date("d-m-Y",($model->created_at)) ?></li>
										
										</ul>
										<h2>
													<?php echo Html::a($model->description,['/news','id'=>$model->news_title]) ?>
												
											</h2>
										<p>
											<?php echo $model->content ?>
										</p>
									
									</div>
								</div>
								<!--BOLG CLASSIC DEC END-->
							
							</div>
							<!--BLOG DETAIL WRAP END-->


						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!--ERROR WRAP END-->
</div>


