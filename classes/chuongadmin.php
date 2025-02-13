<?php
$filepath =realpath(dirname(__FILE__));
include_once ( $filepath.'/../lib/database.php');
include_once ( $filepath.'/../helper/format.php');
?>

<?php
    class chuongadmin
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function laytruyentheoid($id){
            $query = "Select tentruyen, id_truyen from truyen where id_truyen = $id";
            $result = $this->db->select($query);
            return $result;
        }

        public function laychuongtheoid($id){
            $query = "Select tenchuong, id_chuong, chapter, noidung from chuong where id_chuong = $id";
            $result = $this->db->select($query);
            return $result;
        }

        public function layidtruyentheoidchuong($id_chuong) {
            $query = "SELECT id_truyen FROM chuong WHERE id_chuong = '$id_chuong'";
            $result = $this->db->select($query);
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['id_truyen'];
            } else {
                return false;
            }
        }
        

        public function them_chuong($data,$idtruyen){
            $tenchuong = mysqli_real_escape_string($this->db->link, $data['tenchuong']);
            $chapter = mysqli_real_escape_string($this->db->link, $data['chapter']);
            $noidung = mysqli_real_escape_string($this->db->link, $data['noidung']);
            
            if ($chapter == "" || $tenchuong == "" || $noidung == "") {
                $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO `chuong` (`tenchuong`, `chapter`,`noidung`, `id_truyen`) 
                VALUES ('$tenchuong', '$chapter', '$noidung','$idtruyen')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span> Thêm thành công</span>";
                    return $alert;
                }
                else{
                    $alert = "<span class='error'> Thêm không thành công </span>";
                    return $alert;
                }
            }
        }
    
        public function show_chuong($id){
            $query = "SELECT * from chuong where id_truyen='$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function sua_chuong($data,$id_chuong){
            $tenchuong = mysqli_real_escape_string($this->db->link, $data['tenchuong']);
            $chapter = mysqli_real_escape_string($this->db->link, $data['chapter']);
            $noidung = mysqli_real_escape_string($this->db->link, $data['noidung']);
            
            if ($chapter == "" || $tenchuong == "" || $noidung == "" ) {
                $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống</span>";
                return $alert;
                }else{
                    $query = "UPDATE chuong SET tenchuong = '$tenchuong', chapter = '$chapter', noidung = '$noidung' WHERE id_chuong = $id_chuong";
                    $result = $this->db->update($query);
                    if($result){
                        $alert = "<span> Sửa thành công</span>";
                        return $alert;
                    }
                    else{
                        $alert = "<span class='error'> Sửa không thành công </span>";
                        return $alert;
                    }
                }
        }
        public function xoa_chuong($id){
            $query = "Delete from chuong where id_chuong = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span> Xóa thành công </span>";
                return $alert;
            }
            else{
                $alert = "<span> Xóa không thành công </span>";
                return $alert;
            }
        }
        //view
        public function laymotchuong($idtruyen, $idchuong) {
            $query = "SELECT * FROM chuong WHERE id_truyen = $idtruyen AND id_chuong = $idchuong";
            $result = $this->db->select($query);
            return $result;
        }

        public function laychuongdau($id){
            $query = "SELECT id_chuong FROM chuong WHERE id_truyen = '$id' ORDER BY id_chuong ASC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }        

        public function laychuongcuoi($id){
            $query = "SELECT id_chuong, chapter FROM chuong WHERE id_truyen = '$id' ORDER BY id_chuong DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }     

        public function laychaptruoc($idtruyen, $id_chuong_hien_tai){
            if(isset($id_chuong_hien_tai)) {
                $query = "SELECT id_chuong FROM chuong WHERE id_truyen = $idtruyen AND id_chuong < $id_chuong_hien_tai ORDER BY id_chuong DESC LIMIT 1";
                $result = $this->db->select($query);
                return $result;
            } else {
                // Xử lý khi biến id_chuong_hien_tai không tồn tại
                return null;
            }
        }
        
        public function laychapsau($idtruyen, $id_chuong_hien_tai){
            if(isset($id_chuong_hien_tai)) {
                $query = "SELECT id_chuong FROM chuong WHERE id_truyen = $idtruyen AND id_chuong > $id_chuong_hien_tai ORDER BY id_chuong ASC LIMIT 1";
                $result = $this->db->select($query);
                return $result;
            } else {
                // Xử lý khi biến id_chuong_hien_tai không tồn tại
                return null;
            }
           
        }
        
    }
?>