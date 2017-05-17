<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);//loại bỏ nhắc nhở lập trình viên  Undefined index...

session_start();
echo '<meta charset="utf-8" />';
if (isset($_POST['adminlogin'])) {
    include_once "../../core/CRUD.php";
    $username = $_REQUEST['admin-username'];
    $password = md5(($_REQUEST['admin-password']));
    $remember = $_REQUEST['ckRemember'];
    $adminCRUD = new CRUD();
    $whereadmin = array(
        'tai_khoan' => $username,
        'mat_khau' => $password,
      
    );
    $adminCRUD->select(Table::tbquan_tri, $whereadmin);
    if ($adminCRUD->num_rows() > 0) {
            $admin = $adminCRUD->fetch();      
            $_SESSION['admin-login'] = true;
            $_SESSION['admin-username'] = $username;
            //ghi cookies
            if($remember!=""){
                setcookie("admin-username",$username);
                setcookie("admin-password",$admin[0]['mat_khau']);
            }
            
            echo "<script>alert('Bạn đang đăng nhập tài khoản $username'); 
                location.href = '../index.php';</script>";
      
    } else {
        echo " <script>alert('Tài khoản hoặc mật khẩu của bạn không đúng!'); 
            location.href='login.php';</script>";
    }
}
?>