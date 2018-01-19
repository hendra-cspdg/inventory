<?php
date_default_timezone_set('Asia/Jakarta');
?>
<style>
    @import url('<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css');
    table tr th,td {
        padding: 5px
    }
</style>
<div class="row" style="margin-top: 20px">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <table class="table">
            <tr>
                <td class="text-left ">
                    <address>
                        <h4>JAYA ARTA PRIMA</h4><br>
                        Margomulyo Indah,<br>
                        Komplek Mutiara Blok C 25<br>
                        Surabaya
                    </address>
                </td>
                <td class="text-right" style="vertical-align: bottom">
                    <address>
                        jayaartaprima.com
                    </address>
                </td>
            </tr>
        </table>
        <hr/>
        <h3 class="text-center">FORMULIR PRODUKSI BARANG/MATERIAL</h3>
        <hr/>
        <p>
            Surabaya, <?php echo $this->getDateIndo(date('Y-m-d')); ?><br/>
        </p>
        <h3 class="text-center">NO.Produksi : <?php echo $permintaan_barang['nomor_permintaan'] ?></h3>
        <table style="width: 98%;" class="table  table-bordered">
            <thead>
                <tr>
                    <th style="padding: 5px">NO</th>
                    <th style="padding: 5px">Uraian</th>
                    <th style="padding: 5px">Satuan</th>
                    <th style="padding: 5px">Jumlah</th>
                    <th style="padding: 5px">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data_barang_detail as $d):
                    $deskripsi = json_decode($d['deskripsi']);
                    if (count($deskripsi) > 0) {
                        $des = implode(",", $deskripsi);
                    } else {
                        $des = $d['deskripsi'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $d['nama_barang'] . ' ' . $des ?></td>
                        <td><?php echo $d['nama_satuan'] ?></td>
                        <td><?php echo $d['jumlah_ambil'] ?></td>
                        <td><?php echo $d['keterangan'] ?></td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <p></p>
        <table class="table" style="margin-top: 80px">
            <tr>
                <td class="text-center">
                    Diterima<br/>
                    Logistik Kantor<br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    (.................)
                </td>
                <td class="text-center">
                    Menyetujui<br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    (.................)
                </td>
                <td class="text-center">
                    ACC<br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    (.................)
                </td>
                <td class="text-center">
                    Hormat Kami<br/>
                    PIC<br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    (.................)
                </td>
            </tr>
        </table>
        <i>Waktu Cetak : <b><?php echo date('Y-m-d H:i:s') ?></b></i>
    </div>
</div>