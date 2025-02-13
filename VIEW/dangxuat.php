<?php 
session_start();
//$_SESSION['username'] = "111";
//echo $_SESSION['username'];

xoa_session();
function xoa_session(){
   
   // echo $_SESSION['username'] . "session login";

    if (isset($_SESSION['tendangnhap'])){
        echo $_SESSION['tendangnhap'];
        unset($_SESSION['tendangnhap']); // xóa session login
        echo '<script language="javascript">window.location="index.php";</script>';
    } else {
        echo 'loi';
    }
}
?>