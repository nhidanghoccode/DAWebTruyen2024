
<?php
    include '../ADMIN/header.php';
    include '../classes/loaitruyenadmin.php';
?>
<?php
    $ltruyen = new loaitruyenadmin();
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tenloai = $_POST['tenloai'];
        $themloai = $ltruyen-> them_loai($tenloai);
    }
?> 


    <div id="contentDiv" class="main-content">
        <div class="container">
        <h4>Thêm Loại Truyện</h4>
        <?php
            if(isset($themloai)){
                echo $themloai;
            }
        ?>
        <form action="themloaitruyen.php" method="post">
            <p>Loại Truyện</p>
            <input type="text" name="tenloai" placeholder="Nhập tên loại" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <br>
            <input class="btn btn-primary" type="submit" name="submit" value="Lưu">
        </form>
    </div>
    </div>
    <script src="admin.js"> </script>
</body>
</html>