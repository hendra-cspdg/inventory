<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Purchasing Order<small>buat</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" >
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kode_sistem">#ID
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="kode_sistem" data-type="text" data-disabled="true"  data-title="Input data"><?php echo $purchasing_order['kode_sistem'] ?></a>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomor_po">Nomor PO
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="nomor_po" data-type="text" data-disabled="true"  data-title="Input data"><?php echo $purchasing_order['nomor_po'] ?></a>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomor_permintaan">Nomor Permintaan<span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <input type="text" readonly="" value="<?php echo $nomor_pb ?>" class="form-control"/><br/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_supplier">Pilih Supplier<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control"  data-source="<?php echo Yii::app()->createUrl('AjaxData/getJSONSupplier'); ?>"  data-disabled="true" data-value="<?php echo $purchasing_order['id_supplier'] != '' ? $purchasing_order['id_supplier'] : ''; ?>" data-name="id_supplier" data-type="select"  data-title="Input data"></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_on_site">TGL On Site<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="tgl_on_site" data-type="date" data-title="Input data"  data-disabled="true"><?php echo $purchasing_order['tgl_on_site'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_sistem">Waktu Pembuatan
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="form-control" data-name="waktu_sistem" data-type="datetime"  data-title="Input data"  data-disabled="true"><?php echo $purchasing_order['waktu_sistem'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="syarat_pembayaran">Syarat Pembayaran
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field" data-name="syarat_pembayaran" data-rows="4" data-type="textarea" data-title="Input data"  data-disabled="true"><?php echo $purchasing_order['syarat_pembayaran'] ?></a>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat_pengiriman">Alamat Pengiriman
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field" data-name="alamat_pengiriman"  data-rows="8" data-type="textarea"   data-title="Input data"  data-disabled="true"><?php echo $purchasing_order['alamat_pengiriman'] ?></a>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jadwal_nota">Jadwal Nota
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field" data-name="jadwal_nota"  data-rows="4" data-type="textarea" data-title="Input data"  data-disabled="true"><?php echo $purchasing_order['jadwal_nota'] ?></a>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lampiran">Lampiran
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field" data-name="lampiran"  data-rows="8" data-type="textarea"   data-disabled="true" data-title="Input data">NOTA/INVOICE ASLI &#13;&#10; SURAT JALAN ASLI &#13;&#10; TANDA TERIMA MATERIAL ASLI &#13;&#10; COPY PO</a>

                        </div>
                    </div>
                    <div class="ln_solid"></div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data<small>Barang</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <hr/>

                <table id="barang-detail-table" style="width: 98%" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_beli = 0;
                        foreach ($data_barang_detail as $d):
                            $deskripsi = json_decode($d['deskripsi']);
                            if (count($deskripsi) > 0) {
                                $des = implode(",", $deskripsi);
                            } else {
                                $des = $d['deskripsi'];
                            }
                            $total_beli+=$d['harga_total'];
                            ?>
                            <tr>
                                <td><?php echo $d['kode_barang'] ?></td>
                                <td><?php echo $d['nama_barang'] . ' ' . $des ?></td>
                                <td><?php echo $d['nama_satuan'] ?></td>
                                <td><?php echo $d['jumlah_barang'] ?></td>
                                <td class="text-right"><?php echo number_format($d['harga_satuan']) ?></td>
                                <td class="text-right"><?php echo number_format($d['harga_total']) ?></td>
                                <td><?php echo $d['keterangan'] ?></td>
                            </tr>


                            <?php
                        endforeach;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="info">
                            <td colspan="5" class="text-center"><b>TOTAL</b></td>
                            <td class="text-right"><?php echo number_format($total_beli) ?></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <br>
                <form class="form-horizontal form-validation"  method="post" >
                    <div class="ln_solid"></div>
                    <div class="checkbox text-center">
                        <label>
                            <input type="checkbox" class="flat"  name="id_peg_purchasing" value="1" <?php if($purchasing_order['id_peg_purchasing']!='') echo'checked="checked"'; ?> > Purchasing
                        </label>
                        <label>
                            <input type="checkbox" class="flat" name="id_peg_pj" value="1" <?php if($purchasing_order['id_peg_pj']!='') echo'checked="checked"'; ?>> Penanggung Jawab
                        </label>

                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="hidden" name="mode" value="setujui"/>
                            <input type="hidden" name="id" value="<?php echo $purchasing_order['id_purchasing_order'] ?>"/>
                            <a class="btn btn-primary" title="Edit" href="<?php echo Yii::app()->createUrl('purchasing_order/data/readPersetujuan'); ?>">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Purchasing Order</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.editable_field').editable({
            url: '<?php echo Yii::app()->createUrl('purchasing_order/data/saveByField'); ?>',
            pk: <?php echo $purchasing_order['id_purchasing_order'] ?>,
        });
    });
</script>
<?php
include 'plugins.php';
?>