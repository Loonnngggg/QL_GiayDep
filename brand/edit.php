<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Sửa hãng giày</title>
</head>

<body>
    <?php include ("../header_admin.php"); ?>
    <?php
    require ("../connect.php");

    if (isset($_GET['MaHG'])) {
        $ma = $_GET['MaHG'];

        $sql = "SELECT MaHG, TenHG
                    FROM HangGiay
                    WHERE MaHG = '$ma'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_row($result);
            $maHG = $row[0];
            $tenHG = $row[1];
        }
    } else {
        echo "<p align='center'>Không có hãng giày được chọn</p>";
    }

    if (isset($_POST["MaHG"]))
        $maHG = trim($_POST["MaHG"]);
    if (isset($_POST["TenHG"]))
        $tenHG = trim($_POST["TenHG"]);
    ?>

    <form action="" method="post">
        <table align='center' width='600' cellpadding='5' cellspacing='5'>
            <th colspan="2">
                <font size="5"><i>CẬP NHẬT THÔNG TIN HÃNG GIÀY</i></font>
            </th>
            <tr>
                <td>Mã hãng giày: </td>
                <td><input type="text" name="MaHG" size="20" value="<?php echo $maHG; ?>" disabled /></td>
            </tr>
            <tr>
                <td>Tên hãng giày: </td>
                <td><input type="text" name="TenHG" size="50" value="<?php echo $tenHG; ?>" /></td>
            </tr>
            <tr>
                <td><a href="list.php">Quay lại</a></td>
                <td colspan="2" align="center"><input type="submit" name="capnhat" size="10" value="   Cập nhật   " />
                </td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST["capnhat"])) {
        $sql = "UPDATE HangGiay 
                SET TenHG='$tenHG'
                WHERE MaHG='$maHG'";
        $result = mysqli_query($conn, $sql);
        if ($result != false) {
            echo "<p align='center'>Đã cập nhập hãng giày có mã $maHG</p>";
        }
    }
    ?>
    <?php include ("../footer.php"); ?>
</body>

</html>