<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bình luận';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="table-responsive">
  <div class="comment-index">

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
      'attribute'=>'book_id',
      'headerOptions'=>
      [
        'style'=>'width:200px;text-align:center'
      ],
      'contentOptions'=>
      [ 
       'style'=>'width:200px;text-align:center'
     ],
     'value'=>'book.book_name'

   ],
   [
    'attribute'=>'customer_id',
    'headerOptions'=>
    [
      'style'=>'width:200px;text-align:center'
    ],
    'contentOptions'=>
    [ 
     'style'=>'width:200px;text-align:center'
   ],
    'value'=>'customer.email'
],

[
  'attribute'=>'status',
  'filter'=>
  [
    1=>'Kích hoạt',
    0=>'Không kích hoạt'
  ],

  'headerOptions'=>
  [
    'style'=>'width:150px;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:150px;text-align:center'
 ],
 'content'=>function($model)
 {
  if($model->status==0)
  {
    return '<span class="label label-danger">Không kích hoạt</span>';
  }
  else
  {
    return '<span class="label label-success">Kích hoạt</span>';
  }
}
],
[
  'attribute'=> 'cmt_date',
  'format'=>['datetime','dd-MM-yyyy H:i:s'],
  'headerOptions'=>
  [
    'style'=>'width:150px;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:150px;text-align:center'
 ],
],


['class' => 'yii\grid\ActionColumn',
'template' =>'{view}{delete}',
'headerOptions'=>[
  'style'=>'width:100px;text-align:center'
],
'contentOptions'=>[
  'style'=>'width:50px;text-align:center'
],
'buttons'=>[

  'view'=>function($url,$model){
    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',$url,['class'=>'btn btn-xs btn-primary']);
  },

  // 'update'=>function($url,$model){
  //   return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['class'=>'btn btn-xs btn-success']);
  // },
  'delete'=>function($url,$model){
    return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
      'class'=>'btn btn-xs btn-danger',
      'data-confirm'=>'Bạn có chắc muỗn xóa bình luận này không ?',
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
