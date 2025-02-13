<?php
include '../inc/header.php';

if (!isset($_GET['id_truyen']) || $_GET['id_truyen'] == NULL) {
    echo "<script>window.location ='dschuong.php'</script>";
}
$id = $_GET['id_truyen'];

if (isset($_GET['xoaid'])) {
    $id_chuong = $_GET['xoaid'];
    $id_truyen = $ch->layidtruyentheoidchuong($id_chuong); 
    $xoaid = $ch->xoa_chuong($id_chuong);
    if ($id_truyen) {
        header("Location: dschuong.php?id_truyen=$id_truyen"); 
        exit;
    } else {
        echo "Không thể xóa chương!";
    }
}
?>
<div class="div_suggest_list">
  <div class="container main main-content" style="min-height: 300px;">
    <h4>Danh Sách Chương</h4>
    <?php
    $lay_truyen_theo_id = $ch->laytruyentheoid($id);
    if ($lay_truyen_theo_id) {
        $row = $lay_truyen_theo_id->fetch_assoc();
        $tentruyen = $row['tentruyen'];
    ?>
        <h3 style="color: blueviolet;"><?php echo $tentruyen; ?></h3>
    <?php } ?>
<style>
    .buttonthem {
    color: white; /* Màu chữ trắng */
    text-decoration: none; /* Không có gạch chân */
    }

    .buttonthem:hover {
    text-decoration: none; 
    color:tomato;
    }
</style>
    <button type="button" class="btn btn-success"><a class="buttonthem" href="themchuong.php?id_truyen=<?php echo $id; ?>">Thêm Chương Mới</a></button><br>
    <?php
    if (isset($xoaid)) {
        echo $xoaid;
    }
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Chapter</th>
                <th scope="col">Tên Chương</th>
                <th scope="col">Nội Dung</th>
                <th scope="col">Ngày Đăng</th>
                <th scope="col">Chỉnh sửa</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            $show_chuong = $ch->show_chuong($id);
            if ($show_chuong) {
                $i = 0;
                while ($result = $show_chuong->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['chapter'] ?></td>
                        <td><?php echo $result['tenchuong'] ?></td>
                        <td><?php echo $fm->textShorten($result['noidung'], 20) ?></td>
                        <td><?php echo $result['ngaydang'] ?></td>
                        <td><a href="suachuong.php?id_chuong=<?php echo $result['id_chuong'] ?>" title="Sửa chương"><i class="fa-solid fa-pen-to-square"></i></a>&ensp;
                            <a onclick="return confirm('Bạn có muốn xóa không?')" href="?xoaid=<?php echo $result['id_chuong'] ?>" title="Xóa"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<?php
    include '../inc/footer.php';
?>
