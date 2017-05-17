<?php
$options = isset($_REQUEST['options'])?$_REQUEST['options']:"";
switch ($options) {
     case "dangnhap":
        include_once "include/dangnhap.php";
    break;
    case "gioithieu":
        include_once "include/gioithieu.php";
    break;
     case "lienhe":
        include_once "include/lienhe.php";
    break;
     case "dangky":
        include_once "include/dangky.php";
    break;
    case "sanpham":
        include_once "include/sanpham.php";
    break;
    case "huongdan":
        include_once "include/huongdan.php";
    break;
    case "giohang":
        include_once "include/giohang.php";
    break;
    case "checkcart":
        include_once "include/checkcart.php";
    break;
    case "loaitruyen":
        include_once "include/loaitruyen.php";
    break;
    case "addcart":
        include_once "include/addcart.php";
    break;
    case "logout":
        include_once "include/logout.php";
    break;
    case "taikhoan":
        include_once "include/taikhoan.php";
    break;
    case "ct_hoadon":
        include_once "include/ct_hoadon.php";
    break;
    case "search":
        include_once "include/result.php";
         break;
    default:
        include_once "template/default.php";
        break;
}
?>
