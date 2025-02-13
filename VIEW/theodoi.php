<?php
    include '../inc/header.php';
    
?>
<div class="container main" style="min-height: 300px; width:100%; background-image: url('../img/nen.png'); background-size: cover;">
    <section>
    <?php
    $idnguoidung = Session::get('id_nguoidung');
    
    if ($idnguoidung) {
        $laytruyentheodoi = $td->laytruyentheodoi($idnguoidung);
    ?>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['xoatheodoi'])) {
        $idnguoidung = Session::get('id_nguoidung');
        $idtruyen = $_POST['truyenid'];

        $result = $td->xoatheodoi($idnguoidung, $idtruyen);
        if ($result) {
            echo "<script>alert('Xóa theo dõi thành công!');</script>";
            echo "<script>window.location = window.location.href;</script>";
        } else {
            echo "<script>alert('Xóa theo dõi không thành công.');</script>";
        }
    }
?>
       <h2>Danh sách truyện đang theo dõi</h2>
       <div class="list-books">
       <?php 
        if ($laytruyentheodoi) {
            while ($result = $laytruyentheodoi->fetch_assoc()) {
                
        ?>
               <li class='book-item'>
               <div class='book-avatar'>
               <a href="thongtintruyen.php?truyenid=<?php echo $result['id_truyen']?>">
                    <img src="../ADMIN/upload/<?php echo $result['biatruyen'] ?>" alt="<?php echo $result['tentruyen'] ?>">
                </a>
               </div>
               <div class="book-info">
               <div class="book-name">
               <h6 itemprop="name"><?php echo $result['tentruyen']?></h6>
               </div>
               <div class="last-chapter">       
               <?php
                    $chuongcuoi = $ch->laychuongcuoi($result['id_truyen']);
                    if($chuongcuoi){
                        $result_chuongcuoi = $chuongcuoi->fetch_assoc();
                    ?>
                    
                    <?php
                        }
                    ?>
               </div>
               
               <form action="" method="post">
                           <input type="hidden" name="truyenid" value="<?php echo $result['id_truyen'] ?>">
                           <button type="submit" name="xoatheodoi" class="btn" style="background-color:#F2E9E9">Bỏ Theo Dõi</button>
                       </form>
               </div>
               </li>
               <?php
            }
        }
        ?>
       </div>
       <?php
    } else {
        ?>
       <h2>Vui lòng đăng nhập để xem danh sách truyện đang theo dõi</h2>
    <?php
    }
?>

    </section>
</div>



<?php 
include '../inc/footer.php';
?>