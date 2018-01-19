<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Permintaaan <small>buat</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" >
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomor_permintaan">No Permintaan<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <?php echo $permintaan_barang['nomor_permintaan'] ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="proyek">Proyek<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <?php
                            foreach ($data_proyek as $d):
                                if ($d['id_proyek'] == $permintaan_barang['id_proyek']) {
                                    ?>
                                    <?php echo $d['nama_perusahaan'] ?> - <?php echo $d['nama_proyek'] ?>
                                    <?php
                                }
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_permintaan">TGL Permintaan<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <?php echo $permintaan_barang['tgl_permintaan'] ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_on_site">TGL On Site<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <?php echo $permintaan_barang['tgl_on_site'] ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status_kirim">Pengiriman
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <?php if ($permintaan_barang['status_kirim'] == 1) echo 'Dikirim'; ?> 
                            <?php if ($permintaan_barang['status_kirim'] == 2) echo 'Ambil Sendiri'; ?>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <input type="hidden" name="id_permintaan" value="<?php echo $permintaan_barang['id_permintaan_barang'] ?>"/>
                            <a class="btn btn-primary"  href="<?php echo Yii::app()->createUrl('permintaan_barang/persetujuan/read'); ?>">Back</a>
                            <button type="submit" class="btn btn-success">Setujui</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data<small>Barang</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                
                <table id="barang-detail-table" style="width: 80%" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Supplier</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Harga Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_barang_detail as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_barang'] . ' / ' . $d['nama_satuan'] ?></td>
                                <td><?php echo $d['nama_supplier'] ?></td>
                                <td><?php echo $d['jumlah_barang'] ?></td>
                                <td><?php echo $d['harga_satuan'] ?></td>
                                <td><?php echo $d['harga_total'] ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include 'plugins.php';
?>