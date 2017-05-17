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
        $dieukien .=" and id like '%$keyword_Id%' ";
    if($keyword_Name!="")
        $dieukien .=" and ten_kh like '%$keyword_Name%'";
    //-----------
$loaisp=$db->select(Table::tbthue,$dieukien);
$numrow = $db->num_rows();
?>
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">        
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Quản lý thuê truyện</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li  class="active">
                                <a href="#jsncc" data-toggle="tab">
                                    Danh sách thuê truyện 
                                        <b><font color="#FF0000">
                                        [<?php echo $numrow; ?>]</font></b></a> 
                                </li>                                 
                                <form method="post" action="?options=thue_list"
                                    class="form-inline" role="form" 
                                    style="margin-top:5px; text-align:right">
                                    <input type="text" name="keyword_Id" id="keyword_Id" 
                                        class="form-control search "  
                                        value="<?php echo $keyword_Id;?>"
                                        placeholder="Nhập mã...">
                                    <input type="text" name="keyword_Name" id="keyword_Name" 
                                        class="form-control search" 
                                        value="<?php echo $keyword_Name;?>"
                                        placeholder="Nhập tên khách hàng...">
                                    
                                    <input type="submit" class="btn-success "  
                                        value="Tìm kiếm"/>
                                </form>                            
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="jsncc">
                                    <table class="table table-striped table-bordered ">
                                        <thead>
                                           <tr align="center">
                                                <th class="td-actions">
                                                <input type="checkbox" id="checkAll" name="chk_All" /></th>
                                                 <th class="td-actions"> Id phiếu thuê </th>
                                                <th class="td-actions"> Tên Khách hàng </th>
                                                <th class="td-actions"> Số điện thoại </th>
                                                <th class="td-actions"> Hình thức </th>
                                                <th class="td-actions"> Tổng tiền </th>
                                                <th class="td-actions"> Ngày thuê </th>
                                                <th class="td-actions"> Ngày trả </th>
                                               
                                                <th class="td-actions"> Lập phiểu trả </th>
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
                                                        <a href="
                                                            ?options=ct_thue&id=<?php echo $row['id'];?>"
                                                            title="Xem hóa đơn có mã [<?php echo $row['id'];?>]">
                                                            <?php echo $row['id'];?>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['ten_kh'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['sdt'];?>
                                                    </td>
                                                     
                                                    
                                                    <td style="text-align: center;width:20%">
                                                        <select name="Trang_thai" style="width:50%"
                                                        onChange="location.href='?options=thue_list&action=edit&ma=<?php  echo $row['id'];?>&hinh_thuc='+this.value">
                                                        <?php 
                                                            if($row['hinh_thuc']==0)
                                                            {
                                                        ?>
                                                            <option value="1">Thuê về nhà</option>
                                                            <option value="0" selected>Đọc luôn </option>
                                                         <?php
                                                            }else{
                                                         ?> 
                                                            <option value="1" selected>Thuê về nhà</option>
                                                            <option value="0">Đọc luôn</option>
                                                         <?php
                                                            }
                                                         ?> 
                                                         </select>                                                      
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo number_format($row['tong_tien']);?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['ngay_thue'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['ngay_tra'];?>
                                                    </td>
                                                   
                                                    
                                                    <td class="td-actions">

                                                        <a href="?options=phieu_tra&ma=<?php echo $row['id'];?>" 
                                                           class="btn btn-small btn-warning" 
                                                           title="Lập phiếu trả có mã[<?php echo $row['id'];?>]">
                                                            <i class="btn-icon-only fa fa fa-pencil"> </i>
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
                                                        Không có thuê truyện nào! 
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
    $hinh_thuc=isset($_REQUEST['hinh_thuc'])?$_REQUEST['hinh_thuc']:"";
    //3. Kiểm tra các giá trị của biến để xác định việc cập nhật
    if($id>0 && $hinh_thuc!="" && $action=="edit")
    {       
        //Dữ liệu cập nhật
        $data=array("trang_thai"=>"$hinh_thuc");
        $where=array("id"=>"$id");
        
        //5. Thực thi câu lệnh cập nhật
        if($db->update(Table::tbthue,$data,$where)==true)
        {
            echo "<script> alert('Cập nhật thành công');";
            echo "location.href='?options=ncc_list';</script>";
        }
    }
?>

