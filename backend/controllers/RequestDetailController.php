<?php

namespace backend\controllers;

use Yii;
use backend\models\RequestDetail;
use backend\models\RequestDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\KpknlStruktur;
use backend\models\KpknlLayanan;
use backend\models\KpknlLayananProses;
use backend\models\RequestHeader;
use backend\models\KpknlStakeholder;
use backend\models\HistoryMessage;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
/**
 * RequestDetailController implements the CRUD actions for RequestDetail model.
 */
class RequestDetailController extends Controller
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
                        'actions' => ['logout','create','update'],
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            $user = Yii::$app->user;
                            return ($user->identity->username == 'admin');
                        }
                    ],
                    [
                        //boleh akses jika sudah login
                        'allow' => true,
                        'actions' => ['logout','create','update'],
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
     * Lists all RequestDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RequestDetail model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RequestDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new RequestDetail();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    public function actionCreate()
    {
        $model = new RequestDetail();

         if ($model->load(Yii::$app->request->post())){
            $max_id = RequestDetail::find()
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
            $id_proses = $model->id_proses;
            $data_proses = KpknlLayananProses::find()
                ->select(['*'])
                ->where(['id'=>$id_proses])
                // ->where(['id'=> 1])
                ->one();
                $id_layanan = $data_proses->id_layanan;
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
            return $this->redirect(['/admin/'.$ur_seksi_singk, 'id' => $model->id_req_header, '#'=>$model->id_req_header]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

        // if(Yii::$app->user->can('create'))
        // {
        //     $model = new RequestDetail();

        //      if ($model->load(Yii::$app->request->post())){
        //         $max_id = RequestDetail::find()
        //             ->select('id')
        //             ->orderBy(['id'=>SORT_DESC])
        //             ->one();

        //             if ($max_id) {
        //                 $model->id = $max_id->id + 1;
        //             }
        //             else{
        //                 $model->id = 1;
        //             }

        //         $model->save(); 
        //         $id_proses = $model->id_proses;
        //         $data_proses = KpknlLayananProses::find()
        //             ->select(['*'])
        //             ->where(['id'=>$id_proses])
        //             // ->where(['id'=> 1])
        //             ->one();
        //             $id_layanan = $data_proses->id_layanan;
        //             // $id_layanan = 3;
        //                 $data_layanan = KpknlLayanan::find()
        //                     ->select(['*'])
        //                     ->where(['id'=>$id_layanan])
        //                     ->one();
        //                     $ur_layanan = $data_layanan->ur_layanan;
        //                     $id_seksi = $data_layanan->id_seksi;
        //                     $data_seksi = KpknlStruktur::find()
        //                         ->select(['*'])
        //                         ->where(['id'=>$id_seksi])
        //                         ->one();
        //                         $ur_seksi_singk = strtolower($data_seksi->ur_seksi_singk);
        //         return $this->redirect(['/admin/'.$ur_seksi_singk, 'id' => $model->id_req_header, '#'=>$model->id_req_header]);
        //     } else {
        //         return $this->render('create', [
        //             'model' => $model,
        //         ]);
        //     }
        // }else
        // {
        //     throw new ForbiddenHttpException; 
        // }
    }

    /**
     * Updates an existing RequestDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // $id_req_header = Yii::$app->request->post('id_req_header');
        // // $ur_seksi_singk = Yii::$app->request->post('ur_seksi_singk');
        // $ur_seksi_singk = 'pkn';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $id_proses = $model->id_proses;
            $data_proses = KpknlLayananProses::find()
                ->select(['*'])
                ->where(['id'=>$id_proses])
                // ->where(['id'=> 1])
                ->one();
                $id_layanan = $data_proses->id_layanan;
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
            return $this->redirect(['/admin/'.$ur_seksi_singk, 'id' => $model->id_req_header, '#'=>$model->id_req_header]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RequestDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // return $this->redirect(['index']);

        $id_proses = $model->id_proses;
            $data_proses = KpknlLayananProses::find()
                ->select(['*'])
                ->where(['id'=>$id_proses])
                // ->where(['id'=> 1])
                ->one();
                $id_layanan = $data_proses->id_layanan;
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
        $this->findModel($id)->delete();
            return $this->redirect(['/admin/'.$ur_seksi_singk, 'id' => $model->id_req_header, '#'=>$model->id_req_header]);
    }

    /**
     * Finds the RequestDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequestDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequestDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // public function actionSms($id_req_detail)
    public function actionSms()
    {
        // $id_req_detail = $_POST['id_req_detail'];
        $id_req_detail = Yii::$app->request->post('id_req_detail');
        // $id_req_detail = 1;
        $daftar_request_detail = RequestDetail::find()
            ->select(['*'])
            ->where(['id'=>$id_req_detail])
            ->one();
            $id_req_header = $daftar_request_detail->id_req_header;
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
                    $tgl_terima = $data_header->tgl_terima;
                    $ticket_code = $data_header->ticket_code;
                    $keterangan = $data_header->keterangan;
            $id_proses = $daftar_request_detail->id_proses;
                $data_proses = KpknlLayananProses::find()
                    ->select(['*'])
                    ->where(['id'=>$id_proses])
                    ->one();
                    $ur_proses = $data_proses->ur_proses;
            $tgl_proses = $daftar_request_detail->tgl_proses;
            $keterangan_proses = $daftar_request_detail->keterangan;

            $content = 
            "Yth. ".$nama_stakeholder.", tiket dokumen Anda no:".$ticket_code.", saat ini dalam proses ".$ur_proses.
            " per tgl ".date_format(date_create($tgl_proses),"d-m-Y").", ".$keterangan_proses." ".". Terimakasih. KPKNL Bekasi";

        


          $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://api.nusasms.com/api/v3/sendsms/plain',
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => array(
                    'user' => 'kpknlbks_api',
                    'password' => '8Wm21A9',
                    // 'SMSText' => 'This is an example code using PHP.',
                    'SMSText' => $content,
                    // 'GSM' => '6281219238138'
                    'GSM' => $telp
                )
            ));
            $resp = curl_exec($curl);
            if (!$resp) {
                // die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
                return $this->render('sms', [
                // 'content' => $content.die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl))]);
                'content' => $content.'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl)
                ]);
            } else {
                // header('Content-type: text/xml'); if you want to output to be an xml
                // echo $resp;
                // return $this->render('sms', [
                // 'content' => $content]);

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
                    $model->id_detail = $id_req_detail;
                    $model->jenis = 'sms';
                    $model->created_at = date('Y-m-d');
                    $model->created_by = Yii::$app->user->identity->id;

                $model->save();


                return $this->redirect(['/admin/'.$ur_seksi_singk, 'id' => $id_req_header, '#'=>$id_req_header]);
            }
            curl_close($curl);
             

           return $this->redirect(['/admin/'.$ur_seksi_singk, 'id' => $id_req_header, '#'=>$id_req_header]);
            //  return $this->render('sms', [
            // 'content' => $content]);
    }
    // public function actionSms($url)
    // {
    //     $options = array(
    //           CURLOPT_CUSTOMREQUEST  =>"GET",    // Atur type request, get atau post
    //           CURLOPT_POST           =>false,    // Atur menjadi GET
    //           CURLOPT_FOLLOWLOCATION => true,    // Follow redirect aktif
    //           CURLOPT_CONNECTTIMEOUT => 500,     // Atur koneksi timeout
    //           CURLOPT_TIMEOUT        => 500,     // Atur response timeout
    //       );

    //       $ch      = curl_init( $url );          // Inisialisasi Curl
    //       curl_setopt_array( $ch, $options );    // Set Opsi
    //       $content = curl_exec( $ch );           // Eksekusi Curl
    //       curl_close( $ch );                     // Stop atau tutup script

    //       $header['content'] = $content;
    //       // return $header;
    //       return $this->render('sms');

    // }
}
