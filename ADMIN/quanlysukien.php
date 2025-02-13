<?php
include '../ADMIN/header.php';
include '../classes/sukien.php';
include_once '../helper/format.php';
include_once '../lib/database.php';

$skien = new sukien();

$target_dir = "upload/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Xử lý thêm sự kiện
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_event'])) {
    $tensukien = $_POST['tensukien'];
    $tgianbatdau = $_POST['tgianbatdau'];
    $tgianketthuc = $_POST['tgianketthuc'];
    $mota = $_POST['mota'];

    $target_file = $target_dir . basename($_FILES["anh"]["name"]);
    if (move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file)) {
        $anh = basename($_FILES["anh"]["name"]);
        $alert = $skien->them_sukien($tensukien, $anh, $tgianbatdau, $tgianketthuc, $mota);
    } else {
        $alert = "Có lỗi xảy ra khi tải lên file ảnh.";
    }
    
    echo '<script>
        alert("' . $alert . '");
        localStorage.setItem("tensukien", "' . $tensukien . '");
        localStorage.setItem("tgianbatdau", "' . $tgianbatdau . '");
        localStorage.setItem("tgianketthuc", "' . $tgianketthuc . '");
        localStorage.setItem("mota", "' . $mota . '");
    </script>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_event'])) {
    $id = $_POST['id'];
    $tensukien = $_POST['tensukien'];
    $tgianbatdau = $_POST['tgianbatdau'];
    $tgianketthuc = $_POST['tgianketthuc'];
    $mota = $_POST['mota'];

    // File upload handling
    $target_file = $target_dir . basename($_FILES["anh"]["name"]);
    if (move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file)) {
        $anh = basename($_FILES["anh"]["name"]);
        $alert = $skien->sua_sukien($tensukien, $anh, $tgianbatdau, $tgianketthuc, $mota, $id);
    } else {
        $alert = "Có lỗi xảy ra khi tải lên file ảnh.";
    }
    
    echo '<script>
        alert("' . $alert . '");
        localStorage.setItem("tensukien", "' . $tensukien . '");
        localStorage.setItem("tgianbatdau", "' . $tgianbatdau . '");
        localStorage.setItem("tgianketthuc", "' . $tgianketthuc . '");
        localStorage.setItem("mota", "' . $mota . '");
    </script>';
}

// Xử lý xóa sự kiện
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $alert = $skien->xoa_sukien($id);
    echo '<script>alert("' . $alert . '");</script>';
}

$currentEvents = $skien->getCurrentEvent();
$allEvents = $skien->show_sukien();
?>

<div id="contentDiv" class="main-content">
    <h1>Quản lý sự kiện</h1>
    
    <!-- Thêm sự kiện -->
    <h3 style="background-color: #D8BFD8;">Thêm sự kiện</h3>
    <form id="eventForm" method="post" enctype="multipart/form-data">
    <label for="tensukien">Tên sự kiện:</label>
    <input type="text" id="tensukien" name="tensukien" required><br>

    <label for="tgianbatdau">Thời gian bắt đầu:</label>
    <input type="datetime-local" id="tgianbatdau" name="tgianbatdau" required><br>

    <label for="tgianketthuc">Thời gian kết thúc:</label>
    <input type="datetime-local" id="tgianketthuc" name="tgianketthuc" required><br>

    <label for="anh">Ảnh:</label>
    <input type="file" id="anh" name="anh" required><br>

    <label for="mota">Mô tả:</label>
    <textarea name="mota" id="editor2" rows="8" placeholder="mô tả"></textarea>

    <button type="submit" name="add_event">Thêm</button>
    </form>

    <!-- Sự kiện hiện tại -->
    <?php if ($currentEvents && $currentEvents->num_rows > 0): ?>
        <h3 style="background-color: #D8BFD8;">Sự kiện hiện tại</h3>
        <?php while ($event = $currentEvents->fetch_assoc()): ?>
            <p>Tên sự kiện: <?php echo $event['tensukien']; ?></p>
            <p>Thời gian bắt đầu: <?php echo $event['tgianbatdau']; ?></p>
            <p>Thời gian kết thúc: <?php echo $event['tgianketthuc']; ?></p>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Không có sự kiện nào đang diễn ra.</p> <!-- Thêm thông báo nếu không có sự kiện hiện tại -->
    <?php endif; ?>

    <!-- Danh sách sự kiện -->
    <h3 style="background-color: #D8BFD8;">Danh sách sự kiện</h3>
    <table border="1">
        <tr>
            <th>STT</th>
            <th>Bìa</th>
            <th>Tên sự kiện</th>
            <th>Thời gian bắt đầu</th>
            <th>Thời gian kết thúc</th>
            <th>Mô tả</th>
            <th>Thao tác</th>
        </tr>
        <tbody class="table-group-divider">
    <?php
    if ($allEvents) {
        $i = 0;
        while ($result = $allEvents->fetch_assoc()) {
            $i++;
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td>
            <?php if (file_exists('upload/' . $result['anh'])): ?>
                <img src="upload/<?php echo $result['anh']; ?>" width="50px">
            <?php else: ?>
                <img src="default-image.png" width="50px">
            <?php endif; ?>
        </td>
        <td><?php echo $result['tensukien']; ?></td>
        <td><?php echo $result['tgianbatdau']; ?></td>
        <td><?php echo $result['tgianketthuc']; ?></td>
        <td class="event-description"><?php echo $result['mota']; ?></td>
        <td>
            <a href="quanlysukien.php?editid=<?php echo $result['id_sukien']; ?>">Sửa</a> |
            <a href="quanlysukien.php?delid=<?php echo $result['id_sukien']; ?>" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a>
        </td>
    </tr>
    <?php
        }
    }
    ?>
        </tbody>
    </table>

    <!-- Sửa sự kiện -->
    <?php
    if (isset($_GET['editid'])) {
        $id = $_GET['editid'];
        $eventDetails = $skien->getsukienbyid($id);
        if ($eventDetails) {
            $result = $eventDetails->fetch_assoc();
            ?>
            <h3 style="background-color: #D8BFD8;">Sửa sự kiện</h3>
            <form id="eventForm" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $result['id_sukien']; ?>">
                <label for="tensukien">Tên sự kiện:</label>
                <input type="text" id="tensukien" name="tensukien" value="<?php echo $result['tensukien']; ?>" required><br>
                <label for="tgianbatdau">Thời gian bắt đầu:</label>
                <input type="datetime-local" id="tgianbatdau" name="tgianbatdau" value="<?php echo $result['tgianbatdau']; ?>" required><br>

                <label for="tgianketthuc">Thời gian kết thúc:</label>
                <input type="datetime-local" id="tgianketthuc" name="tgianketthuc" value="<?php echo $result['tgianketthuc']; ?>" required><br>

                <label for="anh">Ảnh:</label>
                <input type="file" id="anh" name="anh" required><br>

                <label for="mota">Mô tả:</label>
                <textarea name="mota" id="editor1" rows="10" placeholder="mô tả"><?php echo $result['mota']; ?></textarea>
                <button type="submit" name="edit_event">Lưu</button>
            </form>
            <?php
        }
    }
    ?>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var descriptions = document.querySelectorAll(".event-description");
    descriptions.forEach(function(description) {
        var text = description.innerText;
        if (text.length > 50) {
            var shortenedText = text.substring(0, 50) + "...";
            description.innerText = shortenedText;
        }
    });
});
</script>

<script>
       CKEDITOR.replace( 'editor1', {
    filebrowserBrowseUrl: '/admin/ckfinder/ckfinder.html',
    filebrowserUploadUrl: '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserWindowWidth: '1000',
    filebrowserWindowHeight: '700'
    } );
    </script>
    <script>
       CKEDITOR.replace( 'editor2', {
    filebrowserBrowseUrl: '/admin/ckfinder/ckfinder.html',
    filebrowserUploadUrl: '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserWindowWidth: '1000',
    filebrowserWindowHeight: '700'
    } );
    </script>
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.main-content {
    width: 80%;
    /* margin: 0 auto; */
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    color: #333;
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input[type="text"], input[type="datetime-local"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    padding: 10px 20px;
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f4f4f4;
}

.notification-banner {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: #ff9800;
    color: white;
    text-align: center;
    padding: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.notification-banner a {
    color: white;
    text-decoration: underline;
    margin-left: 10px;
}

.notification-banner button {
    background: none;
    border: none;
    color: white;
    font-size: 16px;
    margin-left: 20px;
    cursor: pointer;
}
</style>
