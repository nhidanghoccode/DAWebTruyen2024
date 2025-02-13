<?php
$sukien = new sukien();
$currentEvent = $sukien->getCurrentEvent();

if ($currentEvent && $currentEvent->num_rows > 0) {
    while ($event = $currentEvent->fetch_assoc()) {
        // Cập nhật thông tin sự kiện trong localStorage
        echo "<script>
            localStorage.setItem('tensukien', '". $event['tensukien'] ."');
            localStorage.setItem('tgianbatdau', '". $event['tgianbatdau'] ."');
            localStorage.setItem('tgianketthuc', '". $event['tgianketthuc'] ."');
        </script>";
?>
<div class="notification-banner" id="notificationBanner">
    <span id="eventMessage"></span> 
    <a id="eventDetailsLink" href="chitietsukien.php?id=<?php echo $event['id_sukien']; ?>">Xem chi tiết</a>
    <button class="dong" onclick="hideBanner()">Đóng</button>
</div>
<?php
    }
}
?>

<script>
    function showBanner() {
        document.getElementById('notificationBanner').style.display = 'block';
    }

    function hideBanner() {
        document.getElementById('notificationBanner').style.display = 'none';
    }

    function checkEventTime() {
        var currentTime = new Date();
        var tgianbatdau = new Date(localStorage.getItem('tgianbatdau'));
        var tgianketthuc = new Date(localStorage.getItem('tgianketthuc'));

        if (tgianbatdau && tgianketthuc && currentTime >= tgianbatdau && currentTime <= tgianketthuc) {
            var eventName = localStorage.getItem('tensukien');
            var eventMessage = "Tham gia " + eventName + " và có cơ hội nhận phần thưởng hấp dẫn!";
            document.getElementById('eventMessage').innerText = eventMessage;
            showBanner();
        }
    }

    window.onload = checkEventTime;
</script>
<style>
.dong{
    background-color: #dc3545;
    color: white; 
    border: none; 
    padding: 8px 16px;
    border-radius: 4px; 
    cursor: pointer;
    transition: background-color 0.3s;
}
.dong:hover{
    background-color: #c82333;
}
</style>