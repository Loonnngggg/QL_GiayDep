<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Xoá hoá đơn</title>
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
    <?php
    require ("../connect.php");

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
            $maNV = $row[2];
            $maKH = $row[3];
            $maKM = $row[4];
            $diemTichLuy = $row[5];
        }
    } else {
        echo "<p align='center'>Không có hoá đơn được chọn</p>";
    }
    ?>

    <form action="" method="post">
        <table align='center' width='600' cellpadding='5' cellspacing='5'>
            <th colspan="2">
                <font size="5"><i>XOÁ HOÁ ĐƠN</i></font>
            </th>
            <tr>
                <td>Mã hoá đơn: </td>
                <td><input type="text" name="MaHD" size="20" value="<?php echo $maHD; ?>" disabled /></td>
            </tr>
            <tr>
                <td>Ngày xuất hoá đơn: </td>
                <td><input type="date" name="NgayXuatHD" value="<?php echo $ngayXuatHD; ?>" disabled/></td>
            </tr>
            <tr>
                <td>Nhân viên: </td>
                <td>
                    <select name="NhanVien" disabled>
                        <?php
                        $query = "SELECT MaNV, TenNV
                                FROM NhanVien";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) <> 0) {
                            while ($rows = mysqli_fetch_row($result)) {
                                if ($maNV == $rows[0])
                                    echo "<option value=$rows[0] selected>$rows[1]</option>";
                                else
                                    echo "<option value=$rows[0]>$rows[1]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Khách hàng: </td>
                <td>
                    <select name="KhachHang" disabled>
                        <?php
                        $query = "SELECT MaKH, TenKH
                                FROM KhachHang";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) <> 0) {
                            while ($rows = mysqli_fetch_row($result)) {
                                if ($maKH == $rows[0])
                                    echo "<option value=$rows[0] selected>$rows[1]</option>";
                                else
                                    echo "<option value=$rows[0]>$rows[1]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Khuyến mãi: </td>
                <td>
                    <select name="KhuyenMai" disabled>
                        <?php
                        $query = "SELECT MaKM, TenKM
                                FROM KhuyenMai";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) <> 0) {
                            while ($rows = mysqli_fetch_row($result)) {
                                if ($maKM == $rows[0])
                                    echo "<option value=$rows[0] selected>$rows[1]</option>";
                                else
                                    echo "<option value=$rows[0]>$rows[1]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Điểm tích luỹ: </td>
                <td><input type="text" name="DiemTichLuy" size="30" value="<?php echo $diemTichLuy; ?>" disabled/></td>
            </tr>
            <?php 
            $dem = 1;
            $sql = "SELECT ChiTietHD.MaGiay, TenGiay, ChiTietHD.MaSize, Size, SoLuongBan
                    FROM ChiTietHD, HoaDon, Giay, SizeGiay
                    WHERE ChiTietHD.MaHD = HoaDon.MaHD AND ChiTietHD.MaGiay = Giay.MaGiay AND ChiTietHD.MaSize = SizeGiay.MaSize 
                        AND HoaDon.MaHD = '$maHD'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) <> 0) {
                while ($rows = mysqli_fetch_row($result)) {
                    echo " <tr>
                        <td>Giày:</td>
                        <td>
                            <select name='Giay$dem' disabled> ";
                            $sql1 = "SELECT MaGiay, TenGiay
                                    FROM Giay";
                            $result1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($result1) <> 0) {
                                while ($rows1 = mysqli_fetch_row($result1)) {
                                    if ($rows[0] == $rows1[0])
                                        echo "<option value=$rows1[0] selected>$rows1[1]</option>";
                                    else 
                                        echo "<option value=$rows1[0]>$rows1[1]</option>";
                                }
                            }
                            echo "</select>
                        </td>
                    </tr>
                    <tr>
                        <td>Size:</td>
                        <td>
                            <select name='SizeGiay$dem' disabled> ";
                            $sql1 = "SELECT MaSize, Size
                                    FROM SizeGiay";
                            $result1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($result1) <> 0) {
                                while ($rows1 = mysqli_fetch_row($result1)) {
                                    if ($rows[2] == $rows1[0])
                                        echo "<option value=$rows1[0] selected>$rows1[1]</option>";
                                    else 
                                        echo "<option value=$rows1[0]>$rows1[1]</option>";
                                }
                            }
                            echo "</select>
                        </td>
                    </tr>
                    <tr>
                        <td>Số lượng:</td>
                        <td><input type='text' name='SoLuong$dem' value='$rows[4]' disabled></td>
                    </tr>";
                    $dem++;
                }
            }
            ?>
            <tr>
                <td><a href="list.php">Quay lại</a></td>
                <td colspan="2" align="center"><input type="submit" name="xoa" size="10"
                        value="   Xoá   " /></td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_POST["xoa"])) {
        $sql = "DELETE FROM ChiTietHD
                WHERE MaHD='$maHD'";
        $result = mysqli_query($conn, $sql);

        if ($result != false) {
            $sql1 = "DELETE FROM HoaDon
                    WHERE MaHD='$maHD'";
            $result1 = mysqli_query($conn, $sql1);
            if ($result1 != false) {
                echo "<p align='center'>Xóa thông tin hoá đơn $maHD thành công</p>";
            }
        } else {
            echo "<p align='center'>Lỗi</p>";
        }
    }
    ?>
    <?php include("../footer.php"); ?>
</body>

</html>