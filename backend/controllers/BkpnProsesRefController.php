<?php

namespace backend\controllers;

use Yii;
use backend\models\BkpnProsesRef;
use backend\models\BkpnProsesRefSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BkpnProsesRefController implements the CRUD actions for BkpnProsesRef model.
 */
class BkpnProsesRefController extends Controller
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
     * Lists all BkpnProsesRef models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BkpnProsesRefSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BkpnProsesRef model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BkpnProsesRef model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BkpnProsesRef();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
         if ($model->load(Yii::$app->request->post())){
            $max_id = BkpnProsesRef::find()
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
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BkpnProsesRef model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BkpnProsesRef model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BkpnProsesRef model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BkpnProsesRef the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BkpnProsesRef::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
