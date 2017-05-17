<?php
$options = isset($_REQUEST['options'])?$_REQUEST['options']:"";
switch ($options) {
    case "don_hang_chi_tiet":
        include_once 'include/don_hang_chi_tiet.php';
        break;  
    case "don_hang_list":
        include_once 'include/don_hang_list.php';
        break; 
   
    case "khach_hang_list":
        include_once 'include/khach_hang.php';
        break;  
    case "signout":
        include_once 'user/signout.php';
        break;  
    
    case "login":
        include_once 'user/login.php';
        break;
        

    case "phieu_tra":
        include_once 'phieu_tra.php';
        break;
        case "phieu_tra2":
        include_once 'phieu_tra2.php';
        break;
        case "phieu_tra_list":
        include_once 'phieu_tra_list.php';
        break;
        //loại sản phẩm
    case "loai_truyen_list":
        include_once 'loai_truyen_list.php';
        break;
    
    case "loai_truyen_add":
        include_once 'loai_truyen_add.php';
        break;
    case "loai_truyen_edit":
        include_once 'loai_truyen_edit.php';
        break;  
        //hãng sản xuất
        case "nha_xuat_ban_list":
        include_once 'nha_xuat_ban_list.php';
        break;
    case 'add':
         include_once 'add.php';
        break;
         case "check":
        include_once "include/check.php";
    break;
    case "nha_xuat_ban_add":
        include_once 'nha_xuat_ban_add.php';
        break;
    case "nha_xuat_ban_edit":
        include_once 'nha_xuat_ban_edit.php';
        break;
         case "ct_thue":
        include_once 'ct_thue.php';
        break;
        case "thue_list":
        include_once 'thue_list.php';
        break;
    case "thue_add":
        include_once 'add.php';
        break;
    case "thue_edit":
        include_once 'thue_edit.php';
        break;
        //Tin tức
        case "khach_hang":
        include_once 'tk_khachhang.php';
        break;
    
        
    //======bản sản phẩm 
    
    case "truyen_list":
        include_once 'truyen_list.php';
        break;  
    case "truyen_add":
        include_once 'truyen_add.php';
        break;
     case "truyen_edit":
        include_once 'truyen_edit.php';
        break;
        case "ct_truyen_list":
        include_once 'ct_truyen_list.php';
        break;  
    case "ct_truyen_add":
        include_once 'ct_truyen_add.php';
        break;
     case "ct_truyen_edit":
        include_once 'ct_truyen_edit.php';
        break;


        case "tk_truyen":
        include_once 'tk_truyen.php';
        break;  
    case "doanhthu":
        include_once 'doanhthu.php';
        break;
     
        break;
    
    default:
        
        break;
}
?>