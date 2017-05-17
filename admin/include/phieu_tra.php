<?php
    include_once '../core/CRUD.php';
?>

<?php
if (isset($_REQUEST['ma'])) {
	# code...
$db = new CRUD();

$id = $_REQUEST['ma'];
$where = array('id'=>$id);
$loaisp=$db->select(Table::tbthue,$where);
$numrow = $db->num_rows();
}

if (isset($_POST['add'])) {
	# code...
	$ten_kh = $_REQUEST['ten_kh'];
	$sdt = $_REQUEST['sdt'];
	$tien_coc = $_REQUEST['tien_coc'];
	$tong_tien = $_REQUEST['tong_tien'];
	$hinh_thuc = $_REQUEST['hinh_thuc'];
	$trang_thai = $_REQUEST['trang_thai'];
	$tien_phat = $_REQUEST['tien_phat']?$_REQUEST['tien_phat']:0;
	$ngay_thue = $_REQUEST['ngay_thue'];
	$ngay_tra = date("Y/m/d");
	$id = $_REQUEST['ma'];
	$tien_thue =$_REQUEST['tien_thue'];
	$dbAction = new CRUD();
	$data = array(
                'id_thue'=> $id,
                'ten_kh' => $ten_kh,
                'sdt'=>$sdt,
                'tien_phat'=>$tien_phat,
               'hinh_thuc'=>$hinh_thuc,
               'tien_coc' =>$tien_coc,
               'ngay_thue' =>$ngay_thue,
               'ngay_tra'  =>$ngay_tra,
               'trang_thai'=>$trang_thai,
               'tien_thue'=>$tien_thue
            );
	if($dbAction->insert(Table::tbphieu_tra,$data)==true)
	{
		
		$db_thue = new CRUD();
		$where = array('id_thue'=>$id);
		$db_thue->select(Table::tbct_thue,$where);
		$data1= $db_thue->fetch();
        foreach ($data1 as $row1 ) {
		 $sql = "UPDATE ct_truyen SET so_luong = so_luong + '$row1[so_luong]'  Where id_truyen2 = '$row1[id_truyen]'  ";
        }
            mysql_query($sql);
        $where1 = array('id'=>$id);
        $db_thue->delete(Table::tbthue,$where1);
		echo "<script> alert('Lập phiếu trả thành công');
        location.href='?options=phieu_tra_list';</script>";                           
	}

	else{
		echo "<script> alert('Lỗi thêm mới!!');</script>";	
	}
}
?>
<style type="text/css">
<!--

@media print
{
.noprint {display:none;}
}
@media screen
{
.printf { display: none; }
}
</style>
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">        
                <div class="widget ">
                    <div class="widget-header noprint">
                        <i class="icon-user"></i>
                        <h3>Lập phiếu trả</h3>
                    </div> <!-- /widget-header -->
  <div  id="page" class="printf">
            <div class="header">
        <div class="logo"><img src="../images/logo.jpg"/></div>
        <div class="company title">Cửa hàng KabiShop</div>
    </div>
  <br/>
  <div class="title">
        PHIẾU TRẢ TRUYỆN
        <br/>
        -------oOo-------
  </div>
  </div>
                    <div class="widget-content">
                        <div class="tabbable">
                            <form id="edit-profile" class="form-horizontal" 
                            		method="post" enctype="multipart/form-data" >
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
                                                <th class="td-actions"> Tiền cọc </th>
                                                <th class="td-actions"> Tiền thuê </th>
                                                <th class="td-actions"> Tổng tiền </th>
                                                <th class="td-actions"> Ngày thuê </th>
                                                <th class="td-actions"> Ngày trả </th>
                                                
                                                <th class="td-actions"> Tình trạng </th>
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
                                                        <select name="hinh_thuc" style="width:50%"
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

                                                        <?php echo number_format($row['tien_coc']);?>
                                                    </td>
                                                    <td style="text-align: center;">

                                                        <?php echo number_format($row['tien_thue']);?>
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

                                                       
                                                       
                                                   

                                                        <?php
                                                         //Lấy ngày hiện tại
                                                          $today = date('Y-m-d');
                                                            $now = date($row['ngay_tra']);
                                                          
                                                            $datetime1 = date_create($today);
                                                            $datetime2 = date_create($now);
                                                           $interval = date_diff($datetime1, $datetime2);
                                                            echo $interval->format( '%R%a ngày');
                                                            $phat = $interval->format( '%R%a ');
                                                            if ($datetime2 < $datetime1) {
                                                            	# code...
                                                            
                                               				$tien_phat = $phat*-1000;
                                               				
                                               			}
                                                            ?>

                                                    </td>
                                                   
                                                </tr>
                                                <input type="hidden" name="ten_kh" id="input" class="form-control" value="<?php echo $row['ten_kh'];?>">
                                    	<input type="hidden" name="sdt" id="input" class="form-control" value=" <?php echo $row['sdt'];?>">
                                    	<input type="hidden" name="tien_coc" id="input" class="form-control" value="<?php echo $row['tien_coc']?>">
                                    	<input type="hidden" name="tong_tien" id="input" class="form-control" value="<?php echo $row['tong_tien'] ?>">
										<input type="hidden" name="ngay_thue" id="input" class="form-control" value="<?php echo $row['ngay_thue'] ?>">
										<input type="hidden" name="ngay_tra" id="input" class="form-control" value="<?php echo $row['ngay_tra'] ?>">
										<input type="hidden" name="tien_thue" id="input" class="form-control" value="<?php echo $row['tien_thue'] ?>">
										<input type="hidden" name="trang_thai" id="input" class="form-control" value="<?php  echo $interval->format( '%R%a '); ?>">
										<input type="hidden" name="tien_phat" value="<?php echo $tien_phat; ?>">
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
                                    	
                                    
                                          <div class="noprint">     	
                                     <input type = "submit"  name="add" id="add"   class="btn btn-primary" value="Lập phiếu trả">   
                                     <a  onClick="javascript:window.print();" class="nounderline print-link" href="javascript:void(0)">
                               <input type = "button" class = "btn btn-warning" value = "     In    " > 
                            </a>
                            </div>
                                     </form> 

                                </div>  
                            </div>

                        </div>
                        
                    </div> <!-- /widget-content -->
                </div> <!-- /widget -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
         <div class="printf"> 
                                         <?php  $today = date('Y-m-d'); ?>
                                         <div class="footer-left"> Hà nội, ngày <?php echo date('d');?> tháng <?php echo date('m');?> năm <?php echo date('Y');?><br/>
                                          Khách hàng </div>
                                        <div class="footer-right"> Hà nội, ngày <?php echo date('d');?> tháng <?php echo date('m');?> năm <?php echo date('Y');?><br/>
                                          Nhân viên </div>  
                                          </div> 
    </div> <!-- /container -->
</div> <!-- /main-inner -->

<link rel="stylesheet" media="print" type="text/css" href="././css/inhoadon.css">
