<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Đơn hàng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-responsive">
  <div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
      'attribute'=>'order_id',
      'headerOptions'=>
      [
        'style'=>'width:25px;text-align:center'
      ],
      'contentOptions'=>
      [ 
       'style'=>'width:25px;text-align:center'
     ]

   ],
   [
    'attribute'=>'created_at',
    'filter'=>FALSE,
    'headerOptions'=>
    [
      'style'=>'width:150px;text-align:center'
    ],
    'contentOptions'=>
    [ 
     'style'=>'width:150px;text-align:center'
   ],
   'format'=>['datetime','dd-MM-yyyy H:i:s']

 ],
 [
  'attribute'=>'customer_id',
  'headerOptions'=>
  [
    'style'=>'width:25px;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:25px;text-align:center'
 ],
 'value'=>'customer.email'

],
[
  'attribute'=>'total_cost',
  'filter'=>FALSE,
  'headerOptions'=>
  [
    'style'=>'width:25px;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:25px;text-align:center'
 ], 
 'format'=>['decimal',0]

],

[
  'attribute'=>'status',
  'filter'=>
  [
   0=>'Chưa duyệt',
   1=>'Đã duyệt',
   2=>'Đã giao hàng',
   3=>'Đã hủy'

 ],

 'headerOptions'=>
 [
  'style'=>'width:80px;text-align:center'
],
'contentOptions'=>
[ 
 'style'=>'width:80px;text-align:center'
],
'content'=>function($model)
{
  if($model->status==0)
  {
    return '<span class="label label-danger">Chưa duyệt</span>';
  }
  elseif($model->status==1)
  {
    return '<span class="label label-success">Đã duyệt</span>';
  }
  elseif($model->status==2)
  {
    return '<span class="label label-primary">Đã giao hàng</span>';
  }
  else{
    return '<span class="label label-default">Đã hủy</span>';
  }
}
],

['class' => 'yii\grid\ActionColumn',
'template' =>'{view}{delete}',
'headerOptions'=>[
  'style'=>'width:100px;text-align:center'
],
'contentOptions'=>
[ 
 'style'=>'width:80px;text-align:center'
],
'buttons'=>[
  'view'=>function($url,$model){
                    // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',['order-detail/view','order_id'=>'OD-001'],['class'=>'btn btn-xs btn-primary']);
    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',$url,['class'=>'btn btn-xs btn-primary']);
  },

  // 'update'=>function($url,$model){
  //   return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['class'=>'btn btn-xs btn-success']);
  // },
  'delete'=>function($url,$model){
    return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
      'class'=>'btn btn-xs btn-danger',
      'data-confirm'=>'Bạn có chắc muỗn xóa '.$model->order_id,
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