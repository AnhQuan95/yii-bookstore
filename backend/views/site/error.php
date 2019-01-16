<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Đã xảy ra lỗi trong khi máy chủ Web đang xử lý yêu cầu của bạn.
    </p>
    <p>
       Vui lòng liên hệ với chúng tôi nếu bạn nghĩ rằng đây là một lỗi máy chủ. Cảm ơn bạn.
    </p>

</div>
