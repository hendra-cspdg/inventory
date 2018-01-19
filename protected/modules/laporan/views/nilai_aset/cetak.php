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
        <h3 class="text-center">LAPORAN NILAI BARANG</h3>
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
                <td style="width: 25%">: <?php echo $barang['nama_barang'] ?></td>
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
                    <th style="padding: 5px">Harga</th>
                    <th style="padding: 5px">Nilai</th>
                    <th style="padding: 5px">Keluar</th>
                    <th style="padding: 5px">Harga</th>
                    <th style="padding: 5px">Nilai</th>
                    <th style="padding: 5px">Sisa</th>
                    <th style="padding: 5px">Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr class="active">
                    <td colspan="9" class="text-center"><b>STOK AWAL</b></td>
                    <td>0</td>
                    <td></td>
                </tr>
                <?php
                $masuk = 0;
                $keluar = 0;
                $sisa_barang = 0;
                $nilai_aset = 0;
                foreach ($data_transaksi as $d):
                    ?>
                    <tr <?php echo $d['status_transaksi'] == 1 ? 'class="success"' : ''; ?>>
                        <td><?php echo $d['tgl_transaksi'] ?></td>
                        <?php
                        if ($d['status_transaksi'] == 1) {
                            $sisa_barang +=$d['barang_masuk'];
                            $nilai_aset +=$d['nilai_masuk'];
                            ?>
                            <td>NO.TTM : <?php echo $d['no_bukti'] ?></td>
                            <td><?php echo $d['keterangan'] ?></td>
                            <td><?php echo $d['barang_masuk'] ?></td>
                            <td class="text-right"><?php echo number_format($d['harga_masuk']) ?></td>
                            <td class="text-right"><?php echo number_format($d['nilai_masuk']) ?></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td style="font-weight: bold"><?php echo $sisa_barang ?></td>
                            <td class="text-right" style="font-weight: bold"><?php echo number_format($nilai_aset) ?></td>
                            <?php
                        } else if ($d['status_transaksi'] == 2) {
                            $sisa_barang -=$d['barang_keluar'];
                            $nilai_aset -=$d['nilai_keluar'];
                            ?>
                            <td>NO.PENGAMBILAN : <?php echo $d['no_bukti'] ?></td>
                            <td><?php echo $d['keterangan'] ?></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="danger"><?php echo $d['barang_keluar'] ?></td>
                            <td>
                                -
                            </td>
                            <td class="text-right danger"><?php echo number_format($d['nilai_keluar']) ?></td>
                            <td style="font-weight: bold"><?php echo $sisa_barang ?></td>
                            <td style="font-weight: bold" class="text-right"><?php echo number_format($nilai_aset) ?></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <hr/>
        <i>Waktu Cetak : <b><?php echo date('Y-m-d H:i:s') ?></b></i>
    </div>
</div>