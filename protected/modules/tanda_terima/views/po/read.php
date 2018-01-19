<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data<small>Tanda Terima</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p><a href="<?php echo Yii::app()->createUrl('tanda_terima/po/create'); ?>" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah dari PO</a></p>
                <hr/>
                <table id="barang-" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>No Po</th>
                            <th>No TTM</th>
                            <th>Waktu</th>
                            <th>Supplier</th>
                            <th>Barang</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['no_po'] ?></td>
                                <td><?php echo $d['nomor_ttm'] ?></td>
                                <td><?php echo $d['tgl_terima'] ?></td>
                                <td><?php echo $d['nama_supplier'] ?></td>
                                <td>
                                    <?php
                                    if (count($d['data_barang']) > 0) {
                                        ?>
                                        <table class="table">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Satuan</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                            </tr>
                                            <?php
                                            foreach ($d['data_barang'] as $db) {
                                                $deskripsi = json_decode($db['deskripsi']);
                                                if (count($deskripsi) > 0) {
                                                    $des = implode(",", $deskripsi);
                                                } else {
                                                    $des = $db['deskripsi'];
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo '['.$db['kode_barang'].'] '.$db['nama_barang'] . ' ' . $des ?></td>
                                                    <td><?php echo $db['nama_satuan'] ?></td>
                                                    <td><?php echo $db['jumlah_terima'] ?></td>
                                                    <td><?php echo number_format($db['harga_satuan']) ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </table>
                                        <?php
                                    } else {
                                        echo '-';
                                    }
                                    ?>

                                </td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn btn-default  btn-sm" title="Edit" href="<?php echo Yii::app()->createUrl('tanda_terima/po/update?id_tt=' . $d['id_tanda_terima']); ?>"><i class="fa fa-edit"></i></a>
                                        <form method="post" class="delete-tanda-terima" style="display: inline">
                                            <input type="hidden" name="mode" value="delete"/>
                                            <input type="hidden" name="id" value="<?php echo $d['id_tanda_terima'] ?>"/>
                                            <button type="submit" class="btn btn-default" title="Delete" ><i class="fa fa-remove"></i> </button>    
                                        </form>
                                    </div>

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
        $('.delete-tanda-terima').submit(function() {
            c = confirm("Apaka anda yakin menghapus data ini?");
            if (c === true) {
                return true;
            } else {
                return false;
            }
            event.preventDefault();
        })
    });
</script>
<?php
include 'plugins.php';
?>