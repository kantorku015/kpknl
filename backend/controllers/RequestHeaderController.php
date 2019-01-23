<?php

namespace backend\controllers;

use Yii;
use backend\models\RequestHeader;
use backend\models\RequestHeaderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\KpknlStakeholder;
use backend\models\HistoryMessage;
use kartik\mpdf\Pdf;
use backend\models\KpknlStruktur;
use backend\models\KpknlLayanan;
use yii\filters\AccessControl;
/**
 * RequestHeaderController implements the CRUD actions for RequestHeader model.
 */
class RequestHeaderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                //akses yang terkena aturan
                'only' => ['login','logout','signup','create','update','delete'],
                'rules' =>[
                    [
                        //boleh akses tanpa login
                        'allow' => true,
                        'actions' => ['login','signup'],
                        'roles' => ['?'],
                    ],
                    [
                        //boleh akses jika sudah login super
                        'allow' => true,
                        'actions' => ['logout','create','update','delete'],
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            $user = Yii::$app->user;
                            return ($user->identity->username == 'super');
                        }
                    ],
                    [
                        //boleh akses jika sudah login admin
                        'allow' => true,
                        'actions' => ['logout','create','update',],
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            $user = Yii::$app->user;
                            return ($user->identity->username == 'admin');
                        }
                    ],
                    [
                        //boleh akses jika sudah login
                        'allow' => true,
                        'actions' => ['logout','create','update',],
                        'roles' => ['@'],
                        // 'matchCallback'=>function($rule,$action){
                        //     $user = Yii::$app->user;
                        //     return ($user->identity->username == 'admin');
                        // }
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all RequestHeader models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestHeaderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RequestHeader model.
     * @param integer $id
     * @return mixed
     */
    


    /**
     * Creates a new RequestHeader model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RequestHeader();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
         if ($model->load(Yii::$app->request->post())){
            $max_id = RequestHeader::find()
                ->select('id')
                ->orderBy(['id'=>SORT_DESC])
                ->one();

                if ($max_id) {
                    $model->id = $max_id->id + 1;
                }
                else{
                    $model->id = 1;
                }

            $model->save(); 
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RequestHeader model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate1($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $id_layanan = $model->id_layanan;
            // $id_layanan = 3;
                $data_layanan = KpknlLayanan::find()
                    ->select(['*'])
                    ->where(['id'=>$id_layanan])
                    ->one();
                    $ur_layanan = $data_layanan->ur_layanan;
                    $id_seksi = $data_layanan->id_seksi;
                    $data_seksi = KpknlStruktur::find()
                        ->select(['*'])
                        ->where(['id'=>$id_seksi])
                        ->one();
                        $ur_seksi_singk = strtolower($data_seksi->ur_seksi_singk);
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['/admin/'.$ur_seksi_singk, 'id' => $model->id, '#'=>$model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RequestHeader model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RequestHeader model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequestHeader the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequestHeader::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

public function actionSms()
    {
        #content
        $id_req_header = Yii::$app->request->post('id_req_header');
        $id = $id_req_header;
        $data_header = RequestHeader::find()
                ->select(['*'])
                ->where(['id'=>$id_req_header])
                ->one();
                $no_dokumen = $data_header->no_dokumen;
                $id_stakeholder = $data_header->id_stakeholder;
                $data_stakeholder = KpknlStakeholder::find()
                    ->select(['*'])
                    ->where(['id'=>$id_stakeholder])
                    ->one();
                    $nama_stakeholder = $data_stakeholder->nama;
                    $telp = $data_stakeholder->telp;
                $tgl_dok = $data_header->tgl_dok;
                $id_layanan = $data_header->id_layanan;
                $tgl_terima = $data_header->tgl_terima;
                $ticket_code = $data_header->ticket_code;
                $keterangan = $data_header->keterangan;

            $content = 
            "Yth. ".$nama_stakeholder.", gunakan nomor tiket ".$ticket_code.", untuk dokumen Anda nomor: ".$no_dokumen.". Terimakasih. KPKNL Bekasi.";

       

        #sms
          $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                // CURLOPT_URL => 'http://api.nusasms.com/api/v3/sendsms/plain',
                CURLOPT_URL => 'http://api.nusasms.com/api/v3/sendsms/plain',
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => array(
                    'user' => 'kpknlbks_api',
                    'password' => '8Wm21A9',
                    // 'SMSText' => 'This is an example code using PHP.',
                    'SMSText' => $content,
                    // 'GSM' => '6281219238138'
                    'GSM' => $telp,
                    'output' => 'json'
                )
            ));
            $resp = curl_exec($curl);
            if (!$resp) {
                // die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
                return $this->render('view', [
                'content' => "gagal".die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl))]);
                // 'content' => $content.'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl)]);
            } else {
                // header('Content-type: text/xml'); if you want to output to be an xml
                // echo $resp;
                // return $this->render('view', [
                // 'content' => $content,
                // 'model' => $this->findModel($id)]);

                 #add table histori
                $model = new HistoryMessage();
                $max_id = HistoryMessage::find()
                    ->select('id')
                    ->orderBy(['id'=>SORT_DESC])
                    ->one();

                    if ($max_id) {
                        $model->id = $max_id->id + 1;
                    }
                    else{
                        $model->id = 1;
                    }

                    $model->id_header = $id_req_header;
                    $model->id_detail = '0';
                    $model->jenis = 'sms';
                    $model->created_at = date('Y-m-d');
                    $model->created_by = Yii::$app->user->identity->id;

                $model->save(); 
                
                 return $this->render('view', [
                'model' => $this->findModel($id_req_header),
                // 'id' => $id_req_header,
                'content' => $content]);
            }
            curl_close($curl);
             
            #tanpa sms
             // return $this->render('/request-detail/sms', [
             return $this->render('view', [
            'model' => $this->findModel($id_req_header),
            // 'id' => $id_req_header,
            'content' => $content]);
    }

    public function actionWa()
    {
        // $id_req_detail = $_POST['id_req_detail'];
        $id_req_header = Yii::$app->request->post('id_req_header');
        $id = $id_req_header;
        // $id_req_detail = 1;
        $data_header = RequestHeader::find()
                ->select(['*'])
                ->where(['id'=>$id_req_header])
                ->one();
                $no_dokumen = $data_header->no_dokumen;
                $id_stakeholder = $data_header->id_stakeholder;
                $data_stakeholder = KpknlStakeholder::find()
                    ->select(['*'])
                    ->where(['id'=>$id_stakeholder])
                    ->one();
                    $nama_stakeholder = $data_stakeholder->nama;
                    $telp = $data_stakeholder->telp;
                $tgl_dok = $data_header->tgl_dok;
                $id_layanan = $data_header->id_layanan;
                $tgl_terima = $data_header->tgl_terima;
                $ticket_code = $data_header->ticket_code;
                $keterangan = $data_header->keterangan;

            $content = 
            "Yth. ".$nama_stakeholder.", gunakan nomor tiket ".$ticket_code.", untuk dokumen Anda nomor: ".$no_dokumen.". Terimakasih. KPKNL Bekasi.";

           


          $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                // CURLOPT_URL => 'http://api.nusasms.com/api/v3/sendsms/plain',
                CURLOPT_URL => 'http://api.nusasms.com/api/v3/sendwa/plain',
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => array(
                    'user' => 'kpknlbks_api',
                    'password' => '8Wm21A9',
                    // 'SMSText' => 'This is an example code using PHP.',
                    'SMSText' => $content,
                    // 'GSM' => '6281219238138'
                    'GSM' => $telp,
                    'output' => 'json'
                )
            ));
            $resp = curl_exec($curl);
            if (!$resp) {
                // die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
                return $this->render('view', [
                'content' => "gagal".die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl))]);
                // 'content' => $content.'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl)]);
            } else {
                // header('Content-type: text/xml'); if you want to output to be an xml
                // echo $resp;
                // return $this->render('view', [
                // 'content' => $content,
                // 'model' => $this->findModel($id)]);

                 #add table histori
                $model = new HistoryMessage();
                $max_id = HistoryMessage::find()
                    ->select('id')
                    ->orderBy(['id'=>SORT_DESC])
                    ->one();

                    if ($max_id) {
                        $model->id = $max_id->id + 1;
                    }
                    else{
                        $model->id = 1;
                    }

                    $model->id_header = $id_req_header;
                    $model->id_detail = '0';
                    $model->jenis = 'wa';
                    $model->created_at = date('Y-m-d');
                    $model->created_by = Yii::$app->user->identity->id;

                $model->save(); 


                 return $this->render('view', [
                'model' => $this->findModel($id_req_header),
                // 'id' => $id_req_header,
                'content' => $content]);
            }
            curl_close($curl);
             
            // return $this->render('view', [
            // 'content' => $content,
            // 'model' => $this->findModel($id)]);
             return $this->render('view', [
            'model' => $this->findModel($id_req_header),
            // 'id' => $id_req_header,
            'content' => $content]);
    }

    public function actionCetak() {
       $pdf = new Pdf([
        // 'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
        'mode' => Pdf::MODE_UTF8,
        'content' => $this->renderPartial('cetak'),
        'options' => [
            'title' => 'Daftar BKPN',
            'subject' => 'Daftar BKPN'
        ],
        'format' => Pdf::FORMAT_A4, 
        'orientation' => Pdf::ORIENT_PORTRAIT, 
         // 'destination' => Pdf::DEST_DOWNLOAD,
        'methods' => [
            // 'SetHeader' => ['KPKNL Bekasi|www.kpknlbekasi.go.id|Tanggal Cetak: ' . date("d-m-Y")],
            'SetHeader' => ['KPKNL Bekasi|Tlp 021-08808888|Tanggal Cetak: ' . date("d-m-Y")],
            'SetFooter' => ['KPKNL Bekasi|Tlp 021-08808888|Tanggal Cetak: ' . date("d-m-Y")],
            // 'SetFooter' => ['KPKNL Bekasi|www.kpknlbekasi.go.id|Tanggal Cetak: ' . date("d-m-Y")],
            // 'SetFooter' => ['|Page {PAGENO}|'],
        ]
        ]);
        return $pdf->render();
        // return $this->render('cetak');
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

}
