<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Sửa size</title>
</head>
<body>
<?php include("../header_admin.php"); ?>
<?php
        require("../connect.php");

        if (isset($_GET['MaSize'])) {
            $ma = $_GET['MaSize'];

            $sql = "SELECT MaSize, Size
                    FROM SizeGiay
                    WHERE MaSize = '$ma'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_row($result);
                $maSize = $row[0];
                $size = $row[1];
            }
        } else {
            echo "<p align='center'>Không có size được chọn</p>";
        }

        if (isset($_POST["MaSize"]))
            $maSize = trim($_POST["MaSize"]);
        if (isset($_POST["Size"]))
            $size = trim($_POST["Size"]);
        ?>

        <form action="" method="post">
            <table align='center' width='400' cellpadding='5' cellspacing='5'>
                <th colspan="2">
                    <font size="5"><i>CẬP NHẬT THÔNG TIN SIZE</i></font>
                </th>
                <tr>
                    <td>Mã size: </td>
                    <td><input type="text" name="MaSize" size="20" value="<?php echo $maSize; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Size: </td>
                    <td><input type="text" name="Size" size="20" value="<?php echo $size; ?>" /></td>
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
            $sql = "UPDATE SizeGiay 
                SET Size='$size'
                WHERE MaSize='$maSize'";
            $result = mysqli_query($conn, $sql);
            if ($result != false) {
                echo "<p align='center'>Đã cập nhập size có mã $maSize</p>";
            }
        }
        ?>
    <?php include("../footer.php"); ?>
</body>
</html>