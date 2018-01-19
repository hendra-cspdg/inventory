<div class="modal-dialog">
    <div class="modal-content">

        <form class="form-horizontal form-validation" action="<?php echo Yii::app()->createUrl('master/satuan/read'); ?>" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="modal-anggota-fasilitasLabel">Form satuan</h3>
            </div>

            <fieldset>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_satuan">Nama<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_satuan" value="<?php echo $satuan['nama_satuan'] ?>">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <input type="hidden" name="mode" value="update"/>
                    <input type="hidden" name="id_satuan" value="<?php echo $id_satuan ?>"/>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
                <br/>
            </fieldset>
        </form>
    </div>
</div>