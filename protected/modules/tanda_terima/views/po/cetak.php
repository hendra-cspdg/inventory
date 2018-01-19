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
                        <h4>PT.VISTA INTI TEKNIK</h4><br>
                        Jl.Gunung Anyar Tambah Kav.162-163<br>
                        Surabaya, Phone /Fax : 031-8721774<br>
                        Email : panelmaker@vistaintiteknik.com
                    </address>
                </td>
                <td class="text-right" style="vertical-align: bottom">
                    <address>
                        vistaintiteknik.com
                    </address>
                </td>
            </tr>
        </table>
        <hr/>
        <h3 class="text-center">PURCHASING ORDER</h3>
        <hr/>
        <h4>Kepada Yth : <?php echo $purchasing_order['nama_pemilik'] ?></h4>
        <table class="table col-md-5" style="width: 50%">
            <tr>
                <td style="width: 25%"><b>UP</b></td>
                <td style="width: 75%">: <?php echo $purchasing_order['nama_pemilik'] ?></td>
            </tr>
            <tr>
                <td style="width: 25%"><b>Phone</b></td>
                <td style="width: 75%">: <?php echo $purchasing_order['no_telephone'] ?></td>
            </tr>
            <tr>
                <td style="width: 25%"><b>Fax</b></td>
                <td style="width: 75%">: <?php echo $purchasing_order['no_fax'] ?></td>
            </tr>

        </table>
        <h3><u>PEMESANAN BARANG</u></h3>
        <table class="table col-md-5" style="width: 50%">
            <tr>
                <td style="width: 25%"><b>Nomor PO</b></td>
                <td style="width: 75%">: <?php echo $purchasing_order['nomor_po'] ?></td>
            </tr>
            <tr>
                <td style="width: 25%"><b>Nomor FPB</b></td>
                <td style="width: 75%">: <?php echo $no_fpb ?></td>
            </tr>

        </table>
        <p>Bersama ini mohon dikirim barang barang tersebut dibawah ini :</p>
        <table style="width: 98%;" class="table  table-bordered">
            <thead>
                <tr>
                    <th style="padding: 5px">NO</th>
                    <th style="padding: 5px">Uraian</th>
                    <th style="padding: 5px">Satuan</th>
                    <th style="padding: 5px">Jumlah</th>
                    <th style="padding: 5px">Harga</th>
                    <th style="padding: 5px">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total = 0;
                foreach ($data_barang_detail as $d):
                    $deskripsi = json_decode($d['deskripsi']);
                    if (count($deskripsi) > 0) {
                        $des = implode(",", $deskripsi);
                    } else {
                        $des = $d['deskripsi'];
                    }
                    $total+=$d['harga_total'];
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $d['nama_barang'] . ' ' . $des ?></td>
                        <td><?php echo $d['nama_satuan'] ?></td>
                        <td><?php echo $d['jumlah_barang'] ?></td>
                        <td class="text-right"><?php echo number_format($d['harga_satuan']) ?></td>
                        <td class="text-right"><?php echo number_format($d['harga_total']) ?></td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
            <tfoot>
                <tr class="info">
                    <td colspan="5" class="text-center"><b>TOTAL</b></td>
                    <td class="text-right"><?php echo number_format($total) ?></td>
                </tr>
            </tfoot>
        </table>
        <table class="table">
            <tr>
                <td style="width: 25%"><b>Syarat Pembayaran</b></td>
                <td style="width: 2%"><b>:</b></td>
                <td style="width: 73%"><?php echo $purchasing_order['nomor_po'] ?></td>
            </tr>
            <tr>
                <td style="width: 25%"><b>Tanggal On Site</b></td>
                <td style="width: 2%"><b>:</b></td>
                <td style="width: 73%"><?php echo $this->getDateIndo($purchasing_order['tgl_on_site']) ?></td>
            </tr>
            <tr>
                <td style="width: 25%;vertical-align: top"><b>Alamat Pengiriman</b></td>
                <td style="width: 2%;vertical-align: top"><b>:</b></td>
                <td style="width: 73%"> <?php echo nl2br($purchasing_order['alamat_pengiriman']) ?></td>
            </tr>
            <tr>
                <td style="width: 25%"><b>Jadwal Masuk Nota</b></td>
                <td style="width: 2%"><b>:</b></td>
                <td style="width: 73%"><?php echo $purchasing_order['jadwal_nota'] ?></td>
            </tr>
            <tr>
                <td style="width: 25%;vertical-align: top"><b>Lampiran</b></td>
                <td style="width: 2%;vertical-align: top"><b>:</b></td>
                <td style="width: 73%"> NOTA/INVOICE ASLI <br/> SURAT JALAN ASLI <br/> TANDA TERIMA MATERIAL ASLI <br/> COPY PO</td>
            </tr>

        </table>
        <p></p>
        <hr/>
        <table class="table" style="margin-top: 20px">
            <tr>
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
                    Mengetahui<br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    (.................)
                </td>
                <td class="text-center">
                    Surabaya, <?php echo $this->getDateIndo(date('Y-m-d')); ?><br/>
                    Purchasing<br/>
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