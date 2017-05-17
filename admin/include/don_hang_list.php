<?php
	include_once '../core/CRUD.php';
?>
<?php

$db = new CRUD();
	// Lấy dữ liệu tìm kiếm -> tạo chuỗi điều kiện tìm
	$dieukien =" 1=1 ";	
	$keyword_Id=isset($_REQUEST['keyword_Id'])?$_REQUEST['keyword_Id']:0;
	$keyword_Name=isset($_REQUEST['keyword_Name'])?$_REQUEST['keyword_Name']:"";
	if($keyword_Id>0)
		$dieukien .=" and MA_HD=$keyword_Id ";
	if($keyword_Name!="")
		$dieukien .=" and hoten_nguoinhan like '%$keyword_Name%'";
	//-----------
$loaisp=$db->select(Table::tbhoa_don,$dieukien);
$numrow = $db->num_rows();
?>

<div class="main-inner">
    <div class="container">
        <div class="row">
            <div class="span12">      	
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Quản lý hóa đơn</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li  class="active">
                                <a href="#jshang_san_xuatlist" data-toggle="tab">
                                    Danh sách hóa đơn
                                    	<b><font color="#FF0000">
                                    	[<?php echo $numrow; ?>]</font></b></a> 
                                </li>                                 
                                <form method="post" action="?options=don_hang_list"
                                    class="form-inline" role="form" 
                                    style="margin-top:5px; text-align:right">
                                    <input type="text" name="keyword_Id" id="keyword_Id" 
                                        class="form-control search "  
                                        value="<?php if($keyword_Id>0) echo $keyword_Id;?>"
                                        placeholder="Nhập mã...">
                                    <input type="text" name="keyword_Name" id="keyword_Name" 
                                        class="form-control search" 
                                        value="<?php echo $keyword_Name;?>"
                                        placeholder="Nhập tên...">
                                    
                                    <input type="submit" class="btn-success "  
                                    	value="Tìm kiếm"/>
                                </form>                             
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="jsdon_hang_list">
                                    <table class="table table-striped table-bordered ">
                                        <thead>
                                            <tr align="center">
                                                <th class="td-actions">
                                                    <input type="checkbox" id="checkAll" name="chk_All" /></th>
                                                <th class="td-actions"> Mã đơn hàng</th>
                                                <th class="td-actions"> Họ tên</th>
                                                <th class="td-actions"> Địa chỉ</th>
                                                <th class="td-actions"> Số điện thoại</th>
                                                <th class="td-actions"> Email</th>
                                                <th class="td-actions"> Ngày giao hàng  </th>
                                                <th class="td-actions"> Mã khách hàng</th>
                                                <th class="td-actions">Tổng tiền</th>
                                                <th class="td-actions"> Trạng thái  </th>
                                                <th class="td-actions" width="80px"> Thao tác </th>
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
                                                    <a href="?op">
                                                        <input type="checkbox" 
                                                        	id="chk_<?php echo $row['MA_HD'];?>" 
                                                            name="chk_<?php echo $row['MA_HD'];?>" />
                                                    </td>
                                                    <td style="text-align: center;">
                                                    	<a href="
                                                            ?options=don_hang_chi_tiet&maHD=<?php echo $row['MA_HD'];?>"
                                                            title="Xem hóa đơn có mã [<?php echo $row['MA_HD'];?>]">
                                                            <?php echo $row['MA_HD'];?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                    	<a href="#">
                                                    		<?php echo $row['hoten_nguoinhan'];?>
                                                        </a></td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['diachi_nguoinhan'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['dienthoai_nguoinhan'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['email'];?>
                                                    </td>
                                                     <td style="text-align: center;">
                                                        <?php echo $row['ngay_giao_hang'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['MaKH'];?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row['tong_tien'];?>
                                                    </td>
                                                    <td style="text-align: center;width:20%">
                                                        <select name="trang_thai" style="width:50%"
                                                        onChange="location.href='?options=don_hang_list&action=edit&Ma_HD=<?php  echo $row['MA_HD'];?>&trang_thai='+this.value">
                                                        <?php 
                                                            if($row['trang_thai']==0)
                                                            {
                                                        ?>
                                                            <option value="1">Đặt hàng</option>
                                                            <option value="0" selected>Đã mua </option>
                                                         <?php
                                                            }else{
                                                         ?> 
                                                            <option value="1" selected>Đặt hàng</option>
                                                            <option value="0">Đã mua</option>
                                                         <?php
                                                            }
                                                         ?> 
                                                         </select>                                                      
                                                    </td>
                                                    <td class="td-actions">
                                                   
                                                        
                                                        <a style="float: left"
                                                        onClick="if(confirm('Bạn có chắc chắn muốn xóa hóa đơn có mã là [<?php echo $row['MA_HD'];?>] không?')){ location.href='?options=don_hang_list&action=del&MA_HD=<?php echo $row['MA_HD'];?>'}"
                                                            class="btn btn-small btn-warning" 
                                                            title="Xóa hóa đơn có mã[<?php echo $row['MA_HD'];?>]">
                                                            <i class="btn-icon-only fa fa fa-times"> </i>
                                                        </a>
														<a style="float: left" href="?options=don_hang_list&action=xuat_xml&MA_HD=<?php echo $row['MA_HD'];?>"><img src="../public/images/xml.png" style="width: 22px; height: 22px"/></a>
                                                    </td>
                                                </tr>
												 <?php
                                                        }// end while
                                                    }// 
                                                    else{		
                                                 ?>
 												<tr>
                                                	<td colspan="5"> 
                                                    	Không có hóa đơn  nào! 
                                                    </td>
                                                </tr>   
  												<?php }//end if ?>                           
  
                                        </tbody>
                                    </table>
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
														$db = new CRUD();

                                                        $MA_HD = $row['MA_HD'];
                                                        $where = array('MA_HD'=>$MA_HD);
                                                        //-----------
                                                        $loaisp=$db->select(Table::tbct_hoa_don,$where);
                                                        $row2 = $db->fetch();

 $so_luong_ban = $row2[0]['so_luong_ban'];
 $Ma_SP = $row2[0]['Ma_SP'];
	// Lấy hành động
	$action=isset($_REQUEST['action'])?$_REQUEST['action']:"";
	
	// Phần xử lý cho chức năng cập nhật trạng thái 
	// Khi thay đổi trên comboBox trạng thái
	//1. Lấy mã cần cập nhật
	$MA_HD=isset($_REQUEST['Ma_HD'])?$_REQUEST['Ma_HD']:0;
	//2. Lấy trạng thái cần cập nhật
	$trang_thai=isset($_REQUEST['trang_thai'])?$_REQUEST['trang_thai']:"";
	//3. Kiểm tra các giá trị của biến để xác định việc cập nhật
	if($MA_HD>0 && $trang_thai!="" && $action=="edit")
	{	
		//Dữ liệu cập nhật
		$data=array("trang_thai"=>"$trang_thai");
		$where=array("MA_HD"=>"$MA_HD");
		
		//5. Thực thi câu lệnh cập nhật
		if($db->update(Table::tbhoa_don,$data,$where)==true)
		{
			$sql = "UPDATE san_pham SET So_luong = So_luong - '$so_luong_ban'Where Ma_SP = '$Ma_SP'  ";
			mysql_query($sql);
			echo "<script>";
			echo "location.href='?options=don_hang_list';</script>";
		}
	}
?>
<?php
	// Phần xử lý cho chức năng xóa 
	//1. Lấy mã cần xóa
	$MA_HD=isset($_REQUEST['MA_HD'])?$_REQUEST['MA_HD']:0;	
	//3. Kiểm tra các giá trị của biến để xác định việc xóa
	
	if($MA_HD>0 && $action=="del")
	{
		//4. Kiểm tra nếu đang có sản phẩm của loại thì 
		// không cho phép xóa.		
		
		
		
			//5. Điều kiện xóa
			//$dieukien="Where MA_HD=$MA_HD";
			$where = array("MA_HD"=>"$MA_HD");
			
			//6. Thực thi câu lệnh cập nhật
			if($db->delete(Table::tbhoa_don,$where)==true)
			{
				echo "<script> alert('Xóa dữ liệu thành công');";
				echo "location.href='?options=don_hang_list';</script>";
			}
		
	}
?>
<?php
	// Phần xử lý cho chức năng xuất XML
	//1. Lấy mã cần xóa
	$MA_HD=isset($_REQUEST['MA_HD'])?$_REQUEST['MA_HD']:0;
	//3. Kiểm tra các giá trị của biến để xác định việc xóa
	
	if($MA_HD>0 && $action=="xuat_xml")
	{
		$db = new CRUD();
		$donhang_query = '
		SELECT * FROM `hoa_don` 
		LEFT JOIN `ct_hoa_don` ON(`ct_hoa_don`.`MA_HD` = `hoa_don`.`MA_HD`) 
		LEFT JOIN `san_pham` ON (`san_pham`.`Ma_SP` = `ct_hoa_don`.`Ma_SP`)
		WHERE `hoa_don`.`MA_HD` = "'.$MA_HD.'"
		';
		$db->execQuery($donhang_query);
		$donhangs = $db->fetch();
		$donhang = $donhangs[0];
		$export = '<?xml version="1.0" encoding="UTF-8"?>
		<project name="Test_ProGuard" default="default" basedir=".">
			<description>Thuc tap chuyen nganh.</description>
			<import file="nbproject/build-impl.xml"/>
			<target name="-post-jar">
			<property name="proguard.jar.path" value="E:\proguard5.2.1\lib/proguard.jar" />
			<property name="java.home.path" value="C:\Program Files\Java\jre1.8.0_31/" />
			
			<taskdef resource="proguard/ant/task.properties"
					 classpath="${proguard.jar.path}" />
			
			<echo message="Obfuscating ${dist.jar}..."/>
			<mkdir dir="${build.dir}/obfuscated"/>
			<proguard printmapping="${build.dir}/obfuscated/${application.title}.map"
					  renamesourcefileattribute="SourceFile" ignorewarnings="true">
				
				<!-- Specify the input jars, output jars, and library jars. -->
				<injar  file="${dist.jar}" />
				<outjar file="${build.dir}/obfuscated/BalloonWindCore_JavaSE.jar" />
				
				<libraryjar path="${javac.classpath}" />            
				<libraryjar file="${java.home.path}/jre/lib/rt.jar" />
				
				<!-- Keep some useful attributes. -->

				<keepattribute name="InnerClasses" />
				<keepattribute name="SourceFile" />
				<keepattribute name="LineNumberTable" />
				<keepattribute name="Deprecated" />
				<keepattribute name="*Annotation*" />
				<keepattribute name="Signature" />
				
				<!-- Preserve all public classes, and their public and protected fields and methods. -->

				<keep access="public">
					<field  access="public protected" />
					<method access="public protected" />
				</keep>
				
				
				<!-- Preserve all .class method names. -->

				<keepclassmembernames access="public">
					<method type      ="java.lang.Class"
							name      ="class$"
							parameters="java.lang.String" />
					<method type      ="java.lang.Class"
							name      ="class$"
							parameters="java.lang.String,boolean" />
				</keepclassmembernames>
				
				<!-- Preserve all native method names and the names of their classes. -->

				<keepclasseswithmembernames>
					<method access="native" />
				</keepclasseswithmembernames>
				
				<!-- Preserve the methods that are required in all enumeration classes. -->

				<keepclassmembers extends="java.lang.Enum">
					<method access="public static"
							type="**[]"
							name="values"
							parameters="" />
					<method access="public static"
							type="**"
							name="valueOf"
							parameters="java.lang.String" />
				</keepclassmembers>
				
				<!-- Explicitly preserve all serialization members. The Serializable
					 interface is only a marker interface, so it wouldnt save them.
					 You can comment this out if your library doesnt use serialization.
					 With this code serializable classes will be backward compatible -->

				<keepnames implements="java.io.Serializable"/>
				<keepclassmembers implements="java.io.Serializable">
					<field  access    ="final"
							type      ="long"
							name      ="serialVersionUID" />
					<field  access    ="!static !transient"
							name      ="**"/>
					<field  access    ="!private"
							name      ="**"/>
					<method access    ="!private"
							name      ="**"/>
					<method access    ="private"
							type      ="void"
							name      ="writeObject"
							parameters="java.io.ObjectOutputStream" />
					<method access    ="private"
							type      ="void"
							name      ="readObject"
							parameters="java.io.ObjectOutputStream" />
					<method type      ="java.lang.Object"
							name      ="writeReplace"
							parameters="" />
					<method type      ="java.lang.Object"
							name      ="readResolve"
							parameters="" />
				</keepclassmembers>

		';
		//Noi dung don hang
		$export .= '<donhang>';
			$export .= '<madon>';
			$export .= $donhang['MA_HD'];
			$export .= '</madon>';
			
			$export .= '<tensp>';
			$export .= $donhang['Ten_sp'];
			$export .= '</tensp>';
			
			$export .= '<masp>';
			$export .= $donhang['Ma_SP'];
			$export .= '</masp>';
			
			$export .= '<so_luong>';
			$export .= $donhang['so_luong_ban'];
			$export .= '</so_luong>';
			
			$export .= '<gia_ban>';
			$export .= $donhang['gia_ban'];
			$export .= '</gia_ban>';
		$export .= '</donhang>';
		$export .= '</proguard>
		</target>
		</project>';

		file_put_contents("xml_temp/hoadon".$donhang['MA_HD'].".xml", $export);
		echo "<center><a href='xml_temp/hoadon".$donhang['MA_HD'].".xml' target='_blank'>Tải file XML</a></center>";
		
	}
?>