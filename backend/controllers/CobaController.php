<?php

namespace backend\controllers;

class CobaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
