<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data<small>Barang Mentah</small></h2>
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
                            <th>Stok Masuk</th>
                            <th>Stok Keluar</th>
                            <th>Sisa</th>
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
                            $sisa=$d['total_terima'] - $d['total_ambil'];
                            ?>
                            <tr>
                                <td><?php echo $d['kode_barang'] ?></td>
                                <td><?php echo $d['nama_barang'] ?></td>
                                <td><?php echo $des ?></td>
                                <td><?php echo $d['nama_satuan'] ?></td>
                                <td><?php echo number_format($d['total_terima']) ?></td>
                                <td><?php echo number_format($d['total_ambil']) ?></td>
                                <td><?php echo number_format($sisa) ?></td>
                                <td>
                                    <a class="btn btn-default  btn-sm" title="Detail" href="<?php echo Yii::app()->createUrl('barang/data/detail?id=' . $d['id_barang'].'&s='.$sisa); ?>"><i class="fa fa-list-alt"></i></a>
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
    });
</script>
<?php
include 'plugins.php';
?>