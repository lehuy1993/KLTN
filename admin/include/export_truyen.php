   <meta charset="utf-8">

<?php
		$data = array(array('Tên truyện ','Số lượng','Số lượng thuê','Trạng thái'));
		include_once '/../../core/CRUD.php';
		require 'php-excel.php';
		$conn = mysql_connect("localhost","root","") or die(mysql_error() );
	 
	    mysql_select_db("kltn",$conn);
	     mysql_query('SET NAMES "UTF-8"');
	     $sql = "SELECT * ,SUM(so_luong) As sl, COUNT(*) AS number_record  FROM ct_thue WHERE ngay_thue BETWEEN CAST('$_REQUEST[ngay_bd]' AS DATE) AND CAST('$_REQUEST[ngay_kt]' AS DATE) GROUP BY id_truyen HAVING number_record > 0 order by sl DESC ";
	     	$result = mysql_query($sql);
    @$numrow = mysql_num_rows($result);

		
		if ($numrow>0)
		{
			while (@$row=mysql_fetch_array($result)) 
			{ 

                $db = new CRUD();
                $where = array('id'=>$row['id_truyen']);
                $db->select(Table::tbct_truyen,$where);
                $row1 = $db->fetch();
               
                                                   
				$data[] = array ($row1[0]['ten'], $row1[0]['so_luong'],$row['sl'],$row1[0]['trang_thai']); 
			} 
			$xls = new Excel_XML('UTF-8', false, 'Sheet 1');
			$xls->addArray($data);
			$xls->generateXML('truyen');
			/*  */
		}

         else{
			echo "<script> alert('không có dữ liệu');
        location.href='?options=tk_truyen';</script>"; 
         }
		
?>