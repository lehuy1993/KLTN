<div id="main">
					
					<style>
.bg-breadcrumb {
	background: url("images/parallax-breadcrumb.jpg") no-repeat center center;}
</style>
<?php
if (isset($_REQUEST['add'])) {
	# code...
	$db= new CRUD();
	$ten = $_POST['name'];
	$sdt = $_POST['phone'];
	$address = $_POST['address'];
	$user = $_POST['tai_khoan'];
	$password = md5($_POST['password']);
	$email = $_POST['email'];
	$ngay_tao = gmdate("Y/m/d H:i:s");
	 $data = array(
                'ten'    => $ten,
                'sdt' => $sdt,
                'dia_chi'   => $address, 
                'email'     => $email,
                'ngay_tao' => $ngay_tao,
              	'tai_khoan'=>$user,
              	'mat_khau' =>$password,

               
            ); 
	 $where = array('email'=>$email,
	 	'tai_khoan'=>$user);
	 $db->select(Table::tbkhach_hang,$where);
	 $num = $db->num_rows();
	 if ($num > 0) {
	 	# code...
	 	echo "<script> alert('Tài khoản hoặc email đã tồn tại');
	 	location.href='index.php?options=dangky';</script>";
	 }
    if($db->insert(Table::tbkhach_hang,$data))
	{
		echo "<script> alert('Đăng ký thành công');
		location.href='index.php';</script>";	
	}else{
		echo "<script> alert('Lỗi thêm mới!!');</script>";	
	}

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
            					
									<li class="active">Đăng ký tài khoản</li>
			  						<h2 class="breadcrumb-title">Đăng ký tài khoản</h2>
			  					
			  
			  
			  <!-- current_tags -->
									
			  
			  
          </ol>
        </div>
      </div>
    </section> <!-- End .section-breadcrumbs -->
					
					<!-- Main Content -->
<div class="main-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="form-style form-login">
					<form accept-charset="UTF-8" action="" id="customer_register" method="post">
						<fieldset>
<input name="utf8" type="hidden" value="true">
					<h3 class="form-heading">Đăng ký tài khoản</h3>
					<p class="form-description">Nếu bạn có một tài khoản, xin vui lòng chuyển qua trang đăng nhập.</p>
					
					<div  class="row">
						<div class="col-md-1">
							<p>Họ và Tên<span class="redcolor">*</span></p>
						</div>
						<div class="col-md-11">
							<input class="controls" type="text" value="" name="ten" required="" minlength="5" title="Tên phải trên 5 ký tự">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
							<p>Địa chỉ<span class="redcolor">*</span></p>
						</div>
						<div class="col-md-11">
							<input type="text" value="" name="address" required=""  minlength="5" title="Tên phải trên 5 ký tự">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
							<p>Số điện thoại<span class="redcolor" >*</span></p>
						</div>
						<div class="col-md-11">
							<input type="text" value="" required=""  pattern="[0][0-9]{10,15}" title="Bắt đầu 0 và từ 10 đến 15 số" name="phone">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
							<p>Email<span class="redcolor">*</span></p>
						</div>
						<div class="col-md-11">
							<input type="email" pattern="^([a-zA-Z0-9_\-\.\+]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" value="" name="email" required="">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
							<p>Tài khoản<span class="redcolor">*</span></p>
						</div>
						<div class="col-md-11">
							<input type="text" minlength="5" title="Tên phải trên 5 ký tự" name="tai_khoan" required="">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
							<p>Mật khẩu<span class="redcolor">*</span></p>
						</div>
						<div class="col-md-11">
							<input type="password" value=""  minlength="5" title="Phải trên 5 ký tự" name="password" required="">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-11">
							<p><a href="?options=dangnhap">Đăng nhập</a></p>
							<button class="btn-cart" type="submit" name="add">Đăng ký</button>
						</div>
					</div>
					</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Main Content -->

				</div>