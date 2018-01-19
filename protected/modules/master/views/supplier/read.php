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


                <a data-target="#modal-supplier" role="button" style="margin: 10px 0px" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Supplier</a>
                <div id="modal-supplier" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="supplierLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="modal-anggota-fasilitasLabel">Form supplier</h3>
                                </div>

                                <fieldset>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_supplier">Nama Supplier<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_supplier" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_pemilik">Pemilik<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_pemilik" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_telephone">No Telephone
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12"name="no_telephone" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_fax">No Fax
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12"name="no_fax" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat_supplier">Alamat<span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <textarea style="height: 150px;width: 100%;resize: none" name="alamat_supplier"></textarea>
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
                        </div>
                    </div>
                </div>
                <hr/>

                <table id="supplier-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>Nama Supplier</th>
                            <th>Nama Pemilik</th>
                            <th>Alamat Supplier</th>
                            <th>No Telephone</th>
                            <th>No Fax</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_supplier as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_supplier'] ?></td>
                                <td><?php echo $d['nama_pemilik'] ?></td>
                                <td><?php echo $d['alamat_supplier'] ?></td>
                                <td><?php echo $d['no_telephone'] ?></td>
                                <td><?php echo $d['no_fax'] ?></td>
                                <td style="width: 150px;text-align: center">
                                    <div>
                                        <button id="button-modal-supplier-edit-<?php echo $d['id_supplier'] ?>" data-target="#modal-supplier-edit-<?php echo $d['id_supplier'] ?>" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-edit"></i> </button>
                                        <div id="modal-supplier-edit-<?php echo $d['id_supplier'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="supplierLabel" data-id="<?php echo $d['id_supplier'] ?>" aria-hidden="true"></div>
                                        <form method="post" style="display: inline">
                                            <input type="hidden" name="mode" value="delete"/>
                                            <input type="hidden" name="id" value="<?php echo $d['id_supplier'] ?>"/>
                                            <button type="submit" class="btn btn-default" title="Delete" ><i class="fa fa-remove"></i> </button>    
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        <script>
                            $(document).ready(function() {
                                $('#modal-supplier-edit-<?php echo $d['id_supplier'] ?>').load('<?php echo Yii::app()->createUrl('master/supplier/updateAjax?id=' . $d['id_supplier']); ?>');
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
        $('#supplier-table').dataTable({
            "lengthChange": true,
            "ordering": false,
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