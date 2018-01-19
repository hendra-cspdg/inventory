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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_permintaan">No Permintaan<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="no_permintaan" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="proyek">Proyek<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <select name="proyek" class="chosen span5" id="agama" data-placeholder="Pilih Parent..." tabindex="2">
                                <option value="">-</option>
                                <?php
                                foreach ($data_proyek as $d):
                                    ?>
                                    <option value="<?php echo $d['id_proyek'] ?>" ><?php echo $d['nama_perusahaan'] ?> - <?php echo $d['nama_proyek'] ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_permintaan">TGL Permintaan<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control col-md-4 col-xs-12 validate[required]" name="tgl_permintaan" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_on_site">TGL On Site<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control col-md-4 col-xs-12 validate[required]" name="tgl_on_site" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status_kirim">Status Kirim
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <select name="status_kirim" class="chosen span5" data-placeholder="Pilih Status" tabindex="2">
                                <option value="1">Dikirim</option>
                                <option value="2">Ambil Sendiri</option>
                            </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a class="btn btn-primary"  href="<?php echo Yii::app()->createUrl('setting/menu/read'); ?>">Back</a>
                            <button type="submit" class="btn btn-success">Save</button>
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