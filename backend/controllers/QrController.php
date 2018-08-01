<?php
/**
 * Created by PhpStorm.
 * User: R720
 * Date: 2018/7/31
 * Time: 14:54
 */

namespace backend\controllers;

use yii\web\Controller;

class QrController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => 'common\actions\QrCodeAction',
            ]
        ];
    }
}