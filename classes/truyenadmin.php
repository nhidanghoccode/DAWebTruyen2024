<?php
    $filepath =realpath(dirname(__FILE__));
    include_once ( $filepath.'/../lib/database.php');
    include_once ( $filepath.'/../helper/format.php');      
?>

<?php
    class truyenadmin
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function them_truyen($data, $files){
            $tentruyen = mysqli_real_escape_string($this->db->link, $data['tentruyen']);
            $tacgia = mysqli_real_escape_string($this->db->link, $data['tacgia']);
            $loaitruyen = mysqli_real_escape_string($this->db->link, $data['loaitruyen']);
            $theloai = mysqli_real_escape_string($this->db->link, $data['theloai']);
            $mota = mysqli_real_escape_string($this->db->link, $data['mota']);
            $kieu = mysqli_real_escape_string($this->db->link, $data['kieu']);
            $trangthai = mysqli_real_escape_string($this->db->link, $data['trangthai']);
            $nguoidang = 'admin';
            
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['biatruyen']['name'];
            $file_size = $_FILES['biatruyen']['size'];
            $file_temp = $_FILES['biatruyen']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/".$unique_image;

            if ($tentruyen == "" || $tacgia == "" || $loaitruyen == "" || $theloai == "" ||  $mota == "" || $kieu == "" || $trangthai == "" || $file_name=="" ) {
            $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống</span>";
            return $alert;
            }else{
                move_uploaded_file($file_temp,$uploaded_image);
               
                $query = "INSERT INTO truyen(tentruyen, tacgia, id_theloai, id_loai, kieu, biatruyen, trangthai, mota, nguoidang, trangthai_phanhoi)
                 VALUES ('$tentruyen','$tacgia','$theloai','$loaitruyen','$kieu','$unique_image','$trangthai', '$mota', '$nguoidang', 'approved')";
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
    
        public function show_truyen(){
            $query = "
                SELECT 
                    truyen.*, 
                    loaitruyen.tenloai, 
                    theloai.tentheloai
                FROM 
                    truyen 
                INNER JOIN 
                    loaitruyen ON truyen.id_loai = loaitruyen.id_loai
                INNER JOIN 
                    theloai ON truyen.id_theloai = theloai.id_theloai
                WHERE 
                    truyen.trangthai_phanhoi = 'approved'
                ORDER BY 
                    truyen.id_truyen DESC 
            ";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_truyentuchoi(){
            $query = "
                SELECT 
                    truyen.*, 
                    loaitruyen.tenloai, 
                    theloai.tentheloai
                FROM 
                    truyen 
                INNER JOIN 
                    loaitruyen ON truyen.id_loai = loaitruyen.id_loai
                INNER JOIN 
                    theloai ON truyen.id_theloai = theloai.id_theloai
                WHERE 
                    truyen.trangthai_phanhoi = 'rejected'
                ORDER BY 
                    truyen.id_truyen DESC 
            ";
            $result = $this->db->select($query);
            return $result;
        }

        public function pheDuyetTruyen($id_truyen, $trangthai) {
            $trangthai = mysqli_real_escape_string($this->db->link, $trangthai);
            $query = "UPDATE truyen SET trangthai_phanhoi = '$trangthai' WHERE id_truyen = '$id_truyen'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span> Cập nhật trạng thái thành công </span>";
                return $alert;
            } else {
                $alert = "<span> Cập nhật trạng thái không thành công </span>";
                return $alert;
            }
        }
        
        public function getTruyenChoPheDuyet() {
            $query = "
                SELECT 
                    truyen.id_truyen, 
                    truyen.tentruyen,
                    truyen.tacgia, 
                    truyen.mota, 
                    truyen.biatruyen, 
                    theloai.tentheloai, 
                    loaitruyen.tenloai
                FROM 
                    truyen 
                LEFT JOIN 
                    theloai ON truyen.id_theloai = theloai.id_theloai 
                LEFT JOIN 
                    loaitruyen ON truyen.id_loai = loaitruyen.id_loai
                WHERE 
                    truyen.trangthai_phanhoi = 'pending'
            ";
            $result = $this->db->select($query);
            return $result;
        }
               
        public function pheDuyetLaiTruyen($id) {
            $query = "UPDATE truyen SET trangthai_phanhoi = 'pending' WHERE id_truyen = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $msg = "<span class='success'>Thêm vào phê duyệt thành công.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Thêm vào phê duyệt không thành công.</span>";
                return $msg;
            }
        }
        
        public function laytruyentheoid($id){
            $query = "Select * from truyen where id_truyen = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function sua_truyen($data,$files,$id){
            $tentruyen = mysqli_real_escape_string($this->db->link, $data['tentruyen']);
            $tacgia = mysqli_real_escape_string($this->db->link, $data['tacgia']);
            $loaitruyen = mysqli_real_escape_string($this->db->link, $data['loaitruyen']);
            $theloai = mysqli_real_escape_string($this->db->link, $data['theloai']);
            $mota = mysqli_real_escape_string($this->db->link, $data['mota']);
            $kieu = mysqli_real_escape_string($this->db->link, $data['kieu']);
            $trangthai = mysqli_real_escape_string($this->db->link, $data['trangthai']);
            
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['biatruyen']['name'];
            $file_size = $_FILES['biatruyen']['size'];
            $file_temp = $_FILES['biatruyen']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/".$unique_image;

            if ($tentruyen == "" || $tacgia == "" || $loaitruyen == "" || $theloai == "" ||  $mota == "" || $kieu == "" || $trangthai == "") {
                $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống</span>";
                return $alert;
            }else{
                if (!empty($file_name)) {
                    // nếu người dùng chọn ảnh
                    if ($file_size < 20480) {
                        $alert = "<span style='font-size: 18px;color: red;' class='success'>kích cỡ nên nhỏ hơn 20MB</span>";
                        return $alert;
                    } else if (in_array($file_ext, $permited) === false) {
                        $alert = "<span>you can upload only: -" .implode('.' . $permited) . "</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = " UPDATE truyen set tentruyen ='$tentruyen', tacgia ='$tacgia', id_loai='$loaitruyen', id_theloai=' $theloai',mota ='$mota', biatruyen ='$unique_image', kieu ='$kieu', trangthai ='trangthai' WHERE id_truyen='$id' ";
                } else{
    
                    // nếu người dùng không chọn ảnh
                    $query = " UPDATE truyen set tentruyen ='$tentruyen', tacgia ='$tacgia', id_loai='$loaitruyen', id_theloai=' $theloai',mota ='$mota', kieu ='$kieu', trangthai ='$trangthai' WHERE id_truyen='$id' ";
                }
        
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span> Sửa thành công</span>";
                    return $alert;
                    // header('loaction:loaitruyen.php');
                }else{
                    $alert = "<span> Sửa không thành công </span>";
                    return $alert;
                }
            }
        }
        public function sua_truyenngdung($data,$files,$id){
            $tentruyen = mysqli_real_escape_string($this->db->link, $data['tentruyen']);
            $tacgia = mysqli_real_escape_string($this->db->link, $data['tacgia']);
            $loaitruyen = mysqli_real_escape_string($this->db->link, $data['loaitruyen']);
            $theloai = mysqli_real_escape_string($this->db->link, $data['theloai']);
            $mota = mysqli_real_escape_string($this->db->link, $data['mota']);
            
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['biatruyen']['name'];
            $file_size = $_FILES['biatruyen']['size'];
            $file_temp = $_FILES['biatruyen']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/".$unique_image;

            if ($tentruyen == "" || $tacgia == "" || $loaitruyen == "" || $theloai == "" ||  $mota == "") {
                $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống</span>";
                return $alert;
            }else{
                if (!empty($file_name)) {
                    // nếu người dùng chọn ảnh
                    if ($file_size < 20480) {
                        $alert = "<span style='font-size: 18px;color: red;' class='success'>kích cỡ nên nhỏ hơn 20MB</span>";
                        return $alert;
                    } else if (in_array($file_ext, $permited) === false) {
                        $alert = "<span>you can upload only: -" .implode('.' . $permited) . "</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = " UPDATE truyen set tentruyen ='$tentruyen', tacgia ='$tacgia', id_loai='$loaitruyen', id_theloai=' $theloai',mota ='$mota', biatruyen ='$unique_image' WHERE id_truyen='$id' "; 
                } else{
    
                    // nếu người dùng không chọn ảnh
                    $query = " UPDATE truyen set tentruyen ='$tentruyen', tacgia ='$tacgia', id_loai='$loaitruyen', id_theloai=' $theloai',mota ='$mota' WHERE id_truyen='$id' ";
                }
        
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span> Sửa thành công</span>";
                    return $alert;
                    // header('loaction:loaitruyen.php');
                }else{
                    $alert = "<span> Sửa không thành công </span>";
                    return $alert;
                }
            }
        }
        public function xoa_truyen($id){
            $query = "Delete from truyen where id_truyen = '$id'";
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
        public function gettruyen_noibat() {
            $query = "SELECT * FROM truyen WHERE kieu = '1' AND trangthai_phanhoi = 'approved'";
            $result = $this->db->select($query);
            return $result;
        }
        public function gettruyen_truyenmoi() {
            $query = "SELECT * FROM truyen WHERE trangthai_phanhoi = 'approved' ORDER BY id_truyen DESC LIMIT 10";
            $result = $this->db->select($query);
            return $result;
        }
        public function gettruyen_truyentranh() {
            $query = "SELECT * FROM truyen WHERE id_loai = '1' AND trangthai_phanhoi = 'approved'";
            $result = $this->db->select($query);
            return $result;
        }
        public function gettruyen_truyenchu() {
            $query = "SELECT * FROM truyen WHERE id_loai = '2' AND trangthai_phanhoi = 'approved'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getthongtin($id){
            $query ="SELECT truyen.*, loaitruyen.tenloai, theloai.tentheloai
                    FROM truyen 
                    INNER JOIN loaitruyen ON truyen.id_loai = loaitruyen.id_loai
                    INNER JOIN theloai ON truyen.id_theloai = theloai.id_theloai WHERE truyen.id_truyen = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function timkiemtruyen($keyword){
            $query = "SELECT * FROM truyen WHERE tentruyen LIKE '%$keyword%'";
            $result = $this->db->select($query);
            return $result;
        }
        public function luotthich($id_truyen){
            $query = "UPDATE truyen SET luotthich = luotthich + 1 WHERE id_truyen = '$id_truyen';";
            $result = $this->db->update($query);
            return $result;
        }
        public function luotxem($id_truyen){
            $query = "UPDATE truyen SET luotxem = luotxem + 1 WHERE id_truyen = '$id_truyen';";
            $result = $this->db->update($query);
            return $result;
        }
        public function kiemtraDanhGia($id_truyen, $id_nguoidung) {
            $query = "SELECT * FROM danhgia WHERE id_truyen = '$id_truyen' AND id_nguoidung = '$id_nguoidung'";
            $result = $this->db->select($query);
            return $result;
        }
        public function capnhatDanhGia($id_truyen, $id_nguoidung, $danhgia) {
            $query = "UPDATE danhgia SET danhgia = '$danhgia' WHERE id_truyen = '$id_truyen' AND id_nguoidung = '$id_nguoidung'";
            $result = $this->db->update($query);
            return $result;
        }
    
        public function themDanhGia($id_truyen, $id_nguoidung, $danhgia) {
            $query = "INSERT INTO danhgia (id_truyen, id_nguoidung, danhgia) VALUES ('$id_truyen', '$id_nguoidung', '$danhgia')";
            $result = $this->db->insert($query);
            return $result;
        }
        public function layDanhGia($id_truyen) {
            $query = "SELECT AVG(danhgia) as danhGiaTrungBinh FROM danhgia WHERE id_truyen = '$id_truyen'";
            $result = $this->db->select($query);
            if($result) {
                $row = $result->fetch_assoc();
                return round($row['danhGiaTrungBinh']);
            } else {
                return 0; // Nếu không có đánh giá, trả về 0
            }
        }
        public function layDanhGiaHienTai($id_truyen, $id_nguoidung) {
            $query = "SELECT danhgia FROM danhgia WHERE id_truyen = '$id_truyen' AND id_nguoidung = '$id_nguoidung'";
            $result = $this->db->select($query);
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['danhgia'];
            } else {
                return 0; // Nếu không có đánh giá, trả về 0
            }
        }
        
        public function dangTruyen($data, $files, $id_nguoidung) {
            $tentruyen = mysqli_real_escape_string($this->db->link, $data['tentruyen']);
            $tacgia = mysqli_real_escape_string($this->db->link, $data['tacgia']);
            $loaitruyen = mysqli_real_escape_string($this->db->link, $data['loaitruyen']);
            $theloai = mysqli_real_escape_string($this->db->link, $data['theloai']);
            $mota = mysqli_real_escape_string($this->db->link, $data['mota']);
            $nguoidang = 'user';
            
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['biatruyen']['name'];
            $file_size = $_FILES['biatruyen']['size'];
            $file_temp = $_FILES['biatruyen']['tmp_name'];
        
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "../ADMIN/upload/".$unique_image;
        
            if ($tentruyen == "" || $tacgia == "" || $loaitruyen == "" || $theloai == "" ||  $mota == "" || $file_name=="" ) {
                $alert = "<span style='font-size: 18px;color: red;' class='success'>Không được để trống</span>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO truyen(tentruyen, tacgia, id_theloai, id_loai, biatruyen, mota, nguoidang, id_nguoidung, trangthai_phanhoi)
                          VALUES ('$tentruyen','$tacgia','$theloai','$loaitruyen','$unique_image','$mota', '$nguoidang', '$id_nguoidung', 'pending')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span> Thêm thành công, đang chờ phê duyệt</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'> Thêm không thành công </span>";
                    return $alert;
                }
            }
        }
        

        public function show_truyentunguoidung($id_nguoidung) {
            $query = "SELECT truyen.*, loaitruyen.tenloai, theloai.tentheloai
            FROM truyen 
            INNER JOIN loaitruyen ON truyen.id_loai = loaitruyen.id_loai
            INNER JOIN theloai ON truyen.id_theloai = theloai.id_theloai
            WHERE truyen.id_nguoidung = '$id_nguoidung' AND truyen.trangthai_phanhoi = 'approved'
            ORDER BY truyen.id_truyen DESC 
            ";
            $result = $this->db->select($query);
            return $result;
        }    
    }
?>