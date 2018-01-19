
<form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="modal-anggota-fasilitasLabel">Form barang</h3>
    </div>

    <fieldset>
        <div class="modal-body">

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kode_barang_jadi">Kode Barang<span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="kode_barang_jadi" value="<?php echo $barang_jadi['kode_barang_jadi'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_barang_jadi">Nama Barang<span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_barang_jadi" value="<?php echo $barang_jadi['nama_barang_jadi'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga<span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="harga" value="<?php echo $barang_jadi['harga'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    ------
                </div>
            </div>


            <?php
            $deskripsi = json_decode($barang_jadi['deskripsi']);
            if (count($deskripsi) > 0) {
                foreach ($deskripsi as $des) {
                    ?>
                    <div class="row" style="margin: 5px">
                        <div class="col-md-4 col-sm-4 col-md-offset-3 col-xs-12">
                            <input type="text" class="form-control col-md-4 col-xs-12"name="deskripsi[]" value="<?php echo $des ?>">
                        </div>
                    </div>
                    <?php
                }
                ?>

                <?php
            } else {
                ?>
                <div class="row" style="margin: 5px">
                    <div class="col-md-4 col-sm-4 col-md-offset-3 col-xs-12 input-wrap-dialog-<?php echo $barang_jadi['id_barang_jadi'] ?>">
                        <input type="text" class="form-control col-md-4 col-xs-12"name="deskripsi[]" value="">
                    </div>
                    <a class="col-md-1 col-sm-1 btn btn-default add-new-input-dialog-<?php echo $barang_jadi['id_barang_jadi'] ?>"><i class="fa fa-plus"></i></a>
                </div>
                <?php
            }
            ?>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_satuan">Satuan<span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <select name="id_satuan" class="form-control"  data-placeholder="Pilih Satuan..." tabindex="2">
                        <option value="">-</option>
                        <?php
                        foreach ($data_satuan as $d):
                            ?>
                            <option value="<?php echo $d['id_satuan'] ?>"  <?php if ($barang_jadi['id_satuan'] == $d['id_satuan']) echo "selected='true'"; ?>><?php echo $d['nama_satuan'] ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>


        </div>
        <div class="modal-footer">

            <input type="hidden" name="mode" value="update"/>
            <input type="hidden" name="id_barang_jadi" value="<?php echo $id_barang_jadi ?>"/>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
        <br/>
    </fieldset>
</form>
<script>
    $(document).ready(function() {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input-wrap-dialog-<?php echo $barang_jadi['id_barang_jadi'] ?>"); //Fields wrapper
        var add_button = $(".add-new-input-dialog-<?php echo $barang_jadi['id_barang_jadi'] ?>"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" class="form-control col-md-4 col-xs-12"name="deskripsi[]" value=""><a class="btn btn-default col-md-2 col-sm-2 remove-new-input-dialog-<?php echo $barang_jadi['id_barang_jadi'] ?>"><i class="fa fa-minus-circle"></i></a></div>'); //add input box
            }
        });

        $(wrapper).on("click", ".remove-new-input-dialog-<?php echo $barang_jadi['id_barang_jadi'] ?>", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>