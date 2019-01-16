<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'full_name',
            'phone',
            'address',
            [
                'attribute'=>'birthday',
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

    ],
]) ?>

</div>
