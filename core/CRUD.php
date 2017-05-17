<?php
include_once '/configserver.php';
include_once '/Pagination.php';
include_once '/common.php';
class CRUD{
	
	//Biến
	var $conn; //Biến đối tượng kết nối
	//1. Hàm tạo
	public function __construct(){
		$this->conn=mysql_connect(__DB_HOST,__DB_USER,__DB_PASS);
		if($this->conn==null){
			echo "Lỗi kết nối";
			return $this->conn;	
		}
		//Kết nối thành công
		// - Chọn cơ sở dữ liệu
		mysql_select_db(__DB_NAME,$this->conn);
		// - Thiết lập chuẩn nhật xuất
		mysql_query("SET NAMES 'UTF-8'");
		// Trả về đối tượng kết nối
		return $this->conn;
	}
	//2. Hàm thực thi câu lệnh SQL;
	public function execQuery($sql){
		$this->result=mysql_query($sql,$this->conn);	
	}
	//3. Hàm đếm số dòng trong result
	public function num_rows(){
		if	($this->result){
			$rows=mysql_num_rows($this->result);
		}else{
			$rows=0;
		}
		return $rows;
	}
	//4. Hàm đọc từng dòng trong result và trả về một array
	public function fetch(){
		if($this->result){
			if($this->num_rows()!=0){
				while($row=mysql_fetch_array($this->result)){
					$this->data[]=$row;
				}
			}else{
				$this->data=0;
			}
		}
		return $this->data;
	}
	//5. Hàm select toàn bộ các cột dữ liệu từ bảng
	public function select($table,$where=false,$orderby=false,$limit=false){
		
		$sql="Select * from $table ";
		if($where){
			if(is_array($where)){
				foreach($where as $k=>$v){
					$sqlcondition[]= "$k='$v'";	
				}
				$where = implode(" and ",$sqlcondition);
				//$where = " where  $where ";
			}else{
				$where = $where;	
			}
			$sql .=" where $where "; 
		}
		
		if($orderby){
			if(is_array($orderby)){
				foreach($orderby as $k=>$v){
					$orderbyarr[]= "$k='$v'";	
				}
				$orderby = implode(" , ",$orderbyarr);
			}	
			$sql .=" order by $orderby ";	
		}
		
		
		if($limit){
				$sql .=" limit $limit";
		}

		//echo ($sql);
		$this->execQuery($sql);
	}
	//6. Insert table
	public function insert($table,$data){
		if($data!=""){
			if(is_array($data)){
				foreach($data as $k=>$v){
					$field[]=$k;
					$value[]="'".$v."'";	
				}
				$fields=implode(", ",$field);
				$values=implode(", ",$value);
			}
		}
		//Tạo câu lệnh thêm
		$sql="insert into $table($fields) values($values) ";
		//Thực thi
		
		$this->execQuery($sql);
		if($this->result !=NULL)
			
			return mysql_insert_id();
		else
			return false;
	}
	//7. Hàm cập nhật
	public function update($table,$data,$where){
		if($data!=""){
			if(is_array($data)){
				foreach($data as $k=>$v){
					$set[]="$k='$v'";	
				}
				$sets=implode(", ",$set);
			}
		}
		if($where!=""){
			if(is_array($where)){
				foreach($where as $k=>$v){
					$sql[]="$k='$v'";	
				}
				$where = implode(" and ",$sql);
				//$where = " where  $where ";
			}else{
				$where = $where;	
			}
		}
		//Tạo truy vấn cập nhật
		$sql="Update $table set $sets where $where ";
		
		//Thực thi
		$this->execQuery($sql);
		if($this->result !=NULL)
			return true;
		else
			return false;
	}
	//8. Xóa dữ liệu trong bảng
	public function delete($table, $where=''){
		//Tạo truy vấn xóa
		$sqlDel="delete from $table ";
		//Xử lý điều kiện xóa
		if($where!=""){
			if(is_array($where)){
				foreach($where as $k=>$v){
					$sql[]= "$k='$v'";	
				}
				$where = implode(" and ",$sql);
				//$where = " where  $where ";
			}else{
				//$where = $where;	
			}
			$sqlDel .= " where $where ";
		}
		//die($sqlDel);
		//Thực thi
		$this->execQuery($sqlDel);
		if($this->result !=NULL)
			return true;
		else
			return false;
	}
}
//====================================
class Table {

    const tbquan_tri = 'quan_tri';
    const tbnha_xuat_ban = 'nha_xuat_ban';
    const tbloai_truyen = 'loai_truyen';
    const tbthue = 'phieu_thue';
    const tbct_truyen = 'ct_truyen';
    const tbkhach_hang = 'khach_hang';
    const tbphieu_tra = 'phieu_tra';
    const tbpt_thanh_toan = 'thanh_toan';
    const tbhoa_don = 'hoa_don';
     const tbct_hoa_don = 'ct_hoadon';
    const tbct_thue = 'ct_thue';
    const tbdac_tinh = 'dac_tinh';
    const tbtruyen = 'truyen';
    
}
class Mail {
    function sendMail($email, $subject, $content) {
        include '../PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;  // enable SMTP authentication
        $mail->SMTPKeepAlive = true;
        $mail->SMTPSecure = "ssl";  // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->Port = 465; // set the SMTP port for the GMAIL server
        $mail->Username = "bkapshoes2015@gmail.com";  // GMAIL username
        $mail->Password = "aA123456!"; // your GMAIL password
        $mail->AddReplyTo("bkapshoes2015@gmail.com", "SHOES");
        $mail->From = "bkapshoes2015@gmail.com";
        $mail->FromName = "SHOES";

        $mail->AddAddress("$email");
        $mail->Subject = "$subject";

        $mail->WordWrap = 50; // set word wrap
        $body = $content;
        $mail->MsgHTML($body);

        $mail->IsHTML(true); // send as HTML
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }
}
?>