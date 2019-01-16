<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Contact */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Phản hồi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['Cập nhật', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['Xóa', 'id' => $model->id], [
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
            'name',
            'email:email',
            'subject',
            'body',
               [
                'attribute'=>'status',
                // 'format'=>['date','dd-MM-yyyy']
                'value'=>function($model){
                 if($model->status==1){
                    return 'Đã ghi nhận';
                }
                else{
                    return 'Chưa ghi nhận';
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
