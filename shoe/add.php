<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Thêm giày</title>
</head>

<body>
<?php include("../header_admin.php"); ?>
    <?php
    require ("../connect.php");

    $maLG = $maHG = $name_anh1 = $tmp_anh1 = $name_anh2 = $tmp_anh2 = $name_anh3 = $tmp_anh3 = "";
    if (isset($_POST["MaGiay"]))
        $maGiay = trim($_POST["MaGiay"]);
    else
        $maGiay = "MG009";
    if (isset($_POST["TenGiay"]))
        $tenGiay = trim($_POST["TenGiay"]);
    else
        $tenGiay = "";
    if (isset($_POST["Gia"]))
        $gia = trim($_POST["Gia"]);
    else
        $gia = "";
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

    <form action="" method="post" enctype="multipart/form-data">
        <table id='table' align='center' width='600' cellpadding='5' cellspacing='5'>
            <th colspan="2">
                <font size="5"><i>THÊM GIÀY MỚI</i></font>
            </th>
            <tr>
                <td>Mã giày: </td>
                <td><input type="text" name="MaGiay" size="20" value="<?php echo $maGiay; ?>" disabled/></td>
            </tr>
            <tr>
                <td>Tên giày: </td>
                <td><input type="text" name="TenGiay" size="50" value="<?php echo $tenGiay; ?>" /></td>
            </tr>
            <tr>
                <td>Loại giày: </td>
                <td>
                    <select name="LoaiGiay">
                        <?php
                        $query = "SELECT MaLG, TenLG
                                    FROM LoaiGiay";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) <> 0) {
                            while ($rows = mysqli_fetch_row($result)) {
                                echo "<option value=$rows[0]>$rows[1]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Hãng giày: </td>
                <td>
                    <select name="HangGiay">
                        <?php
                        $query = "SELECT MaHG, TenHG
                                    FROM HangGiay";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) <> 0) {
                            while ($rows = mysqli_fetch_row($result)) {
                                echo "<option value=$rows[0]>$rows[1]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Giá: </td>
                <td><input type="text" name="Gia" size="30" value="<?php echo $gia; ?>" />VND</td>

            </tr>
            <tr>
                <td>Ảnh 1: </td>
                <td><input type="file" name="Anh1"></td>
            </tr>
            <tr>
                <td>Ảnh 2: </td>
                <td><input type="file" name="Anh2"></td>
            </tr>
            <tr>
                <td>Ảnh 3: </td>
                <td><input type="file" name="Anh3"></td>
            </tr>
            <tr>
                <td><b>Thêm size:</b></td>
                <td><button type="button" id="addSize">+</button></td>
            </tr>
            <tr>
                <td>Size:</td>
                <td>
                    <select name="SizeGiay1">
                        <?php
                        $query = "SELECT MaSize, Size
                                    FROM SizeGiay";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) <> 0) {
                            while ($rows = mysqli_fetch_row($result)) {
                                echo "<option value=$rows[0]>$rows[1]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Số lượng tồn:</td>
                <td><input type="text" name="SoLuongTon1"></td>
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
        $maLG = $_POST["LoaiGiay"];
        $maHG = $_POST["HangGiay"];

        $query = "INSERT INTO Giay
                VALUE ('$maGiay','$tenGiay','$maLG','$maHG','$gia','$name_anh1','$name_anh2','$name_anh3')";
        $result = mysqli_query($conn, $query);
        move_uploaded_file($tmp_anh1, 'images/' . $name_anh1);
        move_uploaded_file($tmp_anh2, 'images/' . $name_anh2);
        move_uploaded_file($tmp_anh3, 'images/' . $name_anh3);

        if ($result) {
            // header("Location: bai_2_11_ketqua.php?maSua=$maSua");
            $sql = "SELECT MaSize, Size 
                    FROM SizeGiay";
            $result = mysqli_query($conn, $sql);

            for ($i=1; $i<=mysqli_num_rows($result); $i++) {
                if (isset($_POST["SizeGiay$i"]) && isset($_POST["SoLuongTon$i"])) {
                    $maSize = $_POST["SizeGiay$i"];
                    $soLuongTon = trim($_POST["SoLuongTon$i"]);

                    $sql = "INSERT INTO ChiTietGiay
                            VALUE ('$maGiay','$maSize','$soLuongTon')";
                    $result = mysqli_query($conn, $sql);
                }
            }
            echo "Đã thêm giày $tenGiay";
        } else
            echo "Cần điền vào các trường trống";
    }
    ?>

    <?php include("../footer.php"); ?>

    <script>
        var dem = 1;
        
        document.getElementById("addSize").addEventListener("click", function() {
            dem++;

            var table = document.getElementById("table");
            var newRow = table.insertRow(10);
    
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

            var newRow2 =table.insertRow(11);

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
    </script>
</body>

</html>