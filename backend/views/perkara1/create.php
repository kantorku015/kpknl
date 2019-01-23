<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Perkara1 */

$this->title = 'Create Perkara1';
$this->params['breadcrumbs'][] = ['label' => 'Perkara1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkara1-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
