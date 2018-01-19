
<?php
include 'breadcumbs.php';
?>
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Permintaan Barang<small>Data</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p><a href="<?php echo Yii::app()->createUrl('permintaan_barang/baru/create'); ?>" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;&nbsp;Buat Draft</a></p>
                <table id="permintaan-barang-datatable" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>No Permintaan</th>
                            <th>Proyek/Perusahaan</th>
                            <th>Tgl Permintaan</th>
                            <th>Pengiriman</th>
                            <th>Status Permintaan</th>
                            <th style="width: 180px">-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nomor_permintaan'] ?></td>
                                <td><?php echo $d['nama_perusahaan'] . ' ' . $d['nama_proyek'] ?></td>
                                <td><?php echo $d['tgl_permintaan'] ?></td>
                                <td style="text-align: center"><?php echo $d['status_kirim'] == 1 ? '<span class="label label-primary">Dikirim</span>' : '<span class="label label-primary">Ambil Sendiri</span>'; ?></td>
                                <td style="text-align: center">
                                    <?php
                                    if ($d['id_peg_apv'] != '') {
                                        ?>
                                        <span class="label label-success">Disetujui</span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="label label-danger">Belum</span>
                                        <?php
                                    }
                                    ?>


                                </td>
                                <td style="width: 120px;text-align: center">
                                    <?php
                                    if ($d['id_peg_apv'] == '') {
                                        ?>
                                        <div>
                                            <a class="btn btn-default btn-sm" title="Edit" href="<?php echo Yii::app()->createUrl('permintaan_barang/persetujuan/setujui?id=' . $d['id_permintaan_barang']); ?>"><i class="fa fa-check-circle"></i></a>
                                            <a class="btn btn-default btn-sm" title="Edit" href="<?php echo Yii::app()->createUrl('permintaan_barang/baru/update?id=' . $d['id_permintaan_barang']); ?>"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-default btn-sm menu-delete-button" title="Delete" id="<?php echo $d['id_permintaan_barang'] ?>" ><i class="fa fa-remove"></i></a>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <?php
    include 'plugins.php';
    ?>
    <script>
        $(document).ready(function() {
            $('#permintaan-barang-datatable').dataTable({
                "lengthChange": true,
                "bSort": false,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo Yii::app()->baseUrl; ?>/js/Datatables/tools/swf/copy_csv_xls_pdf.swf"
                }
            });
            $('#permintaan-barang-datatable tbody').on('click', '.menu-delete-button', function() {
                var c = confirm("Apakah anda yakin menghapus data ini");
                if (c === true)
                    $.ajax({
                        type: 'post',
                        url: '<?php echo Yii::app()->createUrl('permintaan_barang/persetujuan/delete'); ?>',
                        data: 'id=' + $(this).attr('id'),
                        success: function() {
                            window.location.reload();
                        }
                    });
            });
        });
    </script>
</div>