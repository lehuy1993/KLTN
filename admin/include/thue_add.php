 
<?php
include_once '../core/CRUD.php';

?>
<?php //Thêm mới dữ liệu vào bảng
$id=isset($_REQUEST['id'])?$_REQUEST['id']:0;

?>
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">    
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-pencil"></i>
                        <h3>Thêm mới </h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <div class="tabbable">
                            <form action="check.php" name="thue" id="thue" class="form-horizontal" 
                                  method="post" enctype="multipart/form-data">
                                <fieldset>
                                 <div class = "control-group">
                                        <label class = "control-label" for = "truyen">
                                            Tên truyện </label>
                                            <div class = "controls">
                                      <div class = "btn-group">
                                      
                                        <select class = "form-control" name = "ten_truyen" 
                                            onChange="location.href='?options=thue_add&id='+this.value;">
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
                                            <input  type="number" value="<?php echo $gia_cuoc; ?>" class="span6"
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
                                                        $gia_thue1 = $row1[0]['gia_thue'];
                                                   ?>
                                            <input  type="number" value="<?php echo ($gia_thue1); ?>" class="span6"
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
                        </div> <!---//tabbable -->
                    </div> <!---//widget-content -->
                </div> <!---//widget -->

            </div> <!---//span12 -->
        </div> <!---//row -->
    </div> <!---//container -->   
</div> <!---//main-inner  -->      
            