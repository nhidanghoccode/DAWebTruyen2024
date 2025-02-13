<?php
  include '../lib/session.php';
  Session::init();
?>
<?php
    include '../lib/database.php';
    include '../helper/format.php';
    spl_autoload_register(function ($className) {
    include_once "../classes/" . $className . ".php";
    });
    $db = new Database();
    $fm = new Format();
    $us = new user();
    $td = new theodoiadmin();
    $ltruyen = new loaitruyenadmin();
    $tr = new truyenadmin;
    $tl = new theloaiadmin;
    $ch = new chuongadmin;
    $ngd = new nguoidung;
    $skien =  new sukien;
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dangnhap'])){
    $dangnhap = $ngd->dangnhap_nguoidung($_POST);
    
    // Sau khi đăng nhập thành công, kiểm tra nếu người dùng đã đăng nhập
    if($dangnhap == "Đăng nhập thành công"){
        $id_nguoidung = Session::get('id_nguoidung'); 
        $laytruyentheodoi = $td->laytruyentheodoi($id_nguoidung);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../font/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="thongtintruyen.css">
    <link rel="stylesheet" href="index.css?v=3">
    <link rel="stylesheet" href="theodoi.css?v=3">
    <link rel="stylesheet" href="trangdoc.css?v=3">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="/ADMIN/ckeditor/ckeditor.js"></script>
    <script src="/ADMIN/ckfinder/ckfinder.js"></script>
    <title>Document</title>
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" style="background-color: #e3f2fd;"  data-bs-theme="dark">
    <div class="sidebar container-fluid " style="background-color: #198754;" width="100%" data-bs-theme="dark">
        <a class="navbar-brand" href="#"><img src="../img/logo.png" width="80px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa-solid fa-list"></i></span>
        </button>
        <div class="sidebar collapse navbar-collapse " id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item itemhover">
                    <a class="nav-link active" aria-current="page" href="index.php">Trang Chủ</a>
                </li>
                <li class="nav-item itemhover dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Thể Loại
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        $show_ltruyen = $ltruyen->show_loaitruyen();
                        if ($show_ltruyen) {
                            while ($result = $show_ltruyen->fetch_assoc()) {
                                echo '<li class="list-group-item loaitruyen-item" data-id="' . $result['id_loai'] . '">' . $result['tenloai'] . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </li>

                <div id="subcategories-container" class="subcategories-container"></div>

                <li class="nav-item itemhover">
                  <a class="nav-link active" href="theodoi.php" data-target="container">Theo Dõi</a>
                </li>
                <li class="nav-item itemhover">
                  <a class="nav-link active" href="dssukien.php" data-target="container">Sự Kiện</a>
                </li>
                <li class="nav-item itemhover dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Thêm
                    </a>
                    <ul class="dropdown-menu">
                    <?php
                        $kt_dangnhap = Session::get('ngd_dangnhap');
                        $id_nguoidung = Session::get('id_nguoidung');
                    ?>

                    <!-- Thêm mã JavaScript -->
                    <script>
                        function kiemTraDangNhap(action) {
                            <?php if ($kt_dangnhap == false): ?>
                                alert("Bạn cần đăng nhập để " + action);
                                return false; 
                            <?php else: ?>
                                return true;
                            <?php endif; ?>
                        }
                    </script>
                    <li class="nav-item">
                        <a class="dropdown-item" href="thongtin.php" data-target="container" onclick="return kiemTraDangNhap('xem thông tin')">Thông tin</a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="dangtruyen.php" data-target="container" onclick="return kiemTraDangNhap('đăng truyện')">Đăng Truyện</a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="dstruyendang.php" data-target="container" onclick="return kiemTraDangNhap('đăng truyện')">Truyện đã đăng</a>
                    </li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" method="GET" action="search.php">
                <input class="form-control" type="search" placeholder="Tìm kiếm" aria-label="Tìm kiếm" name="keyword">
                <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
              <li class="nav-item">
                <?php
                    if(isset($_GET['id_nguoidung']) && $_GET['id_nguoidung'] !== ''){
                        $id_nguoidung = $_GET['id_nguoidung'];
                        $td->capnhat_trangthai_theodoi($id_nguoidung);
                        Session::destroy();
                        header('location:index.php');
                        exit;
                    }
                ?>
                <?php
                    $kt_dangnhap = Session::get('ngd_dangnhap');
                    $id_nguoidung = Session::get('id_nguoidung');

                    if($kt_dangnhap == false){
                        echo '<a class="nav-link active" aria-current="page" href="#">
                            <button class="btn_dndx dang-nhap-btn login-btn"> <i class="fa-regular fa-user"></i> Đăng Nhập</button>
                        </a>';
                    } else {
                        echo '<a class="nav-link active" aria-current="page" href="?id_nguoidung='.$id_nguoidung.'">
                            <button class="btn_dndx"> <i class="fa-regular fa-user"></i> Đăng Xuất</button>
                        </a>';
                    }

                    if($kt_dangnhap == true){
                        $laytruyentheodoi = $td->laytruyentheodoi($id_nguoidung);
                    }
                ?>

              </li>
              </ul>
        </div>
    </div>
</nav>
  <div class="form-dang-nhap" id="formDangNhap">
    <button class="dong-form-btn"><i class="fa-regular fa-circle-xmark"></i></button>
    <h2 class="txtdn">Đăng nhập</h2>
    <?php
            if(isset($dangnhap)){
                echo $dangnhap;
            }
            ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="matkhau" class="form-label">Mật khẩu:</label>
            <input type="password" class="form-control" id="matkhau" name="matkhau" required>
        </div>
        <div class="text-center">
            <button type="submit" name="dangnhap" class="btn btn-danger login-btn">Đăng nhập</button>
        </div>
        <p class="text-center">Bạn chưa có tài khoản? <a href='dangky.php' title='Đăng ký'>Đăng ký</a></p>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var nutDangNhap = document.querySelector('.dang-nhap-btn');
    var nutDongFormDangNhap = document.querySelector('.dong-form-btn');
    var formDangNhap = document.getElementById('formDangNhap');
    var main = document.querySelector('.main');

    nutDangNhap.addEventListener('click', function () {
        formDangNhap.style.display = 'block';
        main.classList.add('dimmed-background'); 
    });

    nutDongFormDangNhap.addEventListener('click', function () {
        formDangNhap.style.display = 'none';
        main.classList.remove('dimmed-background');
    });
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.loaitruyen-item').hover(function() {
        var loaiId = $(this).data('id');
        var $this = $(this);
        
        $('.subcategories-container').remove();
        
        var subcategoriesContainer = $('<div>', { class: 'subcategories-container' });
        $this.append(subcategoriesContainer);
        
        $.ajax({
            url: 'laytheloai_ajax.php',
            type: 'GET',
            data: { id_loai: loaiId },
            success: function(data) {
                subcategoriesContainer.html(data);
            },
            error: function() {
                subcategoriesContainer.html('<p>Không thể lấy dữ liệu thể loại. Vui lòng thử lại sau.</p>');
            }
        });
    }, function() {
        $(this).find('.subcategories-container').on('mouseenter', function() {
            $(this).show();
        }).on('mouseleave', function() {
            $(this).hide();
        });
    });
});
</script>



</header>
<main>

</body>
</html>