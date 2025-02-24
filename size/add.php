<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Thêm size</title>
</head>

<body>
<?php include("../header_admin.php"); ?>
    <?php
    require ("../connect.php");

    if (isset($_POST["MaSize"]))
        $maSize = trim($_POST["MaSize"]);
    else
        $maSize = "SG009";
    if (isset($_POST["Size"]))
        $size = trim($_POST["Size"]);
    else
        $size = "";

    ?>

    <form action="" method="post">
        <table align='center' width='400' cellpadding='5' cellspacing='5'>
            <th colspan="2">
                <font size="5"><i>THÊM SIZE MỚI</i></font>
            </th>
            <tr>
                <td>Mã size: </td>
                <td><input type="text" name="MaSize" size="20" value="<?php echo $maSize; ?>" disabled/></td>
            </tr>
            <tr>
                <td>Size: </td>
                <td><input type="text" name="Size" size="20" value="<?php echo $size; ?>" /></td>
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
        $query = "INSERT INTO SizeGiay
        VALUE ('$maSize','$size')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Đã thêm size $size";
            // header("Location: bai_2_11_ketqua.php?maSua=$maSua");
        } else
            echo "Cần điền vào các trường trống";
    }
    ?>
    <?php include("../footer.php"); ?>
</body>

</html>