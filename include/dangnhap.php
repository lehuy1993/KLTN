<div id="main">
					
					<style>
.bg-breadcrumb {
	background: url("images/parallax-breadcrumb.jpg") no-repeat center center;}
</style>
<?php
	if (isset($_POST['login'])) {
   
    $username = $_REQUEST['tai_khoan'];
    $password = md5($_REQUEST['mat_khau']);
    $loginCRUD = new CRUD();
    $wherelogin = array(
        'tai_khoan' => $username,
        'mat_khau' => $password,
        
    );
    $loginCRUD->select(Table::tbkhach_hang, $wherelogin);
    if ($loginCRUD->num_rows() > 0) {
            $login = $loginCRUD->fetch();   
            $_SESSION['login'] = true;
            $_SESSION['tai_khoan'] = $username;
            //ghi cookies

            echo "<script>alert('Đăng nhập thành công!'); 
                location.href = 'index.php';</script>";
      
    } else {
        echo " <script>alert('Tài khoản của bạn không tồn tại hoặc đã bị khóa!'); 
            location.href='?options=dangnhap';</script>";
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
            					
									<li class="active">Đăng nhập tài khoản</li>
			  						<h2 class="breadcrumb-title">Đăng nhập tài khoản</h2>

			  					
			  
			  
			  <!-- current_tags -->
									
			  
			  
          </ol>
        </div>
      </div>
    </section> <!-- End .section-breadcrumbs -->
					
					<!-- Main Content -->
<div class="main-content">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="form-style form-login">
					<form accept-charset="UTF-8" action=""  method="post">
<input name="utf8" type="hidden" value="true">
					<h3 class="form-heading">Đăng nhập</h3>
					<p class="form-description">Nếu bạn có một tài khoản, xin vui lòng đăng nhập.</p>
					
					<div class="row">
						<div class="col-md-2">
							<p>Tài khoản<span class="redcolor">*</span></p>
						</div>
						<div class="col-md-10">
							<input type="text"  value="" name="tai_khoan" required="">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p>Password<span class="redcolor">*</span></p>
						</div>
						<div class="col-md-10">
							<input type="password" value="" name="mat_khau" required="">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
						</div>
						<div class="col-md-10">
							<p><a href="?options=dangky">Đăng ký</a></p>
							<button type="submit" name="login" class="btn-cart">Đăng nhập</button>
						</div>
					</div>
					</form>
				</div>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<div class="form-style form-login">
					<form accept-charset="UTF-8" action="#" id="recover_customer_password" method="post">
<input name="FormType" type="hidden" value="recover_customer_password">
<input name="utf8" type="hidden" value="true">
					<h3 class="form-heading">Quên mật khẩu</h3>
					<p class="form-description">Bạn đã có một tài khoản nhưng không nhớ mật khẩu.</p>
					<p style="padding: 0;margin-bottom: 15px;color: #888;line-height: 20px;">Hãy điền Email xuống phía dưới và nhận thông tin qua Email để có thể lấy lại mật khẩu.</p>
					
					<p>Email<span class="redcolor">*</span></p>
					<input type="email" value="" name="Email" required="">
					<button class="btn-cart">Gửi thông tin</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Main Content -->

				</div>