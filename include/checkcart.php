<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" class="anyflexbox boxshadow display-table"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link href="css/nprogress.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="./css/checkout_new.css" rel="stylesheet" type="text/css">

<style>
.bg-breadcrumb {
    background: url("images/parallax-breadcrumb.jpg") no-repeat center center;}
</style>
<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);//loại bỏ nhắc nhở lập trình viên  Undefined index...
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
?>
<?php
    if(isset($_SESSION["login"])){
        $db = new CRUD();
        $user= $_SESSION['tai_khoan'];
        $where  = array('tai_khoan' => $user  );
        $sp=$db->select(Table::tbkhach_hang,$where);
        $row3=$db->fetch();

    }
?>
<?php
    if (isset($_POST['add'])) {
        # code...
       
        $ten=$_POST['name'];
        $dienthoai_nguoinhan=$_POST['phone'];
        $email=$_POST['Email'];
        $id_hd = $_POST['id_kh'];
        $diachi_nguoinhan=$_POST['Address'];
        $tongtien=$_POST['tong_tien'];
        $ngay_hd = gmdate("Y/m/d ");
        $ngay_giao_hang = $_POST['date'];
        $trang_thai= '0';
        $payment = $_POST['payment'];
        $ghi_chu = $$_REQUEST['note'];
        $dbAction = new CRUD();
        $data = array(
                'ten'    => $ten,
                'sdt' => $dienthoai_nguoinhan,
                'dia_chi'   => $diachi_nguoinhan, 
                'id_kh' =>$id_hd,
                'email'     => $email,
                'ngay_hd' => $ngay_hd,
                'ngay_gh' =>$ngay_giao_hang,  
                'tong_tien' => $tongtien,
                'trang_thai'=> $trang_thai,
                'payment'=>$payment,
                'ghi_chu'=>$ghi_chu,
               
            );    
           
        $dbhoadon = $dbAction->insert(Table::tbhoa_don,$data);
        $lastid = mysql_insert_id();
        foreach ($_SESSION['cart'] as $key => $value) {
            $data1 = array(
                        'id_hd' => $lastid,
                        'id_truyen' => $key ,
                        'so_luong' => $value['sl'],
                        'gia_ban' => $value['price'],
                        

         );
        $dbAction->insert(Table::tbct_hoa_don,$data1);
        
        
    }
    
        echo "<script> alert('Đặt hàng thành công');
        location.href='index.php';</script>";
        unset($_SESSION['cart']);

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
                                
                                    <li class="active">Thanh Toán</li>
                                    <h2 class="breadcrumb-title">Thanh Toán</h2>

                                <!-- collection -->
                                
              
              
              <!-- current_tags -->
                                    
              
              
          </ol>
        </div>
      </div>
    </section> <!-- End .section-breadcrumbs -->
   
</head>
<body class="body--custom-background-color ">
    
    <button class="order-summary-toggle" bind-event-click="Bizweb.Checkout.toggleOrderSummary(this)">
        <div class="wrap">
            <h2>
                <label class="control-label">Đơn hàng</label>
                
        </div>
    </button>
    <form novalidate="true" method="post" action="" data-toggle="validator" class="content stateful-form formCheckout">
        <div style="padding-top: 3%" class="wrap" context="checkout" define="{checkout: new Bizweb.Checkout(this,{code: &quot;&quot;, settingLanguage: &quot;vi&quot;, moneyFormat: &quot;{{amount_no_decimals_with_comma_separator}}₫&quot;, discountLabel: &quot;Miễn phí&quot;, districtPolicy: &quot;optional&quot;, district: &quot;&quot; })}">
       
            <div class="sidebar ">
                <div class="sidebar_header">
                    <h2>
                        <label class="control-label">Đơn hàng</label>
                         <input type="hidden" value="<?php echo $row3[0]['id'] ?>" name= 'id_kh' >
                    </h2>
                    <hr class="full_width">
                </div>
                <div class="sidebar__content">
                    <div class="order-summary order-summary--product-list order-summary--is-collapsed">
                        <div class="summary-body summary-section summary-product">
                            <div class="summary-product-list">
                                <table class="product-table">
                                    <tbody>
                                        <?php

                             $total=0;;$i = 0;

                            foreach ($_SESSION['cart'] as $key => $value) {
                            $i++;
                            

                          
                        ?>
                                            <tr class="product product-has-image clearfix">
                                                <td>
                                                    <div class="product-thumbnail">
                                                        <div class="product-thumbnail__wrapper">
                                                            
                                                                <img src="public/truyen/<?php  echo $_SESSION['cart'][$key]['image']?>" class="product-thumbnail__image">
                                                            
                                                        </div>
                                                        <span class="product-thumbnail__quantity" aria-hidden="true"><?php echo $_SESSION['cart'][$key]['sl']; ?></span>
                                                    </div>
                                                </td>
                                                <td class="product-info">
                                                    <span class="product-info-name">
                                                        
                                                       <?php echo $_SESSION['cart'][$key]['name']; ?>
                                                    </span>
                                                    
                                                    
                                                </td>
                                                <td class="product-price text-right">
                                                   <?php echo number_format( $_SESSION['cart'][$key]['sl']* $_SESSION['cart'][$key]['price']); ?>₫
                                                </td>
                                            </tr>
                                        <?php
                            $total += ($_SESSION['cart'][$key]['sl']* $_SESSION['cart'][$key]['price']);

                                          $total2=number_format($total);
                                 }
                            
      
                         
         
                                ?>
                                    </tbody>
                                </table>
                                <div class="order-summary__scroll-indicator">
                                    Cuộn chuột để xem thêm
                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <hr class="m0">
                    </div>
                  
                    <div class="order-summary order-summary--total-lines">
                        <div class="summary-section border-top-none--mobile">
                            
                            
                            <div class="total-line total-line-total clearfix">
                                <span class="total-line-name pull-left">
                                    Tổng cộng
                                </span>
                                <span  class="total-line-price pull-right aqua"><?php
                            
                                          echo $total2;

                        ?>₫</span>
                        <input type="hidden" value="<?php echo $total ?>" name='tong_tien'>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix hidden-sm hidden-xs">
                        <div class="field__input-btn-wrapper mt10">
                            <a class="previous-link" href="?options=giohang">
                                <i class="fa fa-angle-left fa-lg" aria-hidden="true"></i>
                                <span>Quay về giỏ hàng</span>
                            </a>
                            <input class="btn btn-primary btn-checkout"  name="add" value="ĐẶT HÀNG" type="submit">
                        </div>
                    </div>
                    <div class="form-group has-error">
                        <div class="help-block ">
                            <ul class="list-unstyled">
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main" role="main">
              
                <div class="main_content">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="section" define="{billing_address: {}}">
                                <div class="section__header">
                                    <div class="layout-flex layout-flex--wrap">
                                        <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                                            <i class="fa fa-id-card-o fa-lg section__title--icon hidden-md hidden-lg" aria-hidden="true"></i>
                                            <label class="control-label">Thông tin mua hàng</label>
                                        </h2>
                                        
                                    </div>
                                </div>
                                <div class="section__content">
                                    
                                    
                                        <div class="form-group" bind-class="{'has-error' : invalidEmail}">
                                            <div>
                                                <label class="field__input-wrapper" bind-class="{ 'js-is-filled': email }">
                                                    <span class="field__label" bind-event-click="handleClick(this)">
                                                        Email
                                                         
                                                            <span class="required">&nbsp;</span>
                                                        
                                                    </span>

                                                    <input name="Email" bind-event-focus="handleFocus(this)" value="<?php echo $row3[0]['email']; ?>" bind-event-blur="handleFieldBlur(this)" class="field__input form-control" id="_email" data-error="Vui lòng nhập email đúng định dạng" required="" pattern="^([a-zA-Z0-9_\-\.\+]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" bind="email" type="email">
                                                </label>
                                            </div>
                                            <div class="help-block with-errors">
                                            </div>
                                        </div>
                                    
                                    <div class="billing">
                                        <div>
                                            <div class="form-group">
                                                <div class="field__input-wrapper" bind-class="{ 'js-is-filled': billing_address.full_name }">
                                                    <span class="field__label" bind-event-click="handleClick(this)">
                                                        Họ và tên
                                                        <span class="required">&nbsp;</span>
                                                    </span>
                                                    <input name="name" bind-event-focus="handleFocus(this)" bind-event-blur="handleFieldBlur(this)" class="field__input form-control" id="_billing_address_last_name" data-error="Vui lòng nhập họ tên" required="" bind="billing_address.full_name" type="text">
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            
                                                <div class="form-group">
                                                    <div class="field__input-wrapper" bind-class="{ 'js-is-filled': billing_address.phone }">
                                                        <span class="field__label" bind-event-click="handleClick(this)">
                                                            Số điện thoại
                                                             <span class="required">&nbsp;</span>
                                                        </span>
                                                        <input  pattern="[0][0-9]{10,15}" name="phone" bind-event-focus="handleFocus(this)" bind-event-blur="handleFieldBlur(this)" required="" data-error="Vui lòng nhập số điện thoại từ 10 đén 15 ký tự"  class="field__input form-control" id="_billing_address_phone" bind="billing_address.phone" type="text">
                                                    </div>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            
                                            
                                                <div class="form-group">
                                                    <div class="field__input-wrapper" bind-class="{ 'js-is-filled': billing_address.address1 }">
                                                        <span class="field__label" bind-event-click="handleClick(this)">
                                                            Địa chỉ
                                                             <span class="required">&nbsp;</span>
                                                        </span>
                                                        <input name="Address" bind-event-focus="handleFocus(this)" bind-event-blur="handleFieldBlur(this)" class="field__input form-control" id="_billing_address_address1" bind="billing_address.address1" required="" minlength="4" maxlength="100" data-error="Vui lòng nhập địa chỉ từ 4 đến 100 ký tự" type="text">
                                                    </div>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            <div class="form-group">
                                                
                                                <label  bind-event-click="handleClick(this)">
                                                        
                                                         <span class="required">Ngày giao hàng &nbsp;</span>
                                                    </label>
                                                    <div class="field__input-wrapper" bind-class="{ 'js-is-filled': billing_address.full_name }">
                                                    <input name="date" bind-event-focus="handleFocus(this)" bind-event-blur="handleFieldBlur(this)" class="field__input form-control" id="_billing_address_last_name" data-error="Vui lòng nhập " required=""  type="date">

                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            
                                                
                                                  
                                            
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                           
                            <div class="section pt10" >
                                <div class="section__content">
                                    <div class="form-group m0">
                                        <textarea name="note" class="field__input form-control m0" placeholder="Ghi chú"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                          
                            <div class="section payment-methods" >
                                <div class="section__header">
                                    <h2 class="section__title">
                                        <i class="fa fa-credit-card fa-lg section__title--icon hidden-md hidden-lg" aria-hidden="true"></i>
                                        <label class="control-label">Thanh toán</label>
                                    </h2>
                                </div>
                                <div class="section__content">
                                    <div class="content-box">
                                        
    <div class="content-box__row">
        <div class="radio-wrapper">
            <div class="radio__input">
                <input class="input-radio" value="204921" name="PaymentMethodId" id="payment_method_204921" data-check-id="4" bind="payment_method_id" checked="checked" type="radio">
            </div>
            <label class="radio__label" for="payment_method_204921">
                <span class="radio__label__primary">Phương thức thanh toán </span>
                <span class="radio__label__accessory">
                    <ul>
                        <li class="payment-icon payment-icon--4">
                        </li>
                    </ul>
                </span>
            </label> 
        </div> <!-- /radio-wrapper--> 
    </div>
    
        <div class="radio-wrapper content-box__row content-box__row--secondary" id="payment-gateway-subfields-204921" bind-show="payment_method_id == 204921">
            <div class="blank-slate">
               <select name="payment" id="inputPayment" class="form-control" required="required">
                  
                   <option value="tructiep">Thanh toán khi nhận hàng</option>
                   <option value="baokim">Bảo Kim</option>
               </select>

                
            </div>
        </div>
    



                                    </div>
                                </div>
                            </div>
                            <div class="section hidden-md hidden-lg">
                                <div class="form-group clearfix m0">
                                    <input class="btn btn-primary btn-checkout"  name="add" value="ĐẶT HÀNG" type="submit">
                                </div>
                                <div class="text-center mt20">
                                    <a class="previous-link" href="?options=giohang">
                                        <i class="fa fa-angle-left fa-lg" aria-hidden="true"></i>
                                        <span>Quay về giỏ hàng</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           
    
</div>
            </div>
        </div>
    </form>

    <script src="js/jquery-2.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/twine.js" type="text/javascript"></script>
<script src="js/validator.js" type="text/javascript"></script>
<script src="js/nprogress.js" type="text/javascript"></script>
<script src="js/money-helper.js" type="text/javascript"></script>
<script src="./js/checkout_new.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ajaxStart(function () {
        NProgress.start();
    });
    $(document).ajaxComplete(function () {
        NProgress.done();
    });

    context = {}

    $(function () {
        Twine.reset(context).bind().refresh();
    });
    
    $(document).ready(function () {
        
        $("#customer-address").trigger("change");
        
        $("select[name='BillingProvinceId']").trigger("change");
        $("select[name='ShippingProvinceId']").trigger("change");
        Twine.context(document.body).checkout.caculateShippingFee();
    });
</script>
    

</body></html>