<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Thêm khách hàng</title>
</head>

<body>
<?php include("../header_admin.php"); ?>
    <?php
    require ("../connect.php");

    if (isset($_POST["MaKH"]))
        $maKH = trim($_POST["MaKH"]);
    else
        $maKH = "KH017";
    if (isset($_POST["HoKH"]))
        $hoKH = trim($_POST["HoKH"]);
    else
        $hoKH = "";
    if (isset($_POST["TenKH"]))
        $tenKH = trim($_POST["TenKH"]);
    else
        $tenKH = "";
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
    ?>

    <form action="" method="post">
        <table align='center' width='600' cellpadding='5' cellspacing='5'>
            <th colspan="2">
                <font size="5"><i>THÊM KHÁCH HÀNG MỚI</i></font>
            </th>
            <tr>
                <td>Mã khách hàng: </td>
                <td><input type="text" name="MaKH" size="20" value="<?php echo $maKH; ?>" disabled/></td>
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
                <td><a href="list.php">Quay lại</a></td>
                <td align="center"><input type="submit" name="them" size="10" value="   Thêm mới   " />
                </td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST["them"])) {
        $query = "INSERT INTO KhachHang
        VALUE ('$maKH','$hoKH','$tenKH','$gioiTinh','$diaChi','$sdt','$mail',0)";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Đã thêm khách hàng $tenKH";
            // header("Location: bai_2_11_ketqua.php?maSua=$maSua");
        } else
            echo "Cần điền vào các trường trống";
    }
    ?>
    <?php include("../footer.php"); ?>
</body>

</html>