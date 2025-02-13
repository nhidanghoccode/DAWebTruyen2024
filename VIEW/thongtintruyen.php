<?php
    include '../inc/header.php';
?>

<?php
if(!isset($_GET['truyenid']) || $_GET['truyenid']==NULL){
    echo "<script>window.location =''</script>";
}else{
    $id = $_GET['truyenid'];
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['theodoi'])){
    $id_truyen = $_GET['truyenid'];
    $id_nguoidung = $_SESSION['id_nguoidung'];
    if(isset($id_truyen) && isset($id_nguoidung)){
        $data = array(
            'id_theodoi' => $id_truyen,
            'id_nguoidung' => $id_nguoidung
        );
        $themtheodoi = $td->themtheodoi($data);
    } else {
        echo "<script>alert('Đăng Nhập để theo dõi truyện nhé!');</script>";

    }
}
?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['thich'])) {
    if (isset($_SESSION['id_nguoidung'])) {
        $id_nguoidung = $_SESSION['id_nguoidung'];
        $id_truyen = $_GET['truyenid'];

        $result = $tr->luotthich($id_truyen);

        if ($result) {
            echo "<span class='text-success'>Like thành công</span>";
        } else {
            echo "<span>'Đã xảy ra lỗi. Vui lòng thử lại sau!')</span>";
        }
    } else {
        echo "<script>alert('Vui lòng đăng nhập để thích truyện!');</script>";
    }
}
?>
<?php
if(isset($_GET['truyenid'])) {
    $id_truyen = $_GET['truyenid'];
    $result = $tr->luotxem($id_truyen);
    if($result) {
        
    } else {
        echo "Đã xảy ra lỗi. Vui lòng thử lại sau!";
    }
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitRating'])) {
    if (isset($_SESSION['id_nguoidung'])) {
        $id_nguoidung = $_SESSION['id_nguoidung'];
        $id_truyen = $_GET['truyenid'];
        $danhgia = $_POST['rating'];

        // Kiểm tra xem người dùng đã đánh giá truyện này chưa
        $kiemtraDanhGia = $tr->kiemtraDanhGia($id_truyen, $id_nguoidung);
        if ($kiemtraDanhGia) {
            // Nếu đã đánh giá, cập nhật đánh giá
            $capnhatDanhGia = $tr->capnhatDanhGia($id_truyen, $id_nguoidung, $danhgia);
            if ($capnhatDanhGia) {
                echo "<script>alert('Cập nhật đánh giá thành công!');</script>";
            } else {
                echo "<script>alert('Đã xảy ra lỗi. Vui lòng thử lại sau!');</script>";
            }
        } else {
            // Nếu chưa đánh giá, thêm đánh giá mới
            $themDanhGia = $tr->themDanhGia($id_truyen, $id_nguoidung, $danhgia);
            if ($themDanhGia) {
                echo "<script>alert('Đánh giá của bạn đã được thêm thành công!');</script>";
            } else {
                echo "<script>alert('Đã xảy ra lỗi. Vui lòng thử lại sau!');</script>";
            }
        }
    } else {
        echo "<script>alert('Vui lòng đăng nhập để đánh giá truyện!');</script>";
    }
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['suabinhluan'])) {
    $id_binhluan = $_POST['comment_id'];
    $noidung = $_POST['new_content'];
    
    $result = $ngd->sua_binhluan($id_binhluan, $noidung);
    
    if ($result) {
        echo "<script>alert('Bình luận đã được cập nhật!');</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra khi cập nhật bình luận!');</script>";
    }
    
    echo "<script>window.location = 'thongtintruyen.php?truyenid=".$_POST['truyenid']."';</script>";
}
?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['xoabinhluan'])) {
    $id_binhluan = $_POST['comment_id'];
    
    $result = $ngd->xoa_binhluan($id_binhluan);
    
    if ($result) {
        echo "<script>alert('Bình luận đã được xóa!');</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra khi xóa bình luận!');</script>";
    }
    
    echo "<script>window.location = 'thongtintruyen.php?truyenid=".$_POST['truyenid']."';</script>";
}
?>
<?php
if(isset($_GET['id_chuong'])) {
    $idchuong = $_GET['id_chuong'];
}
?>
<?php
            $get_thongtintruyen = $tr->getthongtin($id);
            if($get_thongtintruyen){
                while($result_thongtin = $get_thongtintruyen->fetch_assoc()){
            ?>
<div class="container main" style="min-height: 300px;">
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $result_thongtin['tentruyen'] ?></li>
    </ol>
</nav>
        <div class="main container-fluid">
            <div class="card mb-3" style="max-width: 1000px;">
                <div class="row g-0">
                <div class="col-md-4">
                    <img src="../ADMIN/upload/<?php echo $result_thongtin['biatruyen'] ?>" class="img-fluid rounded-start" alt="Lại Gặp Được Em">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title"><?php echo $result_thongtin['tentruyen'] ?></h5>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><i class="fa-solid fa-user"></i>Tác Giả</td>
                            <td><?php echo $result_thongtin['tacgia'] ?></td>
                        </tr>
                        <tr>
                        <tr>
                            <td><i class="fa-solid fa-thumbs-up"></i>Lượt thích</td>
                            <td><?php echo $result_thongtin['luotthich']; ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-eye"></i>Lượt Xem</td>
                            <td><?php echo $result_thongtin['luotxem']; ?></td>
                        </tr>
                        <tr>
                        <div class="rating-container">
                        <?php
                            // Lấy đánh giá hiện tại của người dùng
                            $danhGiaHienTai = 0;
                            if (isset($_SESSION['id_nguoidung'])) {
                                $id_nguoidung = $_SESSION['id_nguoidung'];
                                $danhGiaHienTai = $tr->layDanhGiaHienTai($id, $id_nguoidung);
                            }
                        ?>
                        <td><i class="fa-solid fa-star"></i>Đánh Giá</td>
                        <td>
                        <form action="" method="post" class="rating-form">
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5" <?php if($danhGiaHienTai == 5) echo 'checked'; ?>><label for="star5" title="Rất tốt"></label>
                            <input type="radio" id="star4" name="rating" value="4" <?php if($danhGiaHienTai == 4) echo 'checked'; ?>><label for="star4" title="Tốt"></label>
                            <input type="radio" id="star3" name="rating" value="3" <?php if($danhGiaHienTai == 3) echo 'checked'; ?>><label for="star3" title="Bình thường"></label>
                            <input type="radio" id="star2" name="rating" value="2" <?php if($danhGiaHienTai == 2) echo 'checked'; ?>><label for="star2" title="Không tốt"></label>
                            <input type="radio" id="star1" name="rating" value="1" <?php if($danhGiaHienTai == 1) echo 'checked'; ?>><label for="star1" title="Rất không tốt"></label>
                        </div>
                            <input type="submit" name="submitRating" value="Đánh Giá" class="btn btn-primary">
                        </form>
                        </td>
                        </tr>
                        </tbody>
                        
                    </div>

                    </table>
                        <button type="button" class="btn btn-outline-primary"><?php echo $result_thongtin['tenloai'] ?></button>
                        <!-- <button type="button" class="btn btn-outline-danger">Ngôn Tình</button> -->
                        <button type="button" class="btn btn-outline-warning"><?php echo $result_thongtin['tentheloai'] ?></button>
                        <br>
                        <hr>
                        <?php
                            // Lấy ID của chương đầu tiên của truyện
                            $first_chapter = $ch->laychuongdau($id);
                            if($first_chapter) {
                                $row = $first_chapter->fetch_assoc();
                                $first_chapter_id = $row['id_chuong'];
                            }
                        ?>
                        <form action="" method="post">
                        <button type="button" class="btn btn-success"><i class="fa-solid fa-book"></i>
                        <a href="trangdoc.php?truyenid=<?php echo $id ?>&idchuong=<?php echo $first_chapter_id ?>" style="color: #fff;">Đọc Từ Đầu</a>
                        </button>

                        <button type="submit" name="theodoi" class="btn btn-danger"><i class="fa-solid fa-heart"></i> Theo Dõi</button>
                        <button type="submit" name="thich" class="btn btn-warning" id="likeButton"><i class="fa-regular fa-thumbs-up"></i> Thích</button>
                        </form>
                        <?php
                            if(isset($themtheodoi)){
                                // echo "<script type='text/javascript'>alert('Truyện đã theo dõi');</s>";
                                echo $themtheodoi;
                            }
                        ?>
                    </div>
                </div>
                </div>
                <hr>
                <h5 style="margin-left:15px;">Giới Thiệu</h5>
                <style>
                    .mota{
                        margin-left:15px;
                        margin-right:15px;
                        background-color:#D8BFD8;
                        padding-left: 20px;
                    }
                </style>
                <div class="mota">
                <p class="card-text"><?php echo $result_thongtin['mota'] ?></p>
                </div>
                <hr>
                <h5 style="margin-left:15px;">Danh Sách Chap</h5>
                <div class="list_chapter">
                    <div class="overflow-auto">
                        <div class="works-chapter-list">
                            <?php
                            $list_chuong = $ch->show_chuong($id);
                            if($list_chuong && $list_chuong->num_rows > 0){
                                while($chuong = $list_chuong->fetch_assoc()){
                                    $chapter_id = $chuong['id_chuong'];
                                    $chapter_number = $chuong['chapter'];
                                    $chapter_name = $chuong['tenchuong'];
                                    $chapter_date = $chuong['ngaydang'];
                            ?>
                            <div class="works-chapter-item">
                            <div class="col-md-4 col-sm-4 col-xs-4 name-chap">
                                    <a target="_self" class="" href="trangdoc.php?truyenid=<?php echo $id ?>&idchuong=<?php echo $chapter_id ?>"><?php echo $chapter_number ?></a>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4 name-chap"><?php echo $chapter_name ?></div>
                            <div class="col-md-2 col-sm-24col-xs-2 time-chap"><?php echo $chapter_date ?></div>
                            </div>
                            <?php
                                }
                            } else {
                                echo "Không có chương nào được tìm thấy.";
                            }
                            ?>
                        </div>
                    </div>
                </div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['binhluansubmit'])) {
    if (isset($_SESSION['id_nguoidung'])) {
        $idnguoidung = $_SESSION['id_nguoidung'];
        $noidung = $_POST['binhluantxt'];
        $data = array(
            'id_nguoidung' => $idnguoidung,
            'id_truyen' => $id,
            'noidung' => $noidung
        );

        $them_binhluan = $ngd->them_binhluan($data, $id, $idchuong,$idnguoidung);

        if ($them_binhluan) {
            echo "<script>alert('Bình luận của bạn đã được thêm thành công!');</script>";
            echo "<script>window.location = window.location.href;</script>";
        } else {
            echo "<script>alert('Đã xảy ra lỗi khi thêm bình luận. Vui lòng thử lại sau!');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng đăng nhập để bình luận!');</script>";
    }
}

$list_comments = $ngd->lay_danh_sach_binhluantruyen($id); 
?>

<div class="binhluan-container">
    <h2>Bình Luận</h2>
    <form action="" method="post">
        <?php foreach ($list_comments as $comment): ?>
            <div class="binhluan">
                <div class="avatar">
                    <img src="../img/<?php echo $comment['avatar']; ?>" alt="Avatar">
                </div>
                
                <div class="binhluan-content">
                    <div class="tenuser"><?php echo $comment['ten_nguoidung']; ?></div>
                    <div class="date"><?php echo $comment['thoigian']; ?></div>
                    <div class="content"><?php echo $comment['noidung']; ?></div>
                    
                    <?php if (isset($_SESSION['id_nguoidung']) && $_SESSION['id_nguoidung'] == $comment['id_nguoidung']): ?>
                    <button type="button" class="edit-btn hovercmt" onclick="showEditForm('<?php echo $comment['id_binhluan']; ?>')" alt="Sửa">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id_binhluan']; ?>">
                        <input type="hidden" name="truyenid" value="<?php echo $id; ?>">
                        <button type="submit" class="hovercmt" name="xoabinhluan" class="delete-btn" alt="Xóa">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                <?php endif; ?>

                </div>
                
                <div class="edit-form" id="edit-form-<?php echo $comment['id_binhluan']; ?>" style="display:none;">
                    <form action="" method="post">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id_binhluan']; ?>">
                        <input type="hidden" name="truyenid" value="<?php echo $id; ?>">
                        <textarea name="new_content"><?php echo $comment['noidung']; ?></textarea><br>
                        <input type="submit" name="suabinhluan" value="Cập nhật">
                        <button type="button" onclick="hideEditForm('<?php echo $comment['id_binhluan']; ?>')">Hủy</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="binhluan-form">
            <textarea name="binhluantxt" placeholder="Nhập bình luận của bạn"></textarea><br>
            <input type="submit" name="binhluansubmit" value="Gửi Bình Luận">
        </div>
    </form>
</div>

<script>
function showEditForm(commentId) {
    document.getElementById('edit-form-' + commentId).style.display = 'block';
}

function hideEditForm(commentId) {
    document.getElementById('edit-form-' + commentId).style.display = 'none';
}
</script>


            <?php
            }
        }
            ?>
        </div>
    </div>

</div>

<?php 
include '../inc/footer.php';
?>