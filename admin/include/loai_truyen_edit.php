<?php
include_once '../core/CRUD.php';
?>
<?php  
if(isset($_POST['edit'])){
	//Lấy dữ liệu trên form
    $id = $_REQUEST['maloai'];
	$id_loai=$_REQUEST['id_loai'];
	$ten=$_REQUEST['ten'];
    $ngay_sua = gmdate("Y/m/d H:i:s",time()+7*3600);
	$trang_thai=$_REQUEST['trang_thai'];
	
	$dbAction=new CRUD();
    //Tạo mảng giá trị sửa
    $data = array(
                'id_loai' => $id_loai,
                'ten' => $ten,
                'trang_thai' => $trang_thai,
                'ngay_sua' =>$ngay_sua
            );
    $where = array('id'=>$id);
    
    //  Thực thi 
    if($dbAction->update(Table::tbloai_truyen,$data,$where))
    {
        echo "<script> alert('Cập nhật dữ liệu thành công');
        location.href='?options=loai_truyen_list';</script>";   
    }else{
        echo "<script> alert('Lỗi sửa đổi dữ liệu!!!');</script>";  
    }
}
?>
<?php
	if(isset($_REQUEST['maloai']))
	{ 
		//Lấy mã trên url
		$id_loai1=$_REQUEST['maloai'];
        $db=new CRUD();
       $dieukien = array('id' => $id_loai1 , );
		$db->select(Table::tbloai_truyen,$dieukien);

        $row_edit=$db->fetch();
      

?>  
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">    
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-pencil"></i>
                        <h3>Sửa thông tin loại truyện có mã 
                            <b><font color="#FF0000">                                       
                                [<?php echo $row_edit[0]['id_loai'];?>]</font></b></h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <div class="tabbable">
                            <form name="loaitruyen" id="loaitruyen" class="form-horizontal" 
                                  	method="post" enctype="multipart/form-data">
                                  <input type="hidden" value="<?php echo $row_edit[0]['id_loai'];?>" 
                                  	name="id_loai" id="id_loai" />
                                <fieldset>
                                <div class="control-group">                                         
                                        <label class="control-label" for="id_loai">ID loại truyện</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="id_loai" 
                                                   value="<?php echo $row_edit[0]['id_loai'];?>"
                                                   name="id_loai" required >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class="control-group">											
                                        <label class="control-label" for="ten">Tên loại truyện</label>
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
                                            onClick="location.href='?options=loai_truyen_list'" >
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