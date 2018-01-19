<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data<small>Stok Masuk<</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                
                <table id="barang-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>No Po</th>
                            <th>Tgl Terima</th>
                            <th>No TTM</th>
                            <th>Supplier</th>
                            <th>Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nomor_po'] ?></td>
                                <td><?php echo $d['tgl_terima'] ?></td>
                                <td><?php echo $d['nomor_ttm'] ?></td>
                                <td><?php echo $d['nama_supplier'] ?></td>
                                <td>
                                    <?php
                                    if (count($d['data_barang']) > 0) {
                                        foreach ($d['data_barang'] as $db) {
                                            echo "- " . $db['nama_barang'].' ';
                                            echo $db['jumlah_barang'].' '.$db['nama_satuan'].' @ Rp. ';
                                            echo $db['harga_satuan'];
                                            echo '<br/>';
                                        }
                                    } else {
                                        echo '-';
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