<?php
/**
 * Created by PhpStorm.
 * User: R720
 * Date: 2018/8/1
 * Time: 15:01
 *
 * @var $books \common\models\Book[]
 * @var $pagination \yii\data\Pagination
 */

use yii\widgets\LinkPager;
use yii\helpers\Url;

$gongzhonghaoUrl = 'http://weixin.qq.com/r/zkxqcnLEOy9ErTYR9xnc';
$engine = new \StringTemplate\Engine;
?>
    <div style="clear:both">
        <?php foreach ($books as $book):
            $url = $engine->render(\Yii::$app->params['qrCodeUrlTemplate'], $book->id); ?>
            <div style="float: left;width: 315px; padding: 5px; text-align: center; page-break-inside: avoid;">
                <div style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?= $book->name ?></div>
                <img src="<?= Url::to(['/qr', 'id' => $book->id]) ?>" style="width: 100px;"/>
            </div>
        <?php endforeach; ?>
    </div>