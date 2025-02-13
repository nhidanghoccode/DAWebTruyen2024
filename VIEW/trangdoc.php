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
    $get_thongtintruyen = $tr->getthongtin($id);
    if($get_thongtintruyen){
        while($result_thongtin = $get_thongtintruyen->fetch_assoc()){
    ?>
    <?php
    $idtruyen = isset($_GET['truyenid']) ? $_GET['truyenid'] : null;
    $idchuong = isset($_GET['idchuong']) ? $_GET['idchuong'] : null;        
    $get_thongtinchuong = $ch->laymotchuong($idtruyen, $idchuong);
    if($get_thongtinchuong){
        while($result_chuong = $get_thongtinchuong->fetch_assoc()){
?>

<?php
    if(isset($_GET['idchuong'])) {
        $id_chuong_hien_tai = $_GET['idchuong'];

        $previousChapter = $ch->laychaptruoc($idtruyen, $id_chuong_hien_tai);
        $nextChapter = $ch->laychapsau($idtruyen, $id_chuong_hien_tai);

        $previousChapterId = $previousChapter ? $previousChapter->fetch_assoc()['id_chuong'] : null;
        $nextChapterId = $nextChapter ? $nextChapter->fetch_assoc()['id_chuong'] : null;
        $hasPreviousChapter = isset($previousChapterId);
        
        $hasNextChapter = isset($nextChapterId);
    }
?>

<body>
	<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
        <li class="breadcrumb-item"><a href="thongtintruyen.php?truyenid=<?php echo $result_thongtin['id_truyen']?>">
            <?php echo $result_thongtin['tentruyen'] ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo  $result_chuong['tenchuong']?></li>
    </ol>
</nav>
		<div class="main container-fluid">

			<div class="card mb-2">
				<h3 class="tenchuong"><?php echo  $result_chuong['tenchuong']?> - <?php echo $result_chuong['chapter'] ?></h3>
				<div class="headerchap">
					<div class="chonchap">
						<button type="button" style="background-color:#FFEFD5;" class="btn btnchonchap btnChapter">Chapter</button>
					</div>
					<div class="chuyenchap">

                    <button type="button" <?php if(!$hasPreviousChapter) echo 'disabled'; ?> onclick="window.location.href='trangdoc.php?truyenid=<?php echo $idtruyen; ?>&idchuong=<?php echo $previousChapterId; ?>'" style="background-color:#FFDAB9;" class="btn btn_chapter">
                    <i class="fa-solid fa-arrow-left"></i> Chap Trước
                    </button>
                    <button type="button" <?php if(!$hasNextChapter) echo 'disabled'; ?> onclick="window.location.href='trangdoc.php?truyenid=<?php echo $idtruyen; ?>&idchuong=<?php echo $nextChapterId; ?>'" style="background-color:#FFDAB9;" class="btn btn_chapter">
                    Chap Sau <i class="fa-solid fa-arrow-right"></i>
                    </button>

					</div>
				</div>
			</div>
			<div class="noidungtruyen chapter-content" id="noidungtruyen_<?php echo $idchuong; ?>"style="background-color: #f2e4f2; min_width:950px;">
					<?php 
						echo $result_chuong['noidung'];
					?>
			</div>

			<div class="card mb-3">
				<div class="headerchap">
					<div class="chuyenchap">
						<button type="button" <?php if(!$hasPreviousChapter) echo 'disabled'; ?> onclick="window.location.href='trangdoc.php?truyenid=<?php echo $idtruyen; ?>&idchuong=<?php echo $previousChapterId; ?>'" style="background-color:#FFDAB9;" class="btn btn_chapter">
                        <i class="fa-solid fa-arrow-left"></i> Chap Trước
                        </button>
                        <button type="button" <?php if(!$hasNextChapter) echo 'disabled'; ?> onclick="window.location.href='trangdoc.php?truyenid=<?php echo $idtruyen; ?>&idchuong=<?php echo $nextChapterId; ?>'" style="background-color:#FFDAB9;" class="btn btn_chapter">
                        Chap Sau <i class="fa-solid fa-arrow-right"></i>
                        </button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="chapcodinh">
	<button type="button" <?php if(!$hasPreviousChapter) echo 'disabled'; ?> onclick="window.location.href='trangdoc.php?truyenid=<?php echo $idtruyen; ?>&idchuong=<?php echo $previousChapterId; ?>'" style="background-color:#FFDAB9;" class="btn btn_chapter">
    <i class="fa-solid fa-arrow-left"></i> Chap Trước
    </button>&ensp;
	<button type="button" style="background-color:#FFEFD5;" class="btn btn_chapter btnChapter">Chapter</button> &ensp;
	<button type="button" <?php if(!$hasNextChapter) echo 'disabled'; ?> onclick="window.location.href='trangdoc.php?truyenid=<?php echo $idtruyen; ?>&idchuong=<?php echo $nextChapterId; ?>'" style="background-color:#FFDAB9;" class="btn btn_chapter">
    Chap Sau <i class="fa-solid fa-arrow-right"></i>
    </button>
	</div>

	<div class="form-chapter " id="formChapter" style="display: none;">
		<button class="close-btn" id="closeBtn"><i class="fa-solid fa-circle-xmark"></i></button>
		<h4>Danh sách Chapter</h4>
		<div class="dschapter overflow-auto">
		<ul>
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
                            <div class="works-chapter-item"style="display:block; text-align:center;">
                            <div class="name-chap">
                                    <a href="trangdoc.php?truyenid=<?php echo $id ?>&idchuong=<?php echo $chapter_id ?>"><?php echo $chapter_number ?></a>
                            </div>
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
		</ul>
		</div>
	</div>
<?php
                }
            }
        }
    }

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['binhluansubmit'])) {
    if (isset($_SESSION['id_nguoidung'])) {
        $idnguoidung = $_SESSION['id_nguoidung'];
        $noidung = $_POST['binhluantxt'];
        $data = array(
            'id' => $idnguoidung,
            'id_truyen' => $id,
            'noidung' => $noidung
        );
        $them_binhluan = $ngd->them_binhluan($data,$id, $idchuong,$idnguoidung);

        if ($them_binhluan) {
            echo "<script>window.location = window.location.href;</script>";
        } else {
            echo "<script>alert('Đã xảy ra lỗi khi thêm bình luận. Vui lòng thử lại sau!');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng đăng nhập để bình luận!');</script>";

    }
}


$list_comments = $ngd->lay_danh_sach_binhluanchuong($idchuong); 
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
    
    echo "<script>window.location = window.location.href;</script>";
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
    
    echo "<script>window.location = window.location.href;</script>";

}
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
                    
                    <?php if ($_SESSION['id_nguoidung'] == $comment['id_nguoidung']): ?>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var nutChapters = document.querySelectorAll('.btnChapter');
    var formChapter = document.getElementById('formChapter');
    var nutDong = document.getElementById('closeBtn');

    nutChapters.forEach(function(nutChapter) {
        nutChapter.addEventListener('click', function () {
            if (formChapter.style.display === 'block') {
                formChapter.style.display = 'none';
            } else {
                formChapter.style.display = 'block';
            }
        });
    });

    nutDong.addEventListener('click', function () {
        formChapter.style.display = 'none';
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var urlParams = new URLSearchParams(window.location.search);
    var idchuong = urlParams.get('idchuong');

    if (idchuong) {
        var tentruyen = document.querySelector('.tentruyen').innerText;
        var tenchuong = document.querySelector('.tenchuong').innerText;
        document.querySelector('.tentruyen').innerText = tentruyen;
        document.querySelector('.tenchuong').innerText = tenchuong;

        const allContents = document.querySelectorAll('.chapter-content');
        allContents.forEach(function(content) {
            content.style.display = 'none';
        });

        const selectedContent = document.querySelector('#noidungtruyen_' + idchuong);
        if (selectedContent) {
            selectedContent.style.display = 'block';
        }
    }
});

document.querySelectorAll('.chapter').forEach(function(chapter) {
    chapter.addEventListener('click', function(event) {
        event.preventDefault(); 
        var idchuong = this.getAttribute('href').split('=')[1];
        
        var urlParams = new URLSearchParams(window.location.search);
        urlParams.set('id_chuong', idchuong);
        var newUrl = window.location.pathname + '?' + urlParams.toString();
        window.history.pushState({}, '', newUrl);
        
        var tentruyen = this.parentElement.parentElement.parentElement.querySelector('.tentruyen').innerText;
        var tenchuong = this.innerText;
        document.querySelector('.tentruyen').innerText = tentruyen;
        document.querySelector('.tenchuong').innerText = tenchuong;

        const allContents = document.querySelectorAll('.chapter-content');
        allContents.forEach(function(content) {
            content.style.display = 'none';
        });

        const selectedContent = document.querySelector('#noidungtruyen_' + idchuong);
        if (selectedContent) {
            selectedContent.style.display = 'block';
        }
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var nutChapters = document.querySelectorAll('.btnChapter');
    var formChapter = document.getElementById('formChapter');
    var nutDong = document.getElementById('closeBtn');

    nutChapters.forEach(function(nutChapter) {
        nutChapter.addEventListener('click', function () {
            formChapter.style.display = 'block';
            document.body.classList.add('form-chapter-open');
        });
    });

    nutDong.addEventListener('click', function () {
        formChapter.style.display = 'none';
        document.body.classList.remove('form-chapter-open');
    });
});

</script>
</body>

<?php 
include '../inc/footer.php';
?>