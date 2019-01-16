<?php 
use yii\helpers\Html;
// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;

// var_dump($book);
// die;
?>
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>STT</th>
				<th>Mã sách</th>
				<th>Ảnh</th>
				<th>Tên sách</th>
				<th>Số lượt thích</th>
				<th>Trạng thái</th>
				<th><th>
			</tr>
		</thead>
		<tbody>
			<?php $n=1; foreach($book as $bk) : ?>
			<tr>
				<td><?php echo $n ?></td>
				<td><?php echo $bk->book_id ?></td>
				<td><img src="<?php echo $baseUrl.'/uploads/images/'.$bk->book->image ?>
				" alt="" width="50px"></td>
				<td><?php echo $bk->book->book_name?></td>
				<td><?php echo $bk->quantity ?></td>
				<td>
					<?php $status=$bk->book->status;
					if($status==2):
						?>
						<span class="label label-warning">Nổi bật</span>
						<?php elseif($status==1): ?>
							<span class="label label-success">Kích hoạt</span>
							<p>
								<?php echo Html::a('Làm Nổi Bật',['change-status','id'=>$bk->book_id,'status'=>2],['class'=>'label label-primary']) ?>
							</p>
							<?php elseif ($status==0) :?>
								<span class="label label-danger">Không kích hoạt</span>
						<?php endif;?>
					</td>
					<td><?php echo Html::a('Xem chi tiết',['book/view','id'=>$bk->book_id],['class'=>'label label-default']) ?></td>
				</tr>
				<?php $n++; endforeach; ?>
			</tbody>
		</table>
	</div>