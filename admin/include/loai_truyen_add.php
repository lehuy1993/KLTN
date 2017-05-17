<?php
include_once '../core/CRUD.php';
?>
<?php //Thêm mới dữ liệu vào bảng
if(isset($_POST['add'])){
	//Lấy dữ liệu trên form
	$ID = $_REQUEST['Id'];
	$ten=$_REQUEST['ten'];
	$trang_thai=$_REQUEST['trang_thai'];
	$ngay_tao = gmdate("Y/m/d H:i:s",time()+7*3600);
    $dbAction=new CRUD();
	//Tạo mảng giá trị thêm
    $data = array(
                'id_loai' =>$ID,
                'ten' => $ten,
                'trang_thai' => $trang_thai,
                'ngay_tao'=>$ngay_tao,
                'ngay_sua'=>$ngay_tao
            );
	
	//	Thực thi 
	if($dbAction->insert(Table::tbloai_truyen,$data))
	{
		echo "<script> alert('Thêm mới thành công');
		location.href='?options=loai_truyen_list';</script>";	
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
                            <form name="loaitruyen" id="loaitruyen" class="form-horizontal" 
                                  method="post" enctype="multipart/form-data">
                                <fieldset>
                                <div class="control-group">                                         
                                        <label class="control-label" for="Id">ID loại truyện</label>
                                        <div class="controls">
                                            <input required="" maxlength="10"  type="text" class="span6" id="Id" 
                                                   name="Id" required>
                                        </div> 
                                </div>
                                <!-- /controls -->   
                                    <div class="control-group">											
                                        <label class="control-label" for="ten">Tên loại truyện</label>
                                        <div class="controls">
                                            <input required="" maxlength="100" minlength="5" type="text" class="span6" id="ten" 
                                                   name="ten" required>
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
                    