<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 300px;
            background-color: #333;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: tomato;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #1e1e1e;
            color: #fff;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: tomato;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #d35400;
        }
    </style>
</head>
<body>
    <?php
        include '../classes/adminlogin.php'
    ?>
    <?php
        $class = new dangnhapadmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $adminuser = $_POST['adminuser'];
            $adminpass = md5($_POST['adminpass']);

            $kiemtra_dangnhap = $class-> dangnhap_admin($adminuser,$adminpass);
        }
    ?>

    <div class="container">
    <h2>Admin Login</h2>
        <form action="login.php" method="POST">
        <span style="color: #fff;">
        <?php
            if(isset($kiemtra_dangnhap)){
                echo $kiemtra_dangnhap;
            }
        ?>
        </span>
            <input type="text" name="adminuser" placeholder="Username" required="">
            <input type="password" name="adminpass" placeholder="Password" required="">
            <input type="submit" value="Đăng Nhập">
        </form>
    </div>
</body>
</html>
