<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Đăng nhập trang quản trị</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes"> 
		<link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon" />
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

        <link href="../css/font-awesome.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <link href="../css/pages/signin.css" rel="stylesheet" type="text/css">

    </head>

    <body>

        <div class="navbar navbar-fixed-top">


        </div> <!-- /navbar -->



        <div class="account-container">

            <div class="content clearfix">

                <form action="check-admin.php" method="post">

                    <h1>Đăng nhập Quản trị</h1>		

                    <div class="login-fields">

                        <p>Điền thông tin đăng nhập Quản trị viên</p>
                        <?php
                            $u="";
                            $p="";
                            if(isset($_COOKIE['admin-username']) && isset($_COOKIE['admin-password']))
                            {
                                $u=$_COOKIE['admin-username'];
                                $p=$_COOKIE['admin-password'];
                            }
                        ?>

                        <div class="field">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" id="username" name="admin-username" value="<?php echo $u;?>" placeholder="Tên đăng nhập" class="login username-field" />
                        </div> <!-- /field -->

                        <div class="field">
                            <label for="password">Mật khẩu:</label>
                            <input type="password" id="password" name="admin-password" value="<?php echo $p;?>" placeholder="Mật khẩu" class="login password-field"/>
                        </div> <!-- /password -->

                    </div> <!-- /login-fields -->

                    <div class="login-actions">

                        <span class="login-checkbox">
                            <input id="ckRemember" name="ckRemember" type="checkbox" class="field login-checkbox" value="" tabindex="4" />
                            <label class="choice" for="Field">Ghi nhớ thông tin đăng nhập</label>
                        </span>

                        <input  type="submit" name="adminlogin" class="button btn btn-success btn-large" value="Đăng nhập"/>
                        
                    </div> <!-- .actions -->



                </form>

            </div> <!-- /content -->

        </div> <!-- /account-container -->
        <script src="../js/jquery-1.7.2.min.js"></script>
        <script src="../js/bootstrap.js"></script>

        <script src="../js/signin.js"></script>

    </body>

</html>
