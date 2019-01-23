<?php

namespace backend\controllers;

use Yii;
use backend\models\LelangRisalah;
use backend\models\LelangRisalahSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * LelangRisalahController implements the CRUD actions for LelangRisalah model.
 */
class LelangRisalahController extends Controller
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
     * Lists all LelangRisalah models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LelangRisalahSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LelangRisalah model.
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
     * Creates a new LelangRisalah model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new LelangRisalah();

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
        $model = new LelangRisalah();

        if ($model->load(Yii::$app->request->post())) {
            $max_id = LelangRisalah::find()
                ->select('id')
                // ->where(['tahun'=>date('Y')])
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

    public function actionCreate2()
    {
        $model = new LelangRisalah();

        if ($model->load(Yii::$app->request->post())) {
            $max_id = LelangRisalah::find()
                ->select('id')
                // ->where(['tahun'=>date('Y')])
                ->orderBy(['id'=>SORT_DESC])
                ->one();

            if ($max_id) {
                $model->id = $max_id->id + 1;
            }
            else{
                $model->id = 1;
            }

            $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $res = "";
            for ($i = 0; $i<6; $i++){
                $res .= $chars[mt_rand(0, strlen($chars)-1)];
            }
            #cari res yang ada
            $cari = LelangRisalah::find()
                ->select(['*'])
                ->where(['rl_no' => $res])
                ->one();
                if ($cari) {
                    $res = "";
                    for ($i = 0; $i<6; $i++){
                        $model->rl_no .= $chars[mt_rand(0, strlen($chars)-1)];
                    }
                }
                else{
                    $model->rl_no = $res;
                }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create2', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LelangRisalah model.
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

    /**
     * Deletes an existing LelangRisalah model.
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
     * Finds the LelangRisalah model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LelangRisalah the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LelangRisalah::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRpn()
    {
        return $this->render('rpn');
    }
    public function actionRpnPdf()
    {
        return $this->render('rpn-pdf');
    }
    public function actionRpl()
    {
        return $this->render('rpl');
    }
    public function actionRplPdf()
    {
        return $this->render('rpl-pdf');
    }
    public function actionSppl()
    {
        return $this->render('sppl');
    }
    public function actionSpplPdf()
    {
        return $this->render('sppl-pdf');
    }
    public function actionTt()
    {
        return $this->render('tt');
    }
    public function actionTtPdf()
    {
        return $this->render('tt-pdf');
    }
    public function actionKui()
    {
        return $this->render('kui');
    }
    public function actionKuiPdf()
    {
        return $this->render('kui-pdf');
    }
    public function actionReportRekap()
    {
        return $this->render('report-rekap');
    }
     public function actionReportTgl()
    {
        return $this->render('report-tgl');
    }
         public function actionTabelPdf()
    {
        return $this->render('tabel-pdf');
    }
}
