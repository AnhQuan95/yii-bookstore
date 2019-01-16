<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Category;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Category_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh mục sách';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="table-responsive">

<div class="category-index">

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
     ['class' => 'yii\grid\SerialColumn',
     'header'=>'STT',
     'headerOptions'=>[ 
       'style'=>'width:15px;text-align:center'
     ],
     'contentOptions'=>[ 
       'style'=>'width:15px;text-align:center'
     ]

   ],
   [
    'attribute'=>'cate_id',
     'headerOptions'=>[
      'style'=>'width:100px;text-align:center'
    ],
    'contentOptions'=>[
      'style'=>'width:100px;text-align:center'
    ]
   ],

    [
    'attribute'=>'cate_name',
     'headerOptions'=>[
      'style'=>'width:150px;text-align:center'
    ],
    'contentOptions'=>[
      'style'=>'width:150px;text-align:center'
    ]
   ],

   
   [
    'attribute'=>'parent',
    'content'=>function($model){
      if($model->parent==0){
        return 'Gốc';
      }
      else{
        $parent=Category::find()->where(['cate_id'=>$model->parent])->one();
        if($parent){
          return $parent->cate_name;
        }
        else{
         return 'Không rõ';
       }

     }
   },
   'filter'=>FALSE
     ,
     'headerOptions'=>[
      'style'=>'width:150px;text-align:center'
    ],
    'contentOptions'=>[
      'style'=>'width:150px;text-align:center'
    ]
  ],
  [
    'attribute'=>'status',
    'filter' => [
      1=>'Kích hoạt',
      0=>'Không kích hoạt'
    ],



    'content'=>function($model){
      if($model->status==0){
        return '<span class="label label-danger">Không kích hoạt</span>';
      }
      else{
        return '<span class="label label-success">Kích hoạt</span>';
      }
    },
     'headerOptions'=>[
      'style'=>'width:50px;text-align:center'
    ],
    'contentOptions'=>[
      'style'=>'width:50px;text-align:center'
    ]
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
      'data-confirm'=>'Bạn có chắc muỗn xóa '.$model->cate_name,
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