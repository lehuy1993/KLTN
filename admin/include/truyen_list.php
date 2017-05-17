
<?php
    include_once '../core/CRUD.php';
   

    $where =  "1=1 ";

 
    //===Tìm kiếm
        $id_truyen=isset($_REQUEST['id_truyen'])?$_REQUEST['id_truyen']:"";
        if($id_truyen !="") $where .=" and id_truyen like '%".$id_truyen."%'";
        $ten=isset($_REQUEST['ten'])?$_REQUEST['ten']:"";
        if($ten!="") $where .=" and ten like '%".$ten."%'";
        $maloai=isset($_REQUEST['maloai'])?$_REQUEST['maloai']:"";
        if($maloai!="") $where .=" and the_loai like '%".$maloai."%'";
    //===
    $db=new CRUD();
    $db->select(Table::tbtruyen,$where);
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
                                    	Danh sách truyện<b><font color="#FF0000">
                                        [<?php echo $num_rows; ?>]</font></b></a> </li>
                                    <a href="#jstruyen_filter" data-toggle="tab">
                                    	Lọc truyện theo loại:</a>
                                        <select class = "form-control" name = "maloai" 
                                        	id = "category"
                                            onChange="location.href='?options=truyen_list&maloai='+this.value;">
                                            <option value="0">---Tất cả---</option>
                                                <?php    
                                                    $dbloai=new CRUD();
                                                    $dbloai->select(Table::tbloai_truyen);
                                                    $num=$dbloai->num_rows();
                                                    if($num>0){
                                                        $data1=$dbloai->fetch();
                                                        foreach ($data1 as $row1) {
                                                           echo '<option value="' . $row1['id_loai'] .'"';
                                                            if($row1['id_loai']==$maloai){  echo "selected"; }
                                                            echo '>' . $row1['ten'] . '</option>';
                                                        }
                                                    }
                                                ?>   
                                       </select>
                                    <li>
                                    <a href="#jstruyen_find" data-toggle="tab">
                                        Tìm kiếm truyện</a> </li>
                                        <li>
                                        <a href="?options=truyen_add" >
                                        Thêm mới </a> </li>  
                                </ul>
                                
                                <div class="tab-content">
                                    <div class="tab-pane active" id="jstruyen_list">
                                   		<table class="table table-striped table-bordered">
                                            <thead>
                                                <tr align="center">
                                                	<th class="td-actions"> ID truyện  </th>
                                                    <th class="td-actions"> Tên  truyện  </th>
                                                    
                                                    <th class="td-actions"> NXB </th>
                                                  
                                                     <th class="td-actions"> Vị trí </th>   
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
                                                        <td>
                                                     
                                                            <?php echo $row['ten'] ?></a></td>
                                                        
                                                        <td  style="text-align: right;">
                                                            <?php echo ($row['nxb']);  ?></td>
                                                             
                                                        <td style="text-align: right;">
                                                            <?php echo ($row['vi_tri']);  ?></td>
                                                       
                                                        
                                                        <td class="td-actions">
                                                            <a href="?options=truyen_edit&masp=<?php echo $row['id'];?>&maloai=<?php echo $row['the_loai'];?>&&manxb=<?php echo $row['nxb'];?>" class="btn btn-small btn-warning" title="Chỉnh sửa truyện có mã [<?php echo $row['id']?>]">
                                                                <i class="btn-icon-only fa fa fa-pencil"> </i>
                                                            </a>
															<a 
                                                            onClick="if(confirm('Bạn có chắc chắn muốn xóa  truyện có mã là [<?php echo $row['id'];?>] không?')){ location.href='?options=truyen_list&action=del&masp=<?php echo $row['id'];?>'}"
                                                            class="btn btn-small btn-warning" 
                                                            title="Xóa truyện có mã[<?php echo $row['id'];?>]">
                                                                <i class="btn-icon-only fa fa fa-times"> </i>

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
        $id_truyen1 = $data[0]['id_truyen'];
            $where1 = array("id_truyen"=>"$id_truyen1");
            $where = array("id"=>"$id");
            
            //6. Thực thi câu lệnh cập nhật
            if( $db->delete(Table::tbct_truyen,$where1)==true && $db->delete(Table::tbtruyen,$where)==true  )
            {
               
                echo "<script> alert('Xóa dữ liệu thành công.$id_truyen1');";
                echo "location.href='?options=truyen_list';</script>";
            }

        
    }

?>
