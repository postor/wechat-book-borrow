<?php

use yii\helpers\Html;

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '微信自助图书借阅管理';
$gongzhonghaoUrl = 'http://weixin.qq.com/r/zkxqcnLEOy9ErTYR9xnc';

?>
<div class="site-index">
    <h1>微信自助图书借阅使用说明</h1>

    <p>
        1.关注本业下方二维码公众号，关注公众号后方可使用借阅功能
    </p>
    <p>
        2.确保手机连接到内网WIFI（MMC-5G\MMC-2.4G)
    </p>
    <p>
        3.借阅、续借、归还时，微信扫图书背面的【借还】二维码进行相应操作
    </p>
    <p>
        4.查询图书状况通过扫描下方的【查询】二维码查看
    </p>
    <p>
        关注公众号<br/>
        <img src="<?= Url::to(['/qr', 'url' => $gongzhonghaoUrl,]) ?>" />
    </p>
    <p>
        图书借阅情况列表<br/>
        <img src="<?= Url::to(['/qr', 'url' => \Yii::$app->params['borrowListUrl'],]) ?>" />
    </p>

</div>
