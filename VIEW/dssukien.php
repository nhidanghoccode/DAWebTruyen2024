<<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sự kiện</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Nền động */
        .bubble {
            position: fixed;
            bottom: -100px;
            left: 50%;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            animation: rise 10s infinite ease-in-out;
            pointer-events: none;
        }

        @keyframes rise {
            0% {
                transform: translateX(0) translateY(0) scale(1);
            }
            100% {
                transform: translateX(-200px) translateY(-1500px) scale(0.5);
            }
        }
    </style>
</head>
<body>
    <header>
        <?php include '../inc/header.php'; ?>
    </header>
    <div class="container_ds" >
        <div class="event-list">
            <?php
            $events = $skien->getAllEvents();
            if ($events && $events->num_rows > 0) {
                while ($event = $events->fetch_assoc()) {
            ?>
            <div class="event-item" onclick="location.href='chitietsukien.php?id=<?php echo $event['id_sukien']; ?>'">
                <div class="event-image">
                    <img src="../ADMIN/upload/<?php echo $event['anh']; ?>" alt="<?php echo $event['tensukien']; ?>" style="height:200px;">
                </div>
                <div class="event-info">
                    <h2><?php echo $event['tensukien']; ?></h2>
                    <p><strong>Thời gian bắt đầu:</strong> <?php echo date('d-m-Y H:i', strtotime($event['tgianbatdau'])); ?></p>
                    <p><strong>Thời gian kết thúc:</strong> <?php echo date('d-m-Y H:i', strtotime($event['tgianketthuc'])); ?></p>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<p>Không có sự kiện nào.</p>";
            }
            ?>
        </div>
    </div>
    <footer>
        <?php include '../inc/footer.php'; ?>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            for (let i = 0; i < 50; i++) {
                let bubble = document.createElement('div');
                bubble.className = 'bubble';
                bubble.style.left = Math.random() * 100 + 'vw';
                bubble.style.animationDelay = Math.random() * 5 + 's';
                bubble.style.animationDuration = Math.random() * 10 + 5 + 's';
                bubble.style.width = bubble.style.height = Math.random() * 20 + 10 + 'px';
                document.body.appendChild(bubble);
            }
        });
    </script>
</body>
</html>


<style>
body {
    font-family: Arial, sans-serif;
    background-image: url('../img/nen1.jpg'); background-size: contain;
}

.container_ds {
    margin-top: 40px;
    margin-left: 100px;
    margin-right: 100px;
    max-width: 1200px;
    min-height: 600px;
    border: 1px solid #dee2e6; /* Viền màu xám nhạt */
    padding: 30px; /* Khoảng cách bên trong */
    border-radius: 10px; /* Bo tròn các góc */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng */
}

.event-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.event-item {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
    cursor: pointer;
}

.event-item:hover {
    transform: scale(1.05);
}

.event-image img {
    width: 100%;
    height: auto;
}

.event-info {
    padding: 20px;
}

.event-info h2 {
    font-size: 20px;
    margin: 0 0 10px;
    color: #333;
}

.event-info p {
    font-size: 16px;
    color: #555;
    margin: 5px 0;
}
</style>
