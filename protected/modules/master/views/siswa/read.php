<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master Siswa</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Siswa</h2>
                <p style="margin: 20px 0px"><a href="<?php echo Yii::app()->createUrl('master/siswa/create'); ?>" class="btn btn"><i class="icon-plus"></i>&nbsp;&nbsp;Tambah Siswa</a></p>
                <table style="margin :10px 0px" id="siswa-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Jenis Kelamin</th>
                            <th>Ortu</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Kekhususan</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Jenis Kelamin</th>
                            <th>Ortu</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Kekhususan</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data_siswa as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_siswa'] ?></td>
                                <td><?php echo $d['nama_kota'] ?><br/> <?php echo date('d-m-Y', strtotime($d['tgl_lahir'])) ?></td>
                                <td><?php echo $d['jenis_kelamin'] == 1 ? "Laki-laki" : "Perempuan" ?></td>
                                <td>Nama : <?php echo $d['nama_ortu'] ?><br/>Pekerjaan : <?php echo $d['pekerjaan_ortu'] ?></td>
                                <td><?php echo $d['nama_agama'] ?></td>
                                <td><?php echo $d['alamat'] ?></td>
                                <td><?php echo $d['kekhususan'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="View" href="<?php echo Yii::app()->createUrl('master/siswa/view?id=' . $d['id_siswa']); ?>" ><i class="icon-search"></i></a>
                                        <a class="btn" title="Edit" href="<?php echo Yii::app()->createUrl('master/siswa/update?id=' . $d['id_siswa']); ?>"><i class="icon-edit"></i></a>
                                        <a class="btn siswa-delete-button" title="Delete" id="<?php echo $d['id_siswa'] ?>" ><i class="icon-remove"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div> <!-- /widget-content -->
        </div> <!-- /widget -->	
    </div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>
<script>
    $(document).ready(function() {
        $('#siswa-datatable').dataTable({
            "lengthChange": true,
        });
        $('#siswa-datatable tbody').on('click', '.siswa-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('master/siswa/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        $('body').html(data);
                    }
                });
        });
    });
</script>