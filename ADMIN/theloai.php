<?php include '../ADMIN/header.php';?>
<?php 
include '../classes/theloaiadmin.php';
include_once '../classes/loaitruyenadmin.php';

$tl = new theloaiadmin();
$ltruyen = new loaitruyenadmin();

if(isset($_GET['xoaid'])){
    $id = $_GET['xoaid'];
    $xoaid = $tl->xoa_theloai($id);
}
?>

<div id="contentDiv" class="main-content">
    <h4>Quản lý thể loại</h4>
    <button type="button" class="btn btn-success" ><a href="themtheloai.php">Thêm Thể Loại</a></button><br>
    <?php if(isset($xoaid)) echo $xoaid; ?>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Loại truyện</th>
                <th scope="col">Thể loại</th>
                <th scope="col">Chỉnh sửa</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                $dsloai = $ltruyen->show_loai();
                if($dsloai){
                    $i = 0;
                    while($result_loai = $dsloai->fetch_assoc()){
                        $show_tl = $tl->show_theloaibyloai($result_loai['id_loai']);
                        if($show_tl){
                            while($result = $show_tl->fetch_assoc()){
                                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $result_loai['tenloai'] ?></td>
                <td><?php echo $result['tentheloai'] ?></td>
                <td>
                    <a href="suatheloai.php?id_theloai=<?php echo $result['id_theloai'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>&ensp;
                    <a onclick="return confirm('Bạn có muốn xóa không?')" href="?xoaid=<?php echo $result['id_theloai'] ?>"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php
                            }
                        }
                    }
                }
            ?>
        </tbody>
    </table>
</div>
<script src="admin.js"> </script>
