<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Địa chỉ email đích
    $to = "ngothimytien14072003@gmail.com";

    // Tiêu đề email
    $email_subject = "Liên hệ từ trang web: $subject";

    // Nội dung email
    $email_body = "Bạn nhận được một tin nhắn từ $name ($email):\n\n$message";

    // Gửi email
    if (mail($to, $email_subject, $email_body)) {
        echo "<script>alert('Email đã được gửi đi');</script>";
        echo "<script>window.location.href = 'contact.html';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra khi gửi email');</script>";
        echo "<script>window.location.href = 'contact.html';</script>";
    }
}
?>
