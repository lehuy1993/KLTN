<?php
	include_once '../core/CRUD.php';
?>
<?php
$db = new CRUD();
	// Lấy dữ liệu tìm kiếm -> tạo chuỗi điều kiện tìm
	$dieukien =" 1=1 ";	
	$keyword_Id=isset($_REQUEST['keyword_Id'])?$_REQUEST['keyword_Id']:0;
	$keyword_Name=isset($_REQUEST['keyword_Name'])?$_REQUEST['keyword_Name']:"";
	if($keyword_Id>0)
		$dieukien .=" and id=$keyword_Id ";
	if($keyword_Name!="")
		$dieukien .=" and ten like '%$keyword_Name%'";
	//-----------
$loaisp=$db->select(Table::tbkhach_hang,$dieukien);
$numrow = $db->num_rows();
?>
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">      	
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Quản lý thành viên</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li  class="active">
                                <a href="#jshang_san_xuatlist" data-toggle="tab">
                                    Danh sách thành viên
                                    	<b><font color="#FF0000">
                                    	[<?php echo $numrow; ?>]</font></b></a> 
                                </li>                                 
                                <form method="post" action="?options=khach_hang_list"
                                    class="form-inline" role="form" 
                                    style="margin-top:5px; text-align:right">
                                    <input type="text" name="keyword_Id" id="keyword_Id" 
                                        class="form-control search "  
                                        value="<?php if($keyword_Id>0) echo $keyword_Id;?>"
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
                                <div class="tab-pane active" id="jskhach_hang_list">
                                    <table class="table table-striped table-bordered ">
                                        <thead>
                                            <tr align="center">
                                                <th class="td-actions">
                                                    <input type="checkbox" id="checkAll" name="chk_All" /></th>
                                                <th class="td-actions"> Mã thành viên  </th>
                                                <th class="td-actions"> Tên thành viên</th>
                                                <th class="td-actions"> Địa chỉ  </th>
                                                <th class="td-actions"> Số điện thoại  </th>
                                                <th class="td-actions"> Email  </th>
                                                <th class="td-actions"> Ngày đăng ký  </th>
                                              
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
                                                    	<?php echo $row['id'];?>
                                                    </td>
                                                    <td>
                                                    	<a href="#">
                                                    		<?php echo $row['ten'];?>
                                                        </a></td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['dia_chi'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['sdt'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['email'];?>
                                                    </td>
                                                     <td style="text-align: center;">
                                                        <?php echo $row['ngay_tao'];?>
                                                    </td>
                                                    
                                                    <td class="td-actions">
                                                        
                                                        <a 
                                                        onClick="if(confirm('Bạn có chắc chắn muốn xóa hãng sản xuất có mã là [<?php echo $row['id'];?>] không?')){ location.href='?options=khach_hang_list&action=del&id=<?php echo $row['id'];?>'}"
                                                            class="btn btn-small btn-warning" 
                                                            title="Xóa hãng sản xuất có mã[<?php echo $row['id'];?>]">
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
                                                    	Không có khách hàng nào! 
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
	$id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
	//2. Lấy trạng thái cần cập nhật
	$trang_thai=isset($_REQUEST['trang_thai'])?$_REQUEST['trang_thai']:"";
	//3. Kiểm tra các giá trị của biến để xác định việc cập nhật
	if($id>0 && $trang_thai!="" && $action=="edit")
	{		
		//Dữ liệu cập nhật
		$data=array("trang_thai"=>"$trang_thai");
		$where=array("id"=>"$id");
		
		//5. Thực thi câu lệnh cập nhật
		if($db->update(Table::tbkhach_hang,$data,$where)==true)
		{
			echo "<script> alert('Cập nhật thành công');";
			echo "location.href='?options=khach_hang_list';</script>";
		}
	}
?>
<?php
	// Phần xử lý cho chức năng xóa 
	//1. Lấy mã cần xóa
	$id=isset($_REQUEST['id'])?$_REQUEST['id']:0;	
	//3. Kiểm tra các giá trị của biến để xác định việc xóa
	
	if($id>0 && $action=="del")
	{
		//4. Kiểm tra nếu đang có sản phẩm của loại thì 
		// không cho phép xóa.		
		$sqlcheck="Select * from sanpham_dactinh where id =$id";
		$res=$db->execQuery($sqlcheck);
		$numcheck=$db->num_rows();
		
		
			//5. Điều kiện xóa
			//$dieukien="Where id=$id";
			$where = array("id"=>"$id");
			
			//6. Thực thi câu lệnh cập nhật
			if($db->delete(Table::tbkhach_hang,$where)==true)
			{
				echo "<script> alert('Xóa dữ liệu thành công');";
				echo "location.href='?options=khach_hang_list';</script>";
			}
		
	}
?>