<div class="modal-dialog">
                        <div class="modal-content">

                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="modal-anggota-fasilitasLabel">Form supplier</h3>
                                </div>

                                <fieldset>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_supplier">Nama Supplier<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_supplier" value="<?php echo $supplier['nama_supplier'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_pemilik">Pemilik<span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_pemilik" value="<?php echo $supplier['nama_pemilik'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_telephone">No Telephone
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12"name="no_telephone" value="<?php echo $supplier['no_telephone'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_fax">No Fax
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12"name="no_fax" value="<?php echo $supplier['no_fax'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat_supplier">Alamat<span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <textarea style="height: 150px;width: 100%;resize: none" name="alamat_supplier"><?php echo $supplier['alamat_supplier'] ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">

                                        <input type="hidden" name="mode" value="update"/>
                                        <input type="hidden" name="id_supplier" value="<?php echo $id_supplier ?>"/>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                                    </div>
                                    <br/>
                                </fieldset>
                            </form>
                        </div>
                    </div>