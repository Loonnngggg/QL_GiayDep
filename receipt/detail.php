<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết hoá đơn</title>
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php //include ("../header_admin.php"); ?>
    <?php
        session_start();
        if ($_SESSION['Quyen'] == 0) {
            include ("../header_admin.php");
        } else {
            include ("../header_nv.php");
        }
    ?>
<div class="invoice-container">
    <div class="invoice-header">
        <h1>HÓA ĐƠN</h1>
    </div>

    <div class="invoice-details">
        <h2>Thông tin hoá đơn</h2>
        <?php
            require("../connect.php");

            if (isset($_GET['MaHD'])) {
                $ma = $_GET['MaHD'];
        
                $sql = "SELECT MaHD, NgayXuatHD, MaNV, MaKH, MaKM, DiemTichLuy
                        FROM HoaDon
                        WHERE MaHD = '$ma'";
                $result = mysqli_query($conn, $sql);
        
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_row($result);
                    $maHD = $row[0];
                    $ngayXuatHD = $row[1];
                    $dinhDangNXHD = date('d-m-Y', strtotime($ngayXuatHD));
                    $maNV = $row[2];
                    $maKH = $row[3];
                    $maKM = $row[4];
                    $diemTichLuy = $row[5];
                }
            } else {
                echo "<p align='center'>Không có hoá đơn được chọn</p>";
            }
        ?>
        <p>Mã hoá đơn: <?php echo $maHD; ?></p>
        <p>Ngày xuất hoá đơn: <?php echo $dinhDangNXHD; ?></p>
        <p>Nhân viên xuất hoá đơn: 
            <?php $sql1 = "SELECT HoNV, TenNV FROM NhanVien WHERE MaNV='$maNV'";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    $row1 = mysqli_fetch_row($result1);
                    echo $row1[0] . " " . $row1[1];
                }
            ?>
        </p>
        <p>Khách hàng nhận hoá đơn:
            <?php $sql1 = "SELECT HoKH, TenKH FROM KhachHang WHERE MaKH='$maKH'";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    $row1 = mysqli_fetch_row($result1);
                    echo $row1[0] . " " . $row1[1];
                }
            ?>
        </p>
    </div>

    <table class="invoice-items">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số Lượng</th>
                <th>Đơn Giá</th>
                <th>Thành Tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $tongTien = 0;

                $sql1 = "SELECT MaGiay, SoLuongBan, Gia
                        FROM ChiTietHD
                        WHERE MaHD = '$ma'";
                $result1 = mysqli_query($conn, $sql1);

                if (mysqli_num_rows($result1) > 0) {
                    while ($rows1 = mysqli_fetch_row($result1)) {
                        $sql2 = "SELECT TenGiay FROM Giay WHERE MaGiay='$rows1[0]'";
                        $result2 = mysqli_query($conn, $sql2);

                        if (mysqli_num_rows($result2) > 0) {
                            $row2 = mysqli_fetch_row($result2);
                            $tenGiay = $row2[0];
                        }

                        $gia = number_format($rows1[2]);
                        $thanhTien = number_format($rows1[1] * $rows1[2]);
                        $tongTien += ($rows1[1] * $rows1[2]);

                        echo "<tr>
                            <td>$tenGiay</td>
                            <td>$rows1[1]</td>
                            <td>$gia VND</td>
                            <td>$thanhTien VND</td>
                        </tr>";
                    }
                }
            ?>
        </tbody>
    </table>

    <div class="invoice-total">
        <p>Tổng cộng: <?php echo number_format($tongTien); ?>VND</p>
        <p>Khuyến mãi: 0 VND</p>
        <p>Điểm tích luỹ: <?php echo $diemTichLuy; ?></p>
        <p><b>Thành tiền: <?php echo number_format($tongTien); ?>VND</b></p>
    </div>
</div>
<?php include ("../footer.php"); ?>
</body>
</html>