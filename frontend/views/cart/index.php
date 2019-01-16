<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\widgets\Alert;
$this->title='Shopping cart';

// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;

?>
<div class="kf_content_wrap">
	<div class="container m-50">

	<?php if (Yii::$app->session->hasFlash('out_of_stock')): ?>
		<div class="alert alert-danger alert-dismissable">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			<?= Yii::$app->session->getFlash('out_of_stock') ?>
		</div>

	<?php endif; ?>	
	<h2 class="text-center">Giỏ hàng của bạn</h2>
	<?php if($cart_store): $n =1; $book_price=0 ?>
		
		<!-- table -->
		<table id="cart" class="table table-hover table-condensed text-center table-borderless">
			
			<!-- thear -->
			<thead>
				<tr>
					<th style="width:40%">Sản phẩm</th>
					<th style="width:5%">Giá</th>
					<th style="width:20%">Số lượng</th>
					<th style="width:25%" class="text-center">Tổng tiền </th>
					<th style="width:10%"></th>
				</tr>
			</thead>
			<!-- thear -->

			<!-- tbody -->
			<tbody>
				<?php foreach($cart_store as $item): ?>

					<?php if($item->sale_price==0){
						$book_price=$item->price;
					}
					else{
						$book_price=$item->sale_price;
					} ?>

					<tr>
						<td data-th="Sản phẩm">
							<div class="row">
								<div class="col-sm-2 hidden-xs"><img src="<?php echo $baseUrl.'/uploads/images/'.$item->image?>" alt="..." class="img-responsive"/></div>
								<div class="col-sm-10">
									<h4 class="nomargin"><?php echo $item->book_name ?></h4>

								</div>
							</div>
						</td>
						<td data-th="Giá">
							<?php
							if($item->sale_price==0):   ?>

								<?php echo number_format($item->price,0, '', '.')?> ₫

								<?php  else :?>

									<del><?php echo number_format($item->price,0, '', '.')?> ₫</del>
									<?php echo number_format($item->sale_price,0, '', '.')?> ₫


								<?php endif; ?> 


							</td>

							<td data-th="Số lượng">
								<?php $form=ActiveForm::begin
								(
									[
										'id'=>'form-update-cart',
										'action'=>Url::to(['/cart/update-cart']),
										'options'=>
										[
											'data-name'=>$item->book_name
										]

									]
								) 
								?>
								<input type="hidden" name="id" value="<?php echo $item->book_id?>"/>

								
								<input class="input-group-field" type="tel" id="quantity" name="quantity" value="<?php echo $item->quantity_in_cart?>" >
								
								<button type="submit" name="update" value="" class="btn btn-sm btn-info updateBtn"/><i class="fa fa-refresh"></i></button>


								<?php $form=ActiveForm::end(); ?>



							</td>
						</td>
						<td data-th="Tổng tiền" class="text-center"><?php echo number_format($item->quantity_in_cart * $book_price,0, '', '.')  ?> ₫</td>
						<td class="actions" data-th="">
							<?php echo Html::a('<i class="glyphicon glyphicon-remove"></i>
								',['/cart/remove','id'=>$item->book_id],
								[
									'class'=>'btn btn-sm btn-danger',
									'data-confirm'=>'Bạn có chắc muốn trả lại '.$item->book_name,
								] ) ?>

							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>

				<!-- tbody -->

				<!-- tfoot -->
				<tfoot>
					<tr>
						<td>
							<?php echo Html::a('<i class="fa fa-angle-left"></i> Tiếp tục mua hàng',['/site'],
								[
									'class'=>'btn btn-lg btn-success'
								]) ?>
							</td>
							<td>
								<?php echo Html::a('<i class="fa fa-angle"></i> Trả lại toàn bộ',['/cart/clear'],
									[
										'class'=>'btn btn-lg btn-danger',
										'data-confirm'=>'Bạn có chắc muốn trả lại toàn bộ sản phẩm không ?'
									]) ?>

								</td>
								<td colspan="1" class="hidden-xs"></td>
								<td class=" text-center"><strong>
									Tổng tiền : <?php echo number_format($cost,0, '', '.')  ?> ₫</strong></td>
									<td>

										<?php echo Html::a('Thanh toán <i class="fa fa-angle-right"></i> ',['/checkout/index'],['class'=>'btn btn-lg btn-primary']) ?>
									</td>
								</tr>
							</tfoot>
							<!-- tfoot -->

						</table>
						<!-- table -->

						<?php else : ?>
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Thông báo!</strong> Giỏ hàng đang rỗng. Mời bạn <?php echo Html::a('Mua hàng',['/site'],['class'=>'btn btn-lg btn-success']) ?>
							</div>


							<?php endif; ?>
						</div>
						</div>
