<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);//loại bỏ nhắc nhở lập trình viên  Undefined index...
?>
<?php
include_once '../core/CRUD.php';
?>
<?php //Thêm mới dữ liệu vào bảng
if(isset($_POST['add'])){
   
	//Lấy dữ liệu trên form
	$id_truyen = $_REQUEST['id_truyen'];
	$ten_truyen=$_REQUEST['ten_truyen'];
	$tom_tat=$_REQUEST['tom_tat'];
    $nxb=$_REQUEST['nxb'];
	$gia_bia=($_REQUEST['gia_bia']);
    $gia_cuoc=($_REQUEST['gia_cuoc']);
    $tac_gia = $_REQUEST['tac_gia'];
    $the_loai=$_REQUEST['the_loai'];
    $vi_tri=$_REQUEST['vi_tri'];
    $dbtruyen = new CRUD();
    //Tạo mảng giá trị thêm mới
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

    //Thực hiện gọi hàm insert, để thêm dữ liệu 
    $id_nxb = $dbtruyen->insert(Table::tbtruyen,$data);
	if($id_nxb)
	{
        // thêm giá trị các đặc tính của truyện
        $dbDT=new CRUD();

        $dbDT->select(Table::tbdac_tinh);
        $data=$dbDT->fetch();
        $num_rows = $dbDT->num_rows();
        if($num_rows>0)
        {
            foreach ($data as $row) {
                $field=$row['Ten_dt'];
                $gtri=isset($_REQUEST[$field])?$_REQUEST[$field]:0;
                //them vào bảng truyện dặc tính
                //Lấy mã truyện, mã đặc tính, giá trị
                //Lấy mã truyện
                $dbtruyen->select(Table::tbtruyen,'1=1','Ma_SP DESC','1,1');
                $datasp=$dbtruyen->fetch();     
                       
                $dataSPDT=array('MaDT' =>$row['MaDT'] , 'Gia_tri' => $gtri, 'Ma_SP' => $datasp[0]['Ma_SP'],'ten_truyen' => $datasp[0]['ten_truyen'],'Ten_dt' => $row['Ten_dt'] );
              
            }
        }
		echo "<script> alert('Thêm mới thành công');
		location.href='?options=truyen_list';</script>";	
	}else{
			echo "<script> alert('Lỗi thêm mới');</script>";
	}
}
//===========================================================
?>
<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">    
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Thêm mới truyện</h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <div class="tabbable">
                            <form name="frmthemsanpham" id="edit-profile" class="form-horizontal" 
                            		method="post" enctype="multipart/form-data">
                                <fieldset>
                                 <div class="control-group">                                            
                                        <label class="control-label" for="id_truyen">ID truyện</label>
                                        <div class="controls">
                                            <input type="text"  class="span6" id="id_truyen" 
                                            name="id_truyen" required>
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class="control-group">											
                                        <label class="control-label" for="ten_truyen">Tên truyện</label>
                                        <div class="controls">
                                            <input type="text" class="span6" required="" minlength="5" maxlength="100" id="ten_truyen" 
                                            name="ten_truyen" required>
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->

                                    <div class="control-group">											
                                        <label class="control-label" for="tom_tat">
                                            Mô tả truyện</label>
                                        <div class="controls">
                                            <textarea  class="span10 ckeditor" name="tom_tat" required></textarea>
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->
                                    
                                     <div class = "control-group">
                                        <label class = "control-label" for = "id_loai">
                                            Loại truyện</label>
                                        <div class = "controls">
                                            <div class = "btn-group">
                                                <select class = "form-control" name = "the_loai" id = "the_loai">
                                                    <?php
                                                        $dbloaisp=new CRUD();
                                                        $where  = array('trang_thai' =>1 , );
                                                        $dbloaisp->select(Table::tbloai_truyen,$where);
                                                        $dataloaisp=$dbloaisp->fetch();
                                                        foreach($dataloaisp as $row){
                                                            echo '<option value="' . $row['id_loai'] .'"';
                                                            echo '>' . $row['ten'] . '</option>';
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
                                                        $dbloaisp=new CRUD();
                                                        $where  = array('trang_thai' =>1 , );
                                                        $dbloaisp->select(Table::tbnha_xuat_ban,$where);
                                                        $dataloaisp=$dbloaisp->fetch();
                                                        foreach($dataloaisp as $row){
                                                            echo '<option value="' . $row['id_nxb'] .'"';
                                                            echo '>' . $row['ten'] . '</option>';
                                                        }
                                                    ?>   
                                                </select>
                                            </div>
                                        </div> <!--/controls -->
                                    </div> <!--/control-group -->
                                   
                             

                                    <div class="control-group">											
                                        <label class="control-label" for="gia_cuoc">Giá cược</label>
                                        <div class="controls">
                                            <input type="number" required="" min="1000" max="1000000" class="span4" id="gia_cuoc" 
                                            	name="gia_cuoc" required>
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->
                                     <div class="control-group">                                            
                                        <label class="control-label" for="gia_cuoc">Vị trí</label>
                                        <div class="controls">
                                            <input type="text" required="" minlength="3" maxlength="100" class="span4" id="vi_tri" 
                                                name="vi_tri" required>
                                        </div> <!-- /controls -->               
                                    </div> <!-- /control-group -->
                                    <div class = "control-group">
                                        <div class = "form-actions">
                                            <input type = "submit" class = "btn btn-primary" 
                                                name = "add" value="Thêm mới">
                                            <input type = "reset" class = "btn" value = "Đặt lại" >
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
         