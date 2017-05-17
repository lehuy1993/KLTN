
<?php
include_once '../core/CRUD.php';
?>
<?php //Thêm mới dữ liệu vào bảng
if(isset($_POST['add'])){
	//Lấy dữ liệu trên form
	$id_nxb=$_REQUEST['id_nxb'];
	$ten=$_REQUEST['ten'];
    $diachi=$_REQUEST['diachi'];
    $ngay_tao = gmdate("Y/m/d H:i:s",time()+7*3600);
	$trang_thai=$_REQUEST['trang_thai'];
	
    $dbAction=new CRUD();
	//Tạo mảng giá trị thêm
    $data = array(
                'id_nxb'=> $id_nxb,
                'ten' => $ten,
                'diachi'=>$diachi,
                'ngay_tao'=>$ngay_tao,
                'ngay_sua'=>$ngay_tao,
                'trang_thai' => $trang_thai,
            );
	
	//	Thực thi 
	if($dbAction->insert(Table::tbnha_xuat_ban,$data))
	{
		echo "<script> alert('Thêm mới thành công');
		location.href='?options=nha_xuat_ban_list';</script>";	
	}else{
		echo "<script> alert('Lỗi thêm mới!!');</script>";	
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
                        <h3>Thêm mới </h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <div class="tabbable">
                            <form name="nxb" id="nxb" class="form-horizontal" 
                                  method="post" enctype="multipart/form-data">
                                <fieldset>
                                 <div class="control-group">                                            
                                        <label class="control-label" for="id_nxb">Id nhà xuất bản</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="id_nxb" 
                                                   name="id_nxb" required>
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class="control-group">											
                                        <label class="control-label" for="ten">Tên nhà xuất bản</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="ten" 
                                                   name="ten" required>
                                        </div> <!-- /controls -->
                                         </div> <!-- /control-group -->	
                                     <div class="control-group">                                            
                                        <label class="control-label" for="diachi">Địa chỉ</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="diachi" 
                                                   name="diachi" required>
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->			
                                   
                                    <div class = "control-group">
                                        <label class = "control-label" for = "trang_thai">
                                            Trạng thái</label>
                                        <div class = "controls">
                                            <div class = "btn-group">
                                                <select class = "form-control" 
                                                        name = "trang_thai" id = "trang_thai">
                                                    <option value="1"> Hiện </option>
                                                    <option value="0"> Ẩn </option>
                                                </select>
                                            </div>
                                        </div> <!--/controls -->
                                    </div> <!--/control-group -->
                                    <div class = "control-group">
                                        <div class = "form-actions">
                                            <input type = "submit" class = "btn btn-primary" 
                                                   name = "add" value="Thêm mới">
                                            <input type = "reset" class = "btn btn-warning" value = "Đặt lại" >
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
                    