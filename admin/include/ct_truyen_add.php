<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);//loại bỏ nhắc nhở lập trình viên  Undefined index...
?>
<?php
include_once '../core/CRUD.php';


?>
<?php //Thêm mới dữ liệu vào bảng
$id_truyen=isset($_REQUEST['id'])?$_REQUEST['id']:"";
if (isset($_POST['submit'])  ){
    //upload mutifile
    
   
	//Lấy dữ liệu trên form
	$id_truyen = $_REQUEST['id_truyen'];
    $id_truyen2 = $_REQUEST['id_truyen2'];
    $gia_moi = $_REQUEST['gia_moi'];
    $gia_cu =$_REQUEST['gia_cu'];
    $gia_thue = $_REQUEST['gia_thue'];
	$so_luong=($_REQUEST['so_luong']);
    $ten = $_REQUEST['ten'];
    $dbtruyen = new CRUD();
    //Upload Ảnh
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
    $data = array(  
                    'id_truyen'=>$id_truyen,
                    'id_truyen2'=>$id_truyen2,
                    'ten' =>$ten,
                    'so_luong' => $so_luong,
                        'gia_thue'=>$gia_thue,
                        'gia_moi'=>$gia_moi,
                        'gia_cu'=>$gia_cu,
                    'anh_bia'=>$Hinh_anh,
                    'trang_thai'=>$trang_thai
                );

    //Thực hiện gọi hàm insert, để thêm dữ liệu
    $where = array('id_truyen'=>$id_truyen); 
    $dbtruyen1 = new CRUD();
   $dbtruyen1->select(Table::tbct_truyen,$where);
   $row1=$dbtruyen1->fetch();
   if (isset($row1[0]['id_truyen'])) 
  {
       echo "<script> alert('Id truyện đã tồn tại ');
        location.href='?options=ct_truyen_list';
        </script>";
   }
    elseif( $dbtruyen->insert(Table::tbct_truyen,$data))
        {
		echo "<script> alert('Thêm mới thành công');
		location.href='?options=ct_truyen_list';</script>";	
	}else{
			echo "<script> alert('Lỗi thêm mới');</script>";
	}
}
//===========================================================
?>

<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">    
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Thêm mới truyện</h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <div class="tabbable">
                            <form name="frmthemsanpham" id="edit-profile" class="form-horizontal" 
                            		method="post" enctype="multipart/form-data">
                                <fieldset>
                                  <div class = "control-group">
                                        <label class = "control-label" for = "id_truyen">
                                            Tên truyện </label>
                                        <div class = "controls">
                                            <div class = "btn-group">
                                                <select class = "form-control" name = "id_truyen" 
                                            onChange="location.href='?options=ct_truyen_add&id='+this.value;">
                                            <option value="0">---Tất cả---</option>
                                                <?php    
                                                    $dbloai=new CRUD();
                                                    $dbloai->select(Table::tbtruyen);
                                                    $num=$dbloai->num_rows();
                                                    if($num>0){
                                                        $data1=$dbloai->fetch();
                                                        foreach ($data1 as $row1) {

                                                           echo '<option value="' . $row1['id_truyen'] .' "';
                                                            if($row1['id_truyen']== $id_truyen)  echo "selected"; 
                                                            echo '>' . $row1['ten'] . '</option>';
                                                        }
                                                    }
                                                ?>   
                                       </select>
                                            </div>
                                        </div> <!--/controls -->
                                    </div> <!--/control-group -->
                                    <?php
                                                           $db1 = new CRUD();

                                                         $dk = array('id_truyen' =>$id_truyen , );
                                                         $db1->select(Table::tbtruyen,$dk);
                                                         $row1=$db1->fetch();
                                                        ?>
                                                        <input type="hidden" name="ten" value="<?php echo $row1[0]['ten'] ; ?>">
                                                         <input type="hidden" name="id_truyen2" value="<?php echo $row1[0]['id'] ; ?>">
                                    <div class="control-group">                                         
                                        <label class="control-label" for="so_luong">
                                            Số lượng</label>
                                        <div class="controls">
                                            <input type="number" class="span4"  required="" min="1" max="1000" id="so_luong" 
                                                name="so_luong" required >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                     <div class="control-group">                                         
                                        <label class="control-label" for="gia_moi">
                                            Giá mới</label>
                                        <div class="controls">
                                            <input type="number" class="span4"   id="gia_moi" 
                                                name="gia_moi" required >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                     <div class="control-group">                                         
                                        <label class="control-label" for="gia_cu">
                                           Gia cũ</label>
                                        <div class="controls">
                                            <input type="number" class="span4"  required="" id="gia_cu" 
                                                name="gia_cu"  >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                     <div class="control-group">                                         
                                        <label class="control-label" for="gia_thue">
                                            Giá thuê</label>
                                        <div class="controls">
                                            <input type="number" class="span4"  required=""  id="gia_thue" 
                                                name="gia_thue" required >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class="control-group">                                         
                                        <label class="control-label" for="Hinh_anh">
                                            Hình ảnh</label>
                                        <div class="controls">
                                            <input type="file" class="span4" id="Hinh_anh" 
                                                name="Hinh_anh" required >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    
                                    
                                    <div class = "control-group">
                                        <div class = "form-actions">
                                            <input type = "submit"  name="submit" id="upload" class="upload" class = "btn btn-primary" 
                                                name = "add" value="Thêm mới">
                                            <input type = "reset" class = "btn" value = "Đặt lại" >
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
