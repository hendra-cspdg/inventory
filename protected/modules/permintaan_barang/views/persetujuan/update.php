<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Template <small>edit</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent">Parent Menu<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <select name="parent" class="chosen span5" id="agama" data-placeholder="Pilih Parent..." tabindex="2">
                                    <option value="">Kosong</option>
                                    <?php
                                    foreach ($data_parent_menu as $d):
                                        ?>
                                        <option value="<?php echo $d['id_menu'] ?>"  <?php if ($menu['id_parent_menu'] == $d['id_menu']) {echo "selected";}?>><?php echo $d['label'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label">Label Menu<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control col-md-4 col-xs-12 validate[required]"name="label" value="<?php echo $menu['label']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL menu<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control col-md-4 col-xs-12 validate[required]" name="url" value="<?php echo $menu['url']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="order">Order Menu<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control col-md-4 col-xs-12 validate[required]" name="order" value="<?php echo $menu['order']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="icon">Icon Menu
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" class="form-control col-md-4 col-xs-12"  name="icon" value="<?php echo $menu['icon']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menu_type">Tipe Menu
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <select name="menu_type" class="chosen span5" data-placeholder="Pilih Tipe..." tabindex="2">
                                <option value="1"  <?php if ($menu['menu_type'] == 1) {echo "selected";}?>>System</option>
                                <option value="2" <?php if ($menu['menu_type'] == 2) {echo "selected";}?>>Process</option>
                            </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a class="btn btn-primary"  href="<?php echo Yii::app()->createUrl('setting/menu/read'); ?>">Back</a>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php
include 'plugins.php';
?>