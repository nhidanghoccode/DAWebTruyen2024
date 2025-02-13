<?php
 $filepath =realpath(dirname(__FILE__));
 include_once ( $filepath.'/../lib/database.php');
 include_once ( $filepath.'/../helper/format.php');
?>

<?php
    class loaitruyenadmin
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function them_loai($tenloai){
            $tenloai = $this->fm->validation($tenloai);
            $tenloai = mysqli_real_escape_string($this->db->link, $tenloai);
            
            if(empty($tenloai)){
                $alert = "Tên thể loại không được để trống";
                return $alert;
            }else{
                $query = "Insert into loaitruyen(tenloai) values('$tenloai')";
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
        public function show_loai(){
            $query = "Select * from loaitruyen order by id_loai desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function show_loaitruyen() {
            $query = "SELECT * FROM loaitruyen";
            $result = $this->db->select($query);
            return $result;
        }        
        public function getloaitruyenbyid($id){
            $query = "Select * from loaitruyen where id_loai = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function sua_loai($tenloai,$id){
            $tenloai = $this->fm->validation($tenloai);
            $tenloai = mysqli_real_escape_string($this->db->link, $tenloai);
            $id = mysqli_real_escape_string($this->db->link, $id);
            

            if(empty($tenloai)){
                $alert = "Tên loại không được để trống";
                return $alert;
            }else{
                $query = "update loaitruyen set tenloai='$tenloai' where id_loai='$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span> Sửa thành công</span>";
                    return $alert;
                    // header('loaction:loaitruyen.php');
                }
                else{
                    $alert = "<span> Sửa không thành công </span>";
                    return $alert;
                }
            }
        }
        public function xoa_loai($id){
            $query = "Delete from loaitruyen where id_loai = '$id'";
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