<div id="main">
					
					<style>
.bg-breadcrumb {
	background: url("images/parallax-breadcrumb.jpg") no-repeat center center;}
</style>

<?php
	if (isset($_GET['id'])) {
		# code...
		$id = $_GET['id'];
		$db1 = new CRUD();
		$where = array('id'=>$id);
		$db1->select(Table::tbhoa_don,$where);
		$row = $db1->fetch();
		$id_hd = $row[0]['id'];
		#ct hóa đơn
		$db = new CRUD();
		$where = array('id_hd'=>$id_hd);
		$db->select(Table::tbct_hoa_don,$where);
		$numrow = $db->num_rows();
		$row1 = $db->fetch();
		$id_truyen = $row1[0]['id_truyen'];
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
            					
									<li class="active">Chi tiết đơn hàng</li>
			  						<h2 class="breadcrumb-title">Chi tiết đơn hàng</h2>
			  					
			  
			  
			  <!-- current_tags -->
									
			  
			  
          </ol>
        </div>
      </div>
    </section> <!-- End .section-breadcrumbs -->
					
					<!-- Main Content -->
<div class="main-content order">
	<div class="container">
		<div class="row">
			<h2>Chi tiết đơn hàng <?php echo $row[0]['ngay_hd']; ?></h2>
			<div class="table-responsive">
				<fieldset>
					<table class="table table-bordered">
						<thead>
							<tr class="">
								<th>Sản phẩm</th>
								
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Thành tiền</th>
							</tr>
						</thead>
						<tbody>
							<?php
										 
													 //Nếu có dữ liệu
													$data=$db->fetch(); 
                                                // đọc từng dòng dữ liệu và hiển thị
                                                    foreach($data as $row1){
								?>
							<tr>
								<?php
									$id_truyen = $row1['id_truyen'];
									$dbtruyen = new CRUD();
									$where = array('id_truyen2'=>$id_truyen);
									$dbtruyen->select(Table::tbct_truyen,$where);
									$row2 = $dbtruyen->fetch();
								?>
								<td><a href="#"><?php echo $row2[0]['ten']; ?></a></td>
							
								<td><?php echo number_format($row2[0]['gia_moi']); ?>₫</td>
								<td><?php echo $row1['so_luong']; ?></td>
								<td>
									<?php
										$thanhtien = $row1['so_luong']*$row2[0]['gia_moi'];
									?>
								<?php echo number_format($thanhtien); ?>₫</td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</fieldset>
			</div>
			<!-- BEGIN CART COLLATERALS -->
			<div class="row">
				
				
				<div class="col-sm-4">
					<h3>Tổng tiền hóa đơn</h3>
					<div class="">
						<table class="table">
							<tbody>
								<tr>
									<td> Cần thanh toán  </td>
									<td class="text-right"><span class="price"><?php echo number_format($row[0]['tong_tien']); ?>₫</span></td>
								</tr>
								
								
								
							
							</tbody>
						</table>
					</div>
					<!--inner-->

				</div>
			</div>

			<!--cart-collaterals-->
		</div>
	</div>
</div>
<!-- End Main Content -->
					


				</div>