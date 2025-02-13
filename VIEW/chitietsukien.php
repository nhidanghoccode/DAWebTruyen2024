<?php include '../inc/header.php'; ?>
<body>
<div class="container main " style="background-image: url('../img/nen1.jpg'); background-size: contain;">
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $skien = new sukien();
        $eventDetails = $skien->getsukienbyid($id);
        
        if ($eventDetails && $eventDetails->num_rows > 0) {
            $event = $eventDetails->fetch_assoc();
    ?>
    <div class="btnds">
    <a href="dssukien.php" class="btn btnsukien">Danh sách sự kiện</a>
    </div>
    <div class="event-details">
        <div class="event-image">
            <?php if (!empty($event['anh'])) : ?>
                <img src="../ADMIN/upload/<?php echo $event['anh']; ?>" alt="<?php echo $event['tensukien']; ?>">
            <?php else : ?>
                <p>No image available</p>
            <?php endif; ?>
        </div>
        <div class="event-info">
            <h1><?php echo $event['tensukien']; ?></h1>
            <p><strong>Thời gian bắt đầu:</strong> <?php echo date('d-m-Y H:i', strtotime($event['tgianbatdau'])); ?></p>
            <p><strong>Thời gian kết thúc:</strong> <?php echo date('d-m-Y H:i', strtotime($event['tgianketthuc'])); ?></p>
            <p><?php echo isset($event['mota']) ? $event['mota'] : "Không có mô tả"; ?></p>
        </div>
    </div>
    <?php
        } else {
            echo "Sự kiện không tồn tại.";
        }
    } else {
        echo "Không tìm thấy sự kiện.";
    }
    ?>
</div>
</body>
<?php
include '../inc/footer.php';
?>
<style>
body{
    background-image: url('../img/nen1.jpg'); background-size: contain;
}
.main-content {
    width: 100%;
}

.event-details {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: row;
}

.event-image {
    flex: 1;
    margin-right: 20px;
}

.event-image img {
    width: 100%;
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.event-image img:hover {
    transform: scale(1.05);
}

.event-info {
    flex: 2;
}

h1 {
    color: #333;
    font-size: 24px;
    margin-bottom: 10px;
}

.event-info p {
    font-size: 16px;
    color: #555;
}

.event-description p {
    font-size: 16px;
    color: #555;
    line-height: 1.6;
}

.btnds {
    text-align: right; /* Căn trái cho container của nút */
    margin-bottom: 10px; /* Thêm khoảng cách dưới */
}

.btnsukien {
    display: inline-block;
    /* padding: 10px 20px; */
    background-color: #007BFF;
    font: 10px;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}
</style>
