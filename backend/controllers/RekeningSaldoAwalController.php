<?php

namespace backend\controllers;

use Yii;
use backend\models\RekeningSaldoAwal;
use backend\models\RekeningSaldoAwalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RekeningSaldoAwalController implements the CRUD actions for RekeningSaldoAwal model.
 */
class RekeningSaldoAwalController extends Controller
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
        ];
    }

    /**
     * Lists all RekeningSaldoAwal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RekeningSaldoAwalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RekeningSaldoAwal model.
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
     * Creates a new RekeningSaldoAwal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RekeningSaldoAwal();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
         if ($model->load(Yii::$app->request->post())){
            $max_id = RekeningSaldoAwal::find()
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

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }
    public function actionCreate1()
    {
        $model = new RekeningSaldoAwal();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
         if ($model->load(Yii::$app->request->post())){
            $max_id = RekeningSaldoAwal::find()
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
            return $this->render('create1', [
                'model' => $model,
            ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }

    public function actionCreate2()
    {
        $model = new RekeningSaldoAwal();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
         if ($model->load(Yii::$app->request->post())){
            $max_id = RekeningSaldoAwal::find()
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
            return $this->render('create2', [
                'model' => $model,
            ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Updates an existing RekeningSaldoAwal model.
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
     * Deletes an existing RekeningSaldoAwal model.
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
     * Finds the RekeningSaldoAwal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RekeningSaldoAwal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RekeningSaldoAwal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
