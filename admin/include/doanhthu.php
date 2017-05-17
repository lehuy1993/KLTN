<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);//loại bỏ nhắc nhở lập trình viên  Undefined index...
?>
<?php
    include_once '../core/CRUD.php';
?>
<?php
   if (isset($_POST['loc_dl'])) {
    # code...
    $conn = mysql_connect("localhost","root","") or die(mysql_error() );
 
    mysql_select_db("kltn",$conn);
     mysql_query('SET NAMES "UTF-8"');
    $ngay_bd = $_POST['ngay_bd'];
    $ngay_kt = $_POST['ngay_kt'];
   
    $sql = "SELECT * ,SUM(tien_thue) As tien_thue, SUM(tien_phat) AS tien_phat  FROM phieu_tra WHERE ngay_tra BETWEEN CAST('$_REQUEST[ngay_bd]' AS DATE) AND CAST('$_REQUEST[ngay_kt]' AS DATE) ";
    $result = mysql_query($sql);
    $numrows = mysql_num_rows($result);
  
    }

?>

<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">        
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Thống kê doanh thu</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">

                        <div class="tabbable">
                            
                            <div class="tab-content">
                                <div class="tab-pane active" id="jsloaitruyen">
                                

                                    <table class="table table-striped table-bordered ">
                                    <ul class="nav nav-tabs">

                                     <form method="post" class="form-inline" role="form" 
                                    style="margin-top:5px; text-align:right">
                                    <input required="" type="date" name="ngay_bd" id="ngay_bd" 
                                        class="form-control search "  
                                        value="<?php echo $ngay_bd;?>"
                                        placeholder="Nhập ngày bắt đầu...">
                                    <input type="date" required="" name="ngay_kt" id="ngay_kt" 
                                        class="form-control search" 
                                        value="<?php echo $ngay_kt;?>"
                                        placeholder="Nhập ngày kết thúc...">
                                    
                                    <input type="submit" name="loc_dl" class="btn-success "  
                                        value="Lọc dữ liệu"/>
                                    </form>  

                                    </ul>                    
                                        <thead>
                                         <form method="post" action="include/export_doanhthu.php" id="frm1">
                                <input type="hidden" name="ngay_bd" value="<?php echo $ngay_bd;?>"> 
                                <input type="hidden" name="ngay_kt" value="<?php echo $ngay_kt;?>"> 

                                            <tr align="center">
                                               
                                                <th class="td-actions"> Tiền thuê  </th>
                                                <th class="td-actions"> Tiền phạt </th>
                                                <th class="td-actions"> Tổng tiền </th>
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php   
                                                //Kiểm tra xem có dữ liệu hay không,
                                                 if ($numrows != 0) {
                                                //Nếu có dữ liệu
                                                 
                                                // đọc từng dòng dữ liệu và hiển thị
                                           
                                                     //Nếu có dữ liệu
                                                    while ($row=mysql_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    
                                                    <td style="text-align: center;">
                                                        <?php echo $row['tien_thue'];?>
                                                    </td>
                                                    
                                                    <td style="text-align: center;">
                                                        <?php echo $row['tien_phat'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo ($row['tien_thue'] + $row['tien_phat']);?>
                                                    </td>
                                                    
                                                   
                                                    
                                                    
                                                </tr>
                                                 <?php
                                                        }// end while
                                                    }// 
                                                    else{       
                                                 ?>
                                                <tr>
                                                    <td colspan="4"> 
                                                        Chưa lọc dữ liệu
                                                    </td>
                                                </tr>   
                                                <?php }//end if ?>                           
  
                                        </tbody>
                                    </table>

                                     <input type="submit" class="btn btn-success" id="excel" name="excel" value="Xuất ra Excel"></input>
                 
                                </div> 
                               
                                    </div> 
                            </div>
                        </div>
                        
                    </div> <!-- /widget-content -->
                </div> <!-- /widget -->
            </div> <!-- /span12 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main-inner -->
   