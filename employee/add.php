<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Thêm nhân viên</title>
</head>

<body>
<?php include("../header_admin.php"); ?>
    <?php
    require ("../connect.php");

    $file_name = $file_tmp = "";

    if (isset($_POST["MaNV"]))
        $maNV = trim($_POST["MaNV"]);
    else
        $maNV = "NV010";
    if (isset($_POST["HoNV"]))
        $hoNV = trim($_POST["HoNV"]);
    else
        $hoNV = "";
    if (isset($_POST["TenNV"]))
        $tenNV = trim($_POST["TenNV"]);
    else
        $tenNV = "";
    if (isset($_POST["GioiTinh"]))
        $gioiTinh = trim($_POST["GioiTinh"]);
    else
        $gioiTinh = "";
    if (isset($_POST["DiaChi"]))
        $diaChi = trim($_POST["DiaChi"]);
    else
        $diaChi = "";
    if (isset($_POST["SDT"]))
        $sdt = trim($_POST["SDT"]);
    else
        $sdt = "";
    if (isset($_POST["Mail"]))
        $mail = trim($_POST["Mail"]);
    else
        $mail = "";
    if (isset($_POST["TenDN"]))
        $tenDN = trim($_POST["TenDN"]);
    else
        $tenDN = "";
    if (isset($_POST["MatKhau"]))
        $matKhau = trim($_POST["MatKhau"]);
    else
        $matKhau = "";
    if (isset($_POST["Quyen"]))
        $quyen = trim($_POST["Quyen"]);
    else
        $quyen = "";
    if (isset($_FILES['HinhAnh'])) {
        $file_name = $_FILES['HinhAnh']['name'];
        $file_tmp = $_FILES['HinhAnh']['tmp_name'];
    }

    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <table align='center' width='600' cellpadding='5' cellspacing='5'>
            <th colspan="2">
                <font size="5"><i>THÊM NHÂN VIÊN MỚI</i></font>
            </th>
            <tr>
                <td>Mã nhân viên: </td>
                <td><input type="text" name="MaNV" size="20" value="<?php echo $maNV; ?>" disabled/></td>
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
                    <input type="radio" name="GioiTinh" value="0" checked />Nam
                    <input type="radio" name="GioiTinh" value="1"/>Nữ
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
                <td><input type="text" name="MatKhau" size="50" value="<?php echo $matKhau; ?>" /></td>
            </tr>
            <tr>
                <td>Quyền: </td>
                <td>
                    <input type="radio" name="Quyen" value="0" checked />Admin
                    <input type="radio" name="Quyen" value="1"/>Nhân viên
                </td>
            </tr>
            <tr>
                <td><a href="list.php">Quay lại</a></td>
                <td align="center"><input type="submit" name="them" size="10" value="   Thêm mới   " />
                </td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST["them"])) {
        $query = "INSERT INTO NhanVien
        VALUE ('$maNV','$hoNV','$tenNV','$gioiTinh','$diaChi','$sdt','$mail','$file_name','$tenDN','$matKhau','$quyen')";
        $result = mysqli_query($conn, $query);
        move_uploaded_file($file_tmp, 'images/' . $file_name);

        if ($result) {
            echo "Đã thêm nhân viên $tenNV";
            // header("Location: bai_2_11_ketqua.php?maSua=$maSua");
        } else
            echo "Cần điền vào các trường trống";
    }
    ?>
    <?php include("../footer.php"); ?>
</body>

</html>