
<?php 
use yii\helpers\Html;
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/frontend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;
// print_r($Book);
?>
<div class="container m-50">

	<?php if(isset($order_id)): ?>
		<div class="row">
			<div class="col-md-3">
				<img src="<?php echo $baseUrl.'/images/checkout.jpg'?>" alt="">
			</div>
			<div class="col-md-9">
				<h3>Cảm ơn bạn đã mua hàng tại AnhQuan BookStore!</h3>
				<p>Mã số đơn hàng của bạn :</p>
				<strong class="order_id"><?php echo $order_id ?></strong>
				<?php if(Yii::$app->user->isGuest):?> 
					<p>Hệ thống tự động tạo cho bạn tài khoản cho khách lần đầu mua. Bạn có thể đăng nhập và theo dõi tại  <strong>đơn hàng cá nhân</strong> </p>
					<p><strong>Email : <?php echo $model->email ?></strong></p>
					<p><strong>Password : <?php echo '123456' ?></strong></p>
					<p>
						Vui lòng đổi mật khẩu ngay khi đăng nhập lần đầu.
					</p>
					<?php else :?>
						<p>Bạn có thể xem tại 
							<?php 
							echo Html::a('đơn hàng cá nhân',
								['/order/view','id'=>$order_id],
								['style'=>'color:#46a146']
							)
							?></p>
						<?php endif; ?>

						<p>Thông tin chi tiết về đơn hàng đã được gửi tới địa chỉ mail : 
							<strong>
								<?php echo $model->email?>
							</strong> . Nếu không tìm thấy vui lòng kiểm tra trong hộp thư <strong>Spam</strong></p>
						</div>
					</div>
				<?php endif; ?>

			</div>