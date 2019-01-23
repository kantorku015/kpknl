<?php

namespace backend\controllers;

use Yii;
use backend\models\LelangObyek;
use backend\models\LelangRisalah;
use backend\models\LelangObyekSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
// use yii\filters\AccessControl;

/**
 * LelangObyekController implements the CRUD actions for LelangObyek model.
 */
class LelangObyekController extends Controller
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
                'only' => ['login','logout','signup','create','create-batal','update','delete'],
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
                        'actions' => ['logout','create','create-batal','update','delete'],
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            $user = Yii::$app->user;
                            return ($user->identity->username == 'super');
                        }
                    ],
                    [
                        //boleh akses jika sudah login admin
                        'allow' => true,
                        'actions' => ['logout','create','create-batal','update',],
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            $user = Yii::$app->user;
                            return ($user->identity->username == 'admin');
                        }
                    ],
                    [
                    //     //boleh akses jika sudah login
                        'allow' => true,
                        'actions' => ['logout','create','create-batal','update',],
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
     * Lists all LelangObyek models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LelangObyekSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LelangObyek model.
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
     * Creates a new LelangObyek model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new LelangObyek();

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
        $model = new LelangObyek();

        if ($model->load(Yii::$app->request->post())) {
            $max_id = LelangObyek::find()
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

    public function actionCreateBatal()
    {
        $model = new LelangObyek();

        if ($model->load(Yii::$app->request->post())) {
            $max_id = LelangObyek::find()
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

            $model->obyek_lelang_sing = $model->obyek_lelang;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create-batal', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LelangObyek model.
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
    public function actionUpdate2($id,$id_rl)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/lelang-risalah/view', 'id' => $id_rl]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LelangObyek model.
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
     * Finds the LelangObyek model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LelangObyek the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LelangObyek::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    

    public function actionIndexSelect()
    {
        return $this->render('index-select');
    }
    public function actionAddRl()
    {
        $rl_no = $_GET['rl_no'];
        $id_obyek = $_GET['id_obyek'];
        $cari_id_rl = LelangRisalah::find()
        ->select(['*'])
        ->where(['rl_no' => $rl_no])
        ->one();
        $id_rl = $cari_id_rl->id;

        $connection = Yii::$app->db;
        $connection->createCommand()->update('lelang_obyek',['rl_no'=>$rl_no], ['id' => $id_obyek])->execute();
        Yii::$app->session->setFlash('success', 'Berhasil menambah obyek lelang');
        return $this->redirect(['lelang-risalah/view', 'id' => $id_rl]);
    }

    public function actionDelRl()
    {
        $rl_no = $_GET['rl_no'];
        $id_obyek = $_GET['id_obyek'];
        $cari_id_rl = LelangRisalah::find()
        ->select(['*'])
        ->where(['rl_no' => $rl_no])
        ->one();
        $id_rl = $cari_id_rl->id;

        $connection = Yii::$app->db;
        $connection->createCommand()->update('lelang_obyek',['rl_no'=>null], ['id' => $id_obyek])->execute();
        Yii::$app->session->setFlash('success', 'Berhasil menghapus obyek lelang');
        return $this->redirect(['lelang-risalah/view', 'id' => $id_rl]);
    }
}

