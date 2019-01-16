<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Contact_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phản hồi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-responsive">
    <div class="contact-index">

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
      'attribute'=>'name',
      'headerOptions'=>
      [
        'style'=>'width:100px;text-align:center'
      ],
      'contentOptions'=>
      [ 
       'style'=>'width:100px;text-align:center'
     ]
 ],
                           [
      'attribute'=>'email',
      'format'=>'email',
      'headerOptions'=>
      [
        'style'=>'width:100px;text-align:center'
      ],
      'contentOptions'=>
      [ 
       'style'=>'width:100px;text-align:center'
     ]
],
                           [
      'attribute'=>'subject',
      'headerOptions'=>
      [
        'style'=>'width:25px;text-align:center'
      ],
      'contentOptions'=>
      [ 
       'style'=>'width:100px;text-align:center'
     ]
 ],
                [
      'attribute'=>'body',
      'headerOptions'=>
      [
        'style'=>'width:250px;text-align:center'
      ],
      'contentOptions'=>
      [ 
       'style'=>'width:100px;text-align:center'
     ]
 ],
 [
  'attribute'=>'status',
  'filter'=>
  [
    1=>'Đã ghi nhận',
    0=>'Chưa ghi nhận'
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
    return '<span class="label label-danger">Chưa ghi nhận</span>';
  }
  else
  {
    return '<span class="label label-success">Đã ghi nhận</span>';
  }
}
],
               ['class' => 'yii\grid\ActionColumn',
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

  'update'=>function($url,$model){
    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['class'=>'btn btn-xs btn-success']);
  },
  'delete'=>function($url,$model){
    return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
      'class'=>'btn btn-xs btn-danger',
      'data-confirm'=>'Bạn có chắc muỗn xóa '.$model->subject,
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
