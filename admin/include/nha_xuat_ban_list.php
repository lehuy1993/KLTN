<?php
	include_once '../core/CRUD.php';
?>
<?php
$db = new CRUD();
    // Lấy dữ liệu tìm kiếm -> tạo chuỗi điều kiện tìm
    $dieukien =" 1=1 "; 
    $keyword_Id=isset($_REQUEST['keyword_Id'])?$_REQUEST['keyword_Id']:"";
    $keyword_Name=isset($_REQUEST['keyword_Name'])?$_REQUEST['keyword_Name']:"";
    if($keyword_Id!="")
        $dieukien .=" and id_nxb like '%$keyword_Id%' ";
    if($keyword_Name!="")
        $dieukien .=" and ten like '%$keyword_Name%'";
    //-----------
$loaisp=$db->select(Table::tbnha_xuat_ban,$dieukien);
$numrow = $db->num_rows();
?>
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">      	
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Quản lý nhà xuất bản</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li  class="active">
                                <a href="#jsnhaxuatbanlist" data-toggle="tab">
                                    Danh sách nhà xuất bản 
                                    	<b><font color="#FF0000">
                                    	[<?php echo $numrow; ?>]</font></b></a> 
                                </li>                                 
                                <form method="post" action="?options=nha_xuat_ban_list"
                                    class="form-inline" role="form" 
                                    style="margin-top:5px; text-align:right">
                                    <input type="text" name="keyword_Id" id="keyword_Id" 
                                        class="form-control search "  
                                        value="<?php echo $keyword_Id;?>"
                                        placeholder="Nhập mã...">
                                    <input type="text" name="keyword_Name" id="keyword_Name" 
                                        class="form-control search" 
                                        value="<?php echo $keyword_Name;?>"
                                        placeholder="Nhập tên...">
                                    
                                    <input type="submit" class="btn-success "  
                                        value="Tìm kiếm"/>
                                </form>                            
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="jsnhaxuatbanlist">
                                    <table class="table table-striped table-bordered ">
                                        <thead>
                                           <tr align="center">
                                                <th class="td-actions">
                                                <input type="checkbox" id="checkAll" name="chk_All" /></th>
                                                <th class="td-actions"> Id NXB  </th>
                                                <th class="td-actions"> Tên NXB </th>
                                                <th class="td-actions"> Địa chỉ </th>
                                                <th class="td-actions"> Ngày tạo </th>
                                                <th class="td-actions"> Ngày sửa </th>
                                                <th class="td-actions"> Trạng thái  </th>
                                                <th class="td-actions"> Thao tác </th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php	
                                                //Kiểm tra xem có dữ liệu hay không,
                                                if($numrow>0){
													 //Nếu có dữ liệu
													$data=$db->fetch(); 
                                                // đọc từng dòng dữ liệu và hiển thị
                                                    foreach($data as $row){
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <input type="checkbox" 
                                                        	id="chk_<?php echo $row['id'];?>" 
                                                            name="chk_<?php echo $row['id'];?>" />
                                                    </td>
                                                    <td style="text-align: center;">
                                                    	<?php echo $row['id_nxb'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['ten'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['diachi'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['ngay_tao'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['ngay_sua'];?>
                                                    </td>
                                                    
                                                    <td style="text-align: center;width:20%">
                                                        <select name="Trang_thai" style="width:50%"
                                                        onChange="location.href='?options=nha_xuat_ban_list&action=edit&ma=<?php  echo $row['id'];?>&trangthai='+this.value">
                                                        <?php 
                                                            if($row['trang_thai']==0)
                                                            {
                                                        ?>
                                                            <option value="1">Đang hiện</option>
                                                            <option value="0" selected>Đang ẩn </option>
                                                         <?php
                                                            }else{
                                                         ?> 
                                                            <option value="1" selected>Đang hiện</option>
                                                            <option value="0">Đang ẩn</option>
                                                         <?php
                                                            }
                                                         ?> 
                                                         </select>                                                    	
                                                    </td>
                                                    <td class="td-actions">
                                                        <a href="?options=nha_xuat_ban_edit&ma=<?php echo $row['id'];?>" 
                                                           class="btn btn-small btn-warning" 
                                                           title="Chỉnh sửa nhà xuất bản có mã[<?php echo $row['id'];?>]">
                                                            <i class="btn-icon-only fa fa fa-pencil"> </i>
                                                        </a>

                                                        
                                                        <a href="?options=nha_xuat_ban_list&action=del&ma=<?php echo $row['id'];?>" 
                                                        onClick="if(confirm('Bạn có chắc chắn muốn xóa nhà xuất bản có mã là [<?php echo $row['id'];?>] không?')){ location.href='?options=nha_xuat_ban_list&action=del&ma=<?php echo $row['id'];?>'}"
                                                            class="btn btn-small btn-warning" 
                                                            title="Xóa nhà xuất bản có mã[<?php echo $row['id'];?>]">
                                                            <i class="btn-icon-only fa fa fa-times"> </i>
                                                        </a>
                                                    </td>
                                                </tr>
												 <?php
                                                        }// end while
                                                    }// 
                                                    else{		
                                                 ?>
 												<tr>
                                                	<td colspan="5"> 
                                                    	Không có nhà xuất bản nào! 
                                                    </td>
                                                </tr>   
  												<?php }//end if ?>                           
  
                                        </tbody>
                                    </table>
                                </div>  
                            </div>
                        </div>
                        
                    </div> <!-- /widget-content -->
                </div> <!-- /widget -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main-inner -->
<?php
	// Lấy hành động
	$action=isset($_REQUEST['action'])?$_REQUEST['action']:"";
	
	// Phần xử lý cho chức năng cập nhật trạng thái 
	// Khi thay đổi trên comboBox trạng thái
	//1. Lấy mã cần cập nhật
	$id=isset($_REQUEST['ma'])?$_REQUEST['ma']:0;
	//2. Lấy trạng thái cần cập nhật
	$trangthai=isset($_REQUEST['trangthai'])?$_REQUEST['trangthai']:"";
	//3. Kiểm tra các giá trị của biến để xác định việc cập nhật
	if($id>0 && $trangthai!="" && $action=="edit")
	{		
		//Dữ liệu cập nhật
		$data=array("trang_thai"=>"$trangthai");
		$where=array("id"=>"$id");
		
		//5. Thực thi câu lệnh cập nhật
		if($db->update(Table::tbnha_xuat_ban,$data,$where)==true)
		{
			echo "<script> alert('Cập nhật thành công');";
			echo "location.href='?options=nha_xuat_ban_list';</script>";
		}
	}
?>
<?php
	// Phần xử lý cho chức năng xóa 
	//1. Lấy mã cần xóa
	$id=isset($_REQUEST['ma'])?$_REQUEST['ma']:0;	
	//3. Kiểm tra các giá trị của biến để xác định việc xóa
	
	if($id>0 && $action=="del")
	{
		//4. Kiểm tra nếu đang có sản phẩm của loại thì 
		// không cho phép xóa.		
		$sqlcheck="Select * from truyen where id =$id";
		$res=$db->execQuery($sqlcheck);
		$numcheck=$db->num_rows();
		
		if($numcheck>0){ //Không cho phép xóa
			echo "<script> alert('Dữ liệu không cho phép xóa. ";
			echo " Hiện đang có [$numcheck] sản phẩm thuộc loại này!');";
			echo " location.href='?options=nha_xuat_ban_list';</script>";
		}else{//cho phép xóa
			
			//5. Điều kiện xóa
			//$dieukien="Where id=$id";
			$where = array("id"=>"$id");
			
			//6. Thực thi câu lệnh cập nhật
			if($db->delete(Table::tbnha_xuat_ban,$where)==true)
			{
				echo "<script> alert('Xóa dữ liệu thành công');";
				echo "location.href='?options=nha_xuat_ban_list';</script>";
			}
		}
	}
?>