		<style type="text/css">
.bg-breadcrumb {
	background: url("images/parallax-breadcrumb.jpg") no-repeat center center;}
</style>
<?php 
        // PHẦN XỬ LÝ PHP
        // BƯỚC 1: KẾT NỐI CSDL
        $conn = mysqli_connect('localhost', 'root', '', 'kltn');
 
        // BƯỚC 2: TÌM TỔNG SỐ RECORDS
        $result = mysqli_query($conn, "select count(id) as total from truyen where the_loai = '$_GET[id]' ");
        $row = mysqli_fetch_assoc($result);
        $total_records = $row['total'];
 
        // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 10;
 
        // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
        // tổng số trang
        $total_page = ceil($total_records / $limit);
 
        // Giới hạn current_page trong khoảng 1 đến total_page
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
 
        // Tìm Start
        $start = ($current_page - 1) * $limit;
 
        // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
        // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
        $result = mysqli_query($conn, "SELECT * FROM truyen where the_loai='$_GET[id]' LIMIT $start, $limit");
 		
        ?>

<section class="section-breadcrumbs">
      <div class="bg-breadcrumb">
        <div style="height: 100px" class="container">
          
        </div>
      </div>
    </section> <!-- End .section-breadcrumbs -->
		
			<section class="section-grids mt-80">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
				<div class="section-product-wrapper product mt-40">
					<div class="row">
						<div class="product-grid-show gridsp2">
						<?php
									 while ($row = mysqli_fetch_assoc($result)){
              
        
							?>
							<div class="grid-item-sp2 col-md-3 col-sm-6">
							
							<?php
			$db= new CRUD();
			$where = array('ten'=>$row['ten']);
			$db->select(Table::tbct_truyen,$where);
			$row1 = $db->fetch();
		?>
								
	<div class="product-gird">
		<a class="product-img" href="?options=sanpham&idsp=<?php echo $row['id'] ?>" >
			 <img src="<?php echo __ImagePro.$row1[0]['anh_bia']; ?>" alt="<?php echo $row['ten']; ?>"  "/>
		</a>
		<h3 class="product-name">
			<a href="?options=sanpham&idsp=<?php echo $row['id'] ?>" "><?php echo $row['ten'] ?></a>
		</h3>
		<span class="product-price">
		
			 
			<span class="product-price">
			<?php
				if ($row1[0]['gia_cu'] > 0 ){
		
				
				$giacu = number_format($row1[0]['gia_cu']);
			
			
			echo "<del> $giacu ₫</del>";
			} 
			?>
			 
			<b class="productminprice"><?php echo number_format($row1[0]['gia_moi']); ?>₫</b></span>
			
		<div style="display:none">
			
			 
			
			
			
		</div>
	
		
		<a  class="product-action btn-red " style="color: red"  href="?options=addcart&idsp=<?php echo $row['id']; ?>">
		
		Mua hàng</a>
		</button>	
		
	</div> <!-- End .product-gird -->
	

							</div>
							<?php 
			}
	 ?>
							
						</div><!-- End .product-grid -->
					</div>
				</div> <!-- End .section-product-wrapper -->


				<div class="filter-right" style="margin-bottom:50px">
					<div class="collection-pagination pull-right pagination-wrapper">
						         
 
                <ul class="pagination">
			
			
			  
			<?php 
            // PHẦN HIỂN THỊ PHÂN TRANG
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG
 
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="index.php?page='.($current_page-1).'">Prev</a> | ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                     echo "<a href='index.php?page=".$i."'><font color='#0000FF'>[".$i."]</font></a> &nbsp;&nbsp;&nbsp;";
                }
                else{
                    echo '<a href="index.php?page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="index.php?page='.($current_page+1).'">Next</a> | ';
            }
            ?>
			
			
		
			
</ul>

					</div>
				</div><!-- End. Filter 2-->
					  
			</div><!--End. right side -->
			<div class="col-md-3 col-md-pull-9">
				<div class="filter gridpage">
	<h4 class="widget-sidebar-name">danh sách truyện</h4>
	<ul class="widget-sidebar-menu list-collections">
		<?php 
				$db = new CRUD();
				$db->select(Table::tbloai_truyen);
				$data = $db->fetch();
				foreach ($data as $row ) {
					# code...
				
		?>
			
		<li>
			<a href="?options=loaitruyen&id=<?php echo $row['id_loai'] ?>" class="" title="<?php echo $row['ten'] ?>"><?php echo $row['ten'] ?></a>
		</li>
		
		<?php
			}
		?>
		
		
			
		
	</ul>
</div> <!-- End .widget-sidebar -->





<div class="filter gridpage">
	<h4 class="widget-sidebar-name">Liên kết</h4>
	<ul class="widget-sidebar-menu">
		
		<li><a href="#huong-dan" title="Hướng dẫn mua hàng">Hướng dẫn mua hàng</a></li>
		
		<li><a href="#huong-dan" title="Giao nhận và thanh toán">Giao nhận và thanh toán</a></li>
		
		<li><a href="#huong-dan" title="Đổi trả và bảo hành">Đổi trả và bảo hành</a></li>
		
		<li><a href="#huong-dan" title="Đăng ký thành viên">Đăng ký thành viên</a></li>
		
	</ul>
</div> <!-- End .widget-sidebar -->





<div class="filter gridpage">
	<h4 class="widget-sidebar-name">Quảng cáo</h4>
	<ul class="widget-sidebar-menu">
		<li>
			<a href="#frontpage#" title="side banner">
				
				<img class="img-responsive" alt="side banner" src="images/sidebar-banner-collection2.jpg">
			</a>
		</li>
	</ul>
</div> <!-- End .widget-sidebar -->


			</div>
		</div>
	</div>
</section>