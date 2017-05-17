<?php
session_start();
$_SESSION['admin-login'] = false;
unset($_SESSION['admin-Id']);
unset($_SESSION['admin-username']);

echo "<script>location.href='user/login.php';</script>";
?>