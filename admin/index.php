<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);//loại bỏ nhắc nhở lập trình viên  Undefined index...

session_start();
include_once '../core/common.php';

if (!isset($_SESSION['admin-login']) || $_SESSION['admin-login'] == false) {
    echo "<script>location.href='../admin/user/login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> Trang quản trị </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon" />
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
       
     
        <link href="css/pages/dashboard.css" rel="stylesheet">
        <script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="js/jquery-1.7.2.min.js"></script> 
        
    </head>
    <style type="text/css">
        @media print
{
.noprint {display:none;}
    </style>
    <body>
        <div class="navbar navbar-fixed-top noprint">
            <?php include_once './template/header.php'; ?>
        </div>
        <!-- /navbar -->
        <div class="subnavbar noprint">
            <?php
                include_once './template/subnav.php';
            ?>
        </div>
        <!-- /subnavbar -->
        <div class="main">
            <?php
            include_once './include/navigation.php';
            ?>
            <!-- /main-inner --> 
        </div>
        <!-- /main -->
        <div class="footer">
            <?php
            include_once './template/footer.php';
            ?>
        </div>
        <!-- /footer --> 
        <!-- Le javascript
        ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 
        <script src="js/excanvas.min.js"></script> 
        <script src="js/bootstrap.js"></script>
        <script src="js/base.js"></script> 
     
        
</html>
