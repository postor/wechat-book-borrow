<?php

namespace frontend\controllers;

use yii\web\Response;
use yii\helpers\Url;
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
        if (isset($media['errcode'])) {
            $media['error'] = $media['errcode'];
            return $media;
        }
        $url = '/images/upload/' . $id . '.png';
        $file = Yii::getAlias('@frontend/web' . $url);
        file_put_contents($file, $media);
        return [
            'error' => 0,
            'url' => Url::to($url, true),
        ];
    }

    public function actionNottesting()
    {
        return $this->render('nottesting');
    }

}
