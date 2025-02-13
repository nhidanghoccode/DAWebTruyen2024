<?php
include '../ADMIN/header.php';
?>
<?php 
      include '../classes/truyenadmin.php';
      include_once '../helper/format.php';
?>
<?php
$tr = new truyenadmin();
if (isset($_GET['approve'])) {
    $id_truyen = $_GET['approve'];
    $trangthai = 'approved';
    $pheduyet = $tr->pheDuyetTruyen($id_truyen, $trangthai);
} elseif (isset($_GET['reject'])) {
    $id_truyen = $_GET['reject'];
    $trangthai = 'rejected';
    $pheduyet = $tr->pheDuyetTruyen($id_truyen, $trangthai);
}
?>

<div id="contentDiv" class="main-content">
    <div class="container animate__animated animate__fadeIn">
        <h4>Danh sách truyện chờ phê duyệt</h4>
        <?php
        if (isset($pheduyet)) {
            echo $pheduyet;
        }
        $truyen_list = $tr->getTruyenChoPheDuyet();  // Sử dụng hàm mới
        if ($truyen_list) {
            while ($result = $truyen_list->fetch_assoc()) {
                ?>
                <div class="truyen-item">
                    <h5><?php echo $result['tentruyen']; ?></h5>
                    <p><strong>Tác giả:</strong> <?php echo $result['tacgia']; ?></p>
                    <p><strong>Thể loại:</strong> <?php echo $result['tentheloai']; ?></p>
                    <p><strong>Mô tả:</strong> <?php echo $result['mota']; ?></p>
                    <!-- <p><strong>Nội dung chi tiết:</strong> <?php echo nl2br($result['noidung']); ?></p> -->
                    <?php if ($result['biatruyen']) { ?>
                        <p><strong>Hình ảnh:</strong><br><img src="upload/<?php echo $result['biatruyen']?>" width="100px" alt="Bìa truyện" style="max-width: 200px;"></p>
                    <?php } ?>
                    <div class="action-buttons">
                        <a class="btn approve" href="?approve=<?php echo $result['id_truyen']; ?>">Phê duyệt</a>
                        <a class="btn reject" href="?reject=<?php echo $result['id_truyen']; ?>">Từ chối</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

.main-content {
    padding: 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h4 {
    text-align: center;
    margin-bottom: 20px;
    color: #333333;
}

.truyen-item {
    border-bottom: 1px solid #dddddd;
    padding: 15px 0;
}

.truyen-item h5 {
    margin: 0;
    font-size: 18px;
    color: #555555;
}

.truyen-item p {
    margin: 5px 0 10px;
    color: #777777;
}

.truyen-item img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
}

.action-buttons {
    display: flex;
    gap: 10px;
}

.action-buttons .btn {
    padding: 8px 12px;
    border-radius: 4px;
    text-decoration: none;
    color: #ffffff;
    font-size: 14px;
    transition: background-color 0.3s;
}

.action-buttons .btn.approve {
    background-color: #28a745;
}

.action-buttons .btn.approve:hover {
    background-color: #218838;
}

.action-buttons .btn.reject {
    background-color: #dc3545;
}

.action-buttons .btn.reject:hover {
    background-color: #c82333;
}

</style>
