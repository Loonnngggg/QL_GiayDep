<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Sửa nhân viên</title>
</head>
<body>
<?php include("../header_admin.php"); ?>
<?php
        require("../connect.php");

        if (isset($_GET['MaNV'])) {
            $ma = $_GET['MaNV'];

            $sql = "SELECT MaNV, HoNV, TenNV, GioiTinh, DiaChi, SDT, Mail, AnhDaiDien, TenDN, MatKhau, Quyen
                    FROM NhanVien
                    WHERE MaNV = '$ma'";
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
        } else {
            echo "<p align='center'>Không có nhân viên được chọn</p>";
        }

        if (isset($_POST["MaNV"]))
            $maNV = trim($_POST["MaNV"]);
        if (isset($_POST["HoNV"]))
            $hoNV = trim($_POST["HoNV"]);
        if (isset($_POST["TenNV"]))
            $tenNV = $_POST["TenNV"];
        if (isset($_POST["GioiTinh"]))
            $gioiTinh = trim($_POST["GioiTinh"]);
        if (isset($_POST["DiaChi"]))
            $diaChi = trim($_POST["DiaChi"]);
        if (isset($_POST["SDT"]))
            $sdt = trim($_POST["SDT"]);
        if (isset($_POST["Mail"]))
            $mail = trim($_POST["Mail"]);
        if (isset($_POST["TenDN"]))
            $tenDN = trim($_POST["TenDN"]);
        if (isset($_POST["MatKhau"]))
            $matKhau = trim($_POST["MatKhau"]);
        if (isset($_POST["Quyen"]))
            $quyen = trim($_POST["Quyen"]);
        if (isset($_FILES['HinhAnh'])) {
            $file_name = $_FILES['HinhAnh']['name'];
            $file_tmp = $_FILES['HinhAnh']['tmp_name'];
        }
        ?>

    <div class="content row">
        <div class="content-left">
            <div class="content-left-img">
                <img src="images/<?php echo $anhDaiDien; ?>" alt="">
            </div>
        </div>
        <div class="content-right">
        <form action="" method="post" enctype="multipart/form-data">
            <table align='center' width='600' cellpadding='5' cellspacing='5'>
                <th colspan="2">
                    <font size="5"><i>CẬP NHẬT THÔNG TIN NHÂN VIÊN</i></font>
                </th>
                <tr>
                    <td>Mã nhân viên: </td>
                    <td><input type="text" name="MaNV" size="20" value="<?php echo $maNV; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Họ nhân viên: </td>
                    <td><input type="text" name="HoNV" size="50" value="<?php echo $hoNV; ?>" /></td>
                </tr>
                <tr>
                    <td>Tên nhân viên: </td>
                    <td><input type="text" name="TenNV" size="50" value="<?php echo $tenNV; ?>" /></td>
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
                    <td>Hình đại diện: </td>
                    <td><input type="file" name="HinhAnh"></td>
                </tr>
                <tr>
                    <td>Tên đăng nhập: </td>
                    <td><input type="text" name="TenDN" size="50" value="<?php echo $tenDN; ?>" /></td>
                </tr>
                <tr>
                    <td>Mật khẩu: </td>
                    <td><input type="password" name="MatKhau" size="50" value="<?php echo $matKhau; ?>" /></td>
                </tr>
                <tr>
                    <td>Quyền: </td>
                    <td>
                        <input type="radio" name="Quyen" value="0" <?php if ($quyen == 0)
                            echo 'checked="checked"' ?> />Admin
                        <input type="radio" name="Quyen" value="1" <?php if ($quyen == 1)
                            echo 'checked="checked"' ?> />Nhân viên
                    </td>
                </tr>
                <tr>
                    <td><a href="list.php">Quay lại</a></td>
                    <td colspan="2" align="center"><input type="submit" name="capnhat" size="10"
                            value="   Cập nhật   " /></td>
                </tr>
            </table>
        </form>
        </div>
    </div>

        <?php
        if (isset($_POST["capnhat"])) {
            $sql = "UPDATE NhanVien 
                SET HoNV = '$hoNV', TenNV='$tenNV', GioiTinh='$gioiTinh', DiaChi='$diaChi', SDT='$sdt', Mail='$mail', TenDN='$tenDN', MatKhau='$matKhau', Quyen='$quyen'
                WHERE MaNV='$maNV'";
            $result = mysqli_query($conn, $sql);

            if ($result != false) {
                echo "<p align='center'>Đã cập nhập nhân viên $tenNV</p>";
            }
        }
        ?>
    <?php include("../footer.php"); ?>
</body>
</html>