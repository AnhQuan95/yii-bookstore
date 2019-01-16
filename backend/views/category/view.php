<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = $model->cate_id;
$this->params['breadcrumbs'][] = ['label' => 'Danh mục', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->cate_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->cate_id], [
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
            'cate_id',
            'cate_name',
                [
                'attribute'=>'parent',
                'value'=>function($model){
                    if($model->parent==0){
                        return 'Root';
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

           }
           ],
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
