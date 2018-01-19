<?php
// AMBIL TEMPLATE USER
$model_user = User::model()->find()->findByAttributes(array('id_user' => Yii::app()->user->id));
$model_template_user = TemplateUser::model()->findByAttributes(array('id_user' => Yii::app()->user->id, 'status_aktif' => '1'));
$model_template = Template::model()->findByAttributes(array('id_template' => $model_template_user->id_template));
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo Yii::app()->baseUrl; ?>/images/icon.jpg" type="image/jpg" sizes="16x16">

        <!-- Bootstrap core CSS -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/fonts/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/animate.min.css" />

        <!-- Custom styling plus plugins -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/select/select2.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/custom.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/icheck/flat/green.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/progressbar/bootstrap-progressbar-3.3.0.css" />
        <link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->baseUrl; ?>/css/chosen.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/validationEngine.jquery.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/datatables/tools/css/dataTables.tableTools.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/editable/bootstrap-editable.css">

        <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/editable/bootstrap-editable.min.js"></script>
        

        <!--[if lt IE 9]>
            <script src="<?php echo Yii::app()->baseUrl; ?>/../assets/js/ie8-responsive-file-warning.js"></script>
            <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="<?php echo Yii::app()->baseUrl; ?>/https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="<?php echo Yii::app()->baseUrl; ?>/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    </head>


    <body class="nav-md">

        <div class="container body">


            <div class="main_container">

                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo Yii::app()->baseUrl; ?>" class="site_title"><span>Inventory</span></a>
                        </div>
                        <div class="clearfix"></div>


                        <!-- menu prile quick info -->
                        <div class="profile">
                            <div class="profile_pic">
                                <img src="<?php echo $model_user['picture']; ?>" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2><?php echo $model_user['nama_user']; ?></h2>
                            </div>
                        </div>
                        <!-- /menu prile quick info -->

                        <br />
                        <div class="clearfix"></div>

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                            <div class="menu_section">
                                <h3>Proses Inventory</h3>
                                <ul class="nav side-menu">
                                    <?php
                                    // MENU USER
                                    if($model_template_user->id_template==1){
                                        $query_menu = "
                                            select m.*
                                            from menu m
                                            where (m.id_parent_menu is null or m.id_parent_menu='0')
                                            and m.menu_type='2'
                                            order by m.order
                                        ";                                        
                                    }else{                                    
                                        $query_menu = "
                                            select m.*
                                            from template_menu tm
                                            join menu m on tm.id_menu=m.id_menu
                                            where tm.id_template='" . $model_template_user->id_template . "'
                                            and (m.id_parent_menu is null or m.id_parent_menu='0')
                                            and m.menu_type='2'
                                            order by m.order
                                        ";                                            
                                    }
                                    $menu = Yii::app()->db->createCommand($query_menu)->queryAll();

                                    // BUAT TAMPILAN MENU UNTUK USER
                                    foreach ($menu as $mu) {
                                        ?>
                                        <?php
                                        // CEK SUBMENU 
                                        if($model_template_user->id_template==1){
                                        $query_submenu = "select * from menu where id_parent_menu='{$mu['id_menu']}' and id_menu in (select id_menu from template_menu)";
                                        }else{
                                            $query_submenu = "select * from menu where id_parent_menu='{$mu['id_menu']}' and id_menu in (select id_menu from template_menu where id_template='" . $model_template_user->id_template . "')";
                                        }
                                        $submenu = Yii::app()->db->createCommand($query_submenu)->queryAll();
                                        if (count($submenu) > 0) {
                                            ?>
                                            <li><a><i class="fa <?php echo $mu['icon'] ?>"></i> <?php echo $mu['label'] ?> <span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu" style="display: none">
                                                    <?php
                                                    foreach ($submenu as $sm) {
                                                        ?>
                                                        <li><a href="<?php echo Yii::app()->createUrl($sm['url']) ?>"><?php echo $sm['label'] ?></a>
                                                        </li>

                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                                <?php
                                            } else {
                                                ?>
                                            <li><a href="<?php echo Yii::app()->createUrl($mu['url']) ?>"><i class="fa <?php echo $mu['icon'] ?>"></i> <?php echo $mu['label'] ?></a>
                                                <?php
                                            }
                                            ?>
                                        </li>

                                        <?php
                                    }
                                    ?>

                                </ul>
                            </div>

                            <div class="menu_section">
                                    <?php
                                    // MENU USER

                                    if($model_template_user->id_template==1){
                                        $query_menu = "
                                    select m.*
                                    from menu m
                                    where (m.id_parent_menu is null or m.id_parent_menu='0')
                                    and m.menu_type='1'
                                    order by m.order
                                    ";
                                        echo '<h3>System</h3>';
                                        }else{
                                        $query_menu = "
                                    select m.*
                                    from template_menu tm
                                    join menu m on tm.id_menu=m.id_menu
                                    where tm.id_template='" . $model_template_user->id_template . "'
                                    and (m.id_parent_menu is null or m.id_parent_menu='0')
                                    and m.menu_type='1'
                                    order by m.order
                                    ";  
                                        }
                                    $menu = Yii::app()->db->createCommand($query_menu)->queryAll();
                                    echo '<ul class="nav side-menu">';
                                    // BUAT TAMPILAN MENU UNTUK USER
                                    foreach ($menu as $mu) {
                                        ?>
                                
                                        <li><a><i class="fa <?php echo $mu['icon'] ?>"></i> <?php echo $mu['label'] ?> <span class="fa fa-chevron-down"></span></a>

                                            <?php
                                            // CEK SUBMENU 
                                            $query_submenu = "select * from menu where id_parent_menu='{$mu['id_menu']}' and id_menu in (select id_menu from template_menu where id_template='" . $model_template_user->id_template . "') ";
                                            $submenu = Yii::app()->db->createCommand($query_submenu)->queryAll();
                                            if (count($submenu) > 0) {
                                                ?>
                                                <ul class="nav child_menu" style="display: none">
                                                    <?php
                                                    foreach ($submenu as $sm) {
                                                        ?>
                                                        <li><a href="<?php echo Yii::app()->createUrl($sm['url']) ?>"><?php echo $sm['label'] ?></a>
                                                        </li>

                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                                <?php
                                            }
                                            ?>
                                        </li>

                                        <?php
                                    }
                                    ?>

                                </ul>
                            </div>

                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->

                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">

                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo $model_user['picture']; ?>" alt=""><?php echo $model_user['nama_user']; ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <!--<li><a href="javascript:;">  Profile</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="badge bg-red pull-right">50%</span>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Help</a>
                                        </li>
                                        -->
                                        <li><a href="<?php echo Yii::app()->createUrl('site/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                        </li>
                                    </ul>
                                </li>
                                <!--
                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green">6</span>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/system-image/person.png" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where... 
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/system-image/person.png" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where... 
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/system-image/person.png" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where... 
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/system-image/person.png" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where... 
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="text-center">
                                                <a>
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                -->

                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">

                    <div class="">
                        <?php echo $content; ?>


                    </div>
                    <div class="clearfix"></div>



                </div>
                <!-- /page content -->
            </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        <script src="<?php echo Yii::app()->baseUrl; ?>/js/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/custom.js"></script>
        <!-- PNotify -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/notify/pnotify.core.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/notify/pnotify.buttons.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/notify/pnotify.nonblock.js"></script>



    </body>

</html>