<?php

namespace backend\controllers;

use Yii;
use backend\models\IkuCapaian;
use backend\models\IkuCapaianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\IkuSs;
use backend\models\IkuHeader;
use backend\models\IkuPic;
use yii\filters\AccessControl;

/**
 * IkuCapaianController implements the CRUD actions for IkuCapaian model.
 */
class IkuCapaianController extends Controller
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
     * Lists all IkuCapaian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IkuCapaianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IkuCapaian model.
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
     * Creates a new IkuCapaian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IkuCapaian();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
         if ($model->load(Yii::$app->request->post())){
            $max_id = IkuCapaian::find()
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
    public function actionCreate1()
        {
            $model = new IkuCapaian();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                // return $this->redirect(['view', 'id' => $model->id]);
                $id_pic = $model->id_pic;
                    $data_pic = IkuPic::find()
                        ->select(['*'])
                        ->where(['id'=>$id_pic])
                        ->one();
                        $id_iku = $data_pic->id_head;
                            $data_iku = IkuHeader::find()
                            ->select(['*'])
                            ->where(['id'=>$id_iku])
                            ->one();
                            $id_ss = $data_iku->id_ss;
                $id_href = $id_ss.$id_iku;
                return $this->redirect(['iku/report', 'id' => $id_href, '#'=>$id_href]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    /**
     * Updates an existing IkuCapaian model.
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

    public function actionUpdate1($id,$tahun)
    {
        $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->id]);
            $id_pic = $model->id_pic;
                $data_pic = IkuPic::find()
                    ->select(['*'])
                    ->where(['id'=>$id_pic])
                    ->one();
                    $id_iku = $data_pic->id_head;
                        $data_iku = IkuHeader::find()
                        ->select(['*'])
                        ->where(['id'=>$id_iku])
                        ->one();
                        $id_ss = $data_iku->id_ss;
            $id_href = $id_ss.$id_iku;
            return $this->redirect(['iku/report', 'id' => $id_href, '#'=>$id_href,'tahun'=>$tahun]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing IkuCapaian model.
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
     * Finds the IkuCapaian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IkuCapaian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IkuCapaian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
