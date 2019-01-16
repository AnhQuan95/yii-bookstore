
<?php use yii\helpers\Html; ?>
<ul>
	<li>
		<?php 
		echo Html::a('Thông tin  cá nhân',
			['/customer/view']
		)
		?>
	</li>
	<li>
		<?php 
		echo Html::a('Đơn hàng cá nhân',
			['/order']
		)
		?>
		
	</li>
	<li>  <?php 
	echo Html::a('Sản phẩm yêu thích',
		['/whilist'])
		?>
		
	</li>
</ul>