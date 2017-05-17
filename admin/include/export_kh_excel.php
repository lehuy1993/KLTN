   <meta charset="utf-8">

<?php
		$data = array(array('Họ và tên','Số điện thoại','Số lần thuê','Tổng tiền thuê'));
		include_once '/../../core/CRUD.php';
		require 'php-excel.php';
		$conn = mysql_connect("localhost","root","") or die(mysql_error() );
	 $so_lan = $_POST['so_lan'];
	    mysql_select_db("kltn",$conn);
	     mysql_query('SET NAMES "UTF-8"');
	     $sql ="SELECT * ,SUM(tien_thue) As tienthue, COUNT(*) AS number_record  FROM phieu_tra GROUP BY sdt HAVING number_record > 0 ORDER BY tienthue";
	     	$result = mysql_query($sql);
    @$numrow = mysql_num_rows($result);

		
		if ($numrow>0)
		{
			while (@$row=mysql_fetch_array($result)) 
			{ 
				$data[] = array ($row['ten_kh'], $row['sdt'],$row['number_record'],number_format($row['tienthue'])); 
			} 
			$xls = new Excel_XML('UTF-8', false, 'Sheet 1');
			$xls->addArray($data);
			$xls->generateXML('khach_hang');
			/*  */
		}

         else{
			echo "<script> alert('không có dữ liệu');
        location.href='?options=khach_hang';</script>"; 
         }
		
?>