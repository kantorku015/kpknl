<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'KPKNL Bekasi';
?>
<div class="site-index">

    <div class="jumbotron">
    <div class="container-fluid">

        <!-- <p class="lead">Kantor Pelayanan Kekayaan Negara dan Lelang.</p> -->

        <!-- <p><a class="btn btn-lg btn-success" href="http://#">Get started with Yii</a></p> -->
    </div>

    <div class="body-content">

         <?php
        $files = \yii\helpers\FileHelper::findFiles('img/new/');
        if (isset($files[0])) {
            $no_file = 0;
            foreach ($files as $index => $file) {
                if ($no_file == 0) {
                    $class = "active";
                }
                else{
                    $class = "";
                }
                $gambar = substr($file, strripos($file, '/')+1);
                echo Html::a($gambar, Url::base().'/img/new/'.$gambar)."<br/>"."<br/>";
                echo $no_file;
                ?>
                <?php
                
                $no_file++;
            } 
        }
        else{
            echo "tak ada file";
        }
        ?>
    </div>
