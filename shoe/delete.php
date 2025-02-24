<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Xoá giày</title>
</head>
<body>
<?php include("../header_admin.php"); ?>
    <?php
        require("../connect.php");

        if (isset($_GET['MaGiay'])) {
            $ma = $_GET['MaGiay'];

            $sql = "SELECT MaGiay, TenGiay, MaLG, MaHG, Gia, MoTa, Anh1, Anh2, Anh3
                    FROM Giay
                    WHERE MaGiay = '$ma'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_row($result);
                $maGiay = $row[0];
                $tenGiay = $row[1];
                $maLG = $row[2];
                $maHG = $row[3];
                $gia = $row[4];
                $moTa = $row[5];
                $anh1 = $row[6];
                $anh2 = $row[7];
                $anh3 = $row[8];
            }
        } else {
            echo "<p align='center'>Không có giày được chọn</p>";
        }

        ?>

    <div class="content row">
        <div class="content-left">
            <div class="content-left-img">
                <img src="images/<?php echo $anh1; ?>" alt="">
                <img src="images/<?php echo $anh2; ?>" alt="">
                <img src="images/<?php echo $anh3; ?>" alt="">
            </div>
        </div>
        <div class="content-right">
        <form action="" method="post">
            <table align='center' width='600' cellpadding='5' cellspacing='5'>
                <th colspan="2">
                    <font size="5"><i>XOÁ GIÀY</i></font>
                </th>
                <tr>
                    <td>Mã giày: </td>
                    <td><input type="text" name="MaGiay" size="20" value="<?php echo $maGiay; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Tên giày: </td>
                    <td><input type="text" name="TenGiay" size="50" value="<?php echo $tenGiay; ?>" disabled /></td>
                </tr>
                <tr>
                    <td>Loại giày: </td>
                    <td>
                        <select name="LoaiGiay" disabled>
                            <?php
                            $query = "SELECT MaLG, TenLG
                                    FROM LoaiGiay";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) <> 0) {
                                while ($rows = mysqli_fetch_row($result)) {
                                    if ($maLG == $rows[0])
                                        echo "<option value=$rows[0] selected>$rows[1]</option>";
                                    else echo "<option value=$rows[0]>$rows[1]</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Hãng giày: </td>
                    <td>
                        <select name="HangGiay" disabled>
                            <?php
                            $query = "SELECT MaHG, TenHG
                                    FROM HangGiay";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) <> 0) {
                                while ($rows = mysqli_fetch_row($result)) {
                                    if ($maHG == $rows[0])
                                        echo "<option value=$rows[0] selected>$rows[1]</option>";
                                    else echo "<option value=$rows[0]>$rows[1]</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Giá: </td>
                    <td><input type="text" name="Gia" size="30" value="<?php echo $gia; ?>" disabled />VND</td>
                </tr>
                <tr>
                    <td>Mô tả:</td>
                    <td><textarea name="" id="" cols="50" rows="10" disabled><?php echo $moTa; ?></textarea></td>
                </tr>
                <?php 
                    $dem = 1;
                    $sql = "SELECT SizeGiay.MaSize, Size, SoLuongTon
                            FROM Giay, ChiTietGiay, SizeGiay
                            WHERE Giay.MaGiay = ChiTietGiay.MaGiay AND SizeGiay.MaSize = ChiTietGiay.MaSize 
                                AND Giay.MaGiay = '$maGiay' ";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) <> 0) {
                        while ($rows = mysqli_fetch_row($result)) {
                            echo " <tr>
                                <td>Size:</td>
                                <td>
                                    <select name='SizeGiay$dem' disabled> ";
                                    $sql1 = "SELECT MaSize, Size
                                            FROM SizeGiay";
                                    $result1 = mysqli_query($conn, $sql1);
                                    if (mysqli_num_rows($result1) <> 0) {
                                        while ($rows1 = mysqli_fetch_row($result1)) {
                                            if ($rows[0] == $rows1[0])
                                                echo "<option value=$rows[0] seleted>$rows[1]</option>";
                                            else 
                                                echo "<option value=$rows[0]>$rows[1]</option>";
                                        }
                                    }
                                    echo "</select>
                                </td>
                            </tr>
                            <tr>
                                <td>Số lượng tồn:</td>
                                <td><input type='text' name='SoLuongTon$dem' value='$rows[2]' disabled></td>
                            </tr>";
                            $dem++;
                        }
                    }
                    ?>
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
        $sql = "DELETE FROM ChiTietGiay 
                WHERE MaGiay='$maGiay'";
        $result = mysqli_query($conn, $sql);

        if ($result != false) {
            $sql1 = "DELETE FROM Giay
                    WHERE MaGiay='$maGiay'";
            $result1 = mysqli_query($conn, $sql1);
            if ($result1 != false) {
                echo "<p align='center'>Xóa thông tin giày $tenGiay thành công</p>";
            }
        } else {
            echo "<p align='center'>Lỗi</p>";
        }
    }
    ?>
    <?php include("../footer.php"); ?>
</body>
</html>