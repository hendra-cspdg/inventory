<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>User<small>buat</small></h2>
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
                    <fieldset>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomor_permintaan">id_user<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a href="#" class="editable_field form-control" data-name="id_user" data-type="text"  data-title="Input data"><?php echo $personil['id_user'] ?></a>
                        </div>
                    </div>
                        <div class="control-group">											
                            <label class="control-label" for="nama_user">Nama</label>
                            <div class="controls">
                                <input type="text" class="span5 validate[required]" name="id_user" value="<?php echo $personil['nama_user'] ?>" />
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="user">username</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="username" value="<?php echo $personil['username'] ?>" >
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"></label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="nama" value="<?php echo $personil['password'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <br />
                            
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('setting/user/read'); ?>">Cancel</a>
                        </div> <!-- /form-actions -->
                    </fieldset>
                </form>
            </div>

        </div> <!-- /widget-content -->
    </div> <!-- /widget -->	
</div> <!-- /spa12 -->
</div> <!-- /row -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.editable_field').editable({
            url: '<?php echo Yii::app()->createUrl('user/saveByField'); ?>',
            pk: <?php echo $personil['id_user'] ?>
        });
    });
</script>
<?php
include 'plugins.php';
?>