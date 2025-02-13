<?php
   $filepath =realpath(dirname(__FILE__));
   include_once ( $filepath.'/../lib/database.php');
   include_once ( $filepath.'/../helper/format.php');
?>

<?php
    class theloaiadmin
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function them_theloai($tentheloai, $id_loai){
            $tentheloai = mysqli_real_escape_string($this->db->link, $tentheloai);
            $id_loai = mysqli_real_escape_string($this->db->link, $id_loai);

            if(empty($tentheloai)){
                $alert = "Tên thể loại không được để trống";
                return $alert;
            }else{
                $query = "INSERT INTO `theloai`(`tentheloai`, `id_loai`) VALUES ('$tentheloai','$id_loai')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span> Thêm thành công</span>";
                    return $alert;
                }
                else{
                    $alert = "<span> Thêm không thành công </span>";
                    return $alert;
                }
            }
        }
        public function show_theloai(){
            $query = "Select * from theloai order by id_theloai desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_theloaibyloai($id_loai){
            $query = "SELECT * FROM theloai WHERE id_loai = '$id_loai'";
            $result = $this->db->select($query);
            return $result;
        }

        public function gettloaibyid($id){
            $query = "Select * from theloai where id_theloai = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function gettruyenbytheloai($id_theloai) {
            $query = "SELECT * FROM truyen WHERE id_theloai = $id_theloai AND trangthai_phanhoi = 'approved'";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function sua_theloai($tentheloai,$id){
            $tentheloai = $this->fm->validation($tentheloai);
            $tentheloai = mysqli_real_escape_string($this->db->link, $tentheloai);
            $id = mysqli_real_escape_string($this->db->link, $id);
            

            if(empty($tentheloai)){
                $alert = "Tên thể loại không được để trống";
                return $alert;
            }else{
                $query = "update theloai set tentheloai='$tentheloai' where id_theloai='$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span> Sửa thành công</span>";
                    return $alert;
                }
                else{
                    $alert = "<span> Sửa không thành công </span>";
                    return $alert;
                }
            }
        }
        public function xoa_theloai($id){
            $query = "Delete from theloai where id_theloai = '$id'";
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
    }
?>