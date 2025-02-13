
<?php
    include '../inc/header.php';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<?php
$tr = new truyenadmin();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id_nguoidung = $_SESSION['id_nguoidung']; 
    $dangtruyen = $tr->dangTruyen($_POST, $_FILES, $id_nguoidung);
}
?> 

    <div id="contentDiv" class="main-content">
        <div class="container animate__animated animate__fadeIn">
        <h4>Đăng truyện</h4>
        <?php
            if(isset( $dangtruyen )){
                echo  $dangtruyen ;
            }
        ?>
        <form action="dangtruyen.php" method="post" enctype="multipart/form-data">
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
            
            <input class="btn btn-primary" type="submit" name="submit" value="Đăng Truyện">
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

<?php
 include '../inc/footer.php';
?>