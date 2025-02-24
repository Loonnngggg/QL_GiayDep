<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết giày</title>
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php //include("../header_admin.php"); ?>
    <?php
        session_start();
        if ($_SESSION['Quyen'] == 0) {
            include ("../header_admin.php");
        } elseif ($_SESSION['Quyen'] == 1) {
            include ("../header_nv.php");
        } else {
            include ("../header.php");
        }
    ?>

    <section class="detail">
        <div class="detail-content row">
            <div class="detail-content-left">
            <?php 
            require("../connect.php");
            if (isset($_GET["MaGiay"])) {
                $ma = $_GET["MaGiay"];

                $sql = "SELECT MaGiay, TenGiay, Gia, MoTa, Anh1, Anh2, Anh3
                        FROM Giay
                        WHERE MaGiay='$ma'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_row($result);
                    $maGiay = $row[0];
                    $tenGiay = $row[1];
                    $gia = $row[2];
                    $moTa = $row[3];
                    $anh1 = $row[4];
                    $anh2 = $row[5];
                    $anh3 = $row[6];
                }
            }
            ?>
                <div class="detail-content-left-big-img">
                    <img src="images/<?php echo $anh1; ?>" alt="">
                </div>
                <div class="detail-content-left-small-img row">
                    <img src="images/<?php echo $anh1; ?>" alt="">
                    <img src="images/<?php echo $anh2; ?>" alt="">
                    <img src="images/<?php echo $anh3; ?>" alt="">
                </div>
            </div>
            <div class="detail-content-right">
                <div class="detail-content-right-name">
                    <h1><?php echo $tenGiay ?></h1>
                    <p>Mã sản phẩm: <?php echo $maGiay ?></p>
                </div>
                <div class="detail-content-right-price">
                    <p><?php echo number_format($gia) ?> VND</p>
                </div>
                <div class="detail-content-right-size">
                    <p>Size:</p>
                    <div class="size">
                    <?php
                    $sql = "SELECT Size
                    FROM SizeGiay, ChiTietGiay
                    WHERE MaGiay = '$ma' AND SizeGiay.MaSize = ChiTietGiay.MaSize";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) <> 0) {
                        while ($row = mysqli_fetch_row($result)) {
                            echo "<span>$row[0]</span>";
                        }
                    }
                    ?>
                    </div>
                </div>

                <div class="detail-content-right-detail-button">
                    <button><a href="<?php echo "edit.php?MaGiay=$maGiay" ?>">Sửa</a></button>
                    <button><a href="<?php echo "delete.php?MaGiay=$maGiay" ?>">Xoá</a></button>
                </div>
                <div class="detail-content-right-des">
                    <p><u>Mô tả:</u></p>
                    <textarea name="" id="" cols="50" rows="15"><?php echo $moTa ?></textarea>
                </div>
            </div>
        </div>
    </section>
    <?php include("../footer.php"); ?>
</body>
</html>