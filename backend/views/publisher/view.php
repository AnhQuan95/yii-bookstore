<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Publisher */

$this->title = $model->publisher_id;
$this->params['breadcrumbs'][] = ['label' => 'Nhà xuất bản', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publisher-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->publisher_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->publisher_id], [
            'class' => 'btn btn-danger',
            'data' => [
                  'confirm' => 'Bạn có chắc muốn xóa mục này không?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'publisher_id',
            'publisher_name',
            'address',
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
