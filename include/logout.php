
<?php
		session_start();
		unset($_SESSION["login"]);
		unset($_SESSION["tai_khoan"]);
		unset($_SESSION["cart"]);
		echo "<script>location.href='index.php';</script>";

?>