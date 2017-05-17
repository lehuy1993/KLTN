
<?php
include_once '../core/CRUD.php';
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);//loại bỏ nhắc nhở lập trình viên  Undefined index...
?>

<?php
if (isset($_POST['edit'])) {
    //Lấy dữ liệu trên form
    $id = $_REQUEST['masp'];
   $id_truyen = $_REQUEST['id_truyen'];
    $ten_truyen=$_REQUEST['ten_truyen'];
    $tom_tat=$_REQUEST['tom_tat'];
    $nxb=$_REQUEST['nxb'];
    $gia_bia=($_REQUEST['gia_bia']);
    $gia_cuoc=($_REQUEST['gia_cuoc']);
    $tac_gia = $_REQUEST['tac_gia'];
    $the_loai=$_REQUEST['the_loai'];
    $vi_tri=$_REQUEST['vi_tri'];

    
    $dbAction = new CRUD();
    //Tạo mảng giá trị sửa
    $data = array(
                    'id_truyen'=>$id_truyen,
                    'ten'    => $ten_truyen , 
                    'tom_tat'     => $tom_tat,
                    'nxb' => $nxb,
                    'gia_bia'  => $gia_bia,
                    'gia_cuoc'    => $gia_cuoc,
                    'tac_gia'=>$tac_gia,
                    'the_loai'=>$the_loai,
                    'vi_tri'=>$vi_tri,
    );

    $where = array('id' => $id);

    //  Thực thi 
  if($dbAction->update(Table::tbtruyen,$data,$where))
    {
        echo "<script> alert('Cập nhật dữ liệu thành công');
        location.href='?options=truyen_list';</script>";   
    }else{
        echo "<script> alert('Lỗi sửa đổi dữ liệu!!!');</script>";  
    }
}

?>
<?php
if (isset($_REQUEST['masp'])) {
    //Lấy mã trên url
    $id = $_REQUEST['masp'];
    $db = new CRUD();
    $dieukien = "id=" . $id;
    $db->select(Table::tbtruyen, $dieukien);

    $row_edit = $db->fetch();

    ?>
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">
                        <div class="widget-header">
                            <i class="icon-pencil"></i>

                            <h3>Sửa truyện có mã
                                <b><font color="#FF0000">
                                        [<?php echo $row_edit[0]['id']; ?>]</font></b></h3>
                        </div>
                        <!-- /widget-header -->

                        <div class="widget-content">
                            <div class="tabbable">
                                <form name="frmsan_pham" id="frmsan_pham" class="form-horizontal"
                                      method="post" enctype="multipart/form-data">
                                    <fieldset>
                                 <div class="control-group">                                            
                                        <label class="control-label" for="id_truyen">ID truyện</label>
                                        <div class="controls">
                                            <input type="text" value="<?php echo $row_edit[0]['id_truyen']; ?>"  class="span6" id="id_truyen" 
                                            name="id_truyen" required>
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class="control-group">                                         
                                        <label class="control-label" for="ten_truyen">Tên truyện</label>
                                        <div class="controls">
                                            <input type="text" value="<?php echo $row_edit[0]['ten']; ?>" class="span6" required="" minlength="5" maxlength="100" id="ten_truyen" 
                                            name="ten_truyen" required>
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->

                                    <div class="control-group">                                         
                                        <label class="control-label" for="tom_tat">
                                            Mô tả truyện</label>
                                        <div class="controls">
                                            <textarea value=""  class="span10 ckeditor" name="tom_tat" required> <?php echo $row_edit[0]['tom_tat']; ?></textarea>
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    
                                     <div class = "control-group">
                                        <label class = "control-label" for = "id_loai">
                                            Loại truyện</label>
                                        <div class = "controls">
                                            <div class = "btn-group">
                                                <select class = "form-control" name = "the_loai" id = "the_loai">
                                                    <?php
                                                    if(isset($_REQUEST['maloai']))
                                                    {
                                                        $dbloaisp=new CRUD();
                                                        $id_loai = $_REQUEST['maloai'];
                                                        $where  = array('trang_thai' =>1 , 

                                                                        );
                                                        $dbloaisp->select(Table::tbloai_truyen,$where);
                                                        $dataloaisp=$dbloaisp->fetch();
                                                         foreach ($dataloaisp as $row) {
                                                                echo '<option value="' .$row['id_loai']  . '"';
                                                                if($row['id_loai']== $id_loai)  echo "selected"; 
                                                                echo '>' . $row['ten'] . '</option>';
                                                            }
                                                        }
                                                    ?>   
                                                </select>
                                            </div>
                                        </div> <!--/controls -->
                                    </div> <!--/control-group -->
                                     <div class = "control-group">
                                        <label class = "control-label" for = "id_loai">
                                            Nhà Xuât Bản </label>
                                        <div class = "controls">
                                            <div class = "btn-group">
                                                <select class = "form-control" required="" name = "nxb" id = "nxb">
                                                    <?php
                                                    if(isset($_REQUEST['manxb']))
                                                    {
                                                        $dbloaisp=new CRUD();
                                                        $id_loai = $_REQUEST['manxb'];
                                                        $where  = array('trang_thai' =>1 , 

                                                                        );
                                                        $dbloaisp->select(Table::tbnha_xuat_ban,$where);
                                                        $dataloaisp=$dbloaisp->fetch();
                                                         foreach ($dataloaisp as $row) {
                                                                echo '<option value="' .$row['id_nxb']  . '"';
                                                                if($row['id_nxb']== $id_loai)  echo "selected"; 
                                                                echo '>' . $row['ten'] . '</option>';
                                                            }
                                                        }
                                                    ?>   
                                                </select>
                                            </div>
                                        </div> <!--/controls -->
                                    </div> <!--/control-group -->
                                   
                                    <div class="control-group">                                         
                                        <label class="control-label" for="tac_gia">
                                                Tác giả </label>
                                        <div class="controls">
                                            <input type="text"  value="<?php echo $row_edit[0]['tac_gia']; ?>" required="" minlength="5" maxlength="100" class="span4" id="tac_gia" 
                                                name="tac_gia" required >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class="control-group">                                         
                                        <label class="control-label" for="gia_bia">
                                            Giá bìa</label>
                                        <div class="controls">
                                            <input type="number"  value="<?php echo $row_edit[0]['gia_bia']; ?>" class="span4"  required="" min="1000" max="10000000" id="gia_bia" 
                                                name="gia_bia" required >
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->

                                    <div class="control-group">                                         
                                        <label class="control-label" for="gia_cuoc">Giá cược</label>
                                        <div class="controls">
                                            <input type="number"  value="<?php echo $row_edit[0]['gia_cuoc']; ?>" required="" min="1000" max="1000000" class="span4" id="gia_cuoc" 
                                                name="gia_cuoc" required>
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                     <div class="control-group">                                            
                                        <label class="control-label" for="gia_cuoc">Vị trí</label>
                                        <div class="controls">
                                            <input type="text"  value="<?php echo $row_edit[0]['vi_tri']; ?>" required="" minlength="3" maxlength="100" class="span4" id="vi_tri" 
                                                name="vi_tri" required>
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                 <div class = "control-group">
                                        <div class = "form-actions">
                                            <input type = "submit" class = "btn btn-primary" 
                                                   name = "edit" value="Cập nhật">
                                            <input type = "reset" class = "btn btn-warning" 
                                            value = "Quay lại" 
                                            onClick="location.href='?options=truyen_list'" >
                                        </div> <!--/form-actions -->
                                    </div>
                                </fieldset>
                                </form>

                            </div>
                        </div>
                        <!-- /widget-content -->
                    </div>
                    <!-- /widget -->
                </div>
                <!-- /span12 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div> <!-- /main-inner -->
    <?php
}
?>