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
                <div><?= $book->name ?></div>
                <div style="width: 105px; float:left;">
                    <img src="<?= Url::to(['/qr', 'url' => $gongzhonghaoUrl,]) ?>" style="width: 100px;"/>
                    <div>关注</div>
                </div>
                <div style="width: 105px; float:left;">
                    <img src="<?= Url::to(['/qr', 'id' => $book->id]) ?>" style="width: 100px;"/>
                    <div>借还</div>
                </div>
                <div style="width: 105px; float:left;">
                    <img src="<?= Url::to(['/qr', 'url' => \Yii::$app->params['borrowListUrl'],]) ?>"
                         style="width: 100px;"/>
                    <div>查询</div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?= LinkPager::widget([
    'pagination' => $pagination,
]) ?>