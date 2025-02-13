<?php
include '../ADMIN/header.php';
include '../classes/truyenadmin.php';
include_once '../helper/format.php';

$tr = new truyenadmin();
$fm = new Format();

if (isset($_GET['xoaid'])) {
    $id = $_GET['xoaid'];
    $xoaid = $tr->xoa_truyen($id);
}

if (isset($_GET['approve_again'])) {
    $id = $_GET['approve_again'];
    $approve_again = $tr->pheDuyetLaiTruyen($id);
}
?>

<div id="contentDiv" class="main-content">
    <h4>Danh sách truyện từ chối</h4>
    <?php
    if (isset($xoaid)) {
        echo $xoaid;
    }
    if (isset($approve_again)) {
        echo $approve_again;
    }
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên Truyện</th>
                <th scope="col">Bìa Truyện</th>
                <th scope="col">Loại Truyện</th>
                <th scope="col">Thể Loại</th>
                <th scope="col">Tác Giả</th>
                <th scope="col">Kiểu</th>
                <th scope="col">Trạng Thái</th>
                <th scope="col">Mô Tả</th>
                <th scope="col">Chỉnh sửa</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            $show_truyen = $tr->show_truyentuchoi();
            if ($show_truyen) {
                $i = 0;
                while ($result = $show_truyen->fetch_assoc()) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['tentruyen'] ?></td>
                        <td><img src="upload/<?php echo $result['biatruyen']?>" width="50px"></td>
                        <td><?php echo $result['tenloai'] ?></td>
                        <td><?php echo $result['tentheloai'] ?></td>
                        <td><?php echo $result['tacgia'] ?></td>
                        <td>
                            <?php
                            if ($result['kieu'] == 0) {
                                echo 'Không Nổi bật';
                            } else {
                                echo 'Nổi bật';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($result['trangthai'] == 0) {
                                echo 'Đang Cập Nhật';
                            } else {
                                echo 'Hoàn Thành';
                            }
                            ?>
                        </td>
                        <td><?php echo $fm->textShorten($result['mota'], 20) ?></td>
                        <td>
                            <a onclick="return confirm('Bạn có muốn phê duyệt lại không?')" href="?approve_again=<?php echo $result['id_truyen'] ?>" title="Phê duyệt lại"><i class="fa-solid fa-check"></i></a>
                            <a onclick="return confirm('Bạn có muốn xóa không?')" href="?xoaid=<?php echo $result['id_truyen'] ?>" title="Xóa"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<script src="admin.js"></script>
