<?php
    include_once '../core/CRUD.php';
   

    $where =  "1=1 ";

 
    //===Tìm kiếm
        $id_truyen=isset($_REQUEST['id_truyen'])?$_REQUEST['id_truyen']:"";
        if($id_truyen>0) $where .=" and id_truyen like '%".$id_truyen."%'";
        $ten=isset($_REQUEST['ten'])?$_REQUEST['ten']:"";
        if($ten!="") $where .=" and ten like '%".$ten."%'";
    //===
    $db=new CRUD();
    $db->select(Table::tbct_truyen,$where);
    $data=$db->fetch();
    $num_rows = $db->num_rows();

?>
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">      	
                    <div class="widget ">
                        <div class="widget-header">
                            <i class="icon-user"></i>
                            <h3>Quản lý truyện</h3>
                        </div> <!-- /widget-header -->
                       
                        <div class="widget-content">
                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li  class="active">
                                    <a href="#jstruyen_list" data-toggle="tab">
                                    	Danh sách truyện <b><font color="#FF0000">
                                        [<?php echo $num_rows; ?>]</font></b></a> </li>
                                    <li>
                                    <a href="#jstruyen_find" data-toggle="tab">
                                        Tìm kiếm truyện</a> </li> 
                                    <li>
                                        <a href="?options=ct_truyen_add" >
                                        Thêm mới </a> </li>   
                                </ul>
                                
                                <div class="tab-content">
                                    <div class="tab-pane active" id="jstruyen_list">
                                   		<table class="table table-striped table-bordered">
                                            <thead>
                                                <tr align="center">
                                                	<th class="td-actions"> ID truyện  </th>
                                                    <th class="td-actions"> Tên  truyện  </th>
                                                    <th class="td-actions"> Ảnh bìa</th>
                                                    <th class="td-actions"> Só lượng </th>
                                                    <th class="td-actions"> Giá mới </th>
                                                    <th class="td-actions"> Giá cũ </th>
                                                    <th class="td-actions"> Giá thuê </th>
                                                    <th class="td-actions"> Trạng thái</th>
                                                    <th class="td-actions"> Thao tác </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php	
												if ($num_rows != 0) {											
                                                    foreach($data as $row) {                                                        
                                                    ?>
                                                    <tr>
                                    
                                                        <td style="text-align: center;">
                                                        <a href="?options=truyen_list&masp=<?php echo $row['id_truyen'] ?>">
															<?php echo $row['id_truyen'] ?></a></td>
                                                        <?php
                                                           $db1 = new CRUD();

                                                         $dk = array('id_truyen' =>$row['id_truyen'] , );
                                                         $db1->select(Table::tbtruyen,$dk);
                                                         $row1=$db1->fetch();
                                                        ?>
                                                        <td>
                                                     
                                                            <?php echo $row1[0]['ten'] ?></a></td>
                                                             <td>
                                                            <img src="<?php echo __ImagePro.$row['anh_bia']; ?>" alt="<?php echo $row['id_truyen']; ?>" style="width:50px "/>
                                                        
                                                        </td>
                                                        <td style="text-align: right;">
															<?php echo ($row['so_luong']);  ?></td>
                                                            <td style="text-align: right;">
                                                            <?php echo number_format($row['gia_moi']);  ?></td>
                                                            <td style="text-align: right;">
                                                            <?php echo number_format($row['gia_cu']);  ?></td>
                                                            <td style="text-align: right;">
                                                            <?php echo number_format($row['gia_thue']);  ?></td>
                                                      
                                                             <td style="text-align: right;">
                                                            <?php echo ($row['trang_thai']);  ?></td>
                                                            
                                                            
                                                        <td class="td-actions">
                                                        <a href="?options=ct_truyen_edit&masp=<?php echo $row['id'];?>" class="btn btn-small btn-warning" title="Chỉnh sửa truyện có mã [<?php echo $row['id']?>]">
                                                                <i class="btn-icon-only fa fa fa-pencil"> </i>
                                                        </a>
															
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }//==end for
                                            }else{ //==if
													?>
                                                    <tr>
                                                    	<td colspan="6">
                                                        	Không có truyện nào!
                                                        	</td>
                                                    </tr>
                                                <?php
												}	//== end if											
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>  
                                    <div class="tab-pane " id="jstruyen_find">
                                        <form method="post" action="?options=truyen_list"
                                                class="form-inline" role="form" 
                                                style="margin-top:5px; text-align:right">
                                            <input type="text" name="id_truyen" id="id_truyen" 
                                                class="form-control search "  
                                                value="<?php if($id_truyen>0) echo $id_truyen;?>"
                                                placeholder="Nhập mã...">
                                            <input type="text" name="ten" id="ten" 
                                                class="form-control search" 
                                                value="<?php echo $ten;?>"
                                                placeholder="Nhập tên...">
                                    
                                            <input type="submit" class="btn-success "  
                                                value="Tìm kiếm"/>
                                </form>  
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
$action=isset($_REQUEST['action'])?$_REQUEST['action']:"";
    // Phần xử lý cho chức năng xóa 
    //1. Lấy mã cần xóa
    $id=isset($_REQUEST['masp'])?$_REQUEST['masp']:0;   
    //3. Kiểm tra các giá trị của biến để xác định việc xóa
    
    if($id>0 && $action=="del")
    {
        //4. Kiểm tra nếu đang có truyện của loại thì 
       
            //5. Điều kiện xóa
            //$dieukien="Where MaDT=$MaDT";
            $where = array("id"=>"$id");
            
            //6. Thực thi câu lệnh cập nhật
            if($db->delete(Table::tbct_truyen,$where)==true)
            {
                echo "<script> alert('Xóa dữ liệu thành công');";
                echo "location.href='?options=ct_truyen_list';</script>";
            }

        
    }

?>