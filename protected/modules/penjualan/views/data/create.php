<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Penjualan<small>buat</small></h2>
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
                            <a href="#" class="editable_field form-control" data-name="kode_sistem" data-type="text" data-disabled="true"  data-title="Input data"><?php echo $penjualan['kode_sistem'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomor_penjualan">Nomor Penjualan<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="nomor_penjualan" data-type="text"  data-title="Input data"><?php echo $penjualan['nomor_penjualan'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_pembeli">Nama Pembeli<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="nama_pembeli" data-type="text"  data-title="Input data"><?php echo $penjualan['nama_pembeli'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Alamat">Alamat<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="alamat" data-type="text"  data-title="Input data"><?php echo $penjualan['alamat'] ?></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_penjualan">TGL Penjualan<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="tgl_penjualan" data-type="date" data-title="Input data"><?php echo $penjualan['tgl_penjualan'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_sistem">Waktu Pembuatan
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="form-control" data-name="waktu_sistem" data-type="datetime"  data-title="Input data"><?php echo $penjualan['waktu_sistem'] ?></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status_jual">Penjualan<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control"  data-source="[{value: 1, text: 'Eceran'}, {value: 2, text: 'Grosir'}]" data-value="<?php echo $penjualan['status_jual'] != '' ? $penjualan['status_jual'] : ''; ?>" data-name="status_jual" data-type="select"  data-title="Input data"></a>
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


                <a data-target="#modal-barang-permintaan" role="button" style="margin: 10px 0px" class="btn btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Barang</a>
                <div id="modal-barang-permintaan" class="modal fade"  role="dialog" aria-labelledby="barang-permintaanLabel" aria-hidden="true">
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
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="number" id="jumlah" class="form-control col-md-4 col-xs-12 validate[required]"name="jumlah" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">Keterangan<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <textarea name="keterangan"></textarea>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $('#barang').select2({
                                                    ajax: {
                                                        url: '<?php echo Yii::app()->createUrl('ajaxData/getJSONBarangProduksi'); ?>',
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
                                                        url: '<?php echo Yii::app()->createUrl('ajaxData/getSatuanBarangJadi'); ?>',
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
                                        <input type="hidden" name="id_penjualan" value="<?php echo $penjualan['id_penjualan'] ?>"/>
                                        <button type="submit" class="btn btn-primary">Tambah Barang</button>
                                        <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                                    </div>


                                    <br/>


                                </fieldset>
                            </form>

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
                            <th>Keterangan</th>
                            <th>Jumlah Barang</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total='0';
                        $jumlah='0';
                        foreach ($data_barang_detail as $d):
                            $deskripsi = json_decode($d['deskripsi']);
                            if (count($deskripsi) > 0) {
                                $des = implode(",", $deskripsi);
                            } else {
                                $des = $d['deskripsi'];
                            }
                            ?>
                            <tr>
                                <td><?php echo $d['kode_barang_jadi'] ?></td>
                                <td><?php echo $d['nama_barang_jadi'] . ' ' . $des ?></td>
                                <td><?php echo $d['nama_satuan'] ?></td>
                                <td><?php echo $d['keterangan'] ?></td>
                                <td><?php echo $d['jumlah_barang'] ?></td>
                                <td>Rp.<?php echo number_format($d['harga']) ?></td>
                                <td><?php
                                    $total=$d['jumlah_barang']*$d['harga'];
                                    $jumlah=$jumlah+$total;
                                    echo 'Rp.'.number_format($total) ?></td>
                                <td>
                                    <div>
                                        <button id="button-modal-barang-edit-<?php echo $d['id_penjualan_detail'] ?>" data-target="#modal-barang-edit-<?php echo $d['id_penjualan_detail'] ?>" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-edit"></i> </button>
                                        <div id="modal-barang-edit-<?php echo $d['id_penjualan_detail'] ?>" class="modal fade" role="dialog" aria-labelledby="barangLabel" data-id="<?php echo $d['id_penjualan_detail'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" id="modal-content-barang-edit-<?php echo $d['id_barang_jadi'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" style="display: inline">
                                            <input type="hidden" name="mode" value="hapus-barang"/>
                                            <input type="hidden" name="id_bd" value="<?php echo $d['id_penjualan_detail'] ?>"/>
                                            <button type="submit" class="btn btn-default" title="Delete" ><i class="fa fa-remove"></i> </button>    
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        <script>
                            $(document).ready(function() {
                                $('#button-modal-barang-edit-<?php echo $d['id_penjualan_detail'] ?>').click(function() {
                                    $.ajax({
                                        url: '<?php echo Yii::app()->createUrl('penjualan/data/updateBarangDetailAjax?id=' . $d['id_penjualan_detail']); ?>',
                                        success: function(data) {
                                            $('#modal-content-barang-edit-<?php echo $d['id_barang_jadi'] ?>').html(data);
                                        }
                                    })
                                });

                            });
                        </script>
                        <?php
                    endforeach;
                    ?>
                        <tr>
                            <th colspan='6'>Jumlah</th>
                            <td>Rp.<?php echo number_format($jumlah) ?></td>
                            <th>-</th>
                        </tr>
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
                            <input type="hidden" name="mode" value="update-permintaan"/>
                            <input type="hidden" name="id" value="<?php echo $penjualan['id_penjualan'] ?>"/>
                            <a class="btn btn-primary" title="Edit" href="<?php echo Yii::app()->createUrl('penjualan/data/read'); ?>">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan penjualan Barang</button>
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
            url: '<?php echo Yii::app()->createUrl('penjualan/data/saveByField'); ?>',
            pk: <?php echo $penjualan['id_penjualan'] ?>
        });
    });
</script>
<?php
include 'plugins.php';
?>