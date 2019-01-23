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

        <div class="row ">
            <div class="col-sm-8">
                <div class="panel panel-success">
                  <div class="panel-heading ">
                        <h3><marquee>Selamat Datang di Kantor Pelayanan Kekayaan Negara dan Lelang <b> Bekasi</b>. SMART - 
                        <b>S</b>impatik
                        <b>M</b>umpuni
                        <b>A</b>kuntabel
                        <b>R</b>esponsif
                        <b>T</b>erukur
                        -
                        </marquee></h3>
                  </div>
                  <div class="panel-body">
                  
                    <div class="col-sm-12">
                        <div id="myCarousel1" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators">
                        <?php
                        // $files = \yii\helpers\FileHelper::findFiles('img/new/');
                        $files = \yii\helpers\FileHelper::findFiles('img/resize/');
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
                                // echo Html::a($gambar, Url::base().'/img/new/'.$gambar)."<br/>"."<br/>";
                                // echo $no_file."x";
                                ?>
                            <li data-target="#myCarousel1" data-slide-to="<?=$no_file?>" class="<?=$class?>"></li>
                                <?php
                                
                                $no_file++;
                            } 
                        }
                        else{
                            echo "tak ada file";
                        }
                        ?>
                          </ol>


                          <!-- Indicators -->

                            <!-- Wrapper for slides -->
                            <div class="row">
                              <div class="carousel-inner">
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
                                            // echo Html::a($gambar, Url::base().'/img/new/'.$gambar)."<br/>"."<br/>";
                                            // echo $no_file."x";
                                            ?>
                                        <div class="item <?=$class?>">
                                          <img src="img/new/<?=$gambar?>" alt="<?=$gambar?>" style="width:100%;">
                                        </div>
                                            <?php
                                            
                                            $no_file++;
                                        } 
                                    }
                                    else{
                                        echo "tak ada file";
                                    }
                                    ?>




                              </div>

                          <!-- Left and right controls -->
                          <a class="left carousel-control" href="#myCarousel1" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="right carousel-control" href="#myCarousel1" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                          </a>
                            </div>
                        </div>
                    </div>
                </div>          

                </div>
            </div>

            <div class="col-sm-2">
            <div class="row">
                <div class="col-sm-12">
                    <a href="request-header/create">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <table>
                            <tr>
                                <td>
                                <?= Html::a('<span class="glyphicon glyphicon-download"></span> TERIMA DOKUMEN', ['request-header/create'], ['class' => 'btn btn-success', 'title'=>'Klik untuk merekam dokumen permohonan layanan']) ?>
                                <?= Html::a('<span class="glyphicon glyphicon-th-list"></span>', ['request-header/index'], ['class' => 'btn btn-default','title'=>'Lihat Daftar Dokumen Masuk']) ?>
                                <?= Html::a('<span class="glyphicon glyphicon-user"></span>', ['kpknl-stakeholder/index'], ['class' => 'btn btn-warning','title'=>'Tambah Data Customer']) ?>
                                </td>
                            </tr>
                        </table>
                          <hr>
                            <img src="img/tiket.png" alt="Profil1" style="width:100%;">
                        </div>
                        <!-- <div class="panel-body">
                            <h3>Permohonan <b>Layanan</b></h3>
                        </div> -->
                    </div>
                    </a>
                </div>
            <!-- </div>
            <div class="row"> -->
                <div class="col-sm-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                        <table>
                            <tr>
                                <td>
                                <?php
                                echo Html::beginForm('admin/res','post',['class' => 'form-inline']);
                                    echo Html::textInput('ticket_code','',['class'=>'form-control required','type'=>'text','placeholder'=>"Masukkan nomor tiket..."]);
                                    echo Html::submitButton('<span class="glyphicon glyphicon-search"></span>',['class'=>'btn btn-warning','title'=>'Cari dokumen']);
                                echo Html::endForm();
                                ?>
                                </td>
                            </tr>
                        </table>
                        <hr>
                            <img src="img/tracking.png" alt="Profil1" style="width:73%;">
                        </div>
                        <!-- <div class="panel-body">
                            <h3>Pencarian <b>Dokumen</b></h3>
                        </div> -->
                    </div>
                </div>


            </div>
        </div>

            
        </div>
        <!-- akhir panel -->





        <div class="row">
            <div class="col-lg-4">
                <h2>Hubungi Kami</h2>

                <p><i class="fa fa-bank"></i> Jalan Sersan Aswan No. 8D</p>
                <p><i class="fa fa-phone"></i> (021) 880 8888</p>
                <p><i class="fa fa-envelope"></i> kpknlbekasi@kemenkeu.go.id</p>

                <!-- <p><a class="btn btn-default" href="#">Alamat &raquo;</a></p> -->
            </div>
        </div>
        
    </div>
    <!-- <hr> -->

    

</div>
