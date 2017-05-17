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
		$dieukien .=" and id_loai like '%$keyword_Id%' ";
	if($keyword_Name!="")
		$dieukien .=" and ten like '%$keyword_Name%'";
	//-----------
$loaisp=$db->select(Table::tbloai_truyen,$dieukien);
$numrow = $db->num_rows();
?>
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">      	
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Danh sách loại truyện</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li  class="active">
                                <a href="#jsloaitruyen" data-toggle="tab">
                                    Danh sách loại truyện 
                                    	<b><font color="#FF0000">
                                    	[<?php echo $numrow; ?>]</font></b></a> 
                                </li>                                 
                                <form method="post" action="?options=loai_truyen_list"
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
                                <div class="tab-pane active" id="jsloaitruyen">
                                    <table class="table table-striped table-bordered ">
                                        <thead>
                                            <tr align="center">
                                                <th class="td-actions">
                                                <input type="checkbox" id="checkAll" name="chk_All" /></th>
                                                <th class="td-actions"> Id loại  </th>
                                                <th class="td-actions"> Tên loại </th>
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
                                                        	id="chk_<?php echo $row['id_loai'];?>" 
                                                            name="chk_<?php echo $row['id_loai'];?>" />
                                                    </td>
                                                    <td style="text-align: center;">
                                                    	<?php echo $row['id_loai'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['ten'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['ngay_tao'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['ngay_sua'];?>
                                                    </td>
                                                   
                                                    <td style="text-align: center;width:20%">
                                                        <select name="trang_thai" style="width:50%"
                                                        onChange="location.href='?options=loai_truyen_list&action=edit&maloai=<?php echo $row['id_loai'];?>&trangthai='+this.value">
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
                                                        <a href="?options=loai_truyen_edit&maloai=<?php echo $row['id'];?>" 
                                                           class="btn btn-small btn-warning" 
                                                           title="Chỉnh sửa loại truyện có mã[<?php echo $row['id'];?>]">
                                                            <i class="btn-icon-only fa fa fa-pencil"> </i>
                                                        </a>
                                                        <a 
                                                        onClick="if(confirm('Bạn có chắc chắn muốn xóa loại truyện có mã là [<?php echo $row['id_loai'];?>] không?'))
                                                        { location.href='?options=loai_truyen_list&action=del&maloai=<?php echo $row['id_loai'];?>'}"
                                                            class="btn btn-small btn-warning" 
                                                            title="Xóa truyện có mã[<?php echo $row['id'];?>]">
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
                                                    	Không có loại truyện nào! 
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
	$id_loai=isset($_REQUEST['maloai'])?$_REQUEST['maloai']:"";
	//2. Lấy trạng thái cần cập nhật
	$trang_thai=isset($_REQUEST['trangthai'])?$_REQUEST['trangthai']:"";
	//3. Kiểm tra các giá trị của biến để xác định việc cập nhật
	if($id_loai!="" && $trang_thai!="" && $action=="edit")
	{		
		//Dữ liệu cập nhật
		$data=array("trang_thai"=>$trang_thai);
		$where=array("id_loai"=>$id_loai);
		
		//5. Thực thi câu lệnh cập nhật
		if($db->update(Table::tbloai_truyen,$data,$where)==true)
		{
			echo "<script> alert('Cập nhật thành công');";
			echo "location.href='?options=loai_truyen_list';</script>";
		}
	}

?>
<?php
    // Phần xử lý cho chức năng xóa 
    //1. Lấy mã cần xóa
    $MaHSX=isset($_REQUEST['maloai'])?$_REQUEST['maloai']:"";  
    //3. Kiểm tra các giá trị của biến để xác định việc xóa
    
    if($MaHSX!="" && $action=="del")
    {
        //4. Kiểm tra nếu đang có sản phẩm của loại thì 
        // không cho phép xóa.      
        $sqlcheck="Select * from truyen where the_loai ='$MaHSX'";
        $res=$db->execQuery($sqlcheck);
        $numcheck=$db->num_rows();
        
        if($numcheck>0){ //Không cho phép xóa
            echo "<script> alert('Dữ liệu không cho phép xóa. ";
            echo " Hiện đang có [$numcheck] sản phẩm thuộc loại này!');";
            echo " location.href='?options=loai_truyen_list';</script>";
        }else{//cho phép xóa
            
            //5. Điều kiện xóa
            //$dieukien="Where MaHSX=$MaHSX";
            $where = array("id_loai"=>$MaHSX);
            
            //6. Thực thi câu lệnh cập nhật
            if($db->delete(Table::tbloai_truyen,$where)==true)
            {
                echo "<script> alert('Xóa dữ liệu thành công');";
                echo "location.href='?options=loai_truyen_list';</script>";
            }
        }
    }
?>