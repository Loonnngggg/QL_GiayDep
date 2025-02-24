<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Xoá nhân viên</title>
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
                    <font size="5"><i>XOÁ NHÂN VIÊN</i></font>
                </th>
                <tr>
                    <td>Mã nhân viên: </td>
                    <td><input type="text" name="MaNV" size="20" value="<?php echo $maNV; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Họ nhân viên: </td>
                    <td><input type="text" name="HoNV" size="50" value="<?php echo $hoNV; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Tên nhân viên: </td>
                    <td><input type="text" name="TenNV" size="50" value="<?php echo $tenNV; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Giới tính: </td>
                    <td>
                        <input type="radio" name="GioiTinh" value="0" disabled <?php if ($gioiTinh == 0)
                            echo 'checked="checked"' ?> />Nam
                        <input type="radio" name="GioiTinh" value="1" disabled <?php if ($gioiTinh == 1)
                            echo 'checked="checked"' ?> />Nữ
                    </td>
                </tr>
                <tr>
                    <td>Địa chỉ: </td>
                    <td><input type="text" name="DiaChi" size="50" value="<?php echo $diaChi; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Điện thoại: </td>
                    <td><input type="text" name="SDT" size="30" value="<?php echo $sdt; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Mail: </td>
                    <td><input type="text" name="Mail" size="50" value="<?php echo $mail; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Tên đăng nhập: </td>
                    <td><input type="text" name="TenDN" size="50" value="<?php echo $tenDN; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Mật khẩu: </td>
                    <td><input type="password" name="MatKhau" size="50" value="<?php echo $matKhau; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Quyền: </td>
                    <td>
                        <input type="radio" name="Quyen" value="0" disabled <?php if ($quyen == 0)
                            echo 'checked="checked"' ?> />Admin
                        <input type="radio" name="Quyen" value="1" disabled <?php if ($quyen == 1)
                            echo 'checked="checked"' ?> />Nhân viên
                    </td>
                </tr>
                <tr>
                    <td><a href="list.php">Quay lại</a></td>
                    <td colspan="2" align="center"><input type="submit" name="xoa" size="10"
                            value="   Xoá   " /></td>
                </tr>
            </table>
        </form>
        </div>
    </div>

        <?php
        if (isset($_POST["xoa"])) {
            $sql = "DELETE FROM NhanVien
                WHERE MaNV='$maNV'";
            $result = mysqli_query($conn, $sql);
            if ($result != false) {
                echo "<p align='center'>Xóa thông tin nhân viên $tenNV thành công</p>";
            }
            
        }
        ?>
    <?php include("../footer.php"); ?>
</body>
</html>