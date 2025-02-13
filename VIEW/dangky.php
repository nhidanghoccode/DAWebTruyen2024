<?php
    include '../inc/header.php';
?>
<?php
$ngd = new nguoidung(); 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dangky'])){
    $dangky = $ngd-> dangky_nguoidung($_POST);
}
?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-header">
            <h3 class="text-center">Đăng ký</h3>
          </div>
          <div class="card-body">
            <?php
            if(isset($dangky)){
                echo $dangky;
            }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="tendangnhap">Tên đăng nhập:</label>
                    <input type="text" class="form-control" id="tendangnhap" name="tendangnhap" placeholder="Nhập tên người dùng">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại:</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập tên người dùng">
                </div>
                <div class="form-group">
                    <label for="matkhau">Mật khẩu:</label>
                    <input type="password" class="form-control" id="matkhau" name="matkhau" placeholder="Nhập mật khẩu">
                </div>
                <input type="submit" name="dangky" value="Đăng Ký" class="btn btn-primary btn-block"></input>
                <div class="container signin">
                <p>Bạn đã có tài khoản? <a href="index.php">Đăng Nhập.</a></p>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
