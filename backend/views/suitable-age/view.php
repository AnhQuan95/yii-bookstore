<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SuitableAge */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Độ tuổi đọc sách phù hợp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suitable-age-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
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
            'id',
            'name_of_age',
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