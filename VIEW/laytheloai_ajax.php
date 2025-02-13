<?php
include '../classes/theloaiadmin.php';

if (isset($_GET['id_loai'])) {
    $id_loai = $_GET['id_loai'];
    $tl = new theloaiadmin();
    
    $get_theloai = $tl->show_theloaibyloai($id_loai);
    if ($get_theloai) {
        echo '<ul class="list-group">';
        while ($result_theloai = $get_theloai->fetch_assoc()) {
            echo '<li class="list-group-item"><a href="theloai.php?id=' . $result_theloai['id_theloai'] . '">' . $result_theloai['tentheloai'] . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Không có thể loại nào cho loại truyện này</p>';
    }
}
?>
