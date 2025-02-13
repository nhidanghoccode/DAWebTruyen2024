<?php
    include '../inc/header.php';
?>
<?php
  if(isset($_GET['xoaid'])){
    $id = $_GET['xoaid'];
    $xoaid = $tr->xoa_truyen($id);
  }
?>
<?php
$id_nguoidung = $_SESSION['id_nguoidung']; // Giả sử user_id là ID của người dùng hiện tại
?>
<div class="div_suggest_list">
  <div class="container main main-content" style="min-height: 300px;">
      <?php
        $show_truyen = $tr->show_truyentunguoidung($id_nguoidung);
        if($show_truyen && $show_truyen->num_rows > 0){
      ?>
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

      <h4>Danh Sách Truyện</h4>
      <button type="button" class="btn btn-success" ><a class="buttonthem" href="dangtruyen.php">Thêm Truyện Mới</a></button><br>
      <?php
            if(isset($xoaid)){
                echo $xoaid;
            }
        ?>
      <table class="table">
          <thead>
            <tr>
              <th scope="col">STT</th>
              <th scope="col">Tên Truyện</th>
              <th scope="col">Bìa Truyện</th>
              <th scope="col">Loại Truyện</th>
              <th scope="col">Thể Loại</th>
              <th scope="col">Tác Giả</th>
              <th scope="col">Mô Tả</th>
              <th scope="col">Chỉnh sửa</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
            $show_truyen = $tr->show_truyentunguoidung($id_nguoidung);
            if($show_truyen){
              $i = 0;
              while($result = $show_truyen->fetch_assoc()){
                $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $result['tentruyen'] ?></td>
              <td><img src="../ADMIN/upload/<?php echo $result['biatruyen']?>" width="50px"></td>
              <td><?php echo $result['tenloai'] ?></td>
              <td><?php echo $result['tentheloai'] ?></td>
              <td><?php echo $result['tacgia'] ?></td>
              <td><?php echo $fm->textShorten($result['mota'],20) ?></td>
              <td><a href="dschuong.php?id_truyen=<?php echo $result['id_truyen'] ?>" title="Thêm Chương"><i class="fa-solid fa-book-medical"></i></a>&ensp;
              <a href="suatruyen.php?id_truyen=<?php echo $result['id_truyen'] ?>"><i class="fa-solid fa-pen-to-square" title="Sửa Truyện"></i></a>&ensp;
              <a onclick="return confirm('Bạn có muốn xóa không?')" href="?xoaid=<?php echo $result['id_truyen'] ?>" title="Xóa"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
            <?php
              }
            }
          
            ?>
          </tbody>
        </table>
        <?php
        } else {
            echo "<h4>Bạn chưa đăng truyện nào</h4>";
        }
        ?>
  </div>
</div>



<?php
    include '../inc/footer.php';
?>