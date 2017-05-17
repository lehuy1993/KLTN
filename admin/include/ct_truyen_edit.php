<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);//loại bỏ nhắc nhở lập trình viên  Undefined index...
?>
<?php
include_once '../core/CRUD.php';
?>
<?php
    if(isset($_REQUEST['masp']))
    { 
        //Lấy mã trên url
        $id_loai1=$_REQUEST['masp'];
        $db=new CRUD();
       $dieukien = array('id' => $id_loai1 , );
        $db->select(Table::tbct_truyen,$dieukien);

        $row_edit=$db->fetch();
      

?>  
<?php  
if(isset($_POST['edit'])){
    //Lấy dữ liệu trên form
    $id = $_REQUEST['masp'];
    $id_truyen2 = $_REQUEST['id_truyen2'];
    $gia_moi = $_REQUEST['gia_moi'];
    $gia_cu =$_REQUEST['gia_cu'];
    $gia_thue = $_REQUEST['gia_thue'];
    $id_truyen=$_REQUEST['id_truyen'];
    $so_luong=$_REQUEST['so_luong'];

    if ($_FILES['Hinh_anh']['name']) {
        # code...
    
    $dataImg = __UploadImage; // folder chứa ảnh
    $max_size = "2000000";   // Dung luong toi da cua file can upload 2M
    $file_name = time() . '_';
    $a = $_FILES["Hinh_anh"]["tmp_name"];
    $b = $_FILES["Hinh_anh"]["type"];
    $c = $_FILES["Hinh_anh"]["name"];
    $d = $_FILES["Hinh_anh"]["size"];
    if (substr($b, 0, 5) == "image") {
        if ($d < $max_size) {               
            move_uploaded_file($a, $dataImg . $file_name . $c);
        } else {
            echo("Dung lượng giới hạn là $max_size KB. File <b>{$c}</b>
                Đã vượt quá giới hạn cho phép <br>");
        }
    } else if (!empty($c)) {
        echo 'File không hợp lệ!';
        return;
    }
    //End Upload Ảnh
    $Hinh_anh=$file_name . $c;
}else{
    
    $Hinh_anh=$file_name.$row_edit[0]['anh_bia'];
}


    //Tạo mảng giá trị thêm mới
    if ($so_luong >= 100) {
            $trang_thai = 'Đủ hàng';
        }
        elseif($so_luong <= 99 && $so_luong >= 30 ){
            $trang_thai='Còn hàng';
        } elseif($so_luong <= 29 && $so_luong >= 1 ){
            $trang_thai='Sắp hết';
        } elseif($so_luong == 0 ){
            $trang_thai='Hết hàng';
        
        }
    
    $dbAction=new CRUD();
    //Tạo mảng giá trị sửa
    $data = array(
                'id_truyen' => $id_truyen,
                'id_truyen2'=>$id_truyen2,
                'so_luong' => $so_luong,
                'anh_bia'=>$Hinh_anh,
                'gia_thue'=>$gia_thue,
                'gia_moi'=>$gia_moi,
                'gia_cu'=>$gia_cu,
                'trang_thai' => $trang_thai,
                
            );
    $where = array('id'=>$id_loai1);
    
    //  Thực thi 
    if($dbAction->update(Table::tbct_truyen,$data,$where))
    {
        echo "<script> alert('Cập nhật dữ liệu thành công');
        location.href='?options=ct_truyen_list';</script>";   
    }else{
        echo "<script> alert('Lỗi sửa đổi dữ liệu!!!');</script>";  
    }
}
?>


<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">    
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-pencil"></i>
                        <h3>Sửa thông tin truyện có mã 
                            <b><font color="#FF0000">                                       
                                [<?php echo $row_edit[0]['id'];?>]</font></b></h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <div class="tabbable">
                            <form name="truyện" id="truyện" class="form-horizontal" 
                                    method="post" enctype="multipart/form-data">
                                  <input  type="hidden" class="span6" id="id_truyen" 
                                                   value="<?php echo $row_edit[0]['id_truyen2'];?>"
                                                   name="id_truyen2" required >
                                <fieldset>
                                <div class="control-group">                                         
                                        <label class="control-label" for="id_truyen">ID truyện</label>
                                        <div class="controls">
                                            <input  type="text" class="span6" id="id_truyen" 
                                                   value="<?php echo $row_edit[0]['id_truyen'];?>"
                                                   name="id_truyen" required >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class="control-group">                                         
                                        <label class="control-label" for="so_luong">Số lượng</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="so_luong" 
                                                   value="<?php echo $row_edit[0]['so_luong'];?>"
                                                   name="so_luong" required >
                                        </div> <!-- /controls -->               
                                    </div>
                                    <div class="control-group">                                         
                                        <label class="control-label" for="gia_moi">Giá mới</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="gia_moi" 
                                                   value="<?php echo $row_edit[0]['gia_moi'];?>"
                                                   name="gia_moi" required >
                                        </div> <!-- /controls -->               
                                    </div>
                                    <div class="control-group">                                         
                                        <label class="control-label" for="gia_cu">Giá cũ</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="gia_cu" 
                                                   value="<?php echo $row_edit[0]['gia_cu'];?>"
                                                   name="gia_cu" >
                                        </div> <!-- /controls -->               
                                    </div>
                                    <div class="control-group">                                         
                                        <label class="control-label" for="gia_thue">Giá thuê</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="gia_thue" 
                                                   value="<?php echo $row_edit[0]['gia_thue'];?>"
                                                   name="gia_thue" required >
                                        </div> <!-- /controls -->               
                                    </div>
                                   
                                <div class="control-group">
                                            <label class="control-label" for="Hinh_anh">
                                               Ảnh bìa</label>

                                            <div class="controls">
                                                <input type="file" class="span4" id="Hinh_anh"
                                                       value="<?php echo $row_edit[0]['anh_bia']; ?>"
                                                       name="Hinh_anh">
                                                <img name="Hinh_anh"  id="Hinh_anh"
                                                    src="/KLTN/public/truyen/<?php echo $row_edit[0]['anh_bia']; ?>"
                                                    style="width:50px ">
                                            </div>
                                            <!-- /controls -->
                                        </div>
                                    <div class = "control-group">
                                        <div class = "form-actions">
                                            <input type = "submit" class = "btn btn-primary" 
                                                   name = "edit" value="Cập nhật">
                                            <input type = "reset" class = "btn btn-warning" 
                                            value = "Quay lại" 
                                            onClick="location.href='?options=ct_truyen_list'" >
                                        </div> <!--/form-actions -->
                                    </div>
                                </fieldset>
                            </form>
                        </div> <!---//tabbable -->
                    </div> <!---//widget-content -->
                </div> <!---//widget -->

            </div> <!---//span12 -->
        </div> <!---//row -->
    </div> <!---//container -->   
</div> <!---//main-inner  -->      
<?php
    }
?>