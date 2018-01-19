<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Form<small>Filter data</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-inline form-validation"  method="get" >
                    <div class="form-group">
                        <label for="tgl_awal">Awal
                        </label>
                        <input type="text" class="datepicker form-control validate[required]" name="tgl_awal" value="<?php echo $tgl_awal == '' ? '' : $tgl_awal; ?>" placeholder="Tanggal Awal"/>
                    </div>
                    <div class="form-group">
                        <label for="tgl_akhir">Akhir
                        </label>
                        <input type="text" class="datepicker form-control validate[required]" name="tgl_akhir" value="<?php echo $tgl_akhir == '' ? '' : $tgl_akhir; ?>" placeholder="Tanggal Akhir"/>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id_barang ?>"/>
                    <input type="hidden" name="s" value="<?php echo $stok ?>"/>
                    <button type="submit" class="btn btn-primary">Filter Data</button>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Kartu Stok<small>Detail barang</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <table class="table table-striped" style="width: 50%">
                    <thead>
                        <tr>
                            <th>Desc</th>
                            <th>Val</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $deskripsi = json_decode($barang['deskripsi']);
                        if (count($deskripsi) > 0) {
                            $des = implode(",", $deskripsi);
                        } else {
                            $des = $barang['deskripsi'];
                        }
                        ?>
                        <tr>
                            <td>Nama Barang</td>
                            <td><?php echo $barang['nama_barang'] ?></td>
                        </tr>
                        <tr>
                            <td>Satuan</td>
                            <td><?php echo $barang['nama_satuan'] ?></td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td><?php echo $des ?></td>
                        </tr>
                        <tr>
                            <td>Sisa Stok Saat ini</td>
                            <td><?php echo $stok ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Transaksi<small>Barang</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table style="width: 80%" class="table  table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <th>No Bukti</th>
                            <th>Keterangan</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="active">
                            <td colspan="5"><b>STOK AWAL</b></td>
                            <td class="text-right">0</td>
                        </tr>
                        <?php
                        $masuk = 0;
                        $keluar = 0;
                        $saldo = 0;
                        foreach ($data_transaksi as $d):
                            ?>
                            <tr <?php if ($d['status_transaksi'] == 3) echo 'class="success" style="font-weight:bolder"'; ?>>
                                <td><?php echo $d['tgl_transaksi'] ?></td>
                                <?php
                                if ($d['status_transaksi'] == 1) {
                                    $masuk+=$d['jumlah'];
                                    $saldo+=$d['jumlah'];
                                    ?>
                                    <td>NO.TTM :<?php echo $d['no_bukti'] ?></td>
                                    <td><?php echo $d['keterangan'] ?></td>
                                    <td class="warning text-right"><?php echo $d['jumlah'] ?></td>
                                    <td>-</td>
                                    <td class=" text-right"><?php echo $saldo ?></td>
                                    <?php
                                } else if ($d['status_transaksi'] == 2) {
                                    $keluar+=$d['jumlah'];
                                    $saldo-=$d['jumlah'];
                                    ?>
                                    <td>NO.PENGAMBILAN :<?php echo $d['no_bukti'] ?></td>
                                    <td><?php echo $d['keterangan'] ?></td>
                                    <td>-</td>
                                    <td class="danger"><?php echo $d['jumlah'] ?></td>
                                    <td class=" text-right"><?php echo $saldo ?></td>
                                    <?php
                                } else if ($d['status_transaksi'] == 3) {
                                    $saldo = $d['jumlah'];
                                    ?>
                                    <td>----- STOK OPNAME : <?php echo $d['no_bukti'] ?> -----</td>
                                    <td><?php echo $d['keterangan'] ?></td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td class="text-right"><?php echo $d['jumlah'] ?></td>
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
                            <td class="text-right"><?php echo $saldo ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <br>
                <form class="form-horizontal form-validation"  method="post" >
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <a class="btn btn-primary" title="Edit" href="<?php echo Yii::app()->createUrl('laporan/kartu_stok/read'); ?>">Kembali</a>
                            <a class="btn btn-dark" target="_blank" title="Cetak" href="<?php echo Yii::app()->createUrl('laporan/kartu_stok/cetak?' . Yii::app()->request->queryString); ?>"><i class="fa fa-print"></i> Cetak</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php
include 'plugins.php';
?>
