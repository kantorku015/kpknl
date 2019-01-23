<?php

namespace backend\controllers;

use Yii;
use backend\models\RekeningPenerimaan;
use backend\models\RekeningPenerimaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \common\widgets\Alert;
use yii\helpers\FileHelper;

// use yii\web\Controller;
use backend\models\UploadForm;
use yii\web\UploadedFile;
/**
 * RekeningPenerimaanController implements the CRUD actions for RekeningPenerimaan model.
 */
class RekeningPenerimaanController extends Controller
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
     * Lists all RekeningPenerimaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RekeningPenerimaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RekeningPenerimaan model.
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
     * Creates a new RekeningPenerimaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new RekeningPenerimaan();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionCreate()
    {
        $model = new RekeningPenerimaan();

        if ($model->load(Yii::$app->request->post())) {
            $max_id = RekeningPenerimaan::find()
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


        public function actionSplit($id_parent,$tgl_awal,$tgl_akhir)
    {
        $model = new RekeningPenerimaan();
        // $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            #cek nominal
            $data_rek = RekeningPenerimaan::find()
                ->select(['*'])
                ->where(['id'=>$id_parent])
                ->one();
                $id = $data_rek->id;
                // $id_parent = $data_rek->id_parent;
                // $id_child = $data_rek->id_child;
                $post_date = $data_rek->post_date;
                $value_date = $data_rek->value_date;
                $branch = $data_rek->branch;
                $journal_no = $data_rek->journal_no;
                $description = $data_rek->description;
                $debit = $data_rek->debit;
                $credit = $data_rek->credit;
                $jns_trn = $data_rek->jns_trn;
                $no_dokumen = $data_rek->no_dokumen;
                $tgl = $data_rek->tgl;
                $jam = $data_rek->jam;
                $keterangan = $data_rek->keterangan;
                #nominal child credit
                $rph_child_credit = Yii::$app->db
                    ->createCommand("SELECT sum(credit) 
                        FROM rekening_penerimaan 
                        where id_parent >= '$id'
                        ");
                $jml_rph_child_credit = $rph_child_credit->queryScalar();
                $sisa_credit = $credit - $jml_rph_child_credit;
                #nominal child debit
                $rph_child_debit = Yii::$app->db
                    ->createCommand("SELECT sum(debit) 
                        FROM rekening_penerimaan 
                        where id_parent >= '$id'
                        ");
                $jml_rph_child_debit = $rph_child_debit->queryScalar();
                $sisa_debit = $debit - $jml_rph_child_debit;
            if(
                ($model->credit > $sisa_credit) ||
                ($model->debit > $sisa_debit)
            ){
                $pesan = new Alert();
                \Yii::$app->session->setFlash('danger', 'Nominal terlalu besar');
                return $this->redirect(['split', 'id_parent' => $id_parent, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir]);
            }

            $max_id = RekeningPenerimaan::find()
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
            // if ($model->save()) {
            //     # code...
            //     Yii::$app->session()->setFlash('success','berhasil memecah transaksi');
            // }
            // else{
            //     Yii::$app->session()->setFlash('warning','gagal memecah transaksi');
            // }
            \Yii::$app->session->setFlash('info', 'Berhasil merinci transaksi');
            return $this->redirect(['daftar-trx', '#' => $id_parent, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir]);
        } else {
            return $this->render('split', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RekeningPenerimaan model.
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
     * Deletes an existing RekeningPenerimaan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$tgl_awal,$tgl_akhir,$id_parent)
    {
        $this->findModel($id)->delete();

        // return $this->redirect(['index']);
        \Yii::$app->session->setFlash('warning', 'Berhasil menghapus transaksi');
        return $this->redirect(['daftar-trx', '#' => $id_parent, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir]);
    }

    /**
     * Finds the RekeningPenerimaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RekeningPenerimaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RekeningPenerimaan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
     public function actionDaftarTrx()
    {
        return $this->render('daftar-trx');
    }
     public function actionDistribusiDana()
    {
        return $this->render('distribusi-dana');
    }
     public function actionPerTrx()
    {
        return $this->render('per-trx');
    }
     public function actionMyTask()
    {
        return $this->render('my-task');
    }
    // public function actionUpload()
    // {
    //     return $this->render('upload');
    // }
    public function actionUploadFile($path){

        // $model = new UploadImage();
        // // $model->load(Yii::$app->request->post());
        // $model->load(Yii::$app->request->post(), '');

        // $path = Yii::getAlias('@frontend') .'/web/upload/couriers/images/';
        // //return $path;

        // // $model->file = UploadedFile::getInstance($model, 'file');
        // $model->file = UploadedFile::getInstanceByName('file');
        // echo json_encode($model->file); # <<--- shoes nothing
        //     $model->path = $path;
        //     if($model->upload()){
        //         return true;
        //     }else{
        //         return $model->getErrors();
        //     }

        // if (Yii::$app->request->isPost) {
        //     # code...
        // }

    //    $pathname = Yii::$app->request->get('path');
    //    $path = $pathname;
    // // $path = YiiBase::getPathOfAlias("webroot");
    //    // return $this->render('upload');
        // $file = \yii\web\UploadedFile::getInstance($model,'')
        // $saveTo = 'bank/'.$path;
        // $simpan = saveAs($saveTo);
        $uploadedFile = CUploadedFile::getInstanceByName('file');
        return $this->redirect(['upload', 'path' => $path]);

        // $model = new UploadFile();
        // $model->load(Yii::$app->request->post());
        // $model->load(Yii::$app->request->get(), '');

        // $path = Yii::getAlias('@backend') .'/bank/';
        // //return $path;

        // // $model->file = UploadedFile::getInstance($model, 'file');
        // $model->file = UploadedFile::getInstanceByName('path');
        // echo json_encode($model->file); # <<--- shoes nothing
        //     $model->path = $path;
        //     if($model->upload()){
        //         // return true;
        //     }else{
        //         return $model->getErrors();
        //     }

    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {                
                $model->file->saveAs('bank/' . $model->file->baseName . '.' . $model->file->extension);
        // return $this->render('upload', ['model' => $model,'file'=>$model->file->baseName]);
        $path = "../../htdocs/bank/".$model->file->baseName.".csv";
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            LOAD DATA INFILE \''.$path.'\' INTO TABLE 
            rekening 
            COLUMNS TERMINATED BY \',\'
            OPTIONALLY ENCLOSED BY \'"\'
            ESCAPED BY ""
            LINES TERMINATED BY \'\n\'
            IGNORE 1 LINES 
            (@var1, @var2, @var3, @var4, @var5, @var6, @var7)
            SET 
            post_date = @var1, 
            value_date = @var2,
            branch = @var3,
            journal_no = @var4,
            description = REPLACE(@var5,\'"\',\'\'),
            debit = replace(@var6,\',\',\'\'),
            credit = replace(@var7,\',\',\'\');
            '
        );

        $result = $command->execute();
        \Yii::$app->session->setFlash('info', 'Data berhasil di-upload');
        return $this->redirect(['upload', 'filename' => $model->file->baseName]);
        return $this->redirect(['upload', 'filename' => $path]);
            }
        }
        return $this->render('upload', ['model' => $model]);

        // return $this->render('upload', 'file' => $file]);
    }
}
