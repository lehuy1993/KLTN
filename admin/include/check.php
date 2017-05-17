<?php
include_once '../core/CRUD.php';

?>
<?php
if(isset($_REQUEST['id'])){
    	$id = $_GET['id'];
		$cart1 = '';  
		$cart1 =$_SESSION['cart1'];

		$db = new CRUD();
		$Ma_SP=$_REQUEST['id'];
        $dieukien = "id=".$Ma_SP;
		$sp=$db->select(Table::tbtruyen,$dieukien);
        $row=$db->fetch();
        $id_truyen =$row[0]['id_truyen'];

        $db1 = new CRUD();
        $where = array('id_truyen'=>$id_truyen);
        
        $ct=$db1->select(Table::tbct_truyen,$where);
        $row1 =$db1->fetch();
		if (!empty( $_SESSION['cart1'])) {
			$cart1=$_SESSION['cart1'];
			// kiểm tra lần tiếp theo mua hàng
			if(array_key_exists($id, $_SESSION['cart1'])){
				$cart1[$id]  = array(
				'id'=> $row[0]['id'],
				'sl' => (int)$_SESSION['cart1'][$id]["sl"]+1 ,
				'price' => $row1[0]['gia_thue'],
				'name' => $row[0]['ten'],
				'image'=> $row[0]['gia_cuoc'] 
				);

			}else{
				$cart1[$id]  = array(
				'id'=> $row[0]['id'],
				'sl' => 1 ,
				'price' => $row1[0]['gia_thue'],
				'name' =>$row[0]['ten'],
				'image'=> $row[0]['gia_cuoc'] 

				);

			}
		}else{
			// lần đầu mua hàng
			$cart1[$id]  = array(
				'id'=> $row[0]['id'],
				'sl' => 1 ,
				'price' => $row1[0]['gia_thue'],
				'name' =>$row[0]['ten'],
				'image'=> $row[0]['gia_cuoc'] 

				);
		}
		$_SESSION['cart1'] = $cart1;
		 echo  "  <script>alert('Đặt hàng thành công!'); 
            location.href='index.php?options=add';</script>";
}
?>