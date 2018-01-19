<form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="modal-anggota-fasilitasLabel">Form Barang</h3>
    </div>

    <fieldset>
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang"> Barang<span class="required">*</span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <span class="form-control">
                        <input type="hidden" name="id_barang" value="<?php echo $pbd['id_barang'] ?>"/>
                        <?php
                        $deskripsi = json_decode($pbd['deskripsi']);
                        if (count($deskripsi) > 0) {
                            $des = implode(",", $deskripsi);
                        } else {
                            $des = $pbd['deskripsi'];
                        }
                        ?>
                        <?php echo $pbd['kode_barang'] ?>  <?php echo $pbd['nama_barang'] ?>  <?php echo $des ?> 
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Ubah Barang<span class="required">*</span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <select id="barang-<?php echo $pbd['id_produksi_detail'] ?>" name="barang" class="form-control js-data-example-ajax" style="width: 98%" data-placeholder="Pilih Barang..."  tabindex="99">
                        <option value="" selected="selected">Pilih Barang</option>
                    </select>
                    <i class="label label-info">Info : gunakan koma "," untuk pencarian berdasarkan nama dan deskripsi</i>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan_barang">Satuan<span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" readonly="" id="satuan-<?php echo $pbd['id_produksi_detail'] ?>" class="form-control col-md-4 col-xs-12 validate[required]"name="satuan_barang" value="" tabindex="99">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah<span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="number" id="jumlah_ambil" class="form-control col-md-4 col-xs-12 validate[required]"name="jumlah_ambil" value="<?php echo $pbd['jumlah_ambil'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">Keterangan<span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <textarea name="keterangan"><?php echo $pbd['keterangan'] ?></textarea>
                </div>
            </div>

        </div>
        <div class="modal-footer">

            <input type="hidden" name="mode" value="update-barang"/>
            <input type="hidden" name="id_bd" value="<?php echo $pbd['id_produksi_detail'] ?>"/>
            <button type="submit" class="btn btn-primary">Simpan Barang</button>
            <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>


        <br/>


    </fieldset>
</form>
<script>
    $(document).ready(function() {
        $('#barang-<?php echo $pbd['id_produksi_detail'] ?>').select2({
            ajax: {
                url: '<?php echo Yii::app()->createUrl('ajaxData/getJSONBarang'); ?>',
                dataType: 'json',
                data: function(params) {
                    return {
                        q: params.term,
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.text,
                                id: item.id
                            }
                        })
                    };
                }
            },
            minimumInputLength: 1,
        });
        $('#barang-<?php echo $pbd['id_produksi_detail'] ?>').change(function() {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('ajaxData/getSatuanBarang'); ?>',
                data: 'id=' + $(this).val(),
                success: function(respones) {
                    $('#satuan-<?php echo $pbd['id_produksi_detail'] ?>').val(respones);
                }
            })
        });

    });
</script>