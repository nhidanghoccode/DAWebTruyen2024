<?php
    $filepath =realpath(dirname(__FILE__));
    include_once ( $filepath.'/../lib/database.php');
    include_once ( $filepath.'/../helper/format.php');
?>
<?php ob_start();?>
<?php
    class nguoidung
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function dangky_nguoidung($data)
        {
            $tendangnhap = mysqli_real_escape_string($this->db->link, $data['tendangnhap']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $matkhau = mysqli_real_escape_string($this->db->link, md5($data['matkhau']));
            $sdt = mysqli_real_escape_string($this->db->link, $data['phone']);
            $avatar = 'avatar.jpg';

            if ($tendangnhap == "" || $email == "" || $matkhau == "" || $sdt == "") {
                $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống</span>";
                return $alert;
            }else{
                $check_email = "SELECT * FROM taikhoan where email='$email' LIMIT 1";
                $result_check = $this->db->select($check_email);
                if($result_check){
                    $alert = "<span class= 'erro'>Email đã đăng ký</span>";
                    return $alert;
                }else{
                    $query = "INSERT INTO taikhoan(tendangnhap, email, matkhau, phone, avatar)
                 VALUES ('$tendangnhap','$email','$matkhau', '$sdt','$avatar')";
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
        }
        public function dangnhap_nguoidung($data){
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $matkhau = mysqli_real_escape_string($this->db->link, md5($data['matkhau']));
            if ($email == "" || $matkhau == "") {
                $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống</span>";
                return $alert;
            }else{
                $check_login = "SELECT * FROM taikhoan where email='$email' AND matkhau='$matkhau'";
                $result_check = $this->db->select($check_login);
                if($result_check != false){
                    $value = $result_check->fetch_assoc();
                    Session::set('ngd_dangnhap', true);
                    Session::set('id_nguoidung', $value['id_nguoidung']);
                    Session::set('ten_nguoidung', $value['tendangnhap']);
                    // header('location:index.php');
                }else{
                    $message = "Email hoặc mật khẩu không đúng";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
        }

        public function capnhatavatar($id_nguoidung, $avatar) {
            $query = "UPDATE taikhoan SET avatar='$avatar' WHERE id_nguoidung='$id_nguoidung'";
            $result = $this->db->update($query);
            if ($result) {
                return "<span>Cập nhật avatar thành công</span>";
            } else {
                return "<span class='error'>Cập nhật avatar không thành công</span>";
            }
        }

        public function laydsnguoidung() {
            $query = "SELECT * FROM taikhoan";
            $result = $this->db->select($query);
            return $result;
        }

        public function sotruyendadang($id_nguoidung){
            $query = "SELECT COUNT(*) as total FROM truyen WHERE id_nguoidung = $id_nguoidung";
            $result = $this->db->select($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['total'];
            } else {
                return 0;
            }
        }

        public function getusertheoid($id_nguoidung) {
            $query = "SELECT * FROM taikhoan WHERE id_nguoidung='$id_nguoidung'";
            $result = $this->db->select($query);
            return $result->fetch_assoc();
        }

        
        public function them_binhluan($data,$idtruyen, $idchuong,$idnguoidung){
            $noidung = mysqli_real_escape_string($this->db->link, $data['noidung']);
            $thoigian = date('Y-m-d H:i:s'); 
            if ($noidung == "") {
                $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO `binhluan`(`id_truyen`, `id_chuong`, `id_nguoidung`, `noidung`, `thoigian`)
                VALUES ('$idtruyen','$idchuong','$idnguoidung','$noidung','$thoigian')";
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
        public function sua_binhluan($id_binhluan, $noidung) {
            $noidung = mysqli_real_escape_string($this->db->link, $noidung);
            $thoigian = date('Y-m-d H:i:s'); 
            if ($noidung == "") {
                $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống</span>";
                return $alert;
            } else {
                $query = "UPDATE binhluan SET noidung = '$noidung', thoigian = '$thoigian' WHERE id_binhluan = '$id_binhluan'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span>Cập nhật thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Cập nhật không thành công</span>";
                    return $alert;
                }
            }
        }
        
        public function xoa_binhluan($id_binhluan) {
            $query = "DELETE FROM binhluan WHERE id_binhluan = '$id_binhluan'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span>Xóa thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Xóa không thành công</span>";
                return $alert;
            }
        }
        
        public function lay_danh_sach_binhluantruyen($id) {
            $query = "SELECT binhluan.*, taikhoan.tendangnhap AS ten_nguoidung, taikhoan.avatar 
                      FROM binhluan 
                      INNER JOIN taikhoan ON binhluan.id_nguoidung = taikhoan.id_nguoidung
                      WHERE binhluan.id_truyen = '$id' 
                      ORDER BY binhluan.thoigian DESC";
            $result = $this->db->select($query);
            $comments = array(); 
        
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $comment = array(
                        'id_binhluan' => $row['id_binhluan'],
                        'id_nguoidung' => $row['id_nguoidung'],
                        'ten_nguoidung' => $row['ten_nguoidung'],
                        'noidung' => $row['noidung'],
                        'thoigian' => $row['thoigian'],
                        'avatar' => $row['avatar'] 
                    );
                    $comments[] = $comment; 
                }
            }
        
            return $comments; 
        }
        public function lay_danh_sach_binhluanchuong($idchuong) {
            $query = "SELECT binhluan.*, taikhoan.tendangnhap AS ten_nguoidung, taikhoan.avatar
                      FROM binhluan 
                      INNER JOIN taikhoan ON binhluan.id_nguoidung = taikhoan.id_nguoidung
                      WHERE binhluan.id_chuong = '$idchuong' 
                      ORDER BY binhluan.thoigian DESC";
            $result = $this->db->select($query);
            $comments = array(); 
        
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $comment = array(
                        'id_binhluan' => $row['id_binhluan'],
                        'id_nguoidung' => $row['id_nguoidung'],
                        'ten_nguoidung' => $row['ten_nguoidung'],
                        'noidung' => $row['noidung'],
                        'thoigian' => $row['thoigian'],
                        'avatar' => $row['avatar'] 
                    );
                    $comments[] = $comment; 
                }
            }
        
            return $comments;
        }
        // public function dangkyTacGia($id_nguoidung, $tentacgia, $mota) {
        //     $id_nguoidung = mysqli_real_escape_string($this->db->link, $id_nguoidung);
        //     $tentacgia = mysqli_real_escape_string($this->db->link, $tentacgia);
        //     $mota = mysqli_real_escape_string($this->db->link, $mota);
    
        //     if (empty($id_nguoidung) || empty($tentacgia) || empty($mota)) {
        //         $alert = "<span class='error'>Các trường không được để trống</span>";
        //         return $alert;
        //     } else {
        //         $query = "INSERT INTO tacgia(id_nguoidung, tentacgia, mota) VALUES('$id_nguoidung', '$tentacgia', '$mota')";
        //         $result = $this->db->insert($query);
        //         if ($result) {
        //             $alert = "<span class='success'>Đăng ký thành công</span>";
        //             return $alert;
        //         } else {
        //             $alert = "<span class='error'>Đăng ký không thành công</span>";
        //             return $alert;
        //         }
        //     }
        // }
        public function capnhatnguoidung($id_nguoidung, $tendangnhap, $email, $phone) {
            $id_nguoidung = mysqli_real_escape_string($this->db->link, $id_nguoidung);
            $tendangnhap = mysqli_real_escape_string($this->db->link, $tendangnhap);
            $email = mysqli_real_escape_string($this->db->link, $email);
            $phone = mysqli_real_escape_string($this->db->link, $phone);
            if (empty($tendangnhap) || empty($email) || empty($phone)) {
                return "<span class='error'>Các trường không được để trống</span>";
            }
            $query = "UPDATE taikhoan SET tendangnhap='$tendangnhap', email='$email', phone='$phone' WHERE id_nguoidung='$id_nguoidung'";
            $result = $this->db->update($query);
        
            if ($result) {
                return "<span class='success'>Cập nhật thông tin thành công</span>";
            } else {
                return "<span class='error'>Cập nhật thông tin không thành công</span>";
            }
        }
        
    }
?>