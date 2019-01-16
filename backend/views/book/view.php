<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Author;
/* @var $this yii\web\View */
/* @var $model backend\models\Book */
// print_r($model);
// die;


$this->title = $model->book_id;
$this->params['breadcrumbs'][] = ['label' => 'Sách', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

//bookstore
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;
?>

<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->book_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->book_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'book_id',
            'book_name',
            
            [
                'attribute'=>'cate_id',
                'value'=>function($model){
                   return $model->cate->cate_name;
               }
           ],

           
           [
            'attribute'=>'age_id',
            'value'=>function($model){
               return $model->age->name_of_age;
           }
       ],

       [
        'attribute'=>'image',
        'value'=> $baseUrl.'/uploads/images/'.$model->image,
        'format' => ['image',['width'=>'250','height'=>'250']],
    ],
    'description:html',
    'content:html',
    'price',
    'sale_price',
    'quantity',
    'pages',
    'size',
    [
        'attribute'=>'publiser_id',
        'value'=>function($model){
           return $model->publisher->publisher_name;
       }
   ],
   
   [
    'attribute'=>'publish_at',
    'format'=>['date','dd-MM-yyyy']

    
],

[
    'attribute'=>'status',
                // 'format'=>['date','dd-MM-yyyy']
    'value'=>function($model){
       if($model->status==1){
        return 'Kích hoạt';
    }
    elseif($model->status==2){
        return 'Nổi bật';
    }
    else{
        return 'Không kích hoạt';
    }
}
],
[
    'attribute'=>'created_at',
    'format'=>['datetime','dd-MM-yyyy H:i:s']

],
[
    'attribute'=>'updated_at',
    'format'=>['datetime','dd-MM-yyyy H:i:s']

],
[
    'attribute'=>'author_ids',
    'format' => 'html',
    'value'=>function($model){
        $authors=Author::findAll($model->author_ids);
        $author_names='';
        foreach ($authors as $item) {
            $author_names.=$item->author_name.' - ';
        }

        return substr($author_names, 0, -3);;
    }
]

],
]) ?>

</div>
