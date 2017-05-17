<div class="header-nav">

<?php

  if(isset($_GET['idsp']) &&isset($_GET['sl']) ){
            //cạp nhat giỏ hàng
    $db = new CRUD();
    $id=$_GET['idsp'];
        $dieukien = "id=".$id;
    $db->select(Table::tbtruyen,$dieukien);
        $row=$db->fetch();
        if($_GET['sl']>0){
        	$idtruyen = $row[0]['id_truyen'];
        $db1 = new CRUD();
        $where = array('id_truyen'=>$idtruyen);
        $db1->select(Table::tbct_truyen,$where);
        $row2 = $db1->fetch();
    $_SESSION['cart'][$_GET['idsp']] = array(
      'sl' => $_GET['sl'] ,
      'price' => $row2[0]['gia_moi'],
		'name' => $row[0]['ten'],
		'image'=> $row2[0]['anh_bia'] 

      );
    }else{
      unset($_SESSION['cart'][$_GET['idsp']]);
    }

  } if(isset($_GET['idsp']) &&isset($_GET['action']) ){
    unset($_SESSION['cart'][$_GET['idsp']]);
  }
  
   
?>  
<?php
						$i = 0;
						 if ($_SESSION['cart']) 
						 {
						 	# code...
						 
                             $total=0;

                            foreach ($_SESSION['cart'] as $key => $value) {
                            $i++;
                        }
                            
}
                          
                        ?>
	<div class="container">
		

		<nav class="navbar navbar-default" id="homemenu" role="navigation">
			<ul class="nav-bar-search-cart nav navbar-nav">          
				
				<li class="cart dropdown">
					<a href="#" id="dLabel1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="images/cart.png" alt="CART">
						
						<span class="cart-number"><?php echo $i ?></span>
					</a>	         
					<div id="cart-info-parent" class="dropdown-menu">
						<div class="arrow"></div>
						 <?php
						
						 	if (($_SESSION['cart'])) {
						 		
                             $total=0;;$i = 0;

                            foreach ($_SESSION['cart'] as $key => $value) {
                            $i++;
                            

                          
                        ?>
						<div id="cart-info">
							<div class="cart-content" id="cart-content">
							<div class="control-container">
							<div class="row">
							<div class="col-md-10 cart-left"><img src="public/truyen/<?php  echo $_SESSION['cart'][$key]['image']?>"
							></div>
							<a class="cart-close" title="Xóa" href="javascript:void(0)" onclick="deleteItem(<?php echo $key ?>)"><img class="item-remove" src="images/itemclose.png"></a>

							<div class="col-md-14 cart-right"><div class="cart-title"><a href="#"><?php echo $_SESSION['cart'][$key]['name']; ?></a>
							</div><div class="cart-price">Giá: <?php echo number_format($_SESSION['cart'][$key]['price']); ?>₫</div>
							<div class="cart-price">Số lượng: <?php echo $_SESSION['cart'][$key]['sl']; ?></div></div>
							</div>

							</div>
							<?php
								 $total += ($_SESSION['cart'][$key]['sl']* $_SESSION['cart'][$key]['price']);

                                          $total2=number_format($total);
							?>
							<?php
							}
							?>
							<div class="subtotal"><span>Tổng số:</span><span class="cart-total-right"><?php echo $total2; ?>₫</span></div><div class="action"><a id="gocart" href="?options=giohang">Giỏ hàng</a></div></div>
						</div>
						
					</div>
					<?php
							
						}else
						echo "Không có sản phẩm trong giỏ hàng";
						?>
				</li>
			</ul>
			<!-- Grid demo navbar -->
			<div class="navbar navbar-default yamm">                     
				<div id="navbar-collapse-grid" class="navbar-collapse collapse">			 
					<ul class="nav navbar-nav">
						<!-- Grid 12 Menu -->
						
						<li class="fali  "><a href="index.php" title="Trang chủ">Trang chủ</a></li>						
						
						
						
						
						<li class="fali  "><a href="?options=huongdan" title="Blog">Hướng dẫn</a></li>					
						
						
						
						<li class="fali  "><a href="?options=gioithieu" title="Giới thiệu">Giới thiệu</a></li>					
						
						
						
						<li class="fali  "><a href="?options=lienhe" title="Liên hệ">Liên hệ</a></li>					
						
						
					</ul>
				</div>
			</div>
		</nav>
	</div>
</div> <!-- End .header-nav -->
<script type="text/javascript">
        function updateItem(id){
          sl=$("#sl_"+id).val();
          $.get("index.php?options=giohang&idsp="+id+"&sl="+sl,function(data){
            location.reload(); 
          });
        }
        function deleteItem(id){
          $.get("index.php?options=giohang&idsp="+id+"&action=del",function(data)
          {
            location.reload(); 
          }); 

        }
</script>