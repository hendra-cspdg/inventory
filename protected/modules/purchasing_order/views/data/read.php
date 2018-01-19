<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data<small>Purchasing Order</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p><a href="<?php echo Yii::app()->createUrl('purchasing_order/data/create'); ?>" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;&nbsp;Buat Baru</a></p>
                <hr/>
                <table id="barang-" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>No.PO</th>
                            <th>No.FPB</th>
                            <th>Supplier</th>
                            <th>Tgl On Site</th>
                            <th class="text-center">Barang</th>
                            <th>Persetujuan</th>
                            <th class="text-center">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $d):
                            ?>
                            <tr>
                                <td>
                                    <?php echo $d['nomor_po'] ?><br/><br/>
                                    <a class="btn btn-dark btn-sm" target="_blank" title="Cetak" href="<?php echo Yii::app()->createUrl('purchasing_order/data/cetak?id=' . $d['id_purchasing_order']); ?>"><i class="fa fa-print"></i> CETAK</a>
                                </td>
                                <td><?php echo $d['no_fpb'] ?></td>
                                <td><?php echo $d['nama_supplier'] ?></td>
                                <td><?php echo $d['tgl_on_site'] ?></td>
                                <td>
                                    <?php
                                    if (count($d['data_barang']) > 0) {
                                        ?>
                                        <table class="table table-condensed table-bordered">
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
                                                    <td><?php echo '[' . $db['kode_barang'] . '] ' . $db['nama_barang'] . ' ' . $des ?></td>
                                                    <td><?php echo $db['nama_satuan'] ?></td>
                                                    <td><?php echo $db['jumlah_barang'] ?></td>
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
                                <td style="text-align: center">
                                    Purchasing : <br/>
                                    <?php
                                    if ($d['id_peg_purchasing'] != '') {
                                        ?>
                                        <span class="label label-success">Disetujui</span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="label label-danger">Belum</span>
                                        <?php
                                    }
                                    ?>
                                    <br/><br/>
                                    PJ :
                                    <br/>
                                    <?php
                                    if ($d['id_peg_pj'] != '') {
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
                                    <div>
                                        <?php
                                        if ($d['id_peg_pj'] == '' && $d['id_peg_purchasing'] == '') {
                                            ?>

                                            <a class="btn btn-default btn-sm" title="Edit" href="<?php echo Yii::app()->createUrl('purchasing_order/data/update?id=' . $d['id_purchasing_order']); ?>"><i class="fa fa-edit"></i></a>
                                            <form method="post" class="delete-purchasing-order" style="display: inline">
                                                <input type="hidden" name="mode" value="delete"/>
                                                <input type="hidden" name="id" value="<?php echo $d['id_purchasing_order'] ?>"/>
                                                <button type="submit" class="btn btn-default btn-sm" title="Delete" ><i class="fa fa-remove"></i> </button>    
                                            </form>

                                            <?php
                                        }
                                        ?>
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
        $('.delete-purchasing-order').submit(function() {
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