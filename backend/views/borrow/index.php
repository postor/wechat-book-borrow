<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Borrow Wxuser Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrow-wxuser-book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Borrow Wxuser Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'wxuser_id',
            'book_id',
            'borrow_time',
            'return_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
