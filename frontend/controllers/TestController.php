<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use Yii;

class TestController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    
    public function actionNottesting()
    {
        return $this->render('nottesting');
    }

}
