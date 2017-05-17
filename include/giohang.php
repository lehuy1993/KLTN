<div id="main">
					
					<style>
.bg-breadcrumb {
	background: url("images/parallax-breadcrumb.jpg") no-repeat center center;}
</style>
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

  }
  if(isset($_GET['idsp']) &&isset($_GET['action']) ){
    unset($_SESSION['cart'][$_GET['idsp']]);
  }
  
   
?>  

<section class="section-breadcrumbs">
      <div class="bg-breadcrumb">
        <div class="container">
          <ol class="breadcrumb">
            <li>
              <a href="index.php" title="Trang chủ">Trang chủ</a>
            </li>
			  
			  
			  
			  					<!-- blog -->
            					
									<li class="active">Giỏ hàng</li>
			  			  			<h2 class="breadcrumb-title">Giỏ hàng</h2>

			  					<!-- collection -->
			  					
			  
			  
			  <!-- current_tags -->
									
			  
			  
          </ol>
        </div>
      </div>

    </section> <!-- End .section-breadcrumbs -->
					
					<section class="mt-40 mb-40 cart">
	<div class="container">
		 <?php 
                        
                          if(empty($_SESSION['cart'])){
                            echo "<span align=center style=\"padding-right:5px; padding-bottom:5px; color:#F00\">Không có sản phẩm nào trong giỏ hàng của Quý khách!</span>";
                        }else{
          ?>
		<form action="?options=giohang" method="post" id="cartform" class="clearfix">
			<div class="table-responsive">
				<table class="table table-hover table-cart">
					<thead>
						<tr>
							<th></th>
							<th class="table-name">Tên sản phẩm</th>
							<th class="table-price">Đơn giá</th>
							<th class="table-qty">số lượng</th>
							<th>thành tiền</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php

                             $total=0;;$i = 0;

                            foreach ($_SESSION['cart'] as $key => $value) {
                            $i++;
                            

                          
                        ?>
						<tr class="product-bg"></tr>
						
						<tr class="product-cart">
							<td>
								<a class="product-img" >
									
									<img  src="public/truyen/<?php  echo $_SESSION['cart'][$key]['image']?>"" class="img-responsive">

									
								</a>
							</td>
							<td>
								<h5 class="product-name"><a href="#"><?php echo $_SESSION['cart'][$key]['name']; ?></a>
									
								</h5>
							</td>
							<td><span class="product-price"><?php echo number_format($_SESSION['cart'][$key]['price']); ?>₫</span></td>
							 <td >
                                        <div style="display: inline-flex;" class="form-inline text-center">
                                            <div class="">
                                                <input class="form-control numberCart text-center" name="sl_<?php echo $key; ?>" id="sl_<?php echo $key; ?>" value="<?php echo $_SESSION['cart'][$key]['sl']; ?>">
                                            </div>
                                            
                                            &nbsp;
                                                    <a  href="javascript:void(0)" onclick="updateItem(<?php echo $key ?>)">
                                                    <i style="font-size: 20px" class="btn-icon-only fa fa-refresh"></i>
                                                </a>
                                         
                                            &nbsp;
                                          
                                                <a href="javascript:void(0)" onclick="deleteItem(<?php echo $key ?>)">
                                                    <i  style="font-size: 20px"class="btn-icon-only fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
							<td><span class="product-price"><?php echo number_format( $_SESSION['cart'][$key]['sl']* $_SESSION['cart'][$key]['price']); ?>₫</span></td>
							<td></td>
						</tr>
						<tr class="product-bg"></tr>
						<tr class="product-line">
							<td>line</td>
							<td>line</td>
							<td>line</td>
							<td>line</td>
							<td>line</td>
							<td>line</td>
						</tr>
						 <?php
						 	$total += ($_SESSION['cart'][$key]['sl']* $_SESSION['cart'][$key]['price']);

                                          $total2=number_format($total);
                                 }
                            
      
                         
         
                                ?>
						
					
						<tr class="product-bg"></tr>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-md-8 col-sm-8">
					<div class="">
						<a class="btn-gray" href="index.php">Mua thêm</a>
						
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="cart-action">
						<p class="cart-total">Tổng cộng:   <span><?php
							
                                          echo $total2;

						?>₫</span></p>
						<a href="?options=checkcart" class="btn-red">Thanh toán</a>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		</form>
		
	</div>
</section>


</div>
				
<script type="text/javascript">
       
        function deleteItem(id){
          $.get("index.php?options=giohang&idsp="+id+"&action=del",function(data)
          {
            location.reload(); 
          }); 

        }
</script>