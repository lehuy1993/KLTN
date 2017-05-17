<div id="main">
					
					<style>
.bg-breadcrumb {
	background: url("images/parallax-breadcrumb.jpg") no-repeat center center;}
</style>

<?php
	$db = new CRUD();
	// Lấy dữ liệu tìm kiếm -> tạo chuỗi điều kiện tìm
	$dieukien =" 1=1 ";	
	
	$keyword_Name=isset($_REQUEST['keyword'])?$_REQUEST['keyword']:"";
	if($keyword_Name!="")
		$dieukien .=" and ten like '%$keyword%'";
	//-----------
$loaisp=$db->select(Table::tbct_truyen,$dieukien);
$numrow = $db->num_rows();

    $keyword = $_GET['keyword'];
    $sql = "SELECT * FROM ct_truyen WHERE ten LIKE '%".$keyword."%'  ";
    $kq = mysql_query($sql);
    $num = mysql_num_rows($kq);
	
?>

<section class="section-breadcrumbs">
      <div class="bg-breadcrumb">
        <div class="container">
          <ol class="breadcrumb">
            <li>
              <a href="index.php" title="Trang chủ">Trang chủ</a>
            </li>
			  
			  
			  					<!-- blog -->
            					
										<li class="active">Tìm kiếm</li> 
										<h1 class="breadcrumb-title"><?php echo $keyword ?></h1>
								<style>
									
									.breadcrumb-title {
										text-transform: capitalize;
									}
								</style>
			  

								<!-- list_collections -->
								
			  
			  
			  <!-- current_tags -->
									
			  
			  
          </ol>
        </div>
      </div>
    </section> <!-- End .section-breadcrumbs -->
						
					
      <div style="padding-top: 5%;" class="container">
        <div class="row">
          <div class="col-md-11">
			 <?php if ($num > 0) {
     ?>
				<div class=" searchpadding">
			  		<p style="padding: 15px 0px 0px 0px;font-size: 14px;color: #666;">
						Có <?php echo $num; ?> kết quả tìm kiếm với từ khóa <span class="keysearch">"<?php echo $keyword ?>"</span>:</p>
			  	</div>
			  
			  <div class="col-xs-6 searchpadding">
					<form method="GET" action ="?options=search" autocomplete="off">
					<div class="input-group searchfomraction">
					<input type="hidden" name="options" value="search">
				<input style="width: 50%;margin-left: auto;height: 40px" type="search" placeholder="Nhập từ khóa tìm kiếm... "  name="keyword" id="input" class="form-control"  required="required" title="tìm kiếm"> 
					  <span class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
					  </span>
					</div><!-- /input-group -->
					</form>
			  </div>  
			  	
		
			
 
            <div class="filter-right">
              
            </div><!-- End. Filter 1-->	  
			  
<?php while ($row =mysql_fetch_array($kq)) {
     ?>
		  
			  
			  
            <div class="section-product-wrapper product mt-40">
              <div class="row">
				  
				  
				<div class="product-list-show" style="display: none;">
					
						<form action="#" method="post">
	<div class="row">
		<div class="product-gird">
			<div class="col-sm-4 col-md-4">
				<a class="product-img" href="#" title="#"><img src="<?php echo __ImagePro.$row['anh_bia']; ?>" alt="<?php echo $row['ten']; ?>"></a>
			</div>
			<div class="col-sm-8 col-md-8 righcontent">
				<h4 class="product-name"><a href="#" title="<?php echo $row['ten']; ?>"><?php echo $row['ten']; ?></a></h4>
				<div class="description"> <?php echo $row[0]['tom_tat']; ?></div>
				<span class="product-price">
					
					<del>79.000₫</del>
					 
					<b class="productminprice">59.000₫</b>
				</span>
				<div style="display:none">
					
					 
					
					<input type="hidden" name="variantId" value="10176104">
					
					
				</div>
				<!--số lượng-->
				<div style="display:none">		
					<div class="input-group quantity">
						<input type="text" class="form-control" name="quantity" id="quantity_wanted" size="2" value="1">
					</div>	
				</div>
				
				<button class="product-action btn-red addtocart add-to-cart" type="submit" id="button-cart">Mua hàng</button>	
				
			</div>
		</div> <!-- End .product-gird -->
	</div>
</form>
					
				</div><!-- End .product-list -->
				
				  
             	<div class="product-grid-show gridsp2" style="display: block;">
						
							<div class="grid-item-sp2 col-md-3 col-sm-6">
							<form action="/cart/add" method="post">
	<div class="product-gird">
		<a class="product-img" href="?options=sanpham&idsp=<?php echo $row['id'] ?>">
			<img src="<?php echo __ImagePro.$row['anh_bia']; ?>" alt="<?php echo $row['ten']; ?>">
		</a>
		<h3 class="product-name">
			<a href=href="?options=sanpham&idsp=<?php echo $row['id'] ?>" title="<?php echo $row['ten']; ?>"><?php echo $row['ten']; ?></a>
		</h3>
		<span class="product-price">
			
			<?php
					if ($row1[0]['gia_cu'] > 0) {
						$giacu = number_format($row['gia_cu']);
						echo "
						<del >$giacu ₫</del>";
								}
						?>
			 
			<b class="productminprice"><?php echo  number_format($row['gia_moi']) ?>₫</b></span>
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
</form>
							</div>
						
				</div><!-- End .product-grid -->

          
				  
				  
              </div>
            </div> <!-- End .section-product-wrapper -->
			  
			  <?php 
			}


?>
	  
			  
			  
			  
			
				    <?php
    }else  {
        echo "<p style=\"color:red;margin-bottom:10%\";>Không tìm thấy kết quả với từ khóa $keyword </p>";
    }
?>