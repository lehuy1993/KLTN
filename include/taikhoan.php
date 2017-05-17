<div id="main">
					
					<style>
.bg-breadcrumb {
	background: url("images/parallax-breadcrumb.jpg") no-repeat center center;}
</style>
<?php
	if(isset($_SESSION["login"])){
		$db = new CRUD();
		$user= $_SESSION['tai_khoan'];
        $where  = array('tai_khoan' => $user  );
		$sp=$db->select(Table::tbkhach_hang,$where);
        $row=$db->fetch();
        $id = $row[0]['id'];

	}
?>
<?php
	$db1 = new CRUD();
	$where = array('id_kh'=>$id);
	$db1->select(Table::tbhoa_don,$where);
	$numrow = $db1->num_rows();
	
?>
<section class="section-breadcrumbs">
      <div class="bg-breadcrumb">
        <div class="container">
          <ol class="breadcrumb">
            <li>
              <a href="index.php" title="Trang chủ">Trang chủ</a>
            </li>
			  
			  
			  
			  					<!-- blog -->
            					
									<li class="active">Trang khách hàng</li>
			  						<h2 class="breadcrumb-title">Trang khách hàng</h2>
			  					
			  
			  
			  <!-- current_tags -->
									
			  
			  
          </ol>
        </div>
      </div>
    </section> <!-- End .section-breadcrumbs -->
					
					<!-- Main Content -->
<div class="main-content account">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
					<h3>Đơn hàng</h3>
				
				<div class="table-responsive">
					<fieldset>
						<table class="table table-bordered">
							<thead>
								<tr class="first last">
									<th rowspan="1">Mã đơn hàng</th>
									<th rowspan="1">Ngày</th>
									<th colspan="1">Trạng thái </th>
									
									<th colspan="1">Thành tiền</th>
								</tr>
							</thead>
							<tbody>
								<?php
										  if($numrow != 0){
													 //Nếu có dữ liệu
													$data=$db1->fetch(); 
                                                // đọc từng dòng dữ liệu và hiển thị
                                                    foreach($data as $row1){
								?>
								<tr class="first odd">
									<td>
										<a href="?options=ct_hoadon&id=<?php echo $row1['id']; ?>">#<?php echo $row1['id']; ?></a>
									</td>
									<td><?php echo $row1['ngay_hd']; ?></td>

									<td>
										
										
                                                       
                                                        <?php 
                                                            if($row1['trang_thai']==0)
                                                            {
                                                        ?>
                                                            <p value="0" >Chưa xử lý</p>
                                                           
                                                         <?php
                                                            }elseif($row1['trang_thai']==1){
                                                         ?> 
                                                           
                                                            <p value="1" >Đang vận chuyển</p>
                                                           
                                                         <?php
                                                            }else{ ?>
                                                            	
                                                            <p value="2" >Đã thanh toán </p>
                                                     	<?php } ?>
                                                                  
										
									</td>
									
									<td class="a-right movewishlist">
										<?php echo number_format($row1['tong_tien']); ?>₫
									</td>
								</tr>
								
							
								 <?php
                                                      
                                                    }// 
                                                }
                                                    else{		
                                                 ?>
 												<tr>
                                                	<td colspan="5"> 
                                                    	Không có đơn hàng nào ! 
                                                    </td>
                                                </tr>   
  												<?php } 

  												//end if ?>                           
  
							</tbody>

						</table>
					</fieldset>
				</div>
				
			</div>
			<div class="col-md-3">
				<h3>Thông tin tài khoản</h3>
				<div class="">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>Họ và tên: </td>
								<td><p><?php echo $row[0]['ten']; ?></p></td>
							</tr>
							<tr>
								<td>Email: </td>
								<td><p><?php echo $row[0]['email']; ?></p></td>
							</tr>
							<tr>
								<td>Địa chỉ: </td>
								<td><p><?php echo $row[0]['dia_chi']; ?></p></td>
							</tr>
							
							
							
							<tr>
								<td>Số điện thoại: </td>
								<td><?php echo $row[0]['sdt']; ?></td>
							</tr>
						</tbody>
					</table>
					
				</div>
				<!--inner-->
			</div>
		</div>
	</div>
</div>
<!-- End Main Content -->


				</div>