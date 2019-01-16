<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Author;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Book_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sách';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-responsive">
  <div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
      <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
        [
          'class' => 'yii\grid\SerialColumn',
          'header'=>'STT', 
          'headerOptions'=>
          [
            'style'=>'width:15px;text-align:center'
          ],
          'contentOptions'=>
          [ 
           'style'=>'width:15px;text-align:center'
         ]
       ],

    [
      'attribute'=>'book_name',
      'headerOptions'=>
      [
        'style'=>'width:200;text-align:center'
      ],
      'contentOptions'=>
      [ 
       'style'=>'width:200px;text-align:center'
     ]

   ],

   [
    'attribute'=> 'publisher_id',
    'headerOptions'=>
    [
      'style'=>'width:200;text-align:center'
    ],
    'contentOptions'=>
    [ 
     'style'=>'width:200px;text-align:center'
   ],
   'value'=>'publisher.publisher_name'
 ],

 [
  'attribute'=> 'cate_id',
  'headerOptions'=>
  [
    'style'=>'width:200;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:200px;text-align:center'
 ],
 'value'=>'cate.cate_name'
],
[
  'attribute'=> 'price',
  'headerOptions'=>
  [
    'style'=>'width:20;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:20px;text-align:center'
 ],
 'format'=>['decimal',0]
],
[
  'attribute'=> 'sale_price',
  'headerOptions'=>
  [
    'style'=>'width:20;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:20px;text-align:center'
 ],
 'format'=>['decimal',0]
],
[
  'attribute'=>'quantity',
  'headerOptions'=>
  [
    'style'=>'width:10;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:10px;text-align:center'
 ]

],

[
  'attribute'=>'status',
  'filter'=>
  [ 
    0=>'Không kích hoạt',
    1=>'Kích hoạt',
    2=>'Nổi bật'

  ],

  'headerOptions'=>
  [
    'style'=>'width:10px;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:10px;text-align:center'
 ],
 'content'=>function($model)
 {
  if($model->status==0)
  {
    return '<span class="label label-danger">Không kích hoạt</span>';
  }
  else if($model->status==2){
   return '<span class="label label-warning">Nổi bật</span>';
 }
 else
 {
  return '<span class="label label-success">Kích hoạt</span>';
}
}
],


['class' => 'yii\grid\ActionColumn',
'headerOptions'=>[
  'style'=>'width:100px;text-align:center'
],
'contentOptions'=>
[ 
 'style'=>'width:10px;text-align:center'
],
'buttons'=>[
  'view'=>function($url,$model){
    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',$url,['class'=>'btn btn-xs btn-primary']);
  },

  'update'=>function($url,$model){
    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['class'=>'btn btn-xs btn-success']);
  },
  'delete'=>function($url,$model){
    return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
      'class'=>'btn btn-xs btn-danger',
      'data-confirm'=>'Bạn có chắc muỗn xóa '.$model->book_name,
      'data-method'=>'post'

    ]
  );
  }
]

],
],
]); ?>
<?php Pjax::end(); ?>

</div>
</div>