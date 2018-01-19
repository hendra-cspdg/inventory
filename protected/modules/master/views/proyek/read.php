<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data<small>Proyek</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>


                <a data-target="#modal-proyek" role="button" style="margin: 10px 0px" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Proyek</a>
                <div id="modal-proyek" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="proyekLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="modal-anggota-fasilitasLabel">Form proyek</h3>
                                </div>

                                <fieldset>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_perusahaan">Nama Perusahaan<span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_perusahaan" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_proyek">Nama Proyek<span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_proyek" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat_proyek">Alamat<span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <textarea style="height: 150px;width: 100%;resize: none" name="alamat_proyek"></textarea>
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

                <table id="proyek-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>Nama Perusaaan</th>
                            <th>Nama Proyek</th>
                            <th>Alamat Proyek</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_proyek as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_perusahaan'] ?></td>
                                <td><?php echo $d['nama_proyek'] ?></td>
                                <td><?php echo $d['alamat_proyek'] ?></td>
                                <td style="width: 150px;text-align: center">
                                    <div>
                                        <button id="button-modal-proyek-edit-<?php echo $d['id_proyek'] ?>" data-target="#modal-proyek-edit-<?php echo $d['id_proyek'] ?>" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-edit"></i> </button>
                                        <div id="modal-proyek-edit-<?php echo $d['id_proyek'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="proyekLabel" data-id="<?php echo $d['id_proyek'] ?>" aria-hidden="true"></div>
                                        <form method="post" style="display: inline">
                                            <input type="hidden" name="mode" value="delete"/>
                                            <input type="hidden" name="id" value="<?php echo $d['id_proyek'] ?>"/>
                                            <button type="submit" class="btn btn-default" title="Delete" ><i class="fa fa-remove"></i> </button>    
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        <script>
                            $(document).ready(function() {
                                $('#modal-proyek-edit-<?php echo $d['id_proyek'] ?>').load('<?php echo Yii::app()->createUrl('master/proyek/updateAjax?id=' . $d['id_proyek']); ?>');
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
        $('#proyek-table').dataTable({
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