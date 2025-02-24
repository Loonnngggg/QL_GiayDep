<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Thêm loại giày</title>
</head>

<body>
<?php include("../header_admin.php"); ?>
    <?php
    require ("../connect.php");

    if (isset($_POST["MaLG"]))
        $maLG = trim($_POST["MaLG"]);
    else
        $maLG = "LG006";
    if (isset($_POST["TenLG"]))
        $tenLG = trim($_POST["TenLG"]);
    else
        $tenLG = "";

    ?>

    <form action="" method="post">
        <table align='center' width='600' cellpadding='5' cellspacing='5'>
            <th colspan="2">
                <font size="5"><i>THÊM HÃNG GIÀY MỚI</i></font>
            </th>
            <tr>
                <td>Mã loại giày: </td>
                <td><input type="text" name="MaLG" size="20" value="<?php echo $maLG; ?>" disabled/></td>
            </tr>
            <tr>
                <td>Tên loại giày: </td>
                <td><input type="text" name="TenLG" size="50" value="<?php echo $tenLG; ?>" /></td>
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
        $query = "INSERT INTO LoaiGiay
        VALUE ('$maLG','$tenLG')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Đã thêm loại giày $tenLG";
            // header("Location: bai_2_11_ketqua.php?maSua=$maSua");
        } else
            echo "Cần điền vào các trường trống";
    }
    ?>
    <?php include("../footer.php"); ?>
</body>

</html>