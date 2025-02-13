<?php
include '../inc/header.php';
?>
<?php
$id_nguoidung = Session::get('id_nguoidung');
if (!$id_nguoidung) {
    header("Location: login.php");
    exit();
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateinfo'])) {
    $tendangnhap = $_POST['tendangnhap'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $update = $ngd->capnhatnguoidung($id_nguoidung, $tendangnhap, $email, $phone);
    $message = $update ? "Cập nhật thông tin thành công" : "Cập nhật thông tin không thành công";
}

// Handle avatar update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['capnhatavatar'])) {
    $avatar = $_FILES['avatar']['name'];
    $target_dir = "../ADMIN/upload/";
    $target_file = $target_dir . basename($avatar);

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
        $update = $ngd->capnhatavatar($id_nguoidung, $avatar);
        $capnhatavatar = $update ? "Cập nhật avatar thành công" : "Cập nhật avatar không thành công";
    } else {
        $capnhatavatar = "Có lỗi xảy ra khi tải lên tệp.";
    }
}

// Fetch user info
$user = $ngd->getusertheoid($id_nguoidung);
?>
<body>
<div class="container" style="background-image: url('../img/nen1.jpg'); background-size: contain;">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="text-center">Thông tin người dùng</h3>
                </div>
                <div class="card-body">
                    <div class="profile-container text-center">
                        <img alt="Avatar người dùng" class="profile-avatar img-thumbnail" style="width: 150px; height: 150px;" src="../img/<?php echo $user['avatar'];?>">
                        <div class="profile-info mt-3">
                            <form action="thongtin.php" method="post">
                                <div class="form-group row">
                                    <label for="tendangnhap" class="col-sm-4 col-form-label">Tên đăng nhập:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="tendangnhap" name="tendangnhap" value="<?php echo $user['tendangnhap']; ?>" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-link" onclick="toggleEdit('tendangnhap')">Sửa</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mail" class="col-sm-4 col-form-label">mail:</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" id="mail" name="email" value="<?php echo $user['email']; ?>" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-link" onclick="toggleEdit('mail')">Sửa</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-4 col-form-label">Số điện thoại:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-link" onclick="toggleEdit('phone')">Sửa</button>
                                    </div>
                                </div>
                                <div id="saveCancelButtons" class="text-center" style="display: none;">
                                    <button type="submit" name="updateinfo" class="btn btn-primary">Lưu</button>
                                    <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Hủy</button>
                                </div>
                            </form>
                        </div>
                        <form action="thongtin.php" method="post" enctype="multipart/form-data" class="mt-4">
                            <div class="form-group">
                                <label for="avatar">Thay đổi avatar:</label>
                                <input type="file" class="form-control" id="avatar" name="avatar">
                            </div>
                            <input type="hidden" name="id_nguoidung" value="<?php echo $user['id_nguoidung']; ?>">
                            <input type="submit" name="capnhatavatar" value="Cập nhật" class="btn btn-primary btn-block">
                        </form>
                        <?php
                        if (isset($message)) {
                            echo "<div class='mt-3'>$message</div>";
                        }
                        if (isset($capnhatavatar)) {
                            echo "<div class='mt-3'>$capnhatavatar</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
function toggleEdit(fieldId) {
    var field = document.getElementById(fieldId);
    console.log("Editing field:", fieldId);
    field.readOnly = false;
    field.classList.add('border-primary');
    document.getElementById('saveCancelButtons').style.display = 'block';
}

function cancelEdit() {
    var fields = ['tendangnhap', 'email', 'phone'];
    for (var i = 0; i < fields.length; i++) {
        var field = document.getElementById(fields[i]);
        field.readOnly = true;
        field.classList.remove('border-primary');
    }
    document.getElementById('saveCancelButtons').style.display = 'none';
    console.log("Canceled edit");
}
</script>
<style>
    body{
        background-image: url('../img/nen1.jpg'); background-size: contain;
    }
</style>
<?php
include '../inc/footer.php';
?>
