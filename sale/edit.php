<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Sửa khuyến mãi</title>
</head>
<body>
<?php include("../header_admin.php"); ?>
<?php
        require("../connect.php");

        if (isset($_GET['MaKM'])) {
            $ma = $_GET['MaKM'];

            $sql = "SELECT MaKM, TenKM, GiaTriKM, NgayBD, NgayKT, SoLuongKM
                    FROM KhuyenMai
                    WHERE MaKM = '$ma'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_row($result);
                $maKM = $row[0];
                $tenKM = $row[1];
                $giaTriKM = $row[2];
                $ngayBD = $row[3];
                $ngayKT = $row[4];
                $soLuongKM = $row[5];
            }
        } else {
            echo "<p align='center'>Không có khuyến mãi được chọn</p>";
        }

        if (isset($_POST["MaKM"]))
            $maKM = trim($_POST["MaKM"]);
        if (isset($_POST["TenKM"]))
            $tenKM = trim($_POST["TenKM"]);
        if (isset($_POST["GiaTriKM"]))
            $giaTriKM = $_POST["GiaTriKM"];
        if (isset($_POST["NgayBD"]))
            $ngayBD = trim($_POST["NgayBD"]);
        if (isset($_POST["NgayKT"]))
            $ngayKT = trim($_POST["NgayKT"]);
        if (isset($_POST["SoLuongKM"]))
            $soLuongKM = trim($_POST["SoLuongKM"]);
        ?>

        <form action="" method="post">
            <table align='center' width='600' cellpadding='5' cellspacing='5'>
                <th colspan="2">
                    <font size="5"><i>CẬP NHẬT THÔNG TIN KHUYẾN MÃI</i></font>
                </th>
                <tr>
                    <td>Mã khuyến mãi: </td>
                    <td><input type="text" name="MaKM" size="20" value="<?php echo $maKM; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Tên khuyến mãi: </td>
                    <td><input type="text" name="TenKM" size="50" value="<?php echo $tenKM; ?>" /></td>
                </tr>
                <tr>
                    <td>Giá trị khuyến mãi: </td>
                    <td><input type="text" name="GiaTriKM" size="20" value="<?php echo $giaTriKM; ?>" /></td>
                </tr>
                <tr>
                    <td>Ngày bắt đầu: </td>
                    <td><input type="date" name="NgayBD" size="20" value="<?php echo $ngayBD; ?>" /></td>
                </tr>
                <tr>
                    <td>Ngày kết thúc: </td>
                    <td><input type="date" name="NgayKT" size="20" value="<?php echo $ngayKT; ?>" /></td>
                </tr>
                <tr>
                    <td>Số lượng khuyến mãi: </td>
                    <td><input type="text" name="SoLuongKM" size="20" value="<?php echo $soLuongKM; ?>" /></td>
                </tr>
                <tr>
                    <td><a href="list.php">Quay lại</a></td>
                    <td colspan="2" align="center"><input type="submit" name="capnhat" size="10"
                            value="   Cập nhật   " /></td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST["capnhat"])) {
            $sql = "UPDATE Giay 
                SET TenKM='$tenKM', GiaTriKM='$giaTriKM', NgayBD='$ngayBD', NgayKT='$ngayKT', SoLuongKM='$soLuongKM'
                WHERE MaKM='$maKM'";
            $result = mysqli_query($conn, $sql);
            if ($result != false) {
                echo "<p align='center'>Đã cập nhập khuyến mãi có mã $maKM</p>";
            }
        }
        ?>
    <?php include("../footer.php"); ?>
</body>
</html>