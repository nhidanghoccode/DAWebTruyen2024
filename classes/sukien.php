<?php
    $filepath =realpath(dirname(__FILE__));
    include_once ( $filepath.'/../lib/database.php');
    include_once ( $filepath.'/../helper/format.php');
?>
<?php
    class sukien
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function them_sukien($tenSukien,$anh, $tgianbatdau, $tgianketthuc, $mota){
            $tenSukien = mysqli_real_escape_string($this->db->link, $tenSukien);
            $anh = mysqli_real_escape_string($this->db->link, $anh);
            $tgianbatdau = mysqli_real_escape_string($this->db->link, $tgianbatdau);
            $tgianketthuc = mysqli_real_escape_string($this->db->link, $tgianketthuc);
            $mota = mysqli_real_escape_string($this->db->link, $mota);
            if(empty($tenSukien) || empty($tgianbatdau) || empty($tgianketthuc)){
                $alert = "Các trường không được để trống";
                return $alert;
            } else {
                $query = "INSERT INTO sukien (tensukien, anh, tgianbatdau, tgianketthuc, mota) VALUES ('$tenSukien', '$anh', '$tgianbatdau', '$tgianketthuc', '$mota')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "Thêm sự kiện thành công";
                    return $alert;
                } else {
                    $alert = "Thêm sự kiện không thành công";
                    return $alert;
                }
            }
        }
    
        public function show_sukien(){
            $query = "SELECT * FROM sukien ORDER BY id_sukien DESC";
            $result = $this->db->select($query);
            return $result;
        }
    
        public function getsukienbyid($id){
            $query = "SELECT * FROM sukien WHERE id_sukien = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
    
        public function sua_sukien($tenSukien, $anh, $tgianbatdau, $tgianketthuc, $mota, $id){
            $tenSukien = $this->fm->validation($tenSukien);
            $tenSukien = mysqli_real_escape_string($this->db->link, $tenSukien);
            $anh = mysqli_real_escape_string($this->db->link, $anh);
            $tgianbatdau = mysqli_real_escape_string($this->db->link, $tgianbatdau);
            $tgianketthuc = mysqli_real_escape_string($this->db->link, $tgianketthuc);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $mota = mysqli_real_escape_string($this->db->link, $mota);
    
            if(empty($tenSukien) || empty($tgianbatdau) || empty($tgianketthuc)){
                $alert = "Các trường không được để trống";
                return $alert;
            } else {
                $query = "UPDATE sukien SET tensukien = '$tenSukien', anh = '$anh', tgianbatdau = '$tgianbatdau', tgianketthuc= '$tgianketthuc', mota='$mota' WHERE id_sukien = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "Sửa sự kiện thành công";
                    return $alert;
                } else {
                    $alert = "Sửa sự kiện không thành công";
                    return $alert;
                }
            }
        }
    
        public function xoa_sukien($id){
            $query = "DELETE FROM sukien WHERE id_sukien = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "Xóa sự kiện thành công";
                return $alert;
            } else {
                $alert = "Xóa sự kiện không thành công";
                return $alert;
            }
        }
    
        public function getCurrentEvent() {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $currentTime = date('Y-m-d H:i:s');
            $query = "SELECT * FROM sukien WHERE tgianbatdau <= '$currentTime' AND tgianketthuc >= '$currentTime'";
            $result = $this->db->select($query);
            // var_dump($result); 
            return $result;
        }
        public function getAllEvents() {
            $query = "SELECT * FROM sukien";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>