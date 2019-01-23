<?php

namespace backend\controllers;

use Yii;
use backend\models\Bkpn;
use backend\models\BkpnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
/**
 * BkpnController implements the CRUD actions for Bkpn model.
 */
class BkpnController extends Controller
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
     * Lists all Bkpn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BkpnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bkpn model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bkpn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bkpn();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->nrpn]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Bkpn model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->nrpn]);
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Bkpn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        
    }

    /**
     * Finds the Bkpn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Bkpn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bkpn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionBkpnRekap()
    {
        return $this->render('bkpn-rekap', [
        ]);
    }
    // public function actionBkpnPdf()
    // {
    //     return $this->render('bkpn-pdf', [
    //     ]);
    // }
    

    

    public function actionBkpnCetak() {
       $pdf = new Pdf([
        'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
        'content' => $this->renderPartial('bkpn-cetak'),
        'options' => [
            'title' => 'Daftar BKPN',
            'subject' => 'Daftar BKPN'
        ],
        'format' => Pdf::FORMAT_A4, 
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        'methods' => [
            'SetHeader' => ['HI KPKNL Bekasi||Tanggal Cetak: ' . date("d-m-Y")],
            'SetFooter' => ['|Page {PAGENO}|'],
        ]
        ]);
        return $pdf->render();
    }

}
