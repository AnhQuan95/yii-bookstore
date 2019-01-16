<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = 'Thông tin cá nhân';
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= Html::encode($this->title) ?></h3>

<div class="table-responsive">
    <div class="customer-view">

     
        <p>
           <?= Html::a('Đổi mật khẩu', ['change-password'], ['class' => 'btn btn-danger']) ?>
           <?= Html::a('Cập nhật', ['update'], ['class' => 'btn btn-primary']) ?>
       </p>

       <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'email:email',
            'full_name',
            'phone',
            'address',
          [
                'attribute'=>'birthday',
                'format'=>['date','dd-MM-yyyy']

            ],
        ],
    ]) ?>

</div>
</div>
