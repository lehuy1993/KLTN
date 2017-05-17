
<?php
	include_once '../core/CRUD.php';
?>
<?php
$db = new CRUD();
    $id = $_REQUEST['id'];
	$where = array('id_thue'=>$id);
	//-----------
$loaisp=$db->select(Table::tbct_thue,$where);
$numrow = $db->num_rows();
?>
<?php 
    $where2 = array('id'=>$id);
    $db2 = new CRUD();
    $thue = $db2->select(Table::tbthue,$where2);
    $dong = $db2->fetch();
?>
  
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">      	
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Quản lý phiếu thuê</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li  class="active">
                                <a href="#jshang_san_xuatlist" data-toggle="tab">
                                    Danh sách truyện thuê
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
                                                <th class="td-actions"> Mã phiếu thuê  </th>
                                                <th class="td-actions"> Tên truyện</th>
                                                <th class="td-actions"> Số lượng   </th>
                                                <th class="td-actions"> Giá thuê </th>
                                                <th class="td-actions"> Giá cược </th>
                                            </tr>
                                        </thead>
                                        <form method="post" action="?options=phieu_tra2">
                                        <input type="hidden" name="ma" value="<?php echo $id; ?>">
                                        <input type="hidden" name="ten_kh" id="input" class="form-control" value="<?php echo $dong[0]['ten_kh'];?>">
                                        <input type="hidden" name="sdt" id="input" class="form-control" value=" <?php echo $dong[0]['sdt'];?>">
                                        <input type="hidden" name="tien_coc" id="input" class="form-control" value="<?php echo $dong[0]['tien_coc']?>">
                                        <input type="hidden" name="tong_tien" id="input" class="form-control" value="<?php echo $dong[0]['tong_tien'] ?>">
                                        <input type="hidden" name="ngay_thue" id="input" class="form-control" value="<?php echo $dong[0]['ngay_thue'] ?>">
                                        <input type="hidden" name="ngay_tra" id="input" class="form-control" value="<?php echo $dong[0]['ngay_tra'] ?>">
                                       
                                        
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
                                                        <input type="checkbox" value="<?php echo $row['id'];?>"
                                                        	id="chk_<?php echo $row['id'];?>" 
                                                            name="ma1[]" />
                                                    </td>
                                                    <td style="text-align: center;">
                                                    	<?php echo $row['id'];?>
                                                    </td>
                                                    <td>

                                                    	<?php 
                                                        $db = new CRUD();

                                                        $id_truyen = $row['id_truyen'];
                                                        $where = array('id'=>$id_truyen);
                                                        //-----------
                                                        $loaisp=$db->select(Table::tbtruyen,$where);
                                                        $row2 = $db->fetch();
                                                        $id_truyen1 = $row2[0]['id_truyen'];

                                                        ?>
                                                    	<?php echo $row2[0]['ten'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['so_luong'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                    <?php 
                                                        $db = new CRUD();

                                                       
                                                        $where = array('id_truyen'=>$id_truyen1);
                                                        //-----------
                                                        $loaisp=$db->select(Table::tbct_truyen,$where);
                                                        $row3 = $db->fetch();

                                                        ?>
                                                        <?php echo number_format($row3[0]['gia_thue']);?>
                        <input type="hidden" name="gia_thue" value="<?php echo $row3[0]['gia_thue'] ?>" >
                        <input type="hidden" name="gia_cuoc" value="<?php echo $row2[0]['gia_cuoc'] ?>" >
                                                    </td>
                                                     <td style="text-align: center;">
                                                        <?php echo number_format($row2[0]['gia_cuoc']);?>
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
                      <div class = "control-group">
                                        <div class = "form-actions">
                                            <a  href="?options=thue_list"> <button type="button" class="btn btn-primary">Quay lại</button>
                                           </a>
                                           
                                            <a> <button type="submit" name="submit" class="btn btn-warning">Lập phiếu trả</button>
                                           </a>
                                           </div> 
                                           
                                        </div> <!--/form-actions -->
                                    </div>   
                                      </form>
                </div> <!-- /widget -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main-inner -->
