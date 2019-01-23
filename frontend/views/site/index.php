<?php

/* @var $this yii\web\View */

$this->title = 'HI | KPKNL Bekasi';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Hukum dan Informasi</h1>

        <p class="lead"><i>tempat Anda mendapat manfaat dari apa yang kami kerjakan...</i></p>

        <p><a class="btn btn-lg btn-success" href="#">KPKNL BEKASI</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2><span class="glyphicon glyphicon-briefcase"></span><br> BKPN</h2>
                <i>BKPN adalah Berkas Kasus Piutang Negara yang tersimpan pada Seksi HI. <br>Anda dapat melihat daftar BKPN dan status peminjaman berkas. </i>
                <hr>
                <p><a class="btn btn-default" href="bkpn/index">Daftar BKPN &raquo;</a></p>
                <p><a class="btn btn-default" href="bkpn-pinjam/index">Peminjaman BKPN &raquo;</a></p>
                <hr>
            </div>
            <div class="col-lg-4">
                <h2><span class="glyphicon glyphicon-tower"></span><br> Perkara</h2>
                <i>Daftar perkara yang tersimpan pada Seksi HI dapat anda temukan di sini. <br>Anda dapat melihat daftar Perkara dan status peminjaman berkas.</i>
                <hr>
                <p><a class="btn btn-default" href="perkara/index">Daftar Perkara &raquo;</a></p>
                <p><a class="btn btn-default" href="perkara-pinjam/index">Peminjaman Perkara &raquo;</a></p>
                <hr>
            </div>
            <div class="col-lg-4">
                <h2><span class="glyphicon glyphicon-bitcoin"></span><br> Bendahara Penerimaan</h2>
                <i>Transaksi bendahara penerimaan dapat dipantau di sini, sesuai hak akses Anda. </i>
                <hr>
                <p><a class="btn btn-default" href="lelang/index">Penatausahaan Lelang &raquo;</a></p>
                <hr>
            </div>
        </div>

    </div>
</div>
