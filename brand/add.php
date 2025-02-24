<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hãng giày</title>
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include ("../header_admin.php"); ?>
    <?php
    require ("../connect.php");

    if (isset($_POST["MaHG"]))
        $maHG = trim($_POST["MaHG"]);
    else
        $maHG = "HG007";
    if (isset($_POST["TenHG"]))
        $tenHG = trim($_POST["TenHG"]);
    else
        $tenHG = "";

    ?>

    <form action="" method="post">
        <table align='center' width='600' cellpadding='5' cellspacing='5'>
            <th colspan="2">
                <font size="5"><i>THÊM HÃNG GIÀY MỚI</i></font>
            </th>
            <tr>
                <td>Mã hãng giày: </td>
                <td><input type="text" name="MaHG" size="20" value="<?php echo $maHG; ?>" disabled/></td>
            </tr>
            <tr>
                <td>Tên hãng giày: </td>
                <td><input type="text" name="TenHG" size="50" value="<?php echo $tenHG; ?>" /></td>
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
        $query = "INSERT INTO HangGiay
        VALUE ('$maHG','$tenHG')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Đã thêm hãng giày $tenHG";
            // header("Location: bai_2_11_ketqua.php?maSua=$maSua");
        } else
            echo "Cần điền vào các trường trống";
    }
    ?>
    <?php include ("../footer.php"); ?>
</body>

</html>