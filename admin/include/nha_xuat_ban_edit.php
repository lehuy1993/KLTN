<?php
include_once '../core/CRUD.php';
?>
<?php  
if(isset($_POST['edit'])){
    //Lấy dữ liệu trên form
    $id = $_REQUEST['ma'];
    $id_nxb=$_REQUEST['id_nxb'];
    $ten=$_REQUEST['ten'];
    $ngay_sua = gmdate("Y/m/d H:i:s",time()+7*3600);
    $trang_thai=$_REQUEST['trang_thai'];
    
    $dbAction=new CRUD();
    //Tạo mảng giá trị sửa
    $data = array(
                'id_nxb' => $id_nxb,
                'ten' => $ten,
                'trang_thai' => $trang_thai,
                'ngay_sua' =>$ngay_sua
            );
    $where = array('id'=>$id);
    
    //  Thực thi 
    if($dbAction->update(Table::tbnha_xuat_ban,$data,$where))
    {
        echo "<script> alert('Cập nhật dữ liệu thành công');
        location.href='?options=nha_xuat_ban_list';</script>";   
    }else{
        echo "<script> alert('Lỗi sửa đổi dữ liệu!!!');</script>";  
    }
}
?>
<?php
    if(isset($_REQUEST['ma']))
    { 
        //Lấy mã trên url
        $id_nxb1=$_REQUEST['ma'];
        $db=new CRUD();
       $dieukien = array('id' => $id_nxb1 , );
        $db->select(Table::tbnha_xuat_ban,$dieukien);

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
                                [<?php echo $row_edit[0]['id_nxb'];?>]</font></b></h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <div class="tabbable">
                            <form name="loaitruyen" id="loaitruyen" class="form-horizontal" 
                                    method="post" enctype="multipart/form-data">
                                  <input type="hidden" value="<?php echo $row_edit[0]['id_nxb'];?>" 
                                    name="id_nxb" id="id_nxb" />
                                <fieldset>
                                <div class="control-group">                                         
                                        <label class="control-label" for="id_nxb">ID NXB</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="id_nxb" 
                                                   value="<?php echo $row_edit[0]['id_nxb'];?>"
                                                   name="id_nxb" required >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class="control-group">                                         
                                        <label class="control-label" for="ten">Tên NXB</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="ten" 
                                                   value="<?php echo $row_edit[0]['ten'];?>"
                                                   name="ten" required >
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
                                            onClick="location.href='?options=nha_xuat_ban_list'" >
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