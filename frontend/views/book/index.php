<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\utils\Time;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'image',
            //'add_time',
            //'borrowed',
            [
                'label' => '借阅状态',
                'value' => function ($model) {
                    if (!$model->borrowed) {
                        return '在库';
                    }
                    /* @var $borrow \common\models\BorrowWxuserBook */
                    $borrow = $model->currentBorrow;
                    if (!$borrow) {
                        return '借出|借阅记录被删除';
                    }
                    /* @var $user \common\models\WxUser*/
                    $user = $borrow->user;
                    if (!$user) {
                        return '借出|借书用户被删除';
                    }
                    $dueReturnLeft = $borrow->getDueReturnTime() - time();
                    if ($dueReturnLeft < 0) {
                        $str =  Time::Sec2Time(-$dueReturnLeft);
                        return "借出|{$user->getNameOrOpenid()}|逾期{$str}";
                    }
                    $str =  Time::Sec2Time($dueReturnLeft);
                    return "借出|{$user->getNameOrOpenid()}|剩余{$str}";

                }
            ],
        ],
    ]); ?>
</div>
