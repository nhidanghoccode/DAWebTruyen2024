
<?php
    include '../inc/header.php';
?>
<?php
    $ch = new chuongadmin();
    if(!isset($_GET['id_chuong']) || $_GET['id_chuong']==NULL){
        echo "<script>window.location ='dstruyen.php'</script>";
    }else{
        $idchuong = $_GET['id_chuong'];
    }
    $suachuong="";
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $suachuong = $ch-> sua_chuong($_POST,$idchuong);
    }
?> 

    <div id="contentDiv" class="main-content">
        <div class="container">
        <h4>Sửa Chương</h4>
        <?php
            if(isset( $suachuong )){
                echo  $suachuong ;
            }
        ?>
        <?php 
        $lay_chuong_theo_id = $ch->laychuongtheoid($idchuong);
        if($lay_chuong_theo_id){
            $result_chuong = $lay_chuong_theo_id->fetch_assoc();
        }
        ?>
        
        <form action="" method="post" enctype="multipart/form-data">
            <p>Chapter</p>
            <input value="<?php echo $result_chuong['chapter'] ?>" type="text" name="chapter" placeholder="Chapter" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <p>Tên Chương</p>
            <input value="<?php echo $result_chuong['tenchuong']?>" type="text" name="tenchuong" placeholder="Tên Chương" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <div class="input-group">
                <span class="input-group-text">Nội Dung</span>
                <textarea name="noidung" id="editor1" rows="10" cols="80">
                    <?php echo $result_chuong['noidung'] ?>
                </textarea>
                <script>
                    CKEDITOR.replace( 'editor1', {
                    filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                    filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                } );
                </script>
            </div>
            
            <br>
            <input class="btn btn-primary" type="submit" name="submit" value="Sửa">
            <?php
                $tr = new truyenadmin();
                $layid = $tr->show_truyen();
                if($layid){
                   $result = $layid->fetch_assoc()
            ?>
            <button type="button" class="btn btn-danger"><a href="dschuong.php?id_truyen=<?php echo $result['id_truyen']?>">Trở Về</a></button>
            <?php 
            }
            ?>
        </form>

    </div>
    </div>
    <script src="admin.js"> </script>
</body>
</html>
<?php
 include '../inc/footer.php';
?>