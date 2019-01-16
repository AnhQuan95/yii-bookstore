<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title='Shopping cart';

?>


<div class="container">
	<BR>&nbsp;
	<h2 class="text-center">Giỏ hàng của bạn</h2>
	<BR>&nbsp;
	<?php //var_dump($cart_store) ?>
	<?php if($cart_store): $n =1; $book_price=0 ?>                                                    
		<div class="table-responsive text-center">          
			<table class="table">
				
				<thead>
					<tr>
						<th>STT</th>
						<th>Ảnh></th>
						<th>Sản phẩm</th>
						<th>Giá</th>
						<th>Số lượng</th>
						<th>Tổng tiền</th>
						<th></th>
						

					</tr>
				</thead>
				<tbody>
					<?php foreach($cart_store as $item): ?>

						<tr>

							<?php //$book_price= ($item->sale_price=!0) ? $item->sale_price : $item->price; ?>
								<?php //echo $item->sale_price;

								if($item->sale_price==0){
									$book_price=$item->price;
								}
								else{
									$book_price=$item->sale_price;
								} ?>
								<td><?php echo $n; ?></td>
								<td>
									<img src="<?php echo $item->image?>" alt="" height="100px" width="80">
								</td>
								<td><?php echo $item->book_name ?></td>
								<?php
								?>
								<td><?php echo number_format($book_price,0, '', '.');?> ₫</td>
								<td>

									<?php $form=ActiveForm::begin
									(
										[
											'action'=>Url::to(['/cart/update-cart']),
											'options'=>
											[
												'class'=>'form-inline pull-left',
											]

										]
									) 
									?>
									<input type="hidden" name="id" value="<?php echo $item->book_id?>"/>
									<input type="number" name="quantity_in_cart" value="<?php echo $item->quantity_in_cart ?>" min="0" max="10""/>
									<button type="submit" name="update" value="Cập nhật" class="btn btn-sm btn-success"/><i class="fa fa-refresh"></i></button>


									<?php $form=ActiveForm::end(); ?>
								</td>
								<td><?php echo number_format($item->quantity_in_cart * $book_price,0, '', '.')  ?> ₫</td>
								<td>
									<?php echo Html::a('<i class="glyphicon glyphicon-remove"></i>
										',['/cart/remove','id'=>$item->book_id],
										[
											'class'=>'btn btn-sm btn-danger',
											'data-confirm'=>'Bạn có chắc muỗn trả lại '.$item->book_name,
										] ) ?>


									</tr>
									<?php $n++; endforeach; ?>
									<tr>
										<td colspan="5" align="right">Tổng tiền </td>
										<td> <?php echo number_format($cost,0, '', '.')  ?> ₫</td>
									</tr>
								</tbody>

							</table>
							<div class="action clearfix text-right">
								<?php echo Html::a('Tiếp tục mua hàng',['/site'],['class'=>'btn btn-lg btn-success']) ?>
								<?php echo Html::a('Trả lại toàn bộ',['/cart/clear'],['class'=>'btn btn-lg btn-danger']) ?>
								<?php echo Html::a('Đặt hàng',['/checkout/index'],['class'=>'btn btn-lg btn-primary']) ?>
							</div>
							<BR>&nbsp;
						</div>

						<?php else : ?>
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Thông báo!</strong> Giỏ hàng đang rỗng. Mời bạn <?php echo Html::a('Mua hàng',['/site'],['class'=>'btn btn-lg btn-success']) ?>
							</div>


						<?php endif; ?>
					</div>
				</div>


				





				<div class="container">
					<?php if($cart_store): $n =1; $book_price=0 ?>
						<table id="cart" class="table table-hover table-condensed text-center">
							<thead>
								<tr>
									<th style="width:50%">Sản phẩm</th>
									<th style="width:10%">Giá</th>
									<th style="width:20%">Số lượng</th>
									<th style="width:22%" class="text-center">Tổng  tiền </th>
									<th style="width:10%"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($cart_store as $item): ?>

									<?php if($item->sale_price==0){
										$book_price=$item->price;
									}
									else{
										$book_price=$item->sale_price;
									} ?>

									<tr>
										<td data-th="Product">
											<div class="row">
												<div class="col-sm-2 hidden-xs"><img src="<?php echo $item->image?>" alt="..." class="img-responsive"/></div>
												<div class="col-sm-10">
													<h4 class="nomargin"><?php echo $item->book_name ?></h4>
													<p><?php echo $item->description ?></p>
												</div>
											</div>
										</td>
										<td data-th="Price"><?php echo number_format($book_price,0, '', '.');?> ₫</td>
										<td data-th="Quantity">
											<?php $form=ActiveForm::begin
											(
												[
													'action'=>Url::to(['/cart/update-cart']),
													'options'=>
													[

													]

												]
											) 
											?>
											<input type="hidden" name="id" value="<?php echo $item->book_id?>"/>
											<input type="number" name="quantity_in_cart" value="<?php echo $item->quantity_in_cart ?>" min="0" max="10""/>
											<button type="submit" name="update" value="" class="btn btn-sm btn-info submitBtn"/><i class="fa fa-refresh"></i></button>


											<?php $form=ActiveForm::end(); ?>



										</td>
									</td>
									<td data-th="Subtotal" class="text-center"><?php echo number_format($item->quantity_in_cart * $book_price,0, '', '.')  ?> ₫</td>
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
										'class'=>'btn btn-lg btn-danger'
									]) ?>

								</td>
								<td colspan="1" class="hidden-xs"></td>
								<td class="hidden-xs text-center"><strong>
								Tổng tiền : <?php echo number_format($cost,0, '', '.')  ?> ₫</strong></td>
								<td>

									<?php echo Html::a('<i class="fa fa-angle-right"></i> Đặt hàng',['/checkout/index'],['class'=>'btn btn-lg btn-primary']) ?>
								</td>
							</tr>
						</tfoot>
					</table>
					<?php else : ?>
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Thông báo!</strong> Giỏ hàng đang rỗng. Mời bạn <?php echo Html::a('Mua hàng',['/site'],['class'=>'btn btn-lg btn-success']) ?>
						</div>


					<?php endif; ?>
				</div>