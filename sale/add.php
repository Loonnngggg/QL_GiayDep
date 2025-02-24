<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Thêm khuyến mãi</title>
</head>

<body>
<?php include("../header_admin.php"); ?>
    <?php
    require ("../connect.php");

    if (isset($_POST["MaKM"]))
        $maKM = trim($_POST["MaKM"]);
    else
        $maKM = "KM003";
    if (isset($_POST["TenKM"]))
        $tenKM = trim($_POST["TenKM"]);
    else
        $tenKM = "";
    if (isset($_POST["GiaTriKM"]))
        $giaTriKM = trim($_POST["GiaTriKM"]);
    else
        $giaTriKM = "";
    if (isset($_POST["NgayBD"]))
        $ngayBD = trim($_POST["NgayBD"]);
    else
        $ngayBD = "";
    if (isset($_POST["NgayKT"]))
        $ngayKT = trim($_POST["NgayKT"]);
    else
        $ngayKT = "";
    if (isset($_POST["SoLuongKM"]))
        $soLuongKM = trim($_POST["SoLuongKM"]);
    else
        $soLuongKM = "";

    ?>

    <form action="" method="post">
        <table align='center' width='600' cellpadding='5' cellspacing='5'>
            <th colspan="2">
                <font size="5"><i>THÊM KHUYẾN MÃI MỚI</i></font>
            </th>
            <tr>
                <td>Mã khuyến mãi: </td>
                <td><input type="text" name="MaKM" size="20" value="<?php echo $maKM; ?>" disabled/></td>
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
                <td align="center"><input type="submit" name="them" size="10" value="   Thêm mới   " />
                </td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST["them"])) {
        $query = "INSERT INTO KhuyenMai
        VALUE ('$maKM','$tenKM','$giaTriKM','$ngayBD','$ngayKT','$soLuongKM')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Đã thêm khuyến mãi $tenKM";
            // header("Location: bai_2_11_ketqua.php?maSua=$maSua");
        } else
            echo "Cần điền vào các trường trống";
    }
    ?>
    <?php include("../footer.php"); ?>
</body>

</html>