<?php
include 'breadcumbs.php';
?>
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Master  <small>Template Sistem</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="template-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>Nama Template</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Template</th>
                            <th>-</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php
                        foreach ($data_template as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_template'] ?></td>
                                <td style="width: 170px;text-align: center">
                                    <div>
                                        <a class="btn btn-default" title="Edit" href="<?php echo Yii::app()->createUrl('setting/template_menu/update?id=' . $d['id_template']); ?>"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-default" title="Edit Menu" href="<?php echo Yii::app()->createUrl('setting/template_menu/edit_menu?id=' . $d['id_template']); ?>"><i class="fa fa-list"></i></a>
                                        <a class="btn btn-default template-delete-button" title="Delete" id="<?php echo $d['id_template'] ?>" ><i class="fa fa-remove"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <?php
    include 'plugins.php';
    ?>
    <!-- Datatables -->

    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                $('#template-table').dataTable({
                    "lengthChange": true,
                });
                $('#template-table tbody').on('click', '.template-delete-button', function() {
                    var c = confirm("Apakah anda yakin menghapus data ini");
                    if (c === true)
                        $.ajax({
                            type: 'post',
                            url: '<?php echo Yii::app()->createUrl('setting/template_menu/delete'); ?>',
                            data: 'id=' + $(this).attr('id'),
                            success: function(data) {
                                $('body').html(data);
                            }
                        });
                });
            });
        });


    </script>
</div>