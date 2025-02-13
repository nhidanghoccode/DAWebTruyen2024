<?php
    $filepath =realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/session.php');
    Session::checkLogin();
    include_once ( $filepath.'/../lib/database.php');
    include_once ( $filepath.'/../helper/format.php');
?>

<?php
    class dangnhapadmin
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function dangnhap_admin($adminuser,$adminpass){
            $adminuser = $this->fm->validation($adminuser);
            $adminpass = $this->fm->validation($adminpass);

            $adminuser = mysqli_real_escape_string($this->db->link, $adminuser);
            $adminpass = mysqli_real_escape_string($this->db->link, $adminpass);

            if(empty($adminuser) || empty($adminpass)){
                $alert = "Tên Đăng Nhập và Mật Khẩu không được để trống";
                return $alert;
            }else{
                $query = "Select * from tbl_admin where adminuser = '$adminuser' and adminpass='$adminpass' LIMIT 1";
                $result = $this->db->select($query);

                if($result != false){
                    $value = $result->fetch_assoc();
                    Session::set('dangnhap',true);
                    Session::set('adminid', $value['adminid']);
                    Session::set('adminuser', $value['adminuser']);
                    Session::set('adminname', $value['adminname']);
                    header('Location:index.php');
                }
                else{
                    $alert = "Tên đăng nhập hoặc mật khẩu không đúng";
                    return $alert;
                }
            }
        }
    }
?>