<?php

namespace frontend\controllers;

use yii\web\Response;
use Yii;


class TestController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionMedia($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $media = Yii::$app->wechat->getMedia($id);
        return [
            'error' => 0,
            'media' => $media,
        ];
    }

    public function actionNottesting()
    {
        return $this->render('nottesting');
    }

}
