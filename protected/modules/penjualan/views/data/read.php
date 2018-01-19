<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data<small>Penjualan</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p><a href="<?php echo Yii::app()->createUrl('penjualan/data/create'); ?>" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;&nbsp;Buat Baru</a></p>
                <hr/>
                <table id="barang-" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>No Penjualan</th>
                            <th>Tgl Penjualan</th>
                            <th>Nama Pembeli</th>				
                            <th>Alamat</th>
                            <th>Penjualan</th>
                            <th class="text-center">Barang</th>				
                            <th>Status</th>
                            <th class="text-center">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $d):
                            ?>
                            <tr>
                                <td>
                                    <?php echo $d['nomor_penjualan'] ?><br/><br/>
                                    <a class="btn btn-dark btn-sm" target="_blank" title="Cetak" href="<?php echo Yii::app()->createUrl('penjualan/data/cetak?id=' . $d['id_penjualan']); ?>"><i class="fa fa-print"></i> CETAK</a>
                                </td>
                                <td><?php echo $d['tgl_penjualan'] ?></td>
                                <td><?php echo $d['nama_pembeli'] ?></td>
                                <td><?php echo $d['alamat'] ?></td>                                
                                <td><?php
                                if($d['status_jual']==1){
                                    echo "Eceran";
                                }else if($d['status_jual']==2){
                                    echo "Grosir";
                                }else{
                                    ?>
                                        <span class="label label-danger">Undefined</span>
                                            <?php       
                                }
                                        ?></td>
                                <td>
                                    <?php
                                    if (count($d['data_barang']) > 0) {
                                        ?>
                                        <table class="table table-condensed table-bordered">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Satuan</th>
                                                <th>Jumlah</th>
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
                                                    <td><?php echo '[' . $db['kode_barang_jadi'] . '] ' . $db['nama_barang_jadi'] . ' ' . $des ?></td>
                                                    <td><?php echo $db['nama_satuan'] ?></td>
                                                    <td><?php echo $db['jumlah_barang'] ?></td>
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
                                    <?php
                                    if ($d['status_kirim'] != '') {
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
                                        if ($d['status_kirim'] != '2') {
                                            ?>

                                            <a class="btn btn-default btn-sm" title="Edit" href="<?php echo Yii::app()->createUrl('penjualan/data/update?id=' . $d['id_penjualan']); ?>"><i class="fa fa-edit"></i></a>
                                            <form method="post" class="delete-permintaan-barang" style="display: inline">
                                                <input type="hidden" name="mode" value="delete"/>
                                                <input type="hidden" name="id" value="<?php echo $d['id_penjualan'] ?>"/>
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
        $('.delete-permintaan-barang').submit(function() {
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