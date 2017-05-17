<?php
	include_once '../core/CRUD.php';
?>
<?php
$db = new CRUD();
    $MA_HD = $_REQUEST['maHD'];
	$where = array('MA_HD'=>$MA_HD);
	//-----------
$loaisp=$db->select(Table::tbct_hoa_don,$where);
$numrow = $db->num_rows();

?>
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">      	
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Quản lý đơn hàng</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li  class="active">
                                <a href="#jshang_san_xuatlist" data-toggle="tab">
                                    Danh sách mặt hàng
                                    	<b><font color="#FF0000">
                                    	[<?php echo $numrow; ?>]</font></b></a> 
                                </li>                                 
                                    
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="jsdac_tinh_list">
                                    <table class="table table-striped table-bordered ">
                                        <thead>
                                            <tr align="center">
                                                <th class="td-actions">
                                                    <input type="checkbox" id="checkAll" name="chk_All" /></th>
                                                <th class="td-actions"> Mã hóa đơn  </th>
                                                <th class="td-actions"> Mã sản phẩm</th>
                                                <th class="td-actions"> Số lượng mua  </th>
                                                <th class="td-actions"> Giá bán </th>
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
                                                        	id="chk_<?php echo $row['MA_HD'];?>" 
                                                            name="chk_<?php echo $row['MA_HD'];?>" />
                                                    </td>
                                                    <td style="text-align: center;">
                                                    	<?php echo $row['MA_HD'];?>
                                                    </td>
                                                    <td>

                                                    	<?php 
                                                        $db = new CRUD();

                                                        $Ma_SP = $row['Ma_SP'];
                                                        $where = array('Ma_SP'=>$Ma_SP);
                                                        //-----------
                                                        $loaisp=$db->select(Table::tbsan_pham,$where);
                                                        $row2 = $db->fetch();

                                                        ?>
                                                    	<?php echo $row2[0]['Ten_sp'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['so_luong_ban'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo number_format($row['gia_ban']);?>
                                                    </td>
                                                   
                                                    
                                                </tr>
												 <?php
                                                        }// end while
                                                    }// 
                                                    else{		
                                                 ?>
 												<tr>
                                                	<td colspan="5"> 
                                                    	Không có đơn hàng nào ! 
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
	$MA_HD=isset($_REQUEST['madactinh'])?$_REQUEST['madactinh']:0;
	//2. Lấy trạng thái cần cập nhật
	$trang_thai=isset($_REQUEST['trang_thai'])?$_REQUEST['trang_thai']:"";
	//3. Kiểm tra các giá trị của biến để xác định việc cập nhật
	if($MA_HD>0 && $trang_thai!="" && $action=="edit")
	{		
		//Dữ liệu cập nhật
		$data=array("trang_thai"=>"$trang_thai");
		$where=array("MA_HD"=>"$MA_HD");
		
		//5. Thực thi câu lệnh cập nhật
		if($db->update(Table::tbct_hoa_don,$data,$where)==true)
		{
			echo "<script> alert('Cập nhật thành công');";
			echo "location.href='?options=dac_tinh_list';</script>";
		}
	}
?>
<?php
	// Phần xử lý cho chức năng xóa 
	//1. Lấy mã cần xóa
	$MA_HD=isset($_REQUEST['madactinh'])?$_REQUEST['madactinh']:0;	
	//3. Kiểm tra các giá trị của biến để xác định việc xóa
	
	if($MA_HD>0 && $action=="del")
	{
		//4. Kiểm tra nếu đang có sản phẩm của loại thì 
		// không cho phép xóa.		
		$sqlcheck="Select * from sanpham_dactinh where MA_HD =$MA_HD";
		$res=$db->execQuery($sqlcheck);
		$numcheck=$db->num_rows();
		
		if($numcheck>0){ //Không cho phép xóa
			echo "<script> alert('Dữ liệu không cho phép xóa. ";
			echo " Hiện đang có [$numcheck] sản phẩm thuộc loại này!');";
			echo " location.href='?options=dac_tinh_list';</script>";
		}else{//cho phép xóa
			
			//5. Điều kiện xóa
			//$dieukien="Where MA_HD=$MA_HD";
			$where = array("MA_HD"=>"$MA_HD");
			
			//6. Thực thi câu lệnh cập nhật
			if($db->delete(Table::tbct_hoa_don,$where)==true)
			{
				echo "<script> alert('Xóa dữ liệu thành công');";
				echo "location.href='?options=dac_tinh_list';</script>";
			}
		}
	}
?>