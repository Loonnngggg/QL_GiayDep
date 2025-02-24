<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Sửa khách hàng</title>
</head>
<body>
<?php include("../header_admin.php"); ?>
    <?php
        require("../connect.php");

        if (isset($_GET['MaKH'])) {
            $ma = $_GET['MaKH'];

            $sql = "SELECT MaKH, HoKH, TenKH, GioiTinh, DiaChi, SDT, Mail
                    FROM KhachHang
                    WHERE MaKH = '$ma'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_row($result);
                $maKH = $row[0];
                $hoKH = $row[1];
                $tenKH = $row[2];
                $gioiTinh = $row[3];
                $diaChi = $row[4];
                $sdt = $row[5];
                $mail = $row[6];
            }
        } else {
            echo "<p align='center'>Không có khách hàng được chọn</p>";
        }

        if (isset($_POST["MaKH"]))
            $maKH = trim($_POST["MaKH"]);
        if (isset($_POST["HoKH"]))
            $hoKH = trim($_POST["HoKH"]);
        if (isset($_POST["TenKH"]))
            $tenKH = $_POST["TenKH"];
        if (isset($_POST["GioiTinh"]))
            $gioiTinh = trim($_POST["GioiTinh"]);
        if (isset($_POST["DiaChi"]))
            $diaChi = trim($_POST["DiaChi"]);
        if (isset($_POST["SDT"]))
            $sdt = trim($_POST["SDT"]);
        if (isset($_POST["Mail"]))
            $mail = trim($_POST["Mail"]);
        ?>

        <form action="" method="post">
            <table align='center' width='600' cellpadding='5' cellspacing='5'>
                <th colspan="2">
                    <font size="5"><i>CẬP NHẬT THÔNG TIN KHÁCH HÀNG</i></font>
                </th>
                <tr>
                    <td>Mã khách hàng: </td>
                    <td><input type="text" name="MaKH" size="20" value="<?php echo $maKH; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Họ khách hàng: </td>
                    <td><input type="text" name="HoKH" size="50" value="<?php echo $hoKH; ?>" /></td>
                </tr>
                <tr>
                    <td>Tên khách hàng: </td>
                    <td><input type="text" name="TenKH" size="50" value="<?php echo $tenKH; ?>" /></td>
                </tr>
                <tr>
                    <td>Giới tính: </td>
                    <td>
                        <input type="radio" name="GioiTinh" value="0" <?php if ($gioiTinh == 0)
                            echo 'checked="checked"' ?> />Nam
                        <input type="radio" name="GioiTinh" value="1" <?php if ($gioiTinh == 1)
                            echo 'checked="checked"' ?> />Nữ
                    </td>
                </tr>
                <tr>
                    <td>Địa chỉ: </td>
                    <td><input type="text" name="DiaChi" size="50" value="<?php echo $diaChi; ?>" /></td>
                </tr>
                <tr>
                    <td>Điện thoại: </td>
                    <td><input type="text" name="SDT" size="30" value="<?php echo $sdt; ?>" /></td>
                </tr>
                <tr>
                    <td>Mail: </td>
                    <td><input type="text" name="Mail" size="50" value="<?php echo $mail; ?>" /></td>
                </tr>
                <tr>
                    <td><a href="list.php">Quay lại</a></td>
                    <td align="center"><input type="submit" name="capnhat" size="10"
                            value="   Cập nhật   " /></td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST["capnhat"])) {
            $sql = "UPDATE KhachHang 
                SET HoKH = '$hoKH', TenKH='$tenKH', GioiTinh='$gioiTinh', DiaChi='$diaChi', SDT='$sdt', Mail='$mail'
                WHERE MaKH='$maKH'";
            $result = mysqli_query($conn, $sql);
            if ($result != false) {
                echo "<p align='center'>Đã cập nhập khách hàng $tenKH</p>";
            }
        }
        ?>
    <?php include("../footer.php"); ?>
</body>
</html>