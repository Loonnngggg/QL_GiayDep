<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Sửa loại giày</title>
</head>
<body>
<?php include("../header_admin.php"); ?>
<?php
        require("../connect.php");

        if (isset($_GET['MaLG'])) {
            $ma = $_GET['MaLG'];

            $sql = "SELECT MaLG, TenLG
                    FROM LoaiGiay
                    WHERE MaLG = '$ma'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_row($result);
                $maLG = $row[0];
                $tenLG = $row[1];
            }
        } else {
            echo "<p align='center'>Không có loại giày được chọn</p>";
        }

        if (isset($_POST["MaLG"]))
            $maLG = trim($_POST["MaLG"]);
        if (isset($_POST["TenLG"]))
            $tenLG = trim($_POST["TenLG"]);
        ?>

        <form action="" method="post">
            <table align='center' width='600' cellpadding='5' cellspacing='5'>
                <th colspan="2">
                    <font size="5"><i>CẬP NHẬT THÔNG TIN LOẠI GIÀY</i></font>
                </th>
                <tr>
                    <td>Mã loại giày: </td>
                    <td><input type="text" name="MaLG" size="20" value="<?php echo $maLG; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Tên loại giày: </td>
                    <td><input type="text" name="TenLG" size="50" value="<?php echo $tenLG; ?>" /></td>
                </tr>
                <tr>
                    <td><a href="list.php">Quay lại</a></td>
                    <td colspan="2" align="center"><input type="submit" name="capnhat" size="10"
                            value="   Cập nhật   " /></td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST["capnhat"])) {
            $sql = "UPDATE LoaiGiay 
                SET TenLG='$tenLG'
                WHERE MaLG='$maLG'";
            $result = mysqli_query($conn, $sql);
            if ($result != false) {
                echo "<p align='center'>Đã cập nhập loại giày có mã $maLG</p>";
            }
        }
        ?>
    <?php include("../footer.php"); ?>
</body>
</html>