<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tanda Terima<small>manual</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <?php if (Yii::app()->user->hasFlash('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" >
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kode_sistem">Kode Sistem<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="kode_sistem" data-disabled="true" data-type="text"  data-title="Input data"><?php echo $tanda_terima['kode_sistem'] ?></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_supplier">Pilih Supplier<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control"  data-source="<?php echo Yii::app()->createUrl('AjaxData/getJSONSupplier'); ?>" data-value="<?php echo $tanda_terima['id_supplier'] != '' ? $tanda_terima['id_supplier'] : ''; ?>" data-name="id_supplier" data-type="select"  data-title="Input data"></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomor_po">Nomor PO<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" readonly="" value="<?php echo $nomor_po ?>" class="form-control"/><br/>
                            <a id="button-modal-po-pilih" data-target="#modal-po-pilih" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-check-square"></i> Pilih Ref. PO</a>
                            <div id="modal-po-pilih" class="modal fade" role="dialog" aria-labelledby="barangLabel"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" id="modal-content-po-pilih">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomor_surat_jalan">Nomor Surat Jalan
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="nomor_surat_jalan" data-type="text"  data-title="Input data"><?php echo $tanda_terima['nomor_surat_jalan'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomor_ttm">Nomor TTM
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="nomor_ttm" data-type="text" data-title="Input data"><?php echo $tanda_terima['nomor_ttm'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_terima">TGL TTM<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="tgl_terima" data-type="date" data-title="Input data"><?php echo $tanda_terima['tgl_terima'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_sistem">Waktu Pembuatan
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="form-control" data-name="waktu_sistem" data-type="datetime"  data-title="Input data"><?php echo $tanda_terima['waktu_sistem'] ?></a>
                        </div>
                    </div>
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

                <a data-target="#modal-barang-po" role="button" style="margin: 10px 0px" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Manual</a>
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
                                                <select id="barang" name="id_barang" class="form-control js-data-example-ajax" style="width: 98%" data-placeholder="Pilih Barang..."  tabindex="99">
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
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah_terima">Jumlah<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" id="jumlah" class="form-control col-md-4 col-xs-12 validate[required]"name="jumlah_terima" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga_terima">Harga<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="number" id="harga" class="form-control col-md-4 col-xs-12 validate[required]"name="harga_terima" value="">
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
                                        <input type="hidden" name="id_tanda_terima" value="<?php echo $tanda_terima['id_tanda_terima'] ?>"/>
                                        <button type="submit" class="btn btn-primary">Tambah Barang</button>
                                        <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                                    </div>


                                    <br/>


                                </fieldset>
                            </form>

                        </div>


                    </div>


                </div>
                <a id="button-modal-barang-pilih" data-target="#modal-barang-pilih" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-caret-square-o-down"></i> Terima Barang PO</a>
                <div id="modal-barang-pilih" class="modal fade" role="dialog" aria-labelledby="barangLabel"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" id="modal-content-barang-pilih">
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#button-modal-barang-pilih').click(function() {
                            $.ajax({
                                url: '<?php echo Yii::app()->createUrl('tanda_terima/po/pilihBarangDetailAjax?id=' . $tanda_terima['id_tanda_terima']); ?>',
                                success: function(data) {
                                    $('#modal-content-barang-pilih').html(data);
                                }
                            })
                        });

                    });
                </script>
                <hr/>

                <table id="barang-detail-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Jumlah Terima</th>
                            <th>Harga Satuan</th>
                            <th>Harga Total</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_barang_detail as $d):
                            $deskripsi = json_decode($d['deskripsi']);
                            if (count($deskripsi) > 0) {
                                $des = implode(",", $deskripsi);
                            } else {
                                $des = $d['deskripsi'];
                            }
                            ?>
                            <tr>
                                <td><?php echo $d['kode_barang'] ?></td>
                                <td><?php echo $d['nama_barang'] . ' ' . $des ?></td>
                                <td><?php echo $d['nama_satuan'] ?></td>
                                <td><?php echo $d['jumlah_terima'] ?></td>
                                <td><?php echo number_format($d['harga_terima']) ?></td>
                                <td><?php echo number_format($d['harga_total']) ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <button id="button-modal-barang-edit-<?php echo $d['id_tanda_terima_detail'] ?>" data-target="#modal-barang-edit-<?php echo $d['id_tanda_terima_detail'] ?>" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-edit"></i> </button>
                                        <div id="modal-barang-edit-<?php echo $d['id_tanda_terima_detail'] ?>" class="modal fade" role="dialog" aria-labelledby="barangLabel" data-id="<?php echo $d['id_tanda_terima_detail'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" id="modal-content-barang-edit-<?php echo $d['id_tanda_terima_detail'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" style="display: inline">
                                            <input type="hidden" name="mode" value="hapus-barang"/>
                                            <input type="hidden" name="id_ttd" value="<?php echo $d['id_tanda_terima_detail'] ?>"/>
                                            <button type="submit" class="btn btn-default" title="Delete" ><i class="fa fa-remove"></i> </button>    
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        <script>
                            $(document).ready(function() {
                                $('#button-modal-barang-edit-<?php echo $d['id_tanda_terima_detail'] ?>').click(function() {
                                    $.ajax({
                                        url: '<?php echo Yii::app()->createUrl('tanda_terima/po/updateBarangDetailAjax?id=' . $d['id_tanda_terima_detail']); ?>',
                                        success: function(data) {
                                            $('#modal-content-barang-edit-<?php echo $d['id_tanda_terima_detail'] ?>').html(data);
                                        }
                                    })
                                });

                            });
                        </script>
                        <?php
                    endforeach;
                    ?>
                    </tbody>
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
                            <input type="hidden" name="mode" value="update-tanda-terima"/>
                            <input type="hidden" name="id" value="<?php echo $tanda_terima['id_tanda_terima'] ?>"/>
                            <a class="btn btn-primary" title="Edit" href="<?php echo Yii::app()->createUrl('tanda_terima/po/read'); ?>">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Tanda Terima</button>
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
            url: '<?php echo Yii::app()->createUrl('tanda_terima/po/saveByField'); ?>',
            pk: <?php echo $tanda_terima['id_tanda_terima'] ?>
        });
        $('#button-modal-po-pilih').click(function() {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('tanda_terima/po/pilihPO?id_tt=' . $tanda_terima['id_tanda_terima']); ?>',
                success: function(data) {
                    $('#modal-content-po-pilih').html(data);
                }
            })
        });
    });
</script>
<?php
include 'plugins.php';
?>
