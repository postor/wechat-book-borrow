<?php
/* @var $this yii\web\View */
/* @var $book common\models\Book */
/* @var $operation common\models\BorrowOperation */

/* @var $user common\models\WxUser */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\BorrowOperation;

?>
<h1>borrow/index</h1>

<p>
    <img src="<?= $book->image ?>">
<h1><?= $book->name ?></h1>
<?php
$borrow = $book->currentBorrow;
if ($borrow):
    $borrowUser = $borrow->user;
    ?>
    <p>
        当前借阅用户 [<?= ($user->id == $borrowUser->id) ? '自己' : $borrowUser->getNameOrOpenid() ?>]
    </p>
    <p>
       剩余归还时间 [<?= \common\utils\Time::Sec2Time($borrow->getDueReturnTime()-time()) ?>]
    </p>
    <?php if ($user->id != $borrowUser->id): ?>
    <p>
        该用户 [<?= BorrowOperation::canReborrow($borrowUser, $book) ? '可续借' : '不可续借' ?>]
    </p>
<?php endif; ?>
<?php endif; ?>
</p>
<hr />
<?php if ($operation->operation != BorrowOperation::OPERATION_NONE): ?>
    <div class="wx-user-form">
        <?php $form = ActiveForm::begin(); ?>
        <?= Html::hiddenInput('book_id', $book->id) ?>
        <?= Html::hiddenInput('user_id', $user->id) ?>
        <?= Html::hiddenInput('operation', $operation->operation) ?>

        <p><?= $operation->message ?></p>
        <div class="form-group">
            <?= Html::submitButton($operation->title, ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php else: ?>
    <p><?=$operation->message?></p>
    <p>抱歉，您目前不能对这本书进行操作！</p>
<?php endif; ?>
