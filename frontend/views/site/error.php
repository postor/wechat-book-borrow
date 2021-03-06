<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;

$data = [
    'name'=>$name,
    'message'=>$message,
    'exception'=>$exception,
];

if(isset($exception->statusCode) && $exception->statusCode== 403){
     echo $this->render('error/403',$data);
     return;
}

echo $this->render('error/default',$data);
?>
