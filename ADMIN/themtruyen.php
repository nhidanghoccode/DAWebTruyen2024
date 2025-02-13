
<?php
    include '../ADMIN/header.php';
    include '../classes/loaitruyenadmin.php';
    include '../classes/theloaiadmin.php';
    include '../classes/truyenadmin.php';
?>
<?php
    $tr = new truyenadmin();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $themtruyen = $tr-> them_truyen($_POST,$_FILES);
    }
?> 

    <div id="contentDiv" class="main-content">
        <div class="container">
        <h4>Thêm Mới Truyện</h4>
        <?php
            if(isset( $themtruyen )){
                echo  $themtruyen ;
            }
        ?>
        <form action="themtruyen.php" method="post" enctype="multipart/form-data">
            <p>Tên Truyện</p>
            <input type="text" name="tentruyen" placeholder="Tên Truyện" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <p>Tác Giả</p>
            <input type="text" name="tacgia" placeholder="Tên tác giả" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <p>Loại Truyện</p>
            <select class="form-select"id="loaitruyen" name="loaitruyen">
                <option value="#">Loại Truyện</option>
                <?php
                $ltruyen = new loaitruyenadmin();
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
            <select class="form-select" id="theloai" name="theloai" >
                <option value="#">Thể Loại</option>
            </select>
            
            <p>Bìa Truyện</p>
            <input type="file" name="biatruyen" placeholder="Tên Truyện" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            
            <br>
            <div class="input-group">
                <span class="input-group-text">Mô Tả</span>
                <textarea name="mota" id="editor1" rows="10" placeholder="mô tả"></textarea>
            </div>
            <br>
            <p>Kiểu</p>
            <select class="form-select" name="kieu" aria-label="Default select example">
                <option selected>Kiểu</option>
                <option value="1">Nổi bật</option>
                <option value="0">Không nổi bật</option>
            </select>
            <p>Trạng Thái</p>
            <select class="form-select" name="trangthai" aria-label="Default select example">
                <option selected>Trạng thái</option>
                <option value="1">Hoàn Thành</option>
                <option value="0">Đang Cập Nhật</option>
            </select>
            <!-- <button type="submit" name="submit" value="Save" class="btn btn-primary">Tạo mới</button> -->
            <input class="btn btn-primary" type="submit" name="submit" value="Lưu">
            <button type="button" class="btn btn-danger"><a href="dstruyen.php">Trở Về</a></button>
        </form>
    </div>
    </div>
    <script src="admin.js"> </script>
    <script>
       CKEDITOR.replace( 'editor1', {
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