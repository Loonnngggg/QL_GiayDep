<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Sửa giày</title>
</head>

<body>
    <?php include ("../header_admin.php"); ?>
    <?php
    require ("../connect.php");

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

    $name_anh1 = $tmp_anh1 = $name_anh2 = $tmp_anh2 = $name_anh3 = $tmp_anh3 = "";
    if (isset($_POST["MaGiay"]))
        $maGiay = trim($_POST["MaGiay"]);
    if (isset($_POST["TenGiay"]))
        $tenGiay = trim($_POST["TenGiay"]);
    if (isset($_POST["MaLG"]))
        $maLG = $_POST["MaLG"];
    if (isset($_POST["MaHG"]))
        $maHG = trim($_POST["MaHG"]);
    if (isset($_POST["Gia"]))
        $gia = trim($_POST["Gia"]);
    if (isset($_FILES["Anh1"])) {
        $name_anh1 = $_FILES["Anh1"]["name"];
        $tmp_anh1 = $_FILES["Anh1"]["tmp_name"];
    }
    if (isset($_FILES["Anh2"])) {
        $name_anh2 = $_FILES["Anh2"]["name"];
        $tmp_anh2 = $_FILES["Anh2"]["tmp_name"];
    }
    if (isset($_FILES["Anh3"])) {
        $name_anh3 = $_FILES["Anh3"]["name"];
        $tmp_anh3 = $_FILES["Anh3"]["tmp_name"];
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
                <table id='table' align='center' width='600' cellpadding='5' cellspacing='5'>
                    <th colspan="2">
                        <font size="5"><i>CẬP NHẬT THÔNG TIN GIÀY</i></font>
                    </th>
                    <tr>
                        <td>Mã giày: </td>
                        <td colspan="2"><input type="text" name="MaGiay" size="20" value="<?php echo $maGiay; ?>" disabled /></td>
                    </tr>
                    <tr>
                        <td>Tên giày: </td>
                        <td colspan="2"><input type="text" name="TenGiay" size="50" value="<?php echo $tenGiay; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Loại giày: </td>
                        <td colspan="2">
                            <select name="LoaiGiay">
                                <?php
                                $query = "SELECT MaLG, TenLG
                                        FROM LoaiGiay";
                                $result = mysqli_query($conn, $query);
                                if (mysqli_num_rows($result) <> 0) {
                                    while ($rows = mysqli_fetch_row($result)) {
                                        if ($maLG == $rows[0])
                                            echo "<option value=$rows[0] selected>$rows[1]</option>";
                                        else
                                            echo "<option value=$rows[0]>$rows[1]</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Hãng giày: </td>
                        <td colspan="2">
                            <select name="HangGiay">
                                <?php
                                $query = "SELECT MaHG, TenHG
                                        FROM HangGiay";
                                $result = mysqli_query($conn, $query);
                                if (mysqli_num_rows($result) <> 0) {
                                    while ($rows = mysqli_fetch_row($result)) {
                                        if ($maHG == $rows[0])
                                            echo "<option value=$rows[0] selected>$rows[1]</option>";
                                        else
                                            echo "<option value=$rows[0]>$rows[1]</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Giá: </td>
                        <td colspan="2"><input type="text" name="Gia" size="30" value="<?php echo $gia; ?>" />VND</td>
                    </tr>
                    <tr>
                        <td>Mô tả:</td>
                        <td colspan="2"><textarea name="" id="" cols="50" rows="10"><?php echo $moTa; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Ảnh 1: </td>
                        <td colspan="2"><input type="file" name="Anh1"></td>
                    </tr>
                    <tr>
                        <td>Ảnh 2: </td>
                        <td colspan="2"><input type="file" name="Anh2"></td>
                    </tr>
                    <tr>
                        <td>Ảnh 3: </td>
                        <td colspan="2"><input type="file" name="Anh3"></td>
                    </tr>
                    <tr>
                        <td><b>Thêm size:</b></td>
                        <td colspan="2"><button type="button" id="addSize">+</button></td>
                    </tr>
                    <?php 
                    $dem = 0;
                    $sql = "SELECT SizeGiay.MaSize, Size, SoLuongTon
                            FROM Giay, ChiTietGiay, SizeGiay
                            WHERE Giay.MaGiay = ChiTietGiay.MaGiay AND SizeGiay.MaSize = ChiTietGiay.MaSize 
                                AND Giay.MaGiay = '$maGiay' ";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) <> 0) {
                        while ($rows = mysqli_fetch_row($result)) {
                            $dem++;
                            echo " <tr>
                                <td>Size:</td>
                                <td>
                                    <select name='SizeGiay$dem'> ";
                                    $sql1 = "SELECT MaSize, Size
                                            FROM SizeGiay";
                                    $result1 = mysqli_query($conn, $sql1);
                                    if (mysqli_num_rows($result1) <> 0) {
                                        while ($rows1 = mysqli_fetch_row($result1)) {
                                            if ($rows[0] == $rows1[0])
                                                echo "<option value=$rows1[0] selected>$rows1[1]</option>";
                                            // else 
                                            //    echo "<option value=$rows1[0]>$rows1[1]</option>";
                                        }
                                    }
                                    echo "</select>
                                </td>
                                <td rowspan='2'>
                                    <input type='button' value='Xoá'>
                                </td>
                            </tr>
                            <tr>
                                <td>Số lượng tồn:</td>
                                <td><input type='text' name='SoLuongTon$dem' value='$rows[2]'></td>
                            </tr>";
                        }
                    }
                    ?>
                    <tr>
                        <td><a href="list.php">Quay lại</a></td>
                        <td colspan="2" align="center"><input type="submit" name="capnhat" size="10"
                                value="   Cập nhật   " /></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST["capnhat"])) {
        if ($name_anh1 != "") {
            $str1 = ",Anh1=$name_anh1";
            move_uploaded_file($tmp_anh1, 'images/' . $name_anh1);
        } else
            $str1 = "";
        if ($name_anh2 != "") {
            $str2 = ",Anh2=$name_anh2";
            move_uploaded_file($tmp_anh2, 'images/' . $name_anh2);
        } else
            $str2 = "";
        if ($name_anh3 != "") {
            $str3 = ",Anh3=$name_anh3";
            move_uploaded_file($tmp_anh3, 'images/' . $name_anh3);
        } else
            $str3 = "";
        $sql = "UPDATE Giay 
                SET TenGiay='$tenGiay', MaLG='$maLG', MaHG='$maHG', Gia='$gia'" . $str1 . $str2 . $str3 . "
                WHERE MaGiay='$maGiay'";
        $result = mysqli_query($conn, $sql);

        for ($i=1; $i<=$dem; $i++) {
            if (isset($_POST["SizeGiay$i"]) && isset($_POST["SoLuongTon$i"])) {
                $maSize = $_POST["SizeGiay$i"];
                $soLuongTon = trim($_POST["SoLuongTon$i"]);

                $sql = "SELECT * FROM ChiTietGiay
                        WHERE MaGiay='$maGiay' AND MaSize='$maSize'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $sql = "UPDATE ChiTietGiay
                            SET SoLuongTon='$soLuongTon'
                            WHERE MaGiay='$maGiay' AND MaSize='$maSize'";
                    $result = mysqli_query($conn, $sql);
                }
                else {
                    $sql = "INSERT INTO ChiTietGiay
                            VALUE ('$maGiay','$maSize','$soLuongTon')";
                    $result = mysqli_query($conn, $sql);
                }
                
            }
            
        }
        if ($result != false) {
            echo "<p align='center'>Đã cập nhập giày có mã $maGiay</p>";
        }
    }
    ?>

    <?php include("../footer.php"); ?>

    <script>
        var dem = <?php echo $dem; ?>
        
        document.getElementById("addSize").addEventListener("click", function() {
            dem++;

            var table = document.getElementById("table");
            var newRow = table.insertRow(11);
    
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = "Size:";
            
            var cell2 = newRow.insertCell(1);
            var select = document.createElement("select");
            select.setAttribute("name", "SizeGiay"+dem);
            <?php
            $sql = "SELECT MaSize, Size 
                    FROM SizeGiay";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) <> 0) {
                while ($rows = mysqli_fetch_row($result)) {
                    echo "var option = document.createElement('option');";
                    echo "option.value = '".$rows[0]."';";
                    echo "option.text = '".$rows[1]."';";
                    echo "select.appendChild(option);";
                }
            }
            ?>
            cell2.appendChild(select);

            var newRow2 =table.insertRow(12);

            var cell1 = newRow2.insertCell(0);
            cell1.innerHTML = "Số lượng tồn:";

            var cell2 = newRow2.insertCell(1);
            var input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("name", "SoLuongTon"+dem);
            cell2.appendChild(input);

            if (dem >= <?php echo mysqli_num_rows($result) ?>) {
                this.disabled = true;
            }
        });
        
        var button = document.getElementById("addSize");
        if (dem >= <?php echo mysqli_num_rows($result) ?>) {
            button.disabled = true;
        }
    </script>
</body>

</html>