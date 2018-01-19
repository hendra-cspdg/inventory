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


                <a data-target="#modal-satuan" role="button" style="margin: 10px 0px" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Satuan</a>
                <div id="modal-satuan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="satuanLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="modal-anggota-fasilitasLabel">Form satuan</h3>
                                </div>

                                <fieldset>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_satuan">Nama<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_satuan" value="">
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

                <table id="satuan-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>Nama Satuan</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_satuan as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_satuan'] ?></td>
                                <td style="width: 150px;text-align: center">
                                    <div>
                                        <button id="button-modal-satuan-edit-<?php echo $d['id_satuan'] ?>" data-target="#modal-satuan-edit-<?php echo $d['id_satuan'] ?>" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-edit"></i> </button>
                                        <div id="modal-satuan-edit-<?php echo $d['id_satuan'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="satuanLabel" data-id="<?php echo $d['id_satuan'] ?>" aria-hidden="true"></div>
                                        <form method="post" style="display: inline">
                                            <input type="hidden" name="mode" value="delete"/>
                                            <input type="hidden" name="id" value="<?php echo $d['id_satuan'] ?>"/>
                                            <button type="submit" class="btn btn-default" title="Delete" ><i class="fa fa-remove"></i> </button>    
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        <script>
                            $(document).ready(function() {
                                $('#modal-satuan-edit-<?php echo $d['id_satuan'] ?>').load('<?php echo Yii::app()->createUrl('master/satuan/updateAjax?id='.$d['id_satuan']); ?>');
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
            $('#satuan-table').dataTable({
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