<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Perkara */

$this->title = 'Tambah Perkara Baru';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Perkara', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
