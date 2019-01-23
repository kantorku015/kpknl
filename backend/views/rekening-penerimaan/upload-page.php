<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\UploadForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RekeningPenerimaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Upload Data Bank';
$this->params['breadcrumbs'][] = $this->title;
if (isset($_POST['file'])) {
    $filename = $_POST['file'];
 }
else{
    $filename = 'xx';
}
?>
<div class="rekening-penerimaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <a href="daftar-trx">Daftar Transaksi</a>
    |
    <a href="per-trx">Per Jenis Transaksi</a>
    |
    <a href="distribusi-dana">Distribusi Dana</a>
    |
    </p>

    <p>
        <?php
            use yii\widgets\ActiveForm;
            $model = new UploadForm();
            ?>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <?= $form->field($model, 'file')->fileInput() ?>

            <?= Html::submitButton('Upload', ['class' => 'btn btn-success']);?>

            <?php ActiveForm::end() ?>
    </p>
    <p>
        filename: <?=$filename ?>
    </p>

</div>
