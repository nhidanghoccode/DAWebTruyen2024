
<?php
    include '../ADMIN/header.php';
    include '../classes/theloaiadmin.php';
?>
<?php
    $tl = new theloaiadmin();
    if(!isset($_GET['id_theloai']) || $_GET['id_theloai']==NULL){
        echo "<script>window.location ='theloai.php'</script>";
    }else{
        $id = $_GET['id_theloai'];
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tentheloai = $_POST['tentheloai'];
        $suatheloai = $tl-> sua_theloai($tentheloai,$id);
    }
?> 


    <div id="contentDiv" class="main-content">
        <div class="container">
        <h4>Sửa Thể Loại</h4>
        <?php
            if(isset($suatheloai)){
                echo $suatheloai;
            }
        ?>
        <?php
            $get_ten_tl = $tl->gettloaibyid($id);
            if($get_ten_tl){
                while($result = $get_ten_tl->fetch_assoc()){

        ?>
        <form action="" method="post">
            <p>Loại Truyện</p>
            <select class="form-select" aria-label="Default select example">
                <option selected>Không có</option>
                <option value="1">Truyện Tranh</option>
                <option value="2">Truyện Chữ</option>
            </select>
            <p>Thể loại</p>
            <input type="text" value="<?php echo $result['tentheloai'] ?>" name="tentheloai" placeholder="Nhập tên thể loại" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <br>
            <!-- <p>Từ khóa tìm kiếm</p>
            <input type="text" placeholder="Từ khóa 1, từ khóa 2,..." class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <br> -->
            <div class="input-group">
                <span class="input-group-text">Mô Tả</span>
                <textarea class="form-control" aria-label="With textarea"></textarea>
            </div>
            <!-- <button type="submit" name="submit" value="Save" class="btn btn-primary">Tạo mới</button> -->
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