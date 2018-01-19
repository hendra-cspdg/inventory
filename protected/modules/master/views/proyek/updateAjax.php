<div class="modal-dialog">
                        <div class="modal-content">

                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="modal-anggota-fasilitasLabel">Form proyek</h3>
                                </div>

                                <fieldset>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_perusahaan">Nama Perusahaan<span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_perusahaan" value="<?php echo $proyek['nama_perusahaan'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_proyek">Nama Proyek<span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="nama_proyek" value="<?php echo $proyek['nama_proyek'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat_proyek">Alamat<span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <textarea style="height: 150px;width: 100%;resize: none" name="alamat_proyek"><?php echo $proyek['alamat_proyek'] ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">

                                        <input type="hidden" name="mode" value="update"/>
                                        <input type="hidden" name="id_proyek" value="<?php echo $id_proyek ?>"/>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                                    </div>
                                    <br/>
                                </fieldset>
                            </form>
                        </div>
                    </div>