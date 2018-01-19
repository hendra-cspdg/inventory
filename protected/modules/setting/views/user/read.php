<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>User<small>Buat</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <table id="barang-" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Username</th>
							<th>Password</th>
							<th>Tgl Lahir</th>
                            <th class="text-center">Akses</th>
                            <th class="text-center">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_personil as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['id_role'] ?></td>
                                <td><?php echo $d['nama_user'] ?></td>
                                <td><?php echo $d['username'] ?></td>
								<td><?php 
								$hash=crypt($d['password'],'inventory');
								 echo $hash;
								?></td>
								<td><?php echo $d['tgl_lahir'] ?></td>
								<td>
                                    <?php
                                    if (count($d['data_parent']) > 0) {
                                        ?>
                                        <table class="table table-condensed table-bordered">
                                            <tr>
                                                <th>Label</th>
                                                <th>Url</th>
                                            </tr>
                                            <?php
                                            foreach ($d['data_parent'] as $db) {
											if($db['id_parent_menu']==0){
												?>
                                                <tr>
                                                    <th><?php echo $db['id_menu'].' '.$db['label']?></th>
                                                    <th><?php echo $db['url'] ?></th>
                                                </tr>
                                                <?php
                                            }else{
												?>
                                                <tr>
                                                    <td><?php echo $db['id_menu'].' '.$db['label']?></td>
                                                    <td><?php echo $db['url'] ?></td>
                                                </tr>
											<?php
											}}
                                            ?>
                                        </table>
                                        <?php
                                   } else if(empty($db['id_template'])){
								   ?>
								   <span class="label label-danger">Menu Kosong</span>									
									<?php
									}else{
                                        echo '-';
                                    }
                                    ?>

                                </td>

                                <td style="width: 150px;text-align: center">
                                    <div>
                                        <button id="button-modal-barang-edit-<?php echo $d['id_user'] ?>" data-target="#modal-barang-edit-<?php echo $d['id_user'] ?>" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-edit"></i> </button>
                                        <div id="modal-barang-edit-<?php echo $d['id_user'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="barangLabel" data-id="<?php echo $d['id_user'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" id="modal-content-barang-edit-<?php echo $d['id_user'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" style="display: inline">
                                            <input type="hidden" name="mode" value="delete"/>
                                            <input type="hidden" name="id" value="<?php echo $d['id_user'] ?>"/>
                                            <button type="submit" class="btn btn-default" title="Delete" ><i class="fa fa-remove"></i> </button>    
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        <script>
                            $(document).ready(function() {
                                $('#button-modal-barang-edit-<?php echo $d['id_user'] ?>').click(function() {
                                    $.ajax({
                                        url: '<?php echo Yii::app()->createUrl('setting/user/update?id=' . $d['id_user']); ?>',
                                        success: function(data) {
                                            $('#modal-content-barang-edit-<?php echo $d['id_user'] ?>').html(data);
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
<script>
    $(document).ready(function() {
        $('.delete-data-personil').submit(function() {
            c = confirm("Apaka anda yakin menghapus data ini?");
            if (c === true) {
                return true;
            } else {
                return false;
            }
            event.preventDefault();
        })
    });
</script>
<?php
include 'plugins.php';
?>