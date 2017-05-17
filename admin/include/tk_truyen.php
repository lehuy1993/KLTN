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
   /* $sql = "SELECT  ct_truyen.*  FROM ct_truyen INNER JOIN ct_thue ON ct_truyen.id_truyen2 = ct_thue.id_truyen WHERE ct_thue.ngay_thue BETWEEN CAST('$_REQUEST[ngay_bd]' AS DATE) AND CAST('$_REQUEST[ngay_kt]' AS DATE)   ";*/
    $sql = "SELECT * ,SUM(so_luong) As sl, COUNT(*) AS number_record  FROM ct_thue WHERE ngay_thue BETWEEN CAST('$_REQUEST[ngay_bd]' AS DATE) AND CAST('$_REQUEST[ngay_kt]' AS DATE) GROUP BY id_truyen HAVING number_record > 0 order by sl DESC ";
    $result = mysql_query($sql);
    $numrows = mysql_num_rows($result);
  
    }
    
    $db = new CRUD;
    $db->Select(Table::tbct_thue);
    $row = $db->fetch();
    $today = date('Y-m-d');
    $now = $row[0]['ngay_tra'];
     $datetime1 = date_create($today);
    $datetime2 = date_create($now);
   $interval = date_diff($datetime1, $datetime2);
    $phat = $interval->format( '%a ');
    if ($datetime2 < $datetime1  ) {
        # code...
        $db1 = new CRUD();
        $where1 = array('ngay_tra'=>date($now));
        $db1->select(Table::tbct_thue,$where1);
        $data=$db1->fetch();
        
        $num_rows = $db1->num_rows();
    }
    
?>
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">        
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Thống kê truyện</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">

                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li  class="active">
                                <a href="#jsloaitruyen" data-toggle="tab">
                                    Danh sách truyện 
                                    <b><font color="#FF0000">
                                        [<?php echo $numrows; ?>]</font></b></a> 
                                     </a> 
                                </li>
                                <li>
                                <a href="#jstruyen_find" data-toggle="tab">
                                        Danh sách truyện thuê quá hạn</a> </li> 

                                                                      
                               
                            </ul>
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
                                         <form method="post" action="include/export_truyen.php" id="frm1">
                                <input type="hidden" name="ngay_bd" value="<?php echo $ngay_bd;?>"> 
                                <input type="hidden" name="ngay_kt" value="<?php echo $ngay_kt;?>"> 

                                            <tr align="center">
                                                <th class="td-actions">
                                                <input type="checkbox" id="checkAll" name="chk_All" /></th>
                                                <th class="td-actions"> Id truyện  </th>
                                                <th class="td-actions"> Tên truyện </th>
                                                <th class="td-actions"> Số lượng </th>
                                                <th class="td-actions"> Số lượng thuê </th>
                                                <th class="td-actions"> Trạng thái  </th>
                                                
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
                                                        <input type="checkbox" 
                                                            id="chk_<?php echo $row['id'];?>" 
                                                            name="chk_<?php echo $row['id'];?>" />
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['id_truyen'];?>
                                                    </td>
                                                    <?php
                                                        $db = new CRUD();
                                                        $where = array('id'=>$row['id_truyen']);
                                                        $db->select(Table::tbct_truyen,$where);
                                                        $row1 = $db->fetch();
                                                       
                                                    ?>
                                                    <td style="text-align: center;">
                                                        <?php echo $row1[0]['ten'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row1[0]['so_luong'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['sl'];?>
                                                    </td>
                                                     <td style="text-align: center;">
                                                        <?php echo $row1[0]['trang_thai'];?>
                                                    </td>
                                                   
                                                    
                                                    
                                                </tr>
                                                 <?php
                                                        }// end while
                                                    }// 
                                                    else{       
                                                 ?>
                                                <tr>
                                                    <td colspan="6"> 
                                                        Chưa lọc dữ liệu
                                                    </td>
                                                </tr>   
                                                <?php }//end if ?>                           
  
                                        </tbody>
                                    </table>

                                     <input type="submit" class="btn btn-success" id="excel" name="excel" value="Xuất ra Excel"></input>
                 
                                </div> 
                                </form>
                                 <div class="tab-pane " id="jstruyen_find">
                                       
                                            <table class="table table-striped table-bordered ">
                                          
                                        <thead>
                                         <form method="post" action=""
                                                class="form-inline" role="form" 
                                                style="margin-top:5px; text-align:right">
                                            <tr align="center">
                                                <th class="td-actions">
                                                <input type="checkbox" id="checkAll" name="chk_All" /></th>
                                                <th class="td-actions"> Id truyện  </th>
                                                <th class="td-actions"> Tên truyện </th>
                                                <th class="td-actions"> Ngày thuê </th>
                                                <th class="td-actions"> Ngày trả </th>
                                                <th class="td-actions"> Số lượng thuê </th>
                                                <th class="td-actions"> Trạng thái  </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php   
                                                //Kiểm tra xem có dữ liệu hay không,
                                                 if ($num_rows != 0) {
                                                //Nếu có dữ liệu
                                                 
                                                // đọc từng dòng dữ liệu và hiển thị
                                           
                                                     //Nếu có dữ liệu
                                                    foreach ($data as $dong ) {
                                                         # code...
                                                     
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <input type="checkbox" 
                                                            id="chk_<?php echo $dong['id'];?>" 
                                                            name="chk_<?php echo $dong['id'];?>" />
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $dong['id_truyen'];?>
                                                    </td>
                                                    <?php
                                                        $db = new CRUD();
                                                        $where = array('id'=>$dong['id_truyen']);
                                                        $db->select(Table::tbct_truyen,$where);
                                                        $row1 = $db->fetch();
                                                       
                                                    ?>
                                                    <td style="text-align: center;">
                                                        <?php echo $row1[0]['ten'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $dong['ngay_thue'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $dong['ngay_tra'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $dong['so_luong'];?>
                                                    </td>
                                                     <td style="text-align: center;">
                                                        <?php echo "Quá hạn ".$phat."ngày";?>
                                                    </td>
                                                   
                                                    
                                                    
                                                </tr>
                                                 <?php
                                                        }// end while
                                                    }// 
                                                    else{       
                                                 ?>
                                                <tr>
                                                    <td colspan="6"> 
                                                        Chưa lọc dữ liệu
                                                    </td>
                                                </tr>   
                                                <?php }//end if ?>                           
  
                                        </tbody>
                                    </table>
                                               <input type="submit" class="btn btn-success" id="excel" name="excel" value="Xuất ra Excel"></input>
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
   