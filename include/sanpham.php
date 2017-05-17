<?php
if (isset($_GET['idsp'])) {
	# code...

	$db = new CRUD();
	$id = $_GET['idsp'];
	$where = array('id'=>$id);
	$db->select(Table::tbtruyen,$where);
	$row = $db->fetch();
	$id_truyen = $row[0]['id_truyen'];
	$db1 = new CRUD();
	$where1 = array('id_truyen'=>$id_truyen);
	$db1->select(Table::tbct_truyen,$where1);
	$row1 = $db1->fetch();
	  $sql ="update truyen set Luot_xem = Luot_xem + 1 where id = $id";
     	mysql_query($sql);
}	
?>
<div id="main">
					
					<style>
.bg-breadcrumb {
	background: url("images/parallax-breadcrumb.jpg") no-repeat center center;}
</style>


<section class="section-breadcrumbs">
      <div class="bg-breadcrumb">
        <div class="container">
          <ol class="breadcrumb">
            <li>
              <a href="index.php" title="Trang chủ">Trang chủ</a>
            </li>
			  
			  
			  
			  					<!-- blog -->
            					
			  						<li class="active">
									
										<a href="" >Sản phẩm</a>
																	
			  
			  						</li>

			  						<h2 class="breadcrumb-title"><?php echo $row[0]['ten'] ?></h2>
								
			  					<!-- search -->
			 					 
			  
			  
			  <!-- current_tags -->
									
			  
			  
          </ol>
        </div>
      </div>
    </section> <!-- End .section-breadcrumbs -->
					
<section itemscope=""  class="product-detail mt-40">
	
	<meta itemprop="shop-currency" content="VND">

	<div class="container">
		<div class="row">
			<form action="/cart/add" method="post">
				<div class="col-md-6">
					
						<div class="product-big-wrapper">
							<div class="product-big">
								<div class="product-big-item product-image">
									
									<a href="" id="ex1">
										<img src="<?php echo __ImagePro.$row1[0]['anh_bia']; ?>" id="image" itemprop="image" class="imagezoom" data-zoom-image="<?php echo __ImagePro.$row1[0]['anh_bia']; ?>"
									</a>
								</div>
							</div> <!-- End .slide-product-big -->
						</div>
					
				</div>
				<div class="col-md-6">
					<h1 itemprop="name" class="product-name"> <?php echo $row[0]['ten']; ?></h1>
					<span class="product-sku">
						
					</span>
					<span class="product-price"><p class="price" itemprop="price"><?php echo  number_format($row1[0]['gia_moi']) ?>₫</p>
					<?php
					if ($row1[0]['gia_cu'] > 0) {
						$giacu = number_format($row1[0]['gia_cu']);
						echo "
						<del itemprop=price class=oldprice>$giacu ₫</del>";
								}
						?>
						
						<p class="availability in-stock"><span>Còn <?php echo $row1[0]['so_luong']; ?> hàng</span></p>
						
					</span>
					<p class="product-description"></p>
						
						<div class="grtc">
							<label class="shoppingtexthide">MUA HÀNG</label>
							<br>
							<div class="grbtn">
								
								<a  class="product-action btn-red " style="color: red"  href="?options=addcart&idsp=<?php echo $row[0]['id']; ?>">
		
		Mua hàng</a>	
								
							</div>
						</div>
					</div>
					
					
					
				</div>
			</form>	
		</div>
	</div>
</section> <!-- End .section-product-detail -->
<section class="mt-40 section-product-tabs">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div role="tabpanel" class="product-tab-wrapper">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs product-tab-info" role="tablist">
						<li role="presentation" class="active">
							<a href="#features" aria-controls="home" role="tab" data-toggle="tab">Thông tin sản phẩm</a>
						</li>
						
						
						
						
						<li role="presentation">
							<a href="#product_rate" aria-controls="tab" role="tab" data-toggle="tab">Bình luận</a>
						</li>
						
					</ul>

					<!-- Tab panes -->
					<div class="tab-content product-tab-content">
						<div role="tabpanel" class="tab-pane active" id="features">
							<?php echo $row[0]['tom_tat']; ?>
						</div>
						<div role="tabpanel" class="tab-pane" id="product_infomation">Đặc điểm nổi bật chưa được kích hoạt</div>
						<div role="tabpanel" class="tab-pane" id="product_rate">
					<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=YOUR_APP_ID";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="anhsaoxanh.tv" data-colorscheme="light" 
   data-numposts="5" data-width="500"></div>

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 ">
				
				<div class="product-detail-banner-item img-responsive em-effect06">
					<a href="#Product-detail-banner-1" title="Product detail banner 1" class="em-eff06-03">
						<img src="images/banner1a.jpg" alt="Product detail banner 1">
						
					</a>
				</div> <!-- End .banner-item -->
				
					  
				<div class="product-detail-banner-item img-responsive em-effect06">
					<a href="#Product-detail-banner-2" title="Product detail banner 2" class="em-eff06-03">
						<img src="images/banner2a.jpg" alt="Product detail banner 2">
						
					</a>
				</div> <!-- End .banner-item -->
				
				
				<div class="product-detail-banner-item img-responsive em-effect06">
					<a href="#Product-detail-banner-3" title="Product detail banner 3" class="em-eff06-03">
						<img src="images/banner3a.jpg" alt="Product detail banner 3">
						
					</a>
				</div> <!-- End .banner-item -->
				
			</div>
		</div>
	</div>
</section>



 
<section class="section-products mt-50">
      <div class="container">
        <div class="section-title">
          <img src="images/icons-title-top.png" alt="Sản phẩm">
          <h3 class="section-title-heading">Sản phẩm</h3>
			<a href="#" title="Sản phẩm"><p class="section-title-main">Liên quan</p></a>
          <img src="images/icons-title-bottom.png" alt="Sản phẩm">
        </div> <!-- End .section-title -->

        <div class="section-product-wrapper product">
          <div class="row">
 <?php 
 			$the_loai = $row[0]['the_loai'];
 $sql="SELECT * FROM truyen WHERE  the_loai='$the_loai'  order by Luot_xem DESC  LIMIT 4 ";
                        $tbl_sanpham=mysql_query($sql); 
                        $numrow =mysql_num_rows($tbl_sanpham);
                ?>
			  

			    <div class="gridsp">
						  <?php while($row = mysql_fetch_array($tbl_sanpham)){ ?>
			  				

							<div class="grid-item-sp col-md-3 col-sm-6">
								
	<div class="product-gird">
		<?php 
				$ddb2 = new CRUD();
				$id_truyen1 = $row['id_truyen'];
	$where1 = array('id_truyen'=>$id_truyen1);
	$ddb2->select(Table::tbct_truyen,$where1);
	$row1 = $ddb2->fetch();
		?>
		<a class="product-img" href="?options=sanpham&idsp=<?php echo $row['id'] ?>" >
			<img src="<?php echo __ImagePro.$row1[0]['anh_bia']; ?>" >
		</a>
		<h3 class="product-name">
			<a href="?options=sanpham&idsp=<?php echo $row['id'] ?>" ><?php echo $row['ten']; ?></a>
		</h3>
		<span class="product-price">
			<?php
				if ($row1[0]['gia_cu'] > 0) {
						$giacu = number_format($row1[0]['gia_cu']);
						echo "
						<del>$giacu ₫</del>";
								}
						
			?>
			
			 
			<b class="productminprice"><?php echo number_format($row1[0]['gia_moi']); ?>₫</b></span>
		<div style="display:none">
			
			 
			
			
			
			
		</div>
		<!--số lượng-->
		<div style="display:none">		
			<div class="input-group quantity">
				<input type="text" class="form-control" name="quantity" id="quantity_wanted" size="2" value="1">
			</div>	
		</div>
		
		<a  class="product-action btn-red " style="color: red"  href="?options=addcart&idsp=<?php echo $row['id']; ?>">
		
		Mua hàng</a>	
		
	</div> <!-- End .product-gird -->
					</div>
			  				
							<?php
				}
				if ($numrow==0) {
					echo "<h3 style=\"color:red; margin-left:10px\"; >Không có sản phẩm cùng loại</h3>";
				}
			
			?>
			
		
			  			
			  </div>
         		
			  
			  

        </div> <!-- End .section-product-wrapper -->
      </div>
	  </div>
    </section> <!-- End .section-products -->




