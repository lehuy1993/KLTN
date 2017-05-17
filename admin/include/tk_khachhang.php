<?php
    include_once '../core/CRUD.php';
   $conn = mysql_connect("localhost","root","") or die(mysql_error() );
   
        mysql_select_db("kltn",$conn);
   $sql = "SELECT * ,SUM(tien_thue) As tienthue, COUNT(*) AS number_record  FROM phieu_tra GROUP BY sdt HAVING number_record > 0";
   $query = mysql_query($sql);

?>
<form method="post" action="include/export_kh_excel.php" id="frm1">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">      	
                    <div class="widget ">
                        <div class="widget-header">
                            <i class="icon-user"></i>
                            <h3>Thống kê     khách hàng</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li  class="active">
                                    <a href="#jstin_tuc_list" data-toggle="tab">
                                    	Danh sách khách hàng</a> </li>
                                    
                                </ul>
                                
                                <div class="tab-content">
                                    <div class="tab-pane active" id="jstin_tuc_list">
                                   		<table class="table table-striped table-bordered">
                                            <thead>
                                                <tr align="center">
                                                	<th class="td-actions"> Họ tên  </th>
                                                    <th class="td-actions"> Số điện thoại  </th>
                                                    <th class="td-actions"> Số lần thuê</th>
                                              
                                                    <th class="td-actions"> Tổng tiền thuê </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php	
														while ($row=mysql_fetch_array($query))									
                                                  {                                                       
                                                    ?>
                                                    <tr>
                                                       
                                                    	<td style="text-align: center; ">
                                                            <?php
                                                            $sdt = $row['sdt']; echo $row['ten_kh']; ?>
                                                       
                                                        </td>
                                                        <td style="text-align: center;">
                                                        
															<?php echo $sdt ?></a></td>
                                                        <td style="overflow: hidden;">
                                                        
                                                            <?php echo  $row['number_record'] ?></a></td>
                                                            <input type="hidden" name="so_lan" value="<?php echo  $row['number_record'] ?>">
                                                        </td>
                                                        <td style="text-align: center;width:20%">
                                                            <?php 
                                                                        
                                                            echo  number_format($row['tienthue']); 
                                                        

                                                            ?>
                                                       
                                                                                                             
                                                    </td>
                                                       
                                                    </tr>
                                                    <?php
                                                        }// end while
                                                          
                                                 ?>
                                                 <tr>
                                                               
  
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

 