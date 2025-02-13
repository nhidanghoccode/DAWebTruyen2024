<?php
    include '../inc/header.php';
?>
<style>
    .navtruyen:hover{
        background-color: #CCFFFF;
        transition: background-color 0.3s ease;
    }
</style>
<?php
include 'tbsukien.php';
include '../inc/danhmuc.php';
?>
<nav class="navbar navbar-expand-lg navbar-light"  style="background-color:#e6eef7; height:50px">
    <a class="navbar-brand" href="#">Web Truyện</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link navtruyen" href="truyenhot.php" style="color: #f95cd7;">Truyện Hot</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navtruyen" href="truyenmoi.php" style="color: #f95cd7;">Truyện Mới</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navtruyen" href="truyentranh.php" style="color: #f95cd7;">Truyện Tranh</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navtruyen" href="truyenchu.php" style="color: #f95cd7;">Truyện Chữ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navtruyen" href="alltruyen.php" style="color: #f95cd7;">Tất Cả Truyện</a>
            </li>
        </ul>
    </div>
</nav>
<div class="typing-text">
    <h3>Welcome to Web Truyện DREAM DOODLE!</h3>
</div>

    <div class="container main" style="width:100%; min-height: 300px; display:flex; padding:0px;">
        <div class="left-panel">
            <div class="heading">
            <a href="truyenhot.php">Truyện Hot</a>
            </div>
            <div id="div_suggest">
                <ul class="list_grid grid" id="list_suggest">
                <?php
                    $truyen_noibat = $tr->gettruyen_noibat();
                    if($truyen_noibat){
                        while($result = $truyen_noibat->fetch_assoc()){
                ?>
                    <li class="book-item">
                        <div class="book-avatar">
                            <a href="thongtintruyen.php?truyenid=<?php echo $result['id_truyen']?>">
                                <img src="../ADMIN/upload/<?php echo $result['biatruyen'] ?>" alt="<?php echo $result['tentruyen'] ?>">
                            </a>
                        </div>
            <div class="book-info">
            <div class="book-name">
                <h6 itemprop="name"><?php echo $fm->textShorten($result['tentruyen'], 22) ?></h6>
            </div>
            <div class="book-rating">
                <?php
                $danhGia = $tr->layDanhGia($result['id_truyen']);
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $danhGia) {
                        echo '<span class="fa fa-star checked"></span>';
                    } else {
                        echo '<span class="fa fa-star"></span>';
                    }
                }
                ?>
                </div>
                <div class="book-review">
                    <p><?php //echo $tr->layNhanXet($result['id_truyen']); ?></p>
                </div>
                <?php
                // Lấy chương cuối cùng của truyện
                $chuongcuoi = $ch->laychuongcuoi($result['id_truyen']);
                if($chuongcuoi){
                    $result_chuongcuoi = $chuongcuoi->fetch_assoc();
                ?>
                <div class="last-chapter">
                    <a href="trangdoc.php?truyenid=<?php echo $result['id_truyen'] ?>&idchuong=<?php echo $result_chuongcuoi['id_chuong'] ?>"><?php echo $result_chuongcuoi['chapter'] ?></a>
                </div>
                    <?php
                    }
                    ?>
                </div>
                </li>
                <?php
                    }
                    }
                ?>
            </ul>
            </div>
          <div class="heading">
          <a href="truyenmoi.php">Truyện Mới</a>
          </div>
            <div id="div_suggest">
                <ul class="list_grid grid" id="list_suggest">
                <?php
                    $truyen_moi = $tr->gettruyen_truyenmoi();
                    if($truyen_moi){
                        while($result = $truyen_moi->fetch_assoc()){
                ?>
                    <li class="book-item">
                        <div class="book-avatar">
                            <a href="thongtintruyen.php?truyenid=<?php echo $result['id_truyen']?>">
                                <img src="../ADMIN/upload/<?php echo $result['biatruyen'] ?>" alt="<?php echo $result['tentruyen'] ?>">
                            </a>
                        </div>
                        <div class="book-info">
                            <div class="book-name">
                                <h6 itemprop="name"><?php echo $fm->textShorten($result['tentruyen'], 22) ?></h6>
                            </div>
                            <div class="book-rating">
                            <?php
                            $danhGia = $tr->layDanhGia($result['id_truyen']);
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $danhGia) {
                                    echo '<span class="fa fa-star checked"></span>';
                                } else {
                                    echo '<span class="fa fa-star"></span>';
                                }
                            }
                            ?>
                            </div>
                            <?php
                            // Lấy chương cuối cùng của truyện
                            $chuongcuoi = $ch->laychuongcuoi($result['id_truyen']);
                            if($chuongcuoi){
                                $result_chuongcuoi = $chuongcuoi->fetch_assoc();
                            ?>
                            <div class="last-chapter">
                            <a href="trangdoc.php?truyenid=<?php echo $result['id_truyen'] ?>&idchuong=<?php echo $result_chuongcuoi['id_chuong'] ?>"><?php echo $result_chuongcuoi['chapter'] ?></a>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                    </li>
                    <?php
                        }
                      }
                ?>
                </ul>
            </div>
        
            <div class="heading">
              <a href="truyentranh.php">Truyện Tranh</a>
            </div>
            <div id="div_suggest">
                <ul class="list_grid grid" id="list_suggest">
                <?php
                    $truyen_tranh = $tr->gettruyen_truyentranh();
                    if($truyen_tranh){
                        while($result = $truyen_tranh->fetch_assoc()){
                ?>
                    <li class="book-item">
                        <div class="book-avatar">
                            <a href="thongtintruyen.php?truyenid=<?php echo $result['id_truyen']?>">
                                <img src="../ADMIN/upload/<?php echo $result['biatruyen'] ?>" alt="<?php echo $result['tentruyen'] ?>">
                            </a>
                        </div>
                        <div class="book-info">
                            <div class="book-name">
                                <h6 itemprop="name"><?php echo $fm->textShorten($result['tentruyen'], 22) ?></h6>
                            </div>
                            <div class="book-rating">
                        <?php
                        $danhGia = $tr->layDanhGia($result['id_truyen']);
                        for ($i = 0; $i < 5; $i++) {
                            if ($i < $danhGia) {
                                echo '<span class="fa fa-star checked"></span>';
                            } else {
                                echo '<span class="fa fa-star"></span>';
                            }
                        }
                        ?>
                        </div>
                            <?php
                            // Lấy chương cuối cùng của truyện
                            $chuongcuoi = $ch->laychuongcuoi($result['id_truyen']);
                            if($chuongcuoi){
                                $result_chuongcuoi = $chuongcuoi->fetch_assoc();
                            ?>
                            <div class="last-chapter">
                            <a href="trangdoc.php?truyenid=<?php echo $result['id_truyen'] ?>&idchuong=<?php echo $result_chuongcuoi['id_chuong'] ?>"><?php echo $result_chuongcuoi['chapter'] ?></a>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                    </li>
                    <?php
                        }
                      }
                ?>
                </ul>
            </div>
            <div class="heading">
                <a href="truyenchu.php">Truyện Chữ</a>
            </div>
            <div id="div_suggest">
                <ul class="list_grid grid" id="list_suggest">
                <?php
                    $truyen_chu = $tr->gettruyen_truyenchu();
                    if($truyen_chu){
                        while($result = $truyen_chu->fetch_assoc()){
                ?>
                    <li class="book-item">
                        <div class="book-avatar">
                            <a href="thongtintruyen.php?truyenid=<?php echo $result['id_truyen']?>">
                                <img src="../ADMIN/upload/<?php echo $result['biatruyen'] ?>" alt="<?php echo $result['tentruyen'] ?>">
                            </a>
                        </div>
                        <div class="book-info">
                            <div class="book-name">
                                <h6 itemprop="name"><?php echo $fm->textShorten($result['tentruyen'], 22) ?></h6>
                            </div>
                            <div class="book-rating">
                            <?php
                            $danhGia = $tr->layDanhGia($result['id_truyen']);
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $danhGia) {
                                    echo '<span class="fa fa-star checked"></span>';
                                } else {
                                    echo '<span class="fa fa-star"></span>';
                                }
                            }
                            ?>
                            </div>
                            <?php
                            // Lấy chương cuối cùng của truyện
                            $chuongcuoi = $ch->laychuongcuoi($result['id_truyen']);
                            if($chuongcuoi){
                                $result_chuongcuoi = $chuongcuoi->fetch_assoc();
                            ?>
                            <div class="last-chapter">
                                <a href="trangdoc.php?truyenid=<?php echo $result['id_truyen'] ?>&idchuong=<?php echo $result_chuongcuoi['id_chuong'] ?>"><?php echo $result_chuongcuoi['chapter'] ?></a>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                    </li>
                    <?php
                        }
                      }
                ?>
                </ul>
            </div>
        </div>
        <style>
            .right-panel {
        padding: 20px;
    }

    .category-container {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .category-grid {
        display: flex;
        flex-direction: column; /* Đảm bảo các khối xếp chồng lên nhau */
        gap: 20px; /* Khoảng cách giữa các khối */
    }

    .category-block {
        background: #ffffff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .category-title {
        font-weight: 700;
        color: #dc3545;
        margin-bottom: 10px;
    }

    .subcategory-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .subcategory-list li {
        margin-bottom: 5px;
    }

    .subcategory-list li a {
        text-decoration: none;
        color: #007bff;
        transition: color 0.3s;
    }

    .subcategory-list li a:hover {
        color: #0056b3;
    }
</style>

        </style>
        <div class="right-panel">
            <div class="category-container">
                <h6>Thể loại truyện</h6>
                <div class="category-grid">
                    <?php
                    $ltruyen = new loaitruyenadmin();
                    $tl = new theloaiadmin();

                    // Truy vấn tất cả các loại truyện
                    $get_all_loai = $ltruyen->show_loaitruyen();
                    if ($get_all_loai) {
                        while ($result_loai = $get_all_loai->fetch_assoc()) {
                            echo '<div class="category-block">';
                            echo '<h6 class="category-title">' . $result_loai['tenloai'] . '</h6>';
                            
                            // Truy vấn các thể loại dựa trên id_loai
                            $get_theloai = $tl->show_theloaibyloai($result_loai['id_loai']);
                            if ($get_theloai) {
                                echo '<ul class="subcategory-list">';
                                while ($result_theloai = $get_theloai->fetch_assoc()) {
                                    echo '<li><a href="theloai.php?id=' . $result_theloai['id_theloai'] . '">' . $result_theloai['tentheloai'] . '</a></li>';
                                }
                                echo '</ul>';
                            } else {
                                echo '<p>Không có thể loại nào cho loại truyện này</p>';
                            }
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Không có loại truyện nào</p>';
                    }
                    ?>
                </div>
            </div>
        </div>

        </div>
    </div>
    </div>
</div>
<!-- <script>
    function showBanner() {
        document.getElementById('notificationBanner').style.display = 'block';
    }

    function hideBanner() {
        document.getElementById('notificationBanner').style.display = 'none';
    }

    function checkEventTime() {
        var currentTime = new Date();
        var tgianbatdau = new Date(localStorage.getItem('tgianbatdau'));
        var tgianketthuc = new Date(localStorage.getItem('tgianketthuc'));

        if (tgianbatdau && tgianketthuc && currentTime >= tgianbatdau && currentTime <= tgianketthuc) {
            var eventName = localStorage.getItem('tensukien');
            var eventMessage = "Tham gia " + eventName + " và có cơ hội nhận phần thưởng hấp dẫn!";
            document.getElementById('eventMessage').innerText = eventMessage;
            showBanner();
        }
    }

    window.onload = checkEventTime;
</script> -->

    <?php 
    include '../inc/footer.php';
    ?>