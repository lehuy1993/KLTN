 
<?php
include_once '../core/CRUD.php';
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
<?php
$id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
  if(isset($_REQUEST['id']) &&isset($_REQUEST['sl']) ){

            //cạp nhat giỏ hàng
    $db = new CRUD();
    $id=$_REQUEST['id'];
    $dieukien = "id=".$id;
    $db1 = new CRUD();
    $db->select(Table::tbtruyen,$dieukien);
   
        $row=$db->fetch();
       
          $id_truyen = $row[0]['id_truyen'];
          $where = array('id_truyen'=>$id_truyen);
        
        $ct=$db1->select(Table::tbct_truyen,$where);
        $row1 = $db1->fetch();
       
          
        if($_REQUEST['sl']>0){
    $_SESSION['cart1'][$_REQUEST['id']] = array(
      'sl' => $_REQUEST['sl'] ,
      'price' => $row1[0]['gia_thue'],
       'name' =>$row[0]['ten'],
        'image'=> $row[0]['gia_cuoc'],

      );
   }else{
      unset($_SESSION['cart'][$_GET['idsp']]);
    }

  }
   if(isset($_REQUEST['id']) && isset($_REQUEST['action']) ){
    unset($_SESSION['cart1'][$_REQUEST['id']]);
}
  
   
?>  

<?php //Thêm mới dữ liệu vào bảng

$id=isset($_REQUEST['id'])?$_REQUEST['id']:0;

if(isset($_POST['add'])){
    
     $ten_kh = $_REQUEST['ten_kh'];
     $sdt = $_REQUEST['sdt'];
         $hinh_thuc = $_REQUEST['hinh_thuc'];
    
     $ngay_thue = date("Y/m/d");
       $week = strtotime(date("Y-m-d", strtotime($ngay_thue)) . " +1 week");
  $week = strftime("%Y-%m-%d", $week);
     $ngay_tra = date($week);
      $tien_cuoc = $_REQUEST['tien_cuoc'];
     $tong_tien = $_REQUEST['tong_tien'];
     $tien_thue = $_REQUEST['tien_thue'];
     $gia_thue2 = $_REQUEST['gia_thue2'];
    //Lấy dữ liệu trên form 
    $dbAction=new CRUD();
    //Tạo mảng giá trị thêm
    $data = array(
                
                'ten_kh' => $ten_kh,
                'tien_coc' =>$tien_cuoc,
                'sdt'=>$sdt,
                'tien_thue'=>$tien_thue,
                'hinh_thuc'=>$hinh_thuc,
                'ngay_thue'=>$ngay_thue,
                'ngay_tra'=>$ngay_tra,
        
                'tong_tien'=>$tong_tien
            );
    
    //  Thực thi 

    $dbtruyen = $dbAction->insert(Table::tbthue,$data)==true;
        $lastid = mysql_insert_id();
        $db2 = new CRUD();
        foreach ($_SESSION['cart1'] as $key => $value) {
            $data2 = array(
                        'id_thue' => $lastid,
                        'id_truyen' => $key ,
                        'so_luong' => $value['sl'],
                        'tong_tien' => $value['price'],
                        'tien_cuoc'=>$value['image'],
                        'ngay_thue'=>$ngay_thue,
                          'ngay_tra'=>$ngay_tra,

         );

        $db2->insert(Table::tbct_thue,$data2)==true;
         $sql = "UPDATE ct_truyen SET so_luong = so_luong - '$value[sl]'  Where ten = '$value[name]'  ";

            mysql_query($sql);
    
    }
      
        
        echo "<script> alert('Lập phiếu  thành công');
        location.href='?options=thue_list';</script>"; 
         unset($_SESSION['cart1']); 
    }
?>

 <div class="main-inner ">
        <div class="container">
            <div class="row">
                <div class="span12">      	
                    <div class="widget ">
                        <div class="widget-header noprint">
                            <i class="icon-user"></i>
                            <h3>Quản lý thuê truyện</h3>
                        </div> <!-- /widget-header -->
                        <div  id="page" class="printf">
            <div class="header">
        <div class="logo"><img src="../images/logo.jpg"/></div>
        <div class="company title">Cửa hàng KabiShop</div>
    </div>
  <br/>
  <div class="title">
        PHIẾU THUÊ TRUYỆN
        <br/>
        -------oOo-------
  </div>
  </div>
                        <div class="widget-content">
                            <div class="tabbable">
                              <form action="check.php" name="thue" id="thue" class="form-horizontal noprint  " 
                                  method="post" enctype="multipart/form-data">
                                <fieldset>
                                 <div class = "control-group">
                                        <label class = "control-label" for = "truyen">
                                            Tên truyện </label>
                                            <div class = "controls">
                                      <div class = "btn-group">
                                      
                                        <select class = "form-control" name = "ten_truyen" 
                                            onChange="location.href='?options=add&id='+this.value;">
                                            <option value="0">---Tất cả---</option>
                                                <?php    
                                                    $dbloai=new CRUD();
                                                    $dbloai->select(Table::tbtruyen);
                                                    $num=$dbloai->num_rows();
                                                    if($num>0){
                                                        $data1=$dbloai->fetch();
                                                        foreach ($data1 as $row1) {
                                                           echo '<option value="' . $row1['id'] .'"';
                                                            if($row1['id']== $id)  echo "selected"; 
                                                            echo '>' . $row1['ten'] . '</option>';
                                                        }
                                                    }
                                                ?>   
                                       </select>
                                       </div>
                                        </div>
                                        </div>
                             
                                    
                                    <div class="control-group">                                            
                                        <label class="control-label" for="gia_cuoc">Tiền đặt cọc </label>
                                        <?php    
                                                    $dbtruyuen = new CRUD();
                                                    $where = array("id"=>$id);
                                                    $dbtruyuen->select(Table::tbtruyen,$where);
                                                    $row = $dbtruyuen->fetch();
                                                    $id = $row[0]['id'];
                                                   $gia_cuoc = $row[0]['gia_cuoc'];
                                                   $id_truyen = $row[0]['id_truyen'];
                                                   
                                                ?>   

                                        <div class="controls">
                                            <input  type="text" value="<?php echo number_format($gia_cuoc); ?>" class="span6"
                                                   name="tien_coc" >
                                        </div> <!-- /controls -->  
                                        </div>
                                    <div class="control-group">                                            
                                        <label class="control-label" for="gia_thue">Giá thuê</label>
                                        <div class="controls">
                                         <?php
                                                        $db = new CRUD();
                                                        $where = array("id_truyen"=>$id_truyen);
                                                        $db->select(Table::tbct_truyen,$where);
                                                        $row1 = $db->fetch();
                                                        $so_luong1 = $row1[0]['so_luong'];
                                                        $gia_thue1 = number_format($row1[0]['gia_thue']);
                                                   ?>
                                            <input  type="text" name="gia_thue2" value="<?php echo ($gia_thue1); ?>" class="span6"
                                                   name="gia_thue" >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->  
                                     <div class="control-group">                                            
                                        <label class="control-label" for="gia_thue">Số lượng còn lại</label>
                                        <div class="controls">
                                        
                                            <input  type="text" value="<?php echo ($so_luong1); ?>" class="span6"
                                                   name="gia_thue" >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->    
                                    
                                          
                                           
                                    <div class = "control-group">
                                        <div class = "form-actions">
                                        
                                                   <a class = "btn btn-primary" href="?options=check&id=<?php echo $id; ?>" >Thuê</a>
                                            <input type = "reset" class = "btn btn-warning" value = "Đặt lại" >
                                        </div> <!--/form-actions -->
                                    </div>
                                </fieldset>
                            </form>


                               <form name="add" id="add" class="form-horizontal" 
                                  method="post" enctype="multipart/form-data">
      

                                <div class="tab-content">
                                    <div class="tab-pane active" id="jstruyen_list">
                                    <h3>Thông tin truyện thuê</h3>
                                   		<table class="table table-striped table-bordered">
                                            <thead>
                                                <tr align="center">
                                                    <th class="td-actions"> STT </th>
                                                	  <th class="td-actions"> Tên truyện   </th>
                                                    <th class="td-actions"> Số lượng  </th>
                                                    <th class="td-actions"> Giá thuê</th>
                                                    <th class="td-actions"> Giá cược </th>
                                                    <th class="td-actions"> Tổng tiền thuê </th>
                                                    <th class="td-actions"> Thành tiền </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php	

                                                 if(empty($_SESSION['cart1'])){
                            echo "<tr><td height=30 colspan=7 align=center style=\"padding-right:5px; padding-bottom:5px; color:#F00\">Không có sản phẩm nào !</td></tr>";
                        }else{
												$total=0;;$i = 0;

					                            foreach ($_SESSION['cart1'] as $key => $value) {
					                            $i++;
                                                                                 
                                                    ?>
                                                    <tr>
                                                   
                                                        
                                                      <input type="hidden" name="id_truyen" value="<?php echo $_SESSION['cart1'][$key]['sl']; ?>">
                                                        <td style="text-align: right;">
                                                          <?php echo $i; ?>
                                                        </td>
                                                        <td style="text-align: right;">
															<?php echo $_SESSION['cart1'][$key]['name']; ?></td>
                                                            <td style="text-align: right;">
                                                           <div class="form-inline text-center">
                                            <div class="form-group">
                                                <input style="float: left" class="form-control " name="sl_<?php echo $key; ?>" id="sl_<?php echo $key; ?>" value="<?php echo $_SESSION['cart1'][$key]['sl']; ?>">
                                      
                                            &nbsp;
                                                    <a  href="javascript:void(0)" onclick="updateItem(<?php echo $key ?>)">
                                                    <i style="font-size: 20px" class="btn-icon-only fa fa-refresh"></i>
                                                </a>
                                         
                                            &nbsp;
                                          
                                                <a href="javascript:void(0)" onclick="deleteItem(<?php echo $key ?>)">
                                                    <i  style="font-size: 20px"class="btn-icon-only fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                        </td>
                                                            <td style="text-align: right;">
                                                           <?php echo number_format($_SESSION['cart1'][$key]['price']); ?><sup>đ</sup></td>

                                                             <td style="text-align: right;">
                                                           <?php echo number_format($_SESSION['cart1'][$key]['image']); ?><sup>đ</sup></td>

                                                            <td style="text-align: right;">
                                                          <?php echo number_format( $_SESSION['cart1'][$key]['sl']* $_SESSION['cart1'][$key]['price']); ?><sup>đ</sup></td>

                                                             <td style="text-align: right;">
                                                           <?php echo number_format( $_SESSION['cart1'][$key]['sl']* $_SESSION['cart1'][$key]['price']+$_SESSION['cart1'][$key]['image']); 
                                          $total += ($_SESSION['cart1'][$key]['sl']* $_SESSION['cart1'][$key]['price']+$_SESSION['cart1'][$key]['image']);

                                          $total2=number_format($total);
                                          ?><sup>đ</sup></td>
                                                            
                                                       <?php 
                                                       $tien_thue +=( $_SESSION['cart1'][$key]['sl']* $_SESSION['cart1'][$key]['price']);

                                                       $gia_cuoc += $_SESSION['cart1'][$key]['image']; ?>
                                                       <input type="hidden" name="tien_cuoc" value="<?php echo $gia_cuoc; ?>">
                                                       <input type="hidden" name="tien_thue" value="<?php echo $tien_thue; ?>">
                                                    </tr>
                                                   
                                               
                                <?php
                                 }
                            echo"<tr>
                                <td style=\"font-size:20px;color:#F00 \"  colspan=6 class=text-right >Tổng tiền</td>
                                <td style=\"font-size:20px;color:#F00 \" class=text-right ><b>  $total2 </b><sup>đ</sup></td>
                            </tr>";
      
                            }
         
                                ?>										
                                               
                                            </tbody>
                                        </table>
                                        <fieldset>
                                         <input type="hidden" value="<?php echo $total ?>" name='tong_tien'>
                                        <h3>Thông tin khách hàng</h3>
                                            <div class="control-group">                                         
                                        <label class="control-label" for="ten_kh">Tên khách hàng</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="ten_kh" 
                                                   name="ten_kh" required minlength="3" maxlength="100">
                                        </div> <!-- /controls -->
                                         </div> <!-- /control-group --> 
                                     
                                    <div class="control-group">                                            
                                        <label class="control-label" for="sdt">Số điện thoại</label>
                                        <div class="controls">
                                            <input type="text" pattern="[0-9]{9,15}" title="Phải là số dài từ 9-15 ký tự "  class="span6" id="sdt" 
                                                   name="sdt" required>
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->          
                                   
                                    <div class = "control-group">
                                        <label class = "control-label" for = "hinh_thuc">
                                            Hình thức</label>
                                        <div class = "controls">
                                            <div class = "btn-group">
                                                <select class = "form-control" 
                                                        name = "hinh_thuc" id = "hinh_thuc">
                                                    <option value="1"> Thuê về nhà </option>
                                                    <option value="0"> Đọc luôn </option>
                                                </select>
                                            </div>
                                        </div> <!--/controls -->
                                        </div>
                                        
                                     
                                         <div class="printf"> 
                                         <?php  $today = date('Y-m-d'); ?>
                                         <div class="footer-left"> Hà nội, ngày <?php echo date('d');?> tháng <?php echo date('m');?> năm <?php echo date('Y');?><br/>
                                          Khách hàng </div>
                                        <div class="footer-right"> Hà nội, ngày <?php echo date('d');?> tháng <?php echo date('m');?> năm <?php echo date('Y');?><br/>
                                          Nhân viên </div>  
                                          </div>       
                                    <div class = "control-group">
                                        <div class = "form-actions noprint">
                                            <a  href="?options=thue_add"> <button type="button" class="btn btn-primary">Quay lại</button>
                                            <input type = "submit" class = "btn btn-primary" 
                                                   name = "add" value="Thêm mới">
                                            
                                            <a  onClick="javascript:window.print();" class="nounderline print-link" href="javascript:void(0)">
                               <input type = "button" class = "btn btn-warning" value = "     In    " > 
                            </a>
                                        </div> <!--/form-actions -->
                                    </div>   
                                        </fieldset>
                                    </div>  
                                   
                                </div>
                            </div>
                            </form>
                        </div> <!-- /widget-content -->
                    </div> <!-- /widget -->
                </div> <!-- /span12 -->
            </div> <!-- /row -->
            
        </div> <!-- /container -->
    </div> <!-- /main-inner -->
                
                <script type="text/javascript">
        function updateItem(id){
          sl=$("#sl_"+id).val();
          $.get("index.php?options=add&id="+id+"&sl="+sl,function(data){
            location.reload(); 
          });
        }
        function deleteItem(id){
          $.get("index.php?options=add&id="+id+"&action=del",function(data)
          {
            location.reload(); 
          }); 

        }
      </script>
<link rel="stylesheet" media="print" type="text/css" href="././css/inhoadon.css">

  
