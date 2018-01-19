                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="modal-anggota-fasilitasLabel">Form USer</h3>
                                </div>

                                <fieldset>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_role">No User<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="id_rol" value="<?php echo $barang['id_role'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_user">Nama<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_user" value="<?php echo $barang['nama_user'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">username<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="username" value="<?php echo $barang['username'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">password<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="password" class="form-control col-md-4 col-xs-12 validate[required]"name="password" value="<?php echo $barang['password'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="email" value="<?php echo $barang['email'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_lahir">Tgl Lahir<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="date" class="form-control col-md-4 col-xs-12 validate[required]"name="tgl_lahir" value="<?php echo $barang['tgl_lahir'] ?>">
                                            </div>
                                        </div>

                                    </div>
        <div class="modal-footer">

            <input type="hidden" name="mode" value="update"/>
            <input type="hidden" name="id_user" value="<?php echo $id_user ?>"/>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
        <br/>
    </fieldset>
</form>
<script>
    $(document).ready(function() {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input-wrap-dialog-<?php echo $barang['id_user'] ?>"); //Fields wrapper
        var add_button = $(".add-new-input-dialog-<?php echo $barang['id_user'] ?>"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" class="form-control col-md-4 col-xs-12"name="deskripsi[]" value=""><a class="btn btn-default col-md-2 col-sm-2 remove-new-input-dialog-<?php echo $barang['id_user'] ?>"><i class="fa fa-minus-circle"></i></a></div>'); //add input box
            }
        });

        $(wrapper).on("click", ".remove-new-input-dialog-<?php echo $barang['id_user'] ?>", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>