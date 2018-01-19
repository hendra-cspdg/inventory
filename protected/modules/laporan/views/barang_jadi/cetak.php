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
                        <h4>CV. JAYA ATMA PRIMA</h4><br>
                        Jl.Gunung Anyar Tambah Kav.162-163<br>
                        Surabaya, Phone /Fax : 031-5555555<br>
                        Email : jayaatmaprima@gmail.com
                    </address>
                </td>
                <td class="text-right" style="vertical-align: bottom">
                    <address>
                        jayaatmaprima.com
                    </address>
                </td>
            </tr>
        </table>
        <hr/>
        <h3 class="text-center">KARTU STOK BARANG</h3>
        <hr/>
        <table class="table">
            <?php
            $deskripsi = json_decode($barang['deskripsi']);
            if (count($deskripsi) > 0) {
                $des = implode(",", $deskripsi);
            } else {
                $des = $barang['deskripsi'];
            }
            ?>
            <tr>
                <td style="width: 25%"><b>Nama Barang</b></td>
                <td style="width: 25%">: <?php echo $barang['nama_barang_jadi'] ?></td>
                <td style="width: 25%"><b>Deskripsi</b></td>
                <td style="width: 25%">: <?php echo $des ?></td>
            </tr>
            <tr>
                <td style="width: 25%"><b>Satuan.</b></td>
                <td style="width: 25%">: <?php echo $barang['nama_satuan'] ?></td>
                <td style="width: 25%"><b>Kartu No</b></td>
                <td style="width: 25%">: -</td>
            </tr>
            <tr>
                <td style="width: 25%"><b>Tgl.Awal</b></td>
                <td style="width: 25%">: <?php echo $tgl_awal == '' ? '-' : $tgl_awal; ?></td>
                <td style="width: 25%"><b>Tgl.Akhir</b></td>
                <td style="width: 25%">: <?php echo $tgl_akhir == '' ? '-' : $tgl_akhir; ?></td>
            </tr>
        </table>
        <p></p>
        <table style="width: 98%;" class="table  table-bordered">
            <thead>
                <tr>
                    <th style="padding: 5px">Tanggal Transaksi</th>
                    <th style="padding: 5px">No Bukti</th>
                    <th style="padding: 5px">Keterangan</th>
                    <th style="padding: 5px">Masuk</th>
                    <th style="padding: 5px">Keluar</th>
                    <th style="padding: 5px">Sisa</th>
                </tr>
            </thead>
            <tbody>
                <tr class="active">
                    <td colspan="5"><b>STOK AWAL</b></td>
                    <td class=" text-right"><?php echo number_format($saldo_awal) ?></td>
                </tr>
                <?php
                $masuk = 0;
                $keluar = 0;
                $saldo = $saldo_awal;
                foreach ($data_transaksi as $d):
                    ?>
                    <tr <?php if ($d['status_transaksi'] == 3) echo 'class="success" style="font-weight:bolder"'; ?>>
                        <td><?php echo $d['tgl_transaksi'] ?></td>
                        <?php
                        if ($d['status_transaksi'] == 1) {
                            $masuk+=$d['jumlah'];
                            $saldo+=$d['jumlah'];
                            ?>
                            <td>NO.PENJUALAN :<?php echo $d['no_bukti'] ?></td>
                            <td><?php echo $d['keterangan'] ?></td>
                            <td class="warning text-right"><?php echo $d['jumlah'] ?></td>
                            <td>-</td>
                            <td class=" text-right"><?php echo $saldo ?></td>
                            <?php
                        } else if ($d['status_transaksi'] == 2) {
                            $keluar+=$d['jumlah'];
                            $saldo-=$d['jumlah'];
                            ?>
                            <td>NO.PRODUKSI :<?php echo $d['no_bukti'] ?></td>
                            <td><?php echo $d['keterangan'] ?></td>
                            <td>-</td>
                            <td class="danger text-right"><?php echo $d['jumlah'] ?></td>
                            <td class=" text-right"><?php echo $saldo ?></td>
                            <?php
                        } else if ($d['status_transaksi'] == 3) {
                            $saldo = $d['jumlah'];
                            ?>
                            <td>----- STOK OPNAME : <?php echo $d['no_bukti'] ?> -----</td>
                            <td><?php echo $d['keterangan'] ?></td>
                            <td>-</td>
                            <td>-</td>
                            <td class=" text-right"><?php echo $d['jumlah'] ?></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
            <tfoot>
                <tr class="active">
                    <td colspan="5"><b>JUMLAH STOK AKHIR</b></td>
                    <td class=" text-right"><?php echo $saldo ?></td>
                </tr>
            </tfoot>
        </table>
        <hr/>
        <i>Waktu Cetak : <b><?php echo date('Y-m-d H:i:s') ?></b></i>
    </div>
</div>