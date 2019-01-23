<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\IkuPic */

$this->title = 'Create Iku Pic';
$this->params['breadcrumbs'][] = ['label' => 'Iku Pics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iku-pic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
