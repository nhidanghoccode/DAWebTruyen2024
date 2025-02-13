<?php
    include '../inc/header.php';
    include '../inc/danhmuc.php';
?>
  <!--Content-->
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Truyện Hot</li>
    </ol>
</nav>
            <div class="div_suggest_list" style="display: flex; flex-wrap: wrap;">
                <?php
                $truyen_noibat = $tr->gettruyen_noibat();
                if($truyen_noibat){
                    while($result = $truyen_noibat->fetch_assoc()){
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
                    }
            ?>
        </div>
    </div>
</div>
    <script src="index.js"></script>

    <?php 
include '../inc/footer.php';
?>