
<?php
    include '../ADMIN/header.php';
    include '../classes/loaitruyenadmin.php';
?>
<?php
    $ltruyen = new loaitruyenadmin();
    if(!isset($_GET['id_loai']) || $_GET['id_loai']==NULL){
        echo "<script>window.location ='themloaitruyen'</script>";
    }else{
        $id = $_GET['id_loai'];
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tenloai = $_POST['tenloai'];
        $sualoai = $ltruyen-> sua_loai($tenloai,$id);
    }
?> 


    <div id="contentDiv" class="main-content">
        <div class="container">
        <h4>Sửa Thể Loại</h4>
        <?php
            if(isset($sualoai)){
                echo $sualoai;
            }
        ?>
        <?php
            $get_ten_loai = $ltruyen->getloaitruyenbyid($id);
            if($get_ten_loai){
                while($result = $get_ten_loai->fetch_assoc()){

        ?>
        <form action="" method="post">
            <p>Loại Truyện</p>
            <input type="text" value="<?php echo $result['tenloai'] ?>" name="tenloai" placeholder="Nhập tên thể loại" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <br>
            <input class="btn btn-primary" type="submit" name="submit" value="Sửa">
        </form>
        <?php
                }
            }
        ?>
    </div>
    </div>
    <script src="admin.js"> </script>
</body>
</html>