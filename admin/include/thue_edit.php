<?php
include_once '../core/CRUD.php';
?>
<?php  
if(isset($_POST['edit'])){
    //Lấy dữ liệu trên form
    $id = $_REQUEST['ma'];
    $id_ncc=$_REQUEST['id_ncc'];
    $ten=$_REQUEST['ten'];
    $diachi=$_REQUEST['diachi'];
    $sdt=$_REQUEST['sdt'];
    $ngay_sua = gmdate("Y/m/d H:i:s",time()+7*3600);
    $trang_thai=$_REQUEST['trang_thai'];
    
    $dbAction=new CRUD();
    //Tạo mảng giá trị sửa
    $data = array(
                'id_ncc' => $id_ncc,
                'ten' => $ten,
                'diachi' => $diachi,
                'sdt' => $sdt,
                'trang_thai' => $trang_thai,
                'ngay_sua' =>$ngay_sua
            );
    $where = array('id'=>$id);
    
    //  Thực thi 
    if($dbAction->update(Table::tbncc,$data,$where))
    {
        echo "<script> alert('Cập nhật dữ liệu thành công');
        location.href='?options=ncc_list';</script>";   
    }else{
        echo "<script> alert('Lỗi sửa đổi dữ liệu!!!');</script>";  
    }
}
?>
<?php
    if(isset($_REQUEST['ma']))
    { 
        //Lấy mã trên url
        $id_ncc1=$_REQUEST['ma'];
        $db=new CRUD();
       $dieukien = array('id' => $id_ncc1 , );
        $db->select(Table::tbncc,$dieukien);

        $row_edit=$db->fetch();
      

?>  
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">    
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-pencil"></i>
                        <h3>Sửa thông tin  có mã 
                            <b><font color="#FF0000">                                       
                                [<?php echo $row_edit[0]['id_ncc'];?>]</font></b></h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <div class="tabbable">
                            <form name="ncc" id="ncc" class="form-horizontal" 
                                    method="post" enctype="multipart/form-data">
                                  <input type="hidden" value="<?php echo $row_edit[0]['id_ncc'];?>" 
                                    name="id_ncc" id="id_ncc" />
                                <fieldset>
                                <div class="control-group">                                         
                                        <label class="control-label" for="id_ncc">ID NCC</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="id_ncc" 
                                                   value="<?php echo $row_edit[0]['id_ncc'];?>"
                                                   name="id_ncc" required required minlength="3" maxlength="10" >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class="control-group">                                         
                                        <label class="control-label" for="ten">Tên NCC</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="ten" 
                                                   value="<?php echo $row_edit[0]['ten'];?>"
                                                   name="ten" required required minlength="3" maxlength="100">
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class="control-group">                                         
                                        <label class="control-label" for="diachi">Điạ chỉ</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="diachi" 
                                                   value="<?php echo $row_edit[0]['diachi'];?>"
                                                   name="diachi" required required minlength="3" maxlength="50" >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class="control-group">                                         
                                        <label class="control-label" for="sdt">Số điện thoại</label>
                                        <div class="controls">
                                            <input type="number" maxlength="15" minlength="10" class="span6" id="sdt" 
                                                   value="<?php echo $row_edit[0]['sdt'];?>"
                                                   name="sdt" required >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class = "control-group">
                                        <label class = "control-label" for = "trang_thai">
                                            Trạng thái</label>
                                        <div class = "controls">
                                            <div class = "btn-group">
                                                <select class = "form-control" 
                                                        name = "trang_thai" id = "trang_thai">
                                                    <?php 
                                                        if($row_edit[0]['trang_thai']==0){
                                                    ?>
                                                        <option value="1">Hiển thị</option>
                                                        <option value="0" selected>Ẩn </option>
                                                     <?php
                                                        }else{
                                                     ?> 
                                                        <option value="1" selected>Hiển thị</option>
                                                        <option value="0">Ẩn</option>
                                                     <?php
                                                        }
                                                     ?> 
                                                </select>
                                            </div>
                                        </div> <!--/controls -->
                                    </div> <!--/control-group -->
                                    <div class = "control-group">
                                        <div class = "form-actions">
                                            <input type = "submit" class = "btn btn-primary" 
                                                   name = "edit" value="Cập nhật">
                                            <input type = "reset" class = "btn btn-warning" 
                                            value = "Quay lại" 
                                            onClick="location.href='?options=ncc_list'" >
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