<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ Giày Đẹp NT</title>
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php //include ("header.php"); ?>
    <?php
        session_start();
        if ($_SESSION['Quyen'] == 1) {
            include ("header_nv.php");
        } else {
            include ("header.php");
        }
    ?>
    <div class="banner">
        <img src="images/banner1.jpeg" alt="Banner Khuyến Mãi">
        <div class="banner-text">
            <h1>Chào Mừng Đến Với Shop</h1>
            <h1>Giày Đẹp NT</h1>
            <p>Chính hãng 100% với các ưu đãi đặt biệt</p>
        </div>
    </div>
    <h1 class="index-text">Sản phẩm tiêu biểu</h1>
    <div class="container">
        <?php 
            require ("connect.php");
            $sql = "SELECT MaGiay, TenGiay, Gia, Anh1
                    FROM Giay
                    LIMIT 3";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) <> 0) {
                while ($rows = mysqli_fetch_row($result)) {
                    $gia = number_format($rows[2]);
                    echo "<div class='product'>
                        <img src='shoe/images/$rows[3]'>
                        <h2>$rows[1]</h2>
                        <p>Giá: $gia VND</p>
                        <a href='shoe/detail.php?MaGiay=$rows[0]'><button>Mua Ngay</button></a>
                    </div>";
                }
            }
        ?>
    </div>
    <div class="view-all">
        <a href="shoe/grid.php">Xem Tất Cả</a>
    </div>
    <?php include ("footer.php"); ?>
</body>
</html>