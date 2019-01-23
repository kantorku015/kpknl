<?php
namespace backend\controllers;
use kartik\mpdf\Pdf;

class IkuController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionReport()
    {
        return $this->render('report');
    }
    public function actionReport1()
    {
        return $this->render('report1');
    }

    public function actionCetak() {
       $pdf = new Pdf([
        // 'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
        'mode' => Pdf::MODE_UTF8,
        // 'content' => $this->renderPartial('tes'),
        'content' => $this->renderPartial('report1'),
        'options' => [
            'title' => 'Daftar BKPN',
            'subject' => 'Daftar BKPN'
        ],
        'format' => Pdf::FORMAT_A4, 
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        // 'orientation' => Pdf::ORIENT_LANDSCAPE, 
         // 'destination' => Pdf::DEST_DOWNLOAD,
        // 'defaultFontSize' => 100,
        // 'defaultFont' => '5',
        'marginLeft' => '5',
        'marginRight' => '5',
        'methods' => [
            // 'SetHeader' => ['KPKNL Bekasi|www.kpknlbekasi.go.id|Tanggal Cetak: ' . date("d-m-Y")],
            // 'SetFooter' => ['KPKNL Bekasi|www.kpknlbekasi.go.id|Tanggal Cetak: ' . date("d-m-Y")],
            // 'SetFooter' => ['|Page {PAGENO}|'],
        ]
        ]);
        return $pdf->render();
        // return $this->render('cetak');
    }

}
