
<?php include '../ADMIN/header.php';?>
<?php include '../classes/loaitruyenadmin.php'?>
<?php
  $ltruyen = new loaitruyenadmin();
  if(isset($_GET['xoaid'])){
    $id = $_GET['xoaid'];
    $xoaid = $ltruyen->xoa_loai($id);
  }
?>

  <div id="contentDiv" class="main-content">
      <h4>Loại Truyện</h4>
      <button type="button" class="btn btn-success" ><a href="themloaitruyen.php">Thêm Loại Truyện</a></button><br>
      <?php
            if(isset($xoaid)){
                echo $xoaid;
            }
        ?>
      <table class="table">
          <thead>
            <tr>
              <th scope="col">STT</th>
              <!-- <th scope="col">Loại truyện</th> -->
              <th scope="col">Tên Loại Truyện</th>
              <th scope="col">Chỉnh sửa</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
            $show_loai = $ltruyen->show_loai();
            if($show_loai){
              $i = 0;
              while($result = $show_loai->fetch_assoc()){
                $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $result['tenloai'] ?></td>
              <td><a href="sualoai.php?id_loai=<?php echo $result['id_loai'] ?>" title="Sửa Loại"><i class="fa-solid fa-pen-to-square"></i></a>&ensp;
              <a onclick="return confirm('Bạn có muốn xóa không?')" href="?xoaid=<?php echo $result['id_loai'] ?>" title="Xóa"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
  </div>
  <script src="admin.js"> </script>