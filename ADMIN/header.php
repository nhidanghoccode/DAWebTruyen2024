<?php
  include '../lib/session.php';
  Session::checkSession();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../font/fontawesome-free-6.4.0-web/css/all.min.css">
<link rel="stylesheet" href="../ADMIN/admin.css?v=4">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="/ADMIN/ckeditor/ckeditor.js"></script>
<script src="/ADMIN/ckfinder/ckfinder.js"></script>
<title>Admin Dashboard</title>
</head>
<body>
<div class="nav fixed-top">
  <div class="navleft">
  <!-- <nav class=""> -->
  <button id="toggleSidebar"><i class="fa-solid fa-list"></i></button>
  <!-- </nav> -->
  </div>
  <div class="navright">
    <li>Hello <?php echo Session::get('adminname') ?></li>
    <?php
    if(isset($_GET['action']) && $_GET['action']=='logout'){
      Session::destroy();
    }
    ?>
    <li><a href="?action=logout" >Đăng xuất</a></li>
  </div>
</div>
<div class="content">
<div class="sidebar">
  <a href="index.php"><h3>ADMIN</h3></a>
  <div class="sidebar">
  <a href="quanlysukien.php">Quản lý sự kiện</a>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" style=" color: aliceblue;" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        <a>Quản Lý Loại</a>
        </button>
      </h2>
      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
        <div class="accordion-body">
          <a href="loaitruyen.php" style="font-size: 15px; color: antiquewhite;" >Loại Truyện</a>
          <a href="theloai.php" style="font-size: 15px; color: antiquewhite;">Thể Loại</a>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" style=" color: aliceblue;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          <a>Quản Lý Truyện</a>
        </button>
      </h2>
      <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
          <a href="dstruyen.php" style="font-size: 15px; color: antiquewhite;" >Danh Sách Truyện</a>
          <a href="dstuchoi.php" style="font-size: 15px; color: antiquewhite;" >Danh Sách từ chối</a>
          <a href="themtruyen.php" style="font-size: 15px; color: antiquewhite;">Thêm Truyện Mới</a>
        </div>
      </div>
    </div>
    <a href="pheduyet.php">Phê duyệt truyện</a>
    <a href="dsnguoidung.php">Quản tài khoản</a>
    
</div>
  </div>
</div>
<script src="admin.js"> </script>
</body>
</html>