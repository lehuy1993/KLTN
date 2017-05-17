<?php 	include_once 'core/CRUD.php'; 
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);//loại bỏ nhắc nhở lập trình viên  Undefined index...
include_once 'core/Pagination.php'; 
session_start();?>
<!DOCTYPE html>
<!-- saved from url=(0042)#frontpage -->
<html lang="en" ><!--<![endif]--><head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta http-equiv="content-language" content="vi">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="robots" content="noodp,index,follow">
		<meta name="revisit-after" content="1 days">
	
		<!-- Web Fonts & Font Awesome
============================================================================== -->
		<link href="css/css.css" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
		<link href="css/font-awesome.css" rel="stylesheet">
		
		<!-- CSS styles | Thứ tự bootstrap.css trước custom.css sau
============================================================================== -->	
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

		
		<link href="css/slick.css" rel="stylesheet" type="text/css">
		<link href="css/main.css" rel="stylesheet" type="text/css">

		<link href="css/bootstrap-select.css" rel="stylesheet" type="text/css">
		<script src="js/jquery-3.2.1.min.js"></script> 


		

	
		
	</head>

	<body>	
		<script src="js/owl.carousel.js" type="text/javascript"></script>
		
		<div id="page-wrapper">
			<!-- SITE HEADER
=========================================================================== -->

			<?php
				if(isset($_SESSION['login'])){
                        include_once "include/login_success.php";
                        
                    }else
			 include_once './template/header.php'; ?>

		<!-- Navigation menu -->
			<?php include_once './template/menu.php'; ?>	
		<!-- /Navigation menu -->
				
		</div>
			<!-- /SITE HEADER -->

			<!-- SITE CONTENT
=========================================================================== -->
			<div id="site-content">
				<div id="main">
					<?php include_once './template/conntent.php'; ?>
					

				</div>
			</div>
			<!-- /SITE CONTENT -->

			<!-- SITE FOOTER
=========================================================================== -->
			<footer id="footer" class="footer">
      <div class="container">
		  <span>© Bản quyền thuộc về FITA| Cung cấp bởi <a  target="_blank" title="Thanh Hoa">Thanh Hoa</a></span>
		  
		 
		</div>
    </div>
  </footer>
			<!-- /SITE FOOTER -->
		</div>
		  <script src="/js/jquery.js"></script>
		<script src="js/bootstrap.js" type="text/javascript"></script>

		<script src="js/main.js" type="text/javascript"></script>

		 



