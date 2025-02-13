<?php
 include '../ADMIN/header.php';?>
<?php
    include '../classes/nguoidung.php';

$ngd = new nguoidung();
$dsnguoidung = $ngd->laydsnguoidung(); // Hàm này trả về danh sách người dùng từ cơ sở dữ liệu
?>

<div id="contentDiv" class="main-content">
        <div class="container">
    <h2 class="mb-4">Danh Sách Người Dùng</h2>
    <?php if ($dsnguoidung && $dsnguoidung->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên Người Dùng</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Số Truyện đã đăng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($row = $dsnguoidung->fetch_assoc()):
                    $i++;
                    $sotruyen = $ngd->sotruyendadang($row['id_nguoidung']);
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['tendangnhap']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $sotruyen; ?></td>
                    <!-- <td>
                        <a href="suanguoidung.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="xoanguoidung.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">Xóa</a>
                    </td> -->
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            Không có người dùng nào.
        </div>
    <?php endif; ?>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
