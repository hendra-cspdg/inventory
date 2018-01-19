
<?php
include 'breadcumbs.php';
?>
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Master <small>Menu</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p><a href="<?php echo Yii::app()->createUrl('setting/menu/create'); ?>" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;&nbsp;Menu</a></p>
                <table id="menu-datatable" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>Parent Menu</th>
                            <th>Label Menu</th>
                            <th>Url Menu</th>
                            <th>Order Menu</th>
                            <th>Icon</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Parent Menu</th>
                            <th>Label Menu</th>
                            <th>Url Menu</th>
                            <th>Order Menu</th>
                            <th>Icon</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data_menu as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['parent_label'] ?></td>
                                <td><?php echo $d['label'] ?></td>
                                <td><?php echo $d['url'] ?></td>
                                <td><?php echo $d['order'] ?></td>
                                <td><?php echo $d['icon'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn btn-default" title="Edit" href="<?php echo Yii::app()->createUrl('setting/menu/update?id=' . $d['id_menu']); ?>"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-default menu-delete-button" title="Delete" id="<?php echo $d['id_menu'] ?>" ><i class="fa fa-remove"></i></a>
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
    <script>
        $(document).ready(function() {
            $('#menu-datatable').dataTable({
                "lengthChange": true,
                "ordering": false,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo Yii::app()->baseUrl; ?>/js/Datatables/tools/swf/copy_csv_xls_pdf.swf"
                }
            });
            $('#menu-datatable tbody').on('click', '.menu-delete-button', function() {
                var c = confirm("Apakah anda yakin menghapus data ini");
                if (c === true)
                    $.ajax({
                        type: 'post',
                        url: '<?php echo Yii::app()->createUrl('setting/menu/delete'); ?>',
                        data: 'id=' + $(this).attr('id'),
                        success: function() {
                            window.location.reload();
                        }
                    });
            });
        });
    </script>
</div>