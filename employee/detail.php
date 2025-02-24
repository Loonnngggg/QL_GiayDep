<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết nhân viên</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("../header_admin.php"); ?>

    <?php 
    require("../connect.php");
    if (isset($_GET["MaNV"])) {
        $ma = $_GET["MaNV"];

        $sql = "SELECT MaNV, HoNV, TenNV, GioiTinh, DiaChi, SDT, Mail, AnhDaiDien, TenDN, MatKhau, Quyen
                FROM NhanVien
                WHERE MaNV='$ma'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_row($result);
            $maNV = $row[0];
            $hoNV = $row[1];
            $tenNV = $row[2];
            $gioiTinh = $row[3];
            $diaChi = $row[4];
            $sdt = $row[5];
            $mail = $row[6];
            $anhDaiDien = $row[7];
            $tenDN = $row[8];
            $matKhau = $row[9];
            $quyen = $row[10];
        }
    }
    ?>
    <div class="content row">
        <div class="content-left">
            <div class="content-left-img">
                <img src="images/<?php echo $anhDaiDien; ?>" alt="">
            </div>
        </div>
        <div class="detail-content-right">
            <div class="detail-content-right-name">
                <h1>Chi tiết nhân viên</h1>
                <p>Mã nhân viên: <?php echo $maNV ?></p>
                <p>Họ tên nhân viên: <?php echo $hoNV . " " . $tenNV ?></p>
                <p>Giới tính: <?php if ($gioiTinh == 0) echo "Nam"; else echo "Nữ"; ?></p>
                <p>Địa chỉ: <?php echo $diaChi ?></p>
                <p>Số điện thoại: <?php echo $sdt ?></p>
                <p>Mail: <?php echo $mail ?></p>
                <p>Tên đăng nhập: <?php echo $tenDN ?></p>
                <p>Mật khẩu: <?php echo $matKhau ?></p>
                <p>Quyền: <?php if ($quyen == 0) echo "Admin"; else echo "Nhân viên"; ?></p>
            </div>
            <div class="detail-content-right-detail-button">
                <button><a href="<?php echo "edit.php?MaNV=$maNV" ?>">Sửa</a></button>
                <button><a href="<?php echo "delete.php?MaNV=$maNV" ?>">Xoá</a></button>
            </div>
        </div>
    </div>
    <?php include("../footer.php"); ?>
</body>
</html>