<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-responsive.min.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.datatables.min.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/chosen.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/datepicker.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/validationEngine.jquery.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/style.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/pages/dashboard.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome.css" rel="stylesheet"/>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"/>
        


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                            class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="<?php echo Yii::app()->baseUrl; ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a>
                    <div class="nav-collapse">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
                                array(
                                    'label' => '<i class="icon-user"></i> Account <b class="caret"></b>',
                                    'url' => '#',
                                    'linkOptions' => array(
                                        'class' => 'dropdown-toggle',
                                        'data-toggle' => 'dropdown',
                                    ),
                                    'itemOptions' => array('class' => 'dropdown'),
                                    'items' => array(
                                        array(
                                            'label' => '<i class="icon-user"></i> My Profile',
                                            'url' => '#'
                                        ),
                                        array(
                                            'label' => '<i class="icon-key"></i> Log Out',
                                            'url' => Yii::app()->createUrl('site/logout'),
                                        ),
                                    )
                                ),
                            ),
                            'encodeLabel' => false,
                            'htmlOptions' => array(
                                'class' => 'nav pull-right',
                            ),
                            'submenuHtmlOptions' => array(
                                'class' => 'dropdown-menu',
                            )
                        ));
                        ?>
                    </div>
                    <!--/.nav-collapse --> 
                </div>
                <!-- /container --> 
            </div>
            <!-- /navbar-inner --> 
        </div>
        <!-- /navbar -->
        <div class="subnavbar">
            <div class="subnavbar-inner">
                <div class="container">
                    <?php
                    // AMBIL TEMPLATE USER
                    $model_template_user = TemplateUser::model()->findByAttributes(array('id_user' => Yii::app()->user->id));

                    // MENU USER
                    $array_menu_user = array();
                    $query_menu = "
                        select m.*
                        from template_menu tm
                        join menu m on tm.id_menu=m.id_menu
                        where tm.id_template='" . $model_template_user->id_template . "'
                        and m.id_parent_menu is null
                        order by m.order
                        ";
                    $menu = Yii::app()->db->createCommand($query_menu)->queryAll();

                    $dashboard_menu = array(
                        'label' => '<i class="icon-dashboard"></i><span>Dashboard</span>',
                        'url' => Yii::app()->createUrl('dashboard')
                    );

                    array_push($array_menu_user, $dashboard_menu);
                    // BUAT TAMPILAN MENU UNTUK USER
                    foreach ($menu as $mu) {

                        // CEK SUBMENU 
                        $query_submenu = "select * from menu where id_parent_menu='{$mu['id_menu']}'";
                        $submenu = Yii::app()->db->createCommand($query_submenu)->queryAll();
                        if (count($submenu) > 0) {
                            $array_submenu = array();
                            foreach ($submenu as $sm) {
                                array_push($array_submenu, array(
                                    'label' => $sm['label'],
                                    'url' => Yii::app()->createUrl($sm['url'])
                                ));
                            }
                            array_push($array_menu_user, array(
                                'label' => "<i class='{$mu['icon']}'></i><span>{$mu['label']}</span> <b class='caret'></b>",
                                'url' => '#',
                                'linkOptions' => array(
                                    'class' => 'dropdown-toggle',
                                    'data-toggle' => 'dropdown',
                                ),
                                'itemOptions' => array('class' => 'dropdown'),
                                'items' => $array_submenu
                            ));
                        } else {
                            array_push($array_menu_user, array(
                                'label' => "<i class='{$mu['icon']}'></i><span>{$mu['label']}</span>",
                                'url' => Yii::app()->createUrl($mu['url'])
                            ));
                        }
                    }
                    // SELESAI BUAT MENU

                    $this->widget('zii.widgets.CMenu', array(
                        'items' => $array_menu_user,
                        'encodeLabel' => false,
                        'htmlOptions' => array(
                            'class' => 'main-nav',
                        ),
                        'submenuHtmlOptions' => array(
                            'class' => 'dropdown-menu',
                        )
                    ));
                    ?>
                </div>
                <!-- /container --> 
            </div>
            <!-- /subnavbar-inner --> 
        </div>
        <!-- /subnavbar -->
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <?php echo $content; ?>
                    <!-- /row --> 
                </div>
                <!-- /container --> 
            </div>
            <!-- /main-inner --> 
        </div>
        <!-- /main -->
        <!-- /extra -->
        <div class="footer">
            <div class="footer-inner">
                <div class="container">
                    <div class="row">
                        <div class="span12"> &copy; 2014 <a href="http://www.facebook.com/nambisembilu">Matooh Team</a>. </div>
                        <!-- /span12 --> 
                    </div>
                    <!-- /row --> 
                </div>
                <!-- /container --> 
            </div>
            <!-- /footer-inner --> 
        </div>
        <!-- /footer --> 


    </body>
</html>