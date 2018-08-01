<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowWxuserBook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrow-wxuser-book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wxuser_id')->textInput() ?>

    <?= $form->field($model, 'book_id')->textInput() ?>

    <?= $form->field($model, 'borrow_time')->textInput() ?>

    <?= $form->field($model, 'return_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
