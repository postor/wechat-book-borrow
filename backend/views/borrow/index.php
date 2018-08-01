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
        <?php // Html::a('Create Borrow Wxuser Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'wxuser_id',
            //'book_id',
            [
                'label' => '用户',
                'value' => function ($model) {
                    /* @var $model \common\models\BorrowWxuserBook */
                    if(!$model->user){
                        return '关联用户已删除';
                    }
                    return $model->user->getNameOrOpenid();
                }
            ],
            [
                'label' => '图书',
                'value' => function ($model) {
                    /* @var $model \common\models\BorrowWxuserBook */
                    if(!$model->book){
                        return '关联图书已删除';
                    }
                    return $model->book->name;
                }
            ],
            'borrow_time',
            'return_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
