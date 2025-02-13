
    <style>
        .category-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            max-width: 300px;
            margin: 20px auto;
        }

        .category-container h3 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .category-grid a {
            color: #000;
            text-decoration: none;
            font-size: 16px;
        }

        .category-grid a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
include '../inc/header.php';

?>

<div class="category-container">
    <h3>Thể loại truyện</h3>
    <div class="category-grid">
        <?php
        $show_tl = $tl->show_theloai();
        if($show_tl){
            while($result = $show_tl->fetch_assoc()){
                echo '<a href="theloai.php?id=' . $result['id_theloai'] . '">' . $result['tentheloai'] . '</a>';
            }
        }
        ?>
    </div>
</div>

<?php include '../inc/footer.php'; ?>

</body>
</html>
