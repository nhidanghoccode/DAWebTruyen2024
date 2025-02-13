<?php
$connect = mysqli_connect ('localhost', 'root', '', 'web_truyen') or die ('Không thể kết nối tới database');
mysqli_set_charset($connect, 'UTF8');
if($connect === false){ 
die("LỖI: Không thể kết nối. " . mysqli_connect_error()); 
}
else {
echo 'Kết nối DB thành công! <br/>';
}
?>