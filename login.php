<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include ("header.php"); ?>
    <?php
        // session_start();
        // require("connect.php");

        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     $tenDN = $_POST['TenDN'];
        //     $matKhau = $_POST['MatKhau'];

        //     $sql = "SELECT TenDN, MatKhau, Quyen 
        //             FROM NhanVien
        //             WHERE TenDN = '$tenDN' AND MatKhau = '$matKhau'";
        //     $result = mysqli_query($conn, $sql);

        //     if (mysqli_num_rows($result) > 0) {
        //         $row = mysqli_fetch_row($result);

        //         $_SESSION['Quyen'] = $row[2];

        //         if ($row[2] == 0)
        //             header("Location: index_admin.php");
        //         else
        //             header("Location: index_none.php");
        //     }
        //     else {
        //         echo "Tên đăng nhập hoặc mật khẩu không đúng.";
        //     }
        // }
    ?>  
    <div class="login-container row">
        <form class="login-form">
            <h1>Đăng nhập</h1>
            <div class="form-group">
                <label for="TenDN">Tên đăng nhập</label>
                <input type="text" id="TenDN" name="TenDN" placeholder="Tên đăng nhập" required>
            </div>
            <div class="form-group">
                <label for="MatKhau">Mật khẩu</label>
                <input type="password" id="MatKhau" name="MatKhau" placeholder="Mật khẩu" required>
            </div>
            <button type="submit">Đăng nhập</button>
            <div class="forgot-pass row">
                <a href="">
                    <button>Quên mật khẩu</button>
                </a>
            </div>
        </form>
    </div>
    <?php include ("footer.php"); ?>
</body>
</html>