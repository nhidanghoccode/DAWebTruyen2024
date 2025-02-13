<?php
    $filepath =realpath(dirname(__FILE__));
    include_once ( $filepath.'/../lib/database.php');
    include_once ( $filepath.'/../helper/format.php');
?>

<?php
    class thongke
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function tong_so_truyen() {
            // Query để đếm số lượng truyện
            $query = "SELECT COUNT(*) AS total_books FROM truyen";
            $result = $this->db->select($query);
            if($result) {
                $row = $result->fetch_assoc();
                $total_books = $row['total_books'];
                return $total_books;
            } else {
                return 0;
            }
        }
        public function tong_so_luot_xem() {
            $query = "SELECT SUM(luotxem) AS total_views FROM truyen";
            $result = $this->db->select($query);
            if($result) {
                $row = $result->fetch_assoc();
                $total_views = $row['total_views'];
        
                return $total_views;
            } else {
                return 0;
            }
        }
        public function tong_so_nguoi_dung(){
            $query = "SELECT COUNT(*) as total_users FROM taikhoan";
            $result = $this->db->select($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['total_users'];
            } else {
                return 0;
            }
        }
        public function tong_so_luot_thich() {
            $query = "SELECT SUM(luotthich) AS total_views FROM truyen";
            $result = $this->db->select($query);
            if($result) {
                $row = $result->fetch_assoc();
                $total_views = $row['total_views'];
        
                return $total_views;
            } else {
                return 0;
            }
        }
        public function truyen_duoc_theo_doi_nhieu_nhat() {
            
            $query="SELECT truyen.tentruyen, COUNT(thdoitruyen.id_theodoi) AS so_luong_theo_doi 
                    FROM thdoitruyen 
                    LEFT JOIN truyen ON thdoitruyen.id_truyen = truyen.id_truyen 
                    WHERE thdoitruyen.trangthai = 'active' OR thdoitruyen.trangthai = 'inactive'
                    GROUP BY thdoitruyen.id_truyen 
                    ORDER BY so_luong_theo_doi DESC 
                    LIMIT 1";
            $result = $this->db->select($query);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                return $row;
            } else {
                return null; 
            }
        }
        public function truyen_duoc_theo_doi_nhieu() {
            $query = "SELECT truyen.tentruyen, COUNT(thdoitruyen.id_theodoi) AS so_luong_theo_doi 
            FROM thdoitruyen 
            LEFT JOIN truyen ON thdoitruyen.id_truyen = truyen.id_truyen 
            WHERE thdoitruyen.trangthai = 'active' OR thdoitruyen.trangthai = 'inactive'
            GROUP BY thdoitruyen.id_truyen 
            ORDER BY so_luong_theo_doi DESC 
            LIMIT 10;
            ";
            $result = $this->db->select($query);
            $chart_data = array(
                'labels' => array(),
                'data' => array()
            );
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $chart_data['labels'][] = $row['tentruyen'];
                    $chart_data['data'][] = $row['so_luong_theo_doi'];
                }
                return $chart_data;
            } else {
                return null; 
            }
        }
    }
?>