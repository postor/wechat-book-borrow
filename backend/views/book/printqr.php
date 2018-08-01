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

$engine = new \StringTemplate\Engine;
?>
    <div style="clear:both">
        <?php foreach ($books as $book):
            $url = $engine->render(\Yii::$app->params['qrCodeUrlTemplate'], $book->id); ?>
            <div style="float: left;width: 40mm; padding: 5mm;">
                <img src="<?= Url::to(['/qr', ['id' => $book->id]]) ?>" style="width: 100%"/>
                <p><?= $book->name ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?= LinkPager::widget([
    'pagination' => $pagination,
]) ?>