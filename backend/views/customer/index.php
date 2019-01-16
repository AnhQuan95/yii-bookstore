<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\Customer_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Khách hàng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-responsive">
<div class="customer-index">

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

  'attribute'=>'email',
  'format'=>'email',
  'headerOptions'=>
  [
    'style'=>'width:150px;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:5px;text-align:center'
 ]

],
 [

  'attribute'=>'full_name',
  'headerOptions'=>
  [
    'style'=>'width:150px;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:5px;text-align:center'
 ]

],
 [

  'attribute'=>'phone',
  'headerOptions'=>
  [
    'style'=>'width:150px;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:5px;text-align:center'
 ]

],
            //'birthday',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
       [
  'attribute'=>'status',
  'filter'=>
  [
    1=>'Kích hoạt',
    0=>'Không kích hoạt'
  ],

  'headerOptions'=>
  [
    'style'=>'width:50px;text-align:center'
  ],
  'contentOptions'=>
  [ 
   'style'=>'width:50px;text-align:center'
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
['class' => 'yii\grid\ActionColumn',
'template'=>'{view},{update}',
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
]

],
],
]); ?>
<?php Pjax::end(); ?>

</div>
</div>