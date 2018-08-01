<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BorrowWxuserBook */

$this->title = 'Create Borrow Wxuser Book';
$this->params['breadcrumbs'][] = ['label' => 'Borrow Wxuser Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrow-wxuser-book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
