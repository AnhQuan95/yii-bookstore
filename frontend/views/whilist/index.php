<?php
use yii\helpers\Html;


$this->title = 'Danh sách yêu thích';
// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;


?>
<?php if (Yii::$app->session->hasFlash('exist_whilist')): ?>
	<div class="alert alert-danger alert-dismissable">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		<?= Yii::$app->session->getFlash('exist_whilist') ?>
	</div>
<?php 	endif; ?>

	<?php if (Yii::$app->session->hasFlash('success_whilist')): ?>
		<div class="alert alert-success alert-dismissable">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			<?= Yii::$app->session->getFlash('success_whilist') ?>
		</div>
	<?php endif; ?>
	<?php if($model): ?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Ảnh</th>
					<th>Sách</th>
					<th>Giá</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ($model as $item) :?>


					<tr>
						<td>
							<img src="<?php echo $baseUrl.'/uploads/images/'.$item->book->image ?>" alt="" width="80px" height="80px">
						</td>
						<td>
								<?php 	echo Html::a($item->book->book_name,['book/view','id'=>$item->book_id]);
								?>
							</td>
						<td>
							<?php
							if($item->book->sale_price==0):   ?>

								<?php echo number_format($item->book->price,0, '', '.')?> ₫

								<?php  else :?>

									<del><?php echo number_format($item->book->price,0, '', '.')?> ₫</del>
									<?php echo number_format($item->book->sale_price,0, '', '.')?> ₫


								<?php endif; ?> 
							</td>
							<td>

								
								<?php echo Html::a('<i class="glyphicon glyphicon-remove"></i>
									',['/whilist/remove','id'=>$item->book->book_id],
									[
										'class'=>'btn btn-sm btn-danger',
										'data-confirm'=>'Bạn có chắc xóa '.$item->book->book_name.' khỏi danh sách yêu thích không ?',
									] ) ?>        
								</td>
							</tr>

						<?php endforeach; ?>
						<?php echo Html::a('<i class="fa fa-angle-left"></i> Tiếp tục mua hàng',['/book'],
							[
								'class'=>'btn btn-lg btn-success'
							]) ?>
						</tbody>
					</table>
					<?php else: ?>
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Thông báo !!</strong> Danh sách yêu thích trống.
						</div>
						<?php echo Html::a('<i class="fa fa-angle-left"></i> Tiếp tục mua hàng',['/site'],
							[
								'class'=>'btn btn-lg btn-success'
							]) ?>
						<?php endif; ?>


