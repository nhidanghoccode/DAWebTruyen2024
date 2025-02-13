<?php
include 'theloaiadmin.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['loaitruyen'])) {
    $id_loai = $_GET['loaitruyen'];

    // Tạo một đối tượng theloaiadmin
    $tl = new theloaiadmin();

    // Lấy danh sách thể loại dựa trên ID loại truyện được chọn
    $ds_theloai = $tl->show_theloaibyloai($id_loai);

    // Tạo một chuỗi HTML từ kết quả
    $html = '';
    if ($ds_theloai) {
        while ($row = $ds_theloai->fetch_assoc()) {
            $html .= '<option value="' . $row['id_theloai'] . '">' . $row['tentheloai'] . '</option>';
        }
    } else {
        $html .= '<option value="#">Không có thể loại</option>';
    }

    // Trả về chuỗi HTML
    echo $html;
}
?>
