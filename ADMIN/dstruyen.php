<?php
// use function PHPSTORM_META\type;
 include '../ADMIN/header.php';?>
<?php 
      include '../classes/truyenadmin.php';
      include_once '../helper/format.php';
?>
<?php
  $tr = new truyenadmin();
  $fm = new Format();
  if(isset($_GET['xoaid'])){
    $id = $_GET['xoaid'];
    $xoaid = $tr->xoa_truyen($id);
  }
?>

  <div id="contentDiv" class="main-content">
      <h4>Danh Sách Truyện</h4>
      <button type="button" class="btn btn-success" ><a href="themtruyen.php">Thêm Truyện Mới</a></button><br>
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
              <th scope="col">Kiểu</th>
              <!-- <th scope="col">Số Chương</th> -->
              <th scope="col">Trạng Thái</th>
              <th scope="col">Mô Tả</th>
              <th scope="col">Chỉnh sửa</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
            $show_truyen = $tr->show_truyen();
            if($show_truyen){
              $i = 0;
              while($result = $show_truyen->fetch_assoc()){
                $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $result['tentruyen'] ?></td>
              <td><img src="upload/<?php echo $result['biatruyen']?>" width="50px"></td>
              <td><?php echo $result['tenloai'] ?></td>
              <td><?php echo $result['tentheloai'] ?></td>
              <td><?php echo $result['tacgia'] ?></td>
              <td>
                <?php
                if($result['kieu']==0){
                  echo 'Không Nổi bật';
                }else{
                  echo 'Nổi bật';
                }
                ?>
               </td>
              <td><?php
                if($result['trangthai']==0){
                  echo 'Đang Cập Nhật';
                }else{
                  echo 'Hoàn Thành';
                }
               ?>
              </td>
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
  </div>
  <script src="admin.js"> </script>