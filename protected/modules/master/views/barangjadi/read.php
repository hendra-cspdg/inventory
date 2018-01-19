<?php
include 'breadcumbs.php';
?>
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


                <a data-target="#modal-barang" role="button" style="margin: 10px 0px" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Barang</a>
                <div id="modal-barang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="barangLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

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
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="kode_barang_jadi" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_barang_jadi">Nama Barang<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_barang_jadi" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Nama Barang<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="harga" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi[]">Deskripsi
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12 input-wrap">
                                                <input type="text" class="form-control col-md-4 col-xs-12"name="deskripsi[]" value="">
                                            </div>
                                            <a class="col-md-1 col-sm-1 btn btn-default add-new-input"><i class="fa fa-plus"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_satuan">Satuan<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <select name="id_satuan" class="chosen span5"  data-placeholder="Pilih Satuan..." tabindex="2">
                                                    <option value="">-</option>
                                                    <?php
                                                    foreach ($data_satuan as $d):
                                                        ?>
                                                        <option value="<?php echo $d['id_satuan'] ?>"><?php echo $d['nama_satuan'] ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">

                                        <input type="hidden" name="mode" value="tambah"/>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                        <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                                    </div>
                                    <br/>
                                </fieldset>
                            </form>
                            <script>
                                $(document).ready(function() {
                                    var max_fields = 10; //maximum input boxes allowed
                                    var wrapper = $(".input-wrap"); //Fields wrapper
                                    var add_button = $(".add-new-input"); //Add button ID

                                    var x = 1; //initlal text box count
                                    $(add_button).click(function(e) { //on add input button click
                                        e.preventDefault();
                                        if (x < max_fields) { //max input box allowed
                                            x++; //text box increment
                                            $(wrapper).append('<div><input type="text" class="form-control col-md-4 col-xs-12"name="deskripsi[]" value=""><a class="btn btn-default remove-new-input"><i class="fa fa-minus-circle"></i></a></div>'); //add input box
                                        }
                                    });

                                    $(wrapper).on("click", ".remove-new-input", function(e) { //user click on remove text
                                        e.preventDefault();
                                        $(this).parent('div').remove();
                                        x--;
                                    })
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <hr/>

                <table id="barang-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Material</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_barang_jadi as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['kode_barang_jadi'] ?></td>
                                <td><?php echo $d['nama_barang_jadi'] ?> / <?php echo $d['nama_satuan'] ?></td>
                                <td>Rp. <?php echo number_format($d['harga']) ?></td>
                                <td>
                                    <?php
                                    $deskripsi = json_decode($d['deskripsi']);
                                    if (count($deskripsi) > 0) {
                                        foreach ($deskripsi as $des) {
                                            echo "- " . $des . '<br/>';
                                        }
                                    } else {
                                        echo $d['deskripsi'];
                                    }
                                    ?>
                                </td>
                                <td style="width: 150px;text-align: center">
                                    <div>
                                        <button id="button-modal-barang-edit-<?php echo $d['id_barang_jadi'] ?>" data-target="#modal-barang-edit-<?php echo $d['id_barang_jadi'] ?>" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-edit"></i> </button>
                                        <div id="modal-barang-edit-<?php echo $d['id_barang_jadi'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="barangLabel" data-id="<?php echo $d['id_barang_jadi'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" id="modal-content-barang-edit-<?php echo $d['id_barang_jadi'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" style="display: inline">
                                            <input type="hidden" name="mode" value="delete"/>
                                            <input type="hidden" name="id" value="<?php echo $d['id_barang_jadi'] ?>"/>
                                            <button type="submit" class="btn btn-default" title="Delete" ><i class="fa fa-remove"></i> </button>    
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        <script>
                            $(document).ready(function() {
                                $('#button-modal-barang-edit-<?php echo $d['id_barang_jadi'] ?>').click(function() {
                                    $.ajax({
                                        url: '<?php echo Yii::app()->createUrl('master/barangjadi/updateAjax?id=' . $d['id_barang_jadi']); ?>',
                                        success: function(data) {
                                            $('#modal-content-barang-edit-<?php echo $d['id_barang_jadi'] ?>').html(data);
                                        }
                                    })
                                });

                            });
                        </script>
                        <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#barang-table').dataTable({
            "lengthChange": true,
            "ordering": false,
            "sPaginationType": "full_numbers",
            //"dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "<?php echo Yii::app()->baseUrl; ?>/js/Datatables/tools/swf/copy_csv_xls_pdf.swf"
            }
        });
    });
</script>
<?php
include 'plugins.php';
?>