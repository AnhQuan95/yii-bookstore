<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\news */

$this->title = $model->news_id;
$this->params['breadcrumbs'][] = ['label' => 'Tin tức', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// http://localhost/
$host='http://'.$_SERVER['HTTP_HOST'];

// yiidemo
$homeUrl=str_replace('/backend/web','',Yii::$app->urlManager->baseUrl);

// http://localhost/yiidemo
$baseUrl=$host.$homeUrl;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->news_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->news_id], [
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
            'news_id',
            'news_title',
            [
                'attribute'=>'image',
                'value'=> $baseUrl.'/uploads/images/'.$model->image,
                'format' => ['image',['width'=>'250','height'=>'250']],
            ],
            'description:html',
            'content:html',
            [
                'attribute'=>'status',
                // 'format'=>['date','dd-MM-yyyy']
                'value'=>function($model){
                   if($model->status==1){
                    return 'Kích hoạt';
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
        
    ],
]) ?>

</div>
