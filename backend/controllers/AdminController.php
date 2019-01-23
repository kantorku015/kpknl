<?php

namespace backend\controllers;
use backend\models\RequestRespon;
use yii\web\ForbiddenHttpException;
use Yii;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionReferensi()
    {
        return $this->render('referensi');
    }
    
    public function actionPkn()
    {
        return $this->render('pkn');
    }

    // public function actionPkn()
    // {

    //     if(Yii::$app->user->can('pkn'))
    //     {
    //         return $this->render('pkn');
    //     }else
    //     {
    //         throw new ForbiddenHttpException; 
    //     }
    // }
    
    public function actionLelang()
    {
        return $this->render('lelang');
    }
    public function actionPenilai()
    {
        return $this->render('penilai');
    }
    public function actionPn()
    {
        return $this->render('pn');
    }
    public function actionKi()
    {
        return $this->render('ki');
    }
    public function actionHiIndex()
    {
        return $this->render('hi-index');
    }
    public function actionHiLayanan()
    {
        return $this->render('hi-layanan');
    }
    public function actionHi()
    {
        return $this->render('hi');
    }
     public function actionUmum()
    {
        return $this->render('umum');
    }
      public function actionRes()
    {
        // $model = RequestRespon::model()->findAll();
        
        return $this->render('res');
    }
     public function actionLayananProses()
    {
        // $model = RequestRespon::model()->findAll();
        return $this->render('layanan-proses');
    }

    public function actionEmail()
    {
        $msg = "email saya";
        mail("anshori82@gmail.com","My Subject",$msg);
        // return $this->render('/site/index');
    }
   


}
