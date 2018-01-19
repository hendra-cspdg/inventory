<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Laporan<small>Kartu Stok</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <h3>Filter Data</h3>

                <div class="ln_solid"></div>
                <table id="barang-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Satuan</th>
                            <th>Total Masuk</th>
                            <th>Total Keluar</th>
                            <th>Sisa</th>
                            <th>Nilai Aset</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_barang as $d):
                            $deskripsi = json_decode($d['deskripsi']);
                            if (count($deskripsi) > 0) {
                                $des = implode(",", $deskripsi);
                            } else {
                                $des = $d['deskripsi'];
                            }
                            ?>
                            <tr>
                                <td><?php echo $d['kode_barang'] ?></td>
                                <td><?php echo $d['nama_barang'] ?></td>
                                <td><?php echo $des ?></td>
                                <td><?php echo $d['nama_satuan'] ?></td>
                                <td><?php echo number_format($d['total_terima']) ?></td>
                                <td><?php echo number_format($d['total_ambil']) ?></td>
                                <td><span id="jumlah_<?php echo $d['id_barang'] ?>"><?php echo number_format($d['sisa']) ?></span></td>
                                <td class="text-right"><span class="nilai_aset" id="nilai_aset_<?php echo $d['id_barang'] ?>" data-id="<?php echo $d['id_barang'] ?>"><img src="<?php echo Yii::app()->baseUrl; ?>/images/loading.gif"/></span></td>
                                <td>
                                    <a class="btn btn-default  btn-sm" title="Detail" href="<?php echo Yii::app()->createUrl('laporan/nilai_aset/detail?id=' . $d['id_barang'] ); ?>"><i class="fa fa-list-alt"></i></a>
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
        $('.nilai_aset').each(function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('laporan/nilai_aset/getNilaiBarangAset'); ?>',
                data: 'id=' + id + '&jumlah=' + $('#jumlah_' + id).text(),
                type: 'post',
                success: function(data) {
                    $('#nilai_aset_' + id).text(data);
                },
            });
        })
    });
</script>
<?php
include 'plugins.php';
?>