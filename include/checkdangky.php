<?php
$action = $_POST['action']; // Lấy giá trị action
    if(!empty($_POST['user_name']) && $action == 'check_user')
    {
        // Lấy giá trị user_name
        $user = $_POST['user_name']; 
        
        // Chuyển giá trị user_name thành chữ thường & gọi hàm kiểm tra
        username_exist(strtolower($user)); 
    }
    
    function username_exist($user)
    {
        // Mảng giá trị user_name đã tồn tại
        $user_arr = array("2cweb", "2cwebvn", "chickchick");
        
        // Kiểm tra user_name mình nhập vào có nằm trong mảng đó hay không?
        // User_name thuộc 1 giá trị trong mảng => user_name tồn tại
        if(in_array($user, $user_arr))
        {
            echo "<span class=error>Username: <strong>{$user}</strong> đã tồn tại, sorry.!!</span>";
        }
        else // Ngược lại user_name Ko tồn tại
        {
            echo "<span class=success>Username: <strong>{$user}</strong> Ko tồn tại, oh yeh..</span>";    
        }
    }
?>