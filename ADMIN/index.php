<?php
    include '../ADMIN/header.php';
    include '../classes/thongke.php';
?>


<div id="contentDiv" class="main-content">
<?php
    $tk = new thongke();
    // Lấy thông tin thống kê từ CSDL
    $total_books = $tk->tong_so_truyen();
    $total_views = $tk->tong_so_luot_xem();
    $total_users = $tk->tong_so_nguoi_dung();
    $total_likes = $tk->tong_so_luot_thich();
    $most_followed_book = $tk->truyen_duoc_theo_doi_nhieu_nhat();
?>
<?php 

?>
<div class="container">
    <h2>Thống Kê</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng Số Truyện</h5>
                    <p class="card-text"><?php echo $total_books; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng Số Lượt Xem</h5>
                    <p class="card-text"><?php echo $total_views; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Số Lượng Người Dùng</h5>
                    <p class="card-text"><?php echo $total_users; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng Số Lượt Thích</h5>
                    <p class="card-text"><?php echo $total_likes; ?></p>
                </div>
            </div>
        </div>
    </div>
   
    <div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">Truyện Được Theo Dõi Nhiều Nhất</h5>
        <?php if($most_followed_book && isset($most_followed_book['tentruyen']) && isset($most_followed_book['so_luong_theo_doi'])): ?>
            <p class="card-text"><?php echo $most_followed_book['tentruyen']; ?> (<?php echo $most_followed_book['so_luong_theo_doi']; ?> lượt theo dõi)</p>
        <?php else: ?>
            <p class="card-text">Không có dữ liệu</p>
        <?php endif; ?>
    </div>
</div>


<?php
    $chart_data = $tk->truyen_duoc_theo_doi_nhieu();
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="myChart" width="400" height="200"></canvas>

<script>
    var chartData = <?php echo json_encode($chart_data); ?>;
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.labels, 
            datasets: [{
                label: 'Số lượng', 
                data: chartData.data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1 
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true 
                }
            }
        }
    });
</script>
    </div>
    
</div>

