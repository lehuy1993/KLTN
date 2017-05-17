<?php 
	include_once 'core/CRUD.php';
	if(isset($_GET['idsp']) ){
		$id = $_GET['idsp'];
		$cart = '';  
		$cart =$_SESSION['cart']?$_SESSION['cart']:'';
		$db = new CRUD();
		$id=$_REQUEST['idsp'];
        $dieukien = "id=".$id;
		$sp=$db->select(Table::tbtruyen,$dieukien);
        $row=$db->fetch();
        $idtruyen = $row[0]['id_truyen'];
        $db1 = new CRUD();
        $where = array('id_truyen'=>$idtruyen);
        $db1->select(Table::tbct_truyen,$where);
        $row2 = $db1->fetch();
		if (!empty( $_SESSION['cart'])) {
			$cart=$_SESSION['cart'];
			// kiểm tra lần tiếp theo mua hàng
			if(array_key_exists($id, $_SESSION['cart'])){
				$cart[$id]  = array(
				'id'=> $row[0]['id'],
				'sl' => (int)$_SESSION['cart'][$id]["sl"]+1 ,
				'price' => $row2[0]['gia_moi'],
				'name' => $row[0]['ten'],
				'image'=> $row2[0]['anh_bia'] 
				);

			}else{
				$cart[$id]  = array(
				'id'=> $row[0]['id'],
				'sl' => 1 ,
				'price' => $row2[0]['gia_moi'],
				'name' =>$row[0]['ten'],
				'image'=> $row2[0]['anh_bia'] 

				);

			}
		}else{
			// lần đầu mua hàng
			$cart[$id]  = array(
				'id'=> $row[0]['id'],
				'sl' => 1 ,
				'price' => $row2[0]['gia_moi'],
				'name' =>$row[0]['ten'],
				'image'=> $row2[0]['anh_bia'] 

				);
		}
		$_SESSION['cart'] = $cart;
		 echo " <script>alert('Đặt hàng thành công!'); 
            location.href='index.php?options=giohang';</script>";
	
	
		
	}
	

	 
?>
