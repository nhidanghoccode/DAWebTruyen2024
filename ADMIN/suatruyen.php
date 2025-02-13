
<?php
    include '../ADMIN/header.php';
    include '../classes/loaitruyenadmin.php';
    include '../classes/theloaiadmin.php';
    include '../classes/truyenadmin.php';
?>
<?php
    $tr = new truyenadmin();
    if(!isset($_GET['id_truyen']) || $_GET['id_truyen']==NULL){
        echo "<script>window.location ='dstruyen.php'</script>";
    }else{
        $id = $_GET['id_truyen'];
    }
    $suatruyen="";
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $suatruyen = $tr-> sua_truyen($_POST,$_FILES,$id);
    }
?> 

    <div id="contentDiv" class="main-content">
        <div class="container">
        <h4>Sửa Truyện</h4>
        <?php
            if(isset( $suatruyen )){
                echo  $suatruyen ;
            }
        ?>
        <?php
            $lay_truyen_theo_id = $tr->laytruyentheoid($id);
            if($lay_truyen_theo_id){
                while($result_truyen = $lay_truyen_theo_id->fetch_assoc()){
        ?>  
        <!-- khi có ảnh phải thêm enctype="multipart/form-data" -->
        <form action="" method="post" enctype="multipart/form-data">
            <p>Tên Truyện</p>
            <input type="text" value="<?php echo $result_truyen['tentruyen'] ?>" name="tentruyen" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <p>Tác Giả</p>
            <input type="text" value="<?php echo $result_truyen['tacgia'] ?>" name="tacgia" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <p>Loại Truyện</p>
            <select class="form-select"id="loaitruyen" name="loaitruyen">
                <option value="#">Loại Truyện</option>
    <?php
    $ltruyen = new loaitruyenadmin();
    $dsloai = $ltruyen->show_loai();

    if($dsloai){
        while($row = $dsloai->fetch_assoc()){
            $selected = ($row['id_loai'] == $result_truyen['id_loai']) ? 'selected' : ''; // Kiểm tra xem loại truyện có trùng khớp với loại truyện của truyện hiện tại không
    ?>
    <option value="<?php echo $row['id_loai'] ?>" <?php echo $selected ?>><?php echo $row['tenloai'] ?></option>
    <?php
        }
    }
    ?>
</select>
<p>Thể loại</p>
<select class="form-select" id="theloai" name="theloai" >
                <option value="#">Thể Loại</option>
    <?php
    $tl = new theloaiadmin();
    $dstheloai = $tl->show_theloai();

    if($dstheloai){
        while($row = $dstheloai->fetch_assoc()){
            $selected = ($row['id_theloai'] == $result_truyen['id_theloai']) ? 'selected' : ''; // Kiểm tra xem thể loại có trùng khớp với thể loại của truyện hiện tại không
    ?>
    <option value="<?php echo $row['id_theloai'] ?>" <?php echo $selected ?>><?php echo $row['tentheloai'] ?></option>
    <?php
        }
    }
    ?>
</select>

            <p>Bìa Truyện</p>
            <img src="upload/<?php echo $result_truyen['biatruyen']?>" width="90px">
            <input type="file" name="biatruyen"class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            
            <br>
            <div class="input-group">
                <span class="input-group-text">Mô Tả</span>
                <textarea name="mota" id="editor1" rows="10"><?php echo $result_truyen['mota'] ?></textarea>
            </div>
            <br>
            <p>Kiểu</p>
            <select class="form-select" name="kieu" aria-label="Default select example">
                <option selected>Kiểu</option>
                <?php
                if($result_truyen['kieu']==0){
                ?>
                <option value="1">Nổi bật</option>
                <option selected value="0">Không nổi bật</option>
                <?php
                }else{
                ?>
                <option selected value="1">Nổi bật</option>
                <option value="0">Không nổi bật</option>
                <?php
                }
                ?>
            </select>
            <p>Trạng Thái</p>
            <select class="form-select" name="trangthai" aria-label="Default select example">
                <option selected>Trạng thái</option>
                <?php
                if($result_truyen['trangthai']==0){
                ?>
                <option value="1">Hoàn Thành</option>
                <option selected value="0">Đang Cập Nhật</option>
                <?php
                }else{
                ?><option selected value="1">Hoàn Thành</option>
                <option value="0">Đang Cập Nhật</option>
                <?php
                }
                ?>
            </select>
            <!-- <button type="submit" name="submit" value="Save" class="btn btn-primary">Tạo mới</button> -->
            <input class="btn btn-primary" type="submit" name="submit" value="Sửa">
            <button type="button" class="btn btn-danger"><a href="dstruyen.php">Trở Về</a></button>
        </form>
    <?php
        }
    }
    ?>
    </div>
    </div>
    <script src="admin.js"> </script>
    <script>
        CKEDITOR.replace( 'editor1', {
        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#loaitruyen').change(function() {
        var x = $(this).val();
        $.get("../classes/theloai_ajax.php", {
            loaitruyen: x
        }, function(data) {
            $("#theloai").html(data);
        });
    });
});
</script>
</body>
</html>