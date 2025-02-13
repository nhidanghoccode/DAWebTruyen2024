<?php
include '../inc/header.php';
include '../inc/danhmuc.php';
?>
    <div class="div_suggest_list" style="display: flex; flex-wrap: wrap;">
    <?php
    $keyword = $_GET['keyword']; 
    $timkiem =$tr-> timkiemtruyen($keyword);
    if ($timkiem) {
        while ($result = $timkiem->fetch_assoc()) {
            ?>
        <div class="card mb-3 dstruyen" style="width: 260px; margin: 5px; background-color:#ecefeb;">
            <div class="row g-0">
                <div class="col-md-6 book-avatar">
                <a href="thongtintruyen.php?truyenid=<?php echo $result['id_truyen']?>">
                <img src="../ADMIN/upload/<?php echo $result['biatruyen'] ?>" alt="<?php echo $result['tentruyen'] ?>" style="width: 120px;">
                </a>    
            </div>
            <div class="col-md-6" style="padding: 0% 4% 15% 0%; ">
                <div class="card-body" style="max-width: 160px; padding:15% 0% 0% 0%;">
                    <h6 class="card-title" style="color: #AF4A4A;"><?php echo $result['tentruyen'] ?></h6>
                    <p class="card-text"><?php echo $result['tacgia'] ?></p>
                    <?php
                    $chuongcuoi = $ch->laychuongcuoi($result['id_truyen']);
                    if($chuongcuoi){
                        $result_chuongcuoi = $chuongcuoi->fetch_assoc();
                    ?>
                    <div class="last-chapter">
                    <p class="card-text"><small class="text-body-secondary">Last chapter:
                        <a href="trangdoc.php?truyenid=<?php echo $result['id_truyen'] ?>&idchuong=<?php echo $result_chuongcuoi['id_chuong'] ?>">
                        <?php echo $result_chuongcuoi['chapter'] ?></a>
                    </small></p>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    } else {
        echo "Không tìm thấy kết quả phù hợp";
    }

    ?>
        </div>
    </div>
</div>
    

<?php 
include '../inc/footer.php';
?>