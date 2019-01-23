<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$src = Url::to(['img/015a.png']);
?>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="shortcut icon" href="<?=$src?>" type="image/x-icon"/>
</head>
<body>
<div class="site-login">
    <div class="row">
        <div class="login-box">
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                <font size="10"><b>KPKNL</b> BEKASI</font>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username', ['template' => '
                                <div class="col-sm-12" style="margin-top:15px;">
                                    <div class="input-group col-sm-12">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </span>
                                        {input}
                                    </div>{error}{hint}
                                </div>'])->textInput(['autofocus' => true])
                                        ->input('text', ['placeholder'=>'Username']) ?>

                        <?= $form->field($model, 'password', ['template' => '
                                <div class="col-sm-12" style="margin-top:15px;">
                                    <div class="input-group col-sm-12">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-lock"></span>
                                        </span>
                                        {input}
                                    </div>{error}{hint}
                                </div>'])->passwordInput()
                                        ->input('password', ['placeholder'=>'Password'])?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                    <hr>
                    <?php
                    // echo Html::a('Daftar Baru', ['signup'], ['class' => 'btn btn-primary']) 
                    ?>

                    </div>
                </div>          
            </div>
        </div>
    </div>
</div>
</body>
</html>