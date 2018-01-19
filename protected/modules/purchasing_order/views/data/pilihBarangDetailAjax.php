<form class="form-horizontal form-validation" method="post" style="margin: 10px 10px 10px 10px">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="modal-anggota-fasilitasLabel">Form Barang</h3>
    </div>

    <fieldset>
         <?php if (Yii::app()->user->hasFlash('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                <?php endif; ?>
        <div class="modal-body">
            <table id="barang-detail-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>--</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    <?php
                    foreach ($data_barang as $d):
                        $no = 1;
                        $deskripsi = json_decode($d['deskripsi']);
                        if (count($deskripsi) > 0) {
                            $des = implode(",", $deskripsi);
                        } else {
                            $des = $d['deskripsi'];
                        }
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="id_pbd[]" value="<?php echo $d['id_permintaan_barang_detail'] ?>" />
                            </td>
                            <td>(<?php echo $d['kode_barang'] ?>) <?php echo $d['nama_barang'] . ' ' . $des ?></td>
                            <td><?php echo $d['nama_satuan'] ?></td>
                            <td>
                                <input type="number" id="jumlah_<?php echo $d['id_permintaan_barang_detail'] ?>" name="jumlah_<?php echo $d['id_permintaan_barang_detail'] ?>" class="form-control" value="<?php echo $d['jumlah_barang'] ?>" />
                            </td>
                            <td class="text-right">
                                <input type="number" id="harga_satuan_<?php echo $d['id_permintaan_barang_detail'] ?>" data-id="<?php echo $d['id_permintaan_barang_detail'] ?>" name="harga_satuan_<?php echo $d['id_permintaan_barang_detail'] ?>" class="form-control harga_satuan" value="0" />
                            </td>
                            <td class="text-right">
                                <input type="number" id="harga_total_<?php echo $d['id_permintaan_barang_detail'] ?>" readonly="" name="harga_total_<?php echo $d['id_permintaan_barang_detail'] ?>" class="form-control" value="0" />
                            </td>
                            <td><textarea style="resize: none" name="keterangan_<?php echo $d['id_permintaan_barang_detail'] ?>"><?php echo $d['keterangan'] ?></textarea></td>
                        </tr>

                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>

        </div>
        <div class="modal-footer">

            <input type="hidden" name="mode" value="pilih-barang"/>
            <input type="hidden" name="id_purchasing_order" value="<?php echo $purchasing_order['id_purchasing_order'] ?>"/>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>


        <br/>


    </fieldset>
</form>
<script>
    $(document).ready(function() {
        $('.harga_satuan').keyup(function() {
            $('#harga_total_'+$(this).attr('data-id')).val($(this).val() * $('#jumlah_'+$(this).attr('data-id')).val());
        });

    });
</script>