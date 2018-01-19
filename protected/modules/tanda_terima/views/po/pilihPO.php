
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="modal-anggota-fasilitasLabel">Form Barang</h3>
</div>
<form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
    <div style="width: 100%;height: 340px;overflow: scroll">

        <table id="tt-po" class="table table-striped responsive-utilities jambo_table small">
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
                foreach ($data_tt_po as $d):
                    ?>
                    <tr>
                        <td>
                            <?php echo $d['nomor_po'] ?><br/><br/>
                        </td>
                        <td><?php echo $d['nomor_fpb'] ?></td>
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
                            <span class="label label-success">Disetujui</span>
                            <br/><br/>
                            PJ :
                            <br/>
                            <span class="label label-success">Disetujui</span>


                        </td>
                        <td style="width: 120px;text-align: center">
                            <div>
                                <?php
                                if ($d['id_peg_pj'] != '' && $d['id_peg_purchasing'] != '') {
                                    ?>

                                    <div class="checkbox text-center">
                                        <label>
                                            <input type="checkbox" class="flat"  name="id_po[]" value="<?php echo $d['id_purchasing_order'] ?>" <?php if ($d['id_tanda_terima_po'] != '') echo'checked="checked"'; ?> /> 
                                        </label>
                                    </div>

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
    <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="hidden" name="mode" value="pilih-po"/>
            <button type="submit" class="btn btn-success">Pilih</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#tt-po').dataTable({
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