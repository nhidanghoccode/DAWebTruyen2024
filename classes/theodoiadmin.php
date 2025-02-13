<?php
    $filepath =realpath(dirname(__FILE__));
    include_once ( $filepath.'/../lib/database.php');
    include_once ( $filepath.'/../helper/format.php');
?>
<?php
    class theodoiadmin
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function themtheodoi($data){
            if(isset($data['id_theodoi']) && isset($data['id_nguoidung'])){
                $id = mysqli_real_escape_string($this->db->link, $data['id_theodoi']);
                $idnguoidung = mysqli_real_escape_string($this->db->link, $data['id_nguoidung']);
                $sessionid = session_id();
                $kiemtra_theodoi = "SELECT * FROM thdoitruyen WHERE id_truyen='$id' AND id_nguoidung='$idnguoidung'";
                $result_kiemtra = $this->db->select($kiemtra_theodoi);
            
                if($result_kiemtra){
                    $msg = '<span class="text-warning" style="">Truyện đã có trong danh sách theo dõi</span>';
                    return $msg;
                } else {
                    $query = "SELECT * FROM truyen WHERE id_truyen='$id'";
                    $result_truyen = $this->db->select($query)->fetch_assoc();
                    
                    $query_them = "INSERT INTO thdoitruyen (id_truyen, tentruyen, sessionid, id_nguoidung, biatruyen, trangthai) VALUES ('$id', '$result_truyen[tentruyen]', '$sessionid', '$idnguoidung', '$result_truyen[biatruyen]', 'active')";

                    $result_them = $this->db->insert($query_them);
                    
                    if($result_them){
                        $alert = '<span class="text-info" style="">Thêm vào danh sách theo dõi thành công</span>';
                        return $alert;
                    } else {
                        $alert = '<span class="text-info" style="">Thêm vào danh sách theo dõi không thành công</span>';
                        return $alert;
                    }
                }
            } else {
                // Xử lý khi không có đủ thông tin
                $msg = '<span class="text-warning" style="">Không đủ thông tin để thêm vào danh sách theo dõi</span>';
                return $msg;
            }
        }
        
        public function laytruyentheodoi($idnguoidung){
            $idnguoidung = mysqli_real_escape_string($this->db->link, $idnguoidung );
            $query = "SELECT * from thdoitruyen where id_nguoidung='$idnguoidung'";
            $result = $this->db->select($query);
            return $result;
        }
        public function xoatheodoi($idnguoidung, $idtruyen){
            $idnguoidung = mysqli_real_escape_string($this->db->link, $idnguoidung );
            $idtruyen = mysqli_real_escape_string($this->db->link, $idtruyen );
            $query = "DELETE FROM thdoitruyen WHERE id_nguoidung = '$idnguoidung' AND id_truyen = '$idtruyen'";
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
        public function capnhat_trangthai_theodoi($idNguoiDung) {
            $sessionid = session_id();
            $sql = "UPDATE thdoitruyen SET trangthai = 'inactive' WHERE id_nguoidung = $idNguoiDung AND sessionid = '$sessionid'";
            $result = $this->db->update($sql); 
            return $result; 
        }
    }
?>