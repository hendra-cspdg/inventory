<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Permintaaan Barang<small>buat</small></h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kode_sistem">#ID
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="kode_sistem" data-type="text" data-disabled="true"  data-title="Input data"><?php echo $permintaan_barang['kode_sistem'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomor_permintaan">Nomor Permintaan
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-disabled="true"  data-name="nomor_permintaan" data-type="text"  data-title="Input data"><?php echo $permintaan_barang['nomor_permintaan'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_permintaan">TGL FPB
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-disabled="true"  data-name="tgl_permintaan" data-type="date" data-title="Input data"><?php echo $permintaan_barang['tgl_permintaan'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_sistem">Waktu Pembuatan
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="form-control"  data-disabled="true"  data-name="waktu_sistem" data-type="datetime"  data-title="Input data"><?php echo $permintaan_barang['waktu_sistem'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status_kirim">Pengiriman
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-disabled="true"   data-source="[{value: 1, text: 'Dikirim'}, {value: 2, text: 'Ambil Sendiri'}]" data-value="<?php echo $permintaan_barang['status_kirim'] != '' ? $permintaan_barang['status_kirim'] : ''; ?>" data-name="status_kirim" data-type="select"  data-title="Input data"></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status_kirim">Persetujuan
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <?php
                            if ($permintaan_barang['id_peg_apv'] != '') {
                                ?>
                                <span class="form-control label label-success">Sudah</span>
                                <?php
                            } else {
                                ?>
                                <span class="form-control label label-danger">Belum</span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="ln_solid"></div>

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
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>


                <hr/>

                <table id="barang-detail-table" style="width: 80%" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Jumlah Ambil</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_barang_detail as $d):
                            $deskripsi = json_decode($d['deskripsi']);
                            if (count($deskripsi) > 0) {
                                $des = implode(",", $deskripsi);
                            } else {
                                $des = $d['deskripsi'];
                            }
                            ?>
                            <tr>
                                <td><?php echo $d['kode_barang'] ?></td>
                                <td><?php echo $d['nama_barang'] . ' ' . $des ?></td>
                                <td><?php echo $d['nama_satuan'] ?></td>
                                <td><?php echo $d['jumlah_barang'] ?></td>
                                <td><?php echo $d['keterangan'] ?></td>
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
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <br>
                <form class="form-horizontal form-validation"  method="post" >
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="hidden" name="mode" value="update-permintaan"/>
                            <input type="hidden" name="id" value="<?php echo $permintaan_barang['id_permintaan_barang'] ?>"/>
                            <a class="btn btn-primary" title="Edit" href="<?php echo Yii::app()->createUrl('permintaan_barang/baru/readPersetujuan'); ?>">Kembali</a>

                            <?php
                            if ($permintaan_barang['id_peg_apv'] != '') {
                                ?>
                                <button type="submit" class="btn btn-danger">Batalkan</button>
                                <?php
                            } else {
                                ?>
                                <button type="submit" class="btn btn-success">Setujui</button>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.editable_field').editable({
            url: '<?php echo Yii::app()->createUrl('permintaan_barang/baru/saveByField'); ?>',
            pk: <?php echo $permintaan_barang['id_permintaan_barang'] ?>
        });
    });
</script>
<?php
include 'plugins.php';
?>