<?php
    include '../ADMIN/header.php';
    include '../classes/theloaiadmin.php';
    include_once '../classes/loaitruyenadmin.php';

    $tl = new theloaiadmin();
    $ltruyen = new loaitruyenadmin();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tentheloai = $_POST['tentheloai'];
        $id_loai = $_POST['loaitruyen'];

        $themtheloai = $tl->them_theloai($tentheloai, $id_loai);
    }
?> 

<div id="contentDiv" class="main-content">
    <div class="container">
        <h4>Thêm Thể Loại</h4>
        <?php
            if(isset($themtheloai)){
                echo $themtheloai;
            }
        ?>
        <form action="themtheloai.php" method="post">
            <p>Loại Truyện</p>
            <select class="form-select" aria-label="Default select example" name="loaitruyen">
                <option selected disabled>Chọn loại truyện</option>
                <?php
                    $dsloai = $ltruyen->show_loai();

                    if($dsloai){
                        while($result = $dsloai->fetch_assoc()){
                ?>
                <option value="<?php echo $result['id_loai'] ?>"><?php echo $result['tenloai'] ?></option>
                <?php
                        }
                    }
                ?>
            </select>
            <p>Thể loại</p>
            <input type="text" name="tentheloai" placeholder="Nhập tên thể loại" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <br>
            <br>
            <input class="btn btn-primary" type="submit" name="submit" value="Lưu">
            <button type="button" class="btn btn-danger"><a href="theloai.php">Trở Về</a></button>
        </form>
    </div>
</div>
<script src="admin.js"> </script>
