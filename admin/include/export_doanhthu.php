   <meta charset="utf-8">

<?php
		$data = array(array('Tiền thuê ','Tiền phạt','Tổng tiền'));
		include_once '/../../core/CRUD.php';
		require 'php-excel.php';
		$conn = mysql_connect("localhost","root","") or die(mysql_error() );
	 
	    mysql_select_db("kltn",$conn);
	     mysql_query('SET NAMES "UTF-8"');
	     $sql = "SELECT * ,SUM(tien_thue) As tien_thue, SUM(tien_phat) AS tien_phat  FROM phieu_tra WHERE ngay_tra BETWEEN CAST('$_REQUEST[ngay_bd]' AS DATE) AND CAST('$_REQUEST[ngay_kt]' AS DATE) ";
   
	     	$result = mysql_query($sql);
    @$numrow = mysql_num_rows($result);

		
		if ($numrow>0)
		{
			while (@$row=mysql_fetch_array($result)) 
			{ 
				$tongtien = $row['tien_thue'] + $row['tien_phat'];
				$data[] = array ($row['tien_thue'], $row['tien_phat'],number_format($tongtien)); 
			} 
			$xls = new Excel_XML('UTF-8', false, 'Sheet 1');
			$xls->addArray($data);
			$xls->generateXML('doanhthu');
			/*  */
		}

         
         else{
			echo "<script> alert('không có dữ liệu');
        location.href='?options=doanhthu';</script>"; 
         }
		
?>