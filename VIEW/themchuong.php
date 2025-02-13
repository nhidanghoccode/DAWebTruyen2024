
<?php
    include '../inc/header.php';
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['luu'])){
       
        if(isset($_GET['id_truyen'])){
            $id_truyen = $_GET['id_truyen'];
            $themchuong = $ch->them_chuong($_POST, $id_truyen);
           
        }
    }
?> 

    <div id="contentDiv" class="main-content" style="margin-bottom: 20px;">
        <div class="container">
        <h4>Thêm Chương Mới</h4>
        <?php
            if(isset( $themchuong )){
                echo  $themchuong ;
            }
        ?>

`       <form action="" method="post" enctype="multipart/form-data" onsubmit="setToday()">
            <?php
                if(isset($_GET['id_truyen'])){
                    $id_truyen = $_GET['id_truyen'];
                    $tr = new truyenadmin();
                    $tentruyen = $tr->laytruyentheoid($id_truyen);
                    if($tentruyen){
                        $result = $tentruyen->fetch_assoc();
            ?>
            <p>Truyện</p>
            <input value="<?php echo $result['tentruyen'] ?>" readonly name="tentruyen"class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <?php 
                    }
                }
            ?>
            <p>Chapter</p>
            <input type="text" name="chapter" placeholder="Chapter" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <p>Tên Chương</p>
            <input type="text" name="tenchuong" placeholder="Tên Chương" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <p>Nội dung</p>
            <div class="input-group">
                <textarea name="noidung" id="editor1" rows="10" cols="200">
                </textarea>
                <script>
                    CKEDITOR.replace( 'editor1', {
                    filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                    filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                } );
                </script>
            </div>
            
            <br>
            <input class="btn btn-primary" type="submit" name="luu" value="Lưu">
            <button type="button" class="btn btn-danger"><a href="dschuong.php?id_truyen=<?php echo $result['id_truyen'] ?>">Trở Về</a></button>
            
        </form>
    </div>
    </div>
    <script src="admin.js"> </script>
<?php
    include '../inc/footer.php';
?>