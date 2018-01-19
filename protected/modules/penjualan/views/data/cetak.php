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
        <h3 class="text-center">NOTA PENJUALAN BARANG</h3>
        <hr/>
        <p>
			&nbsp; NO : <?php echo $penjualan['kode_sistem'] ?><br/>
		</p>
        <table class="table">
            <tr>
                <td style="width: 25%"><b>Pembeli</b></td>
                <td style="width: 25%">: <?php echo $penjualan['nama_pembeli'] ?></td>
                <td style="width: 25%"></td>
                <td style="width: 25%"></td>
            </tr>
            <tr>
                <td style="width: 25%"><b>Alamat</b></td>
                <td style="width: 25%">: <?php echo $penjualan['alamat'] ?></td>
                <td style="width: 25%"></td>
                <td style="width: 25%"></td>
            </tr>
            <tr>
                <td style="width: 25%"><b>Penjualan</b></td>
                <td style="width: 25%">: <?php echo $penjualan['status_kirim'] == 1 ? "Eceran" : "Grosir" ?></td>
                <td style="width: 25%"></td>
                <td style="width: 25%"></td>
            </tr>
        </table>
        <h3 class="text-center">NO.Penjualan : <?php echo $penjualan['nomor_penjualan'] ?></h3>
        <table style="width: 98%;" class="table  table-bordered">

            <thead>
                <tr>
                    <th style="padding: 5px">NO</th>
                    <th style="padding: 5px">Uraian</th>
                    <th style="padding: 5px">Satuan</th>
                    <th style="padding: 5px">Jumlah Barang</th>
                    <th style="padding: 5px">Harga</th>
                    <th style="padding: 5px">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total='0';
                $jumlah='0';
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
                        <td><?php echo $d['nama_barang_jadi'] . ' ' . $des ?></td>
                        <td><?php echo $d['nama_satuan'] ?></td>
                        <td><?php echo $d['jumlah_barang'] ?></td>
                        <td>Rp. <?php echo number_format($d['harga']) ?></td>
                        <td><?php
                            $total=$d['jumlah_barang']*$d['harga'];
                            $jumlah=$jumlah+$total;
                            echo 'Rp. '.number_format($total) ?></td>
                    </tr>
                    <?php
                endforeach;
                ?>
                <tr>
                    <th style="padding: 5px" colspan='5'>Jumlah</th>
                    <td>Rp. <?php echo number_format($jumlah) ?></td>
                </tr>
            </tbody>
        </table>
        <p>
		Surabaya, <?php echo $this->getDateIndo(date('Y-m-d')); ?>
			</p>
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