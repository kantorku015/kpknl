<?php

namespace backend\controllers;

class LelangController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionJaminan()
    {
        return $this->render('jaminan');
    }
    public function actionPelunasan()
    {
        return $this->render('pelunasan');
    }
     public function actionFiles()
    {
        return $this->render('files');
    }

}
