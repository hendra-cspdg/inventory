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
                            <a href="#" class="editable_field form-control" data-name="nomor_po" data-type="text"  data-title="Input data"><?php echo $purchasing_order['nomor_po'] ?></a>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomor_permintaan">Nomor Permintaan<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" readonly="" value="<?php echo $nomor_pb ?>" class="form-control"/><br/>
                            <a id="button-modal-fpb-pilih" data-target="#modal-fpb-pilih" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-check-square"></i> Pilih Ref. FPB</a>
                            <div id="modal-fpb-pilih" class="modal fade" role="dialog" aria-labelledby="barangLabel"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" id="modal-content-fpb-pilih">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_supplier">Pilih Supplier<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control"  data-source="<?php echo Yii::app()->createUrl('AjaxData/getJSONSupplier'); ?>" data-value="<?php echo $purchasing_order['id_supplier'] != '' ? $purchasing_order['id_supplier'] : ''; ?>" data-name="id_supplier" data-type="select"  data-title="Input data"></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_on_site">TGL On Site<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="tgl_on_site" data-type="date" data-title="Input data"><?php echo $purchasing_order['tgl_on_site'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_sistem">Waktu Pembuatan
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="form-control" data-name="waktu_sistem" data-type="datetime"  data-title="Input data"><?php echo $purchasing_order['waktu_sistem'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="syarat_pembayaran">Syarat Pembayaran
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field" data-name="syarat_pembayaran" data-rows="4" data-type="textarea" data-title="Input data">SATU BULAN</a>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat_pengiriman">Alamat Pengiriman
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field" data-name="alamat_pengiriman"  data-rows="8" data-type="textarea"   data-title="Input data">JAYA ARTA PRIMA&#13;&#10;MARGOMULYO INDAH, &#13;&#10;KOMPLEK MUTIARA BLOK C 25  &#13;&#10;SURABAYA</a>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jadwal_nota">Jadwal Nota
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field" data-name="jadwal_nota"  data-rows="4" data-type="textarea" data-title="Input data">Selasa, PKL 10.00 - 14.00 WIB</a>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lampiran">Lampiran
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field" data-name="lampiran"  data-rows="8" data-type="textarea" data-disabled="true"  data-title="Input data">NOTA/INVOICE ASLI &#13;&#10; SURAT JALAN ASLI &#13;&#10; TANDA TERIMA MATERIAL ASLI &#13;&#10; COPY PO</a>

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
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>


                <a data-target="#modal-barang-po" role="button" style="margin: 10px 0px" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Barang</a>
                <div id="modal-barang-po" class="modal fade"  role="dialog" aria-labelledby="barang-poLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="modal-anggota-fasilitasLabel">Form Barang</h3>
                                </div>

                                <fieldset>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Pilih Barang<span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <select id="barang" name="barang" class="form-control js-data-example-ajax" style="width: 98%" data-placeholder="Pilih Barang..."  tabindex="99">
                                                    <option value="" selected="selected">Pilih Barang</option>
                                                </select>
                                                <i class="label label-info">Info : gunakan koma "," untuk pencarian berdasarkan nama dan deskripsi</i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan_barang">Satuan<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" readonly="" id="satuan" class="form-control col-md-4 col-xs-12 validate[required]"name="satuan_barang" value="" tabindex="99">
                                            </div>
                                        </div><div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" id="jumlah" class="form-control col-md-4 col-xs-12 validate[required]"name="jumlah" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="number" id="harga" class="form-control col-md-4 col-xs-12 validate[required]"name="harga" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga_total">Harga Total<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="number" id="harga_total" class="form-control col-md-4 col-xs-12 validate[required]"name="harga_total" readonly="" value="0">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="keterangan">Keterangan<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <textarea name="keterangan"></textarea>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $('#harga').keyup(function() {
                                                    $('#harga_total').val($(this).val() * $('#jumlah').val());
                                                });
                                                $('#supplier').select2();
                                                $('#barang').select2({
                                                    ajax: {
                                                        url: '<?php echo Yii::app()->createUrl('ajaxData/getJSONBarang'); ?>',
                                                        dataType: 'json',
                                                        data: function(params) {
                                                            return {
                                                                q: params.term,
                                                            };
                                                        },
                                                        processResults: function(data) {
                                                            return {
                                                                results: $.map(data, function(item) {
                                                                    return {
                                                                        text: item.text,
                                                                        id: item.id
                                                                    }
                                                                })
                                                            };
                                                        }
                                                    },
                                                    minimumInputLength: 1,
                                                });
                                                $('#barang').change(function() {
                                                    $.ajax({
                                                        url: '<?php echo Yii::app()->createUrl('ajaxData/getSatuanBarang'); ?>',
                                                        data: 'id=' + $(this).val(),
                                                        success: function(respones) {
                                                            $('#satuan').val(respones);
                                                        }
                                                    })
                                                });

                                            });
                                        </script>

                                    </div>
                                    <div class="modal-footer">

                                        <input type="hidden" name="mode" value="tambah-barang"/>
                                        <input type="hidden" name="id_purchasing_order" value="<?php echo $purchasing_order['id_purchasing_order'] ?>"/>
                                        <button type="submit" class="btn btn-primary">Tambah Barang</button>
                                        <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                                    </div>


                                    <br/>


                                </fieldset>
                            </form>

                        </div>


                    </div>


                </div>
                <a id="button-modal-barang-pilih" data-target="#modal-barang-pilih" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-check"></i> Pilih Barang FPB</a>
                <div id="modal-barang-pilih" class="modal fade" role="dialog" aria-labelledby="barangLabel"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" id="modal-content-barang-pilih">
                        </div>
                    </div>
                </div>
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
                            <th>-</th>
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
                                <td>
                                    <div>
                                        <button id="button-modal-barang-edit-<?php echo $d['id_purchasing_order_detail'] ?>" data-target="#modal-barang-edit-<?php echo $d['id_purchasing_order_detail'] ?>" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-edit"></i> </button>
                                        <div id="modal-barang-edit-<?php echo $d['id_purchasing_order_detail'] ?>" class="modal fade" role="dialog" aria-labelledby="barangLabel" data-id="<?php echo $d['id_purchasing_order_detail'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" id="modal-content-barang-edit-<?php echo $d['id_barang'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" style="display: inline">
                                            <input type="hidden" name="mode" value="hapus-barang"/>
                                            <input type="hidden" name="id_bd" value="<?php echo $d['id_purchasing_order_detail'] ?>"/>
                                            <button type="submit" class="btn btn-default" title="Delete" ><i class="fa fa-remove"></i> </button>    
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        <script>
                            $(document).ready(function() {
                                $('#button-modal-barang-edit-<?php echo $d['id_purchasing_order_detail'] ?>').click(function() {
                                    $.ajax({
                                        url: '<?php echo Yii::app()->createUrl('purchasing_order/data/updateBarangDetailAjax?id=' . $d['id_purchasing_order_detail']); ?>',
                                        success: function(data) {
                                            $('#modal-content-barang-edit-<?php echo $d['id_barang'] ?>').html(data);
                                        }
                                    })
                                });

                            });
                        </script>
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
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="hidden" name="mode" value="update-purchasing"/>
                            <input type="hidden" name="id" value="<?php echo $purchasing_order['id_purchasing_order'] ?>"/>
                            <a class="btn btn-primary" title="Edit" href="<?php echo Yii::app()->createUrl('purchasing_order/data/read'); ?>">Kembali</a>
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
        $('#button-modal-barang-pilih').click(function() {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('purchasing_order/data/pilihBarangDetailAjax?id=' . $purchasing_order['id_purchasing_order']); ?>',
                success: function(data) {
                    $('#modal-content-barang-pilih').html(data);
                }
            })
        });
        $('#button-modal-fpb-pilih').click(function() {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('purchasing_order/data/pilihFPB?id_po=' . $purchasing_order['id_purchasing_order']); ?>',
                success: function(data) {
                    $('#modal-content-fpb-pilih').html(data);
                }
            })
        });
    });
</script>
<?php
include 'plugins.php';
?>