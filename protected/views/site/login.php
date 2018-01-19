<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo Yii::app()->baseUrl; ?>/images/icon.jpg" type="image/jpg" sizes="16x16">
        <title>LOGIN - <?php echo CHtml::encode(Yii::app()->name); ?></title>

        <!-- Bootstrap core CSS -->

        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">

        <link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/animate.min.css" rel="stylesheet">

        <!-- Custom styling plus plugins -->
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/custom.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/icheck/flat/green.css" rel="stylesheet">


        <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.min.js"></script>

        <!--[if lt IE 9]>
            <script src="../assets/js/ie8-responsive-file-warning.js"></script>
            <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

    </head>

    <body style="background:#F7F7F7;">

        <div class="">
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>

            <div id="wrapper">
                <div id="login" class="animate form">
                    <section class="login_content">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/inventory.jpg" alt="100x100" style="height: 200px;width: 200px" class="img-circle">
            
                        <form action="<?php echo Yii::app()->request->url ?>" method="post">
                            
                            <h1>Login Form</h1>
                            <?php if (Yii::app()->user->hasFlash('error')): ?>
                                <div class="alert alert-warning">
                                    <?php echo Yii::app()->user->getFlash('error'); ?>
                                </div>
                            <?php endif; ?>

                            <div>
                                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <input type="submit" value="Log In" class="btn btn-default submit"/>
<!--                                <a class="reset_pass" href="#">Lost your password?</a>-->
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">

                                <!--<p class="change_link">New to site?
                                    <a href="#toregister" class="to_register"> Create Account </a>
                                </p>
                                -->
                                <a type="button" href="http://api-google.aldiragil.com/auth.php" class="btn btn-default btn-danger" style="width: 100%"><i class="fa fa-google" style="height: 100%"></i> LOGIN WITH GOOGLE</a>
                                <div class="clearfix"></div>
                                <br />
                                <div>


                                    <p>©2017 All Rights Reserved.</p>
                                </div>
                            </div>
                        </form>
                        <!-- form -->
                    </section>
                    <!-- content -->
                </div>
            </div>
        </div>

    </body>

</html>