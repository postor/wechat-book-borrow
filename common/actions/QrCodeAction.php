<?php
/**
 * Created by PhpStorm.
 * User: R720
 * Date: 2018/7/31
 * Time: 14:38
 */

namespace common\actions;
use Da\QrCode\QrCode;
use yii\web\Response;

class QrCodeAction extends \yii\base\Action
{
    public function run($id=0) {
        $engine = new \StringTemplate\Engine;
        $url = $engine->render(\Yii::$app->params['qrCodeUrlTemplate'], $id);
        $qrCode = (new QrCode($url))
            ->setSize(250)
            ->setMargin(5);

        $response = \Yii::$app->response;
        $response->headers->set('Content-Type', $qrCode->getContentType());
        $response->format = Response::FORMAT_RAW;

        return $qrCode->writeString();
    }

}