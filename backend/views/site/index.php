<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>扫码借书工具</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>图书管理</h2>
                <p>
                    <?= Html::a('增删改查', ['/book']) ?>
                    <br/>
                    <?= Html::a('打印二维码', ['/book/printqr']) ?>
                </p>
            </div>
            <div class="col-lg-4">
                <h2>微信用户管理</h2>
                <p><?= Html::a('增删改查', ['/wxuser']) ?>.</p>
            </div>
        </div>

    </div>
</div>
