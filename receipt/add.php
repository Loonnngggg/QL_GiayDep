<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Thêm hoá đơn</title>
</head>

<body>
<?php //include("../header_admin.php"); ?>
    <?php
        session_start();
        if ($_SESSION['Quyen'] == 0) {
            include ("../header_admin.php");
        } else {
            include ("../header_nv.php");
        }
    ?>
    <?php
    require ("../connect.php");

    $maNV = $maKH = $maKM = "";
    if (isset($_POST["MaHD"]))
        $maHD = trim($_POST["MaHD"]);
    else
        $maHD = "20240602001";
    if (isset($_POST["NgayXuatHD"]))
        $ngayXuatHD = trim($_POST["NgayXuatHD"]);
    else
        $ngayXuatHD = "";
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <table id='table' align='center' width='600' cellpadding='5' cellspacing='5'>
            <th colspan="2">
                <font size="5"><i>THÊM HOÁ ĐƠN MỚI</i></font>
            </th>
            <tr>
                <td>Mã hoá đơn: </td>
                <td><input type="text" name="MaHD" size="20" value="<?php echo $maHD; ?>" disabled/></td>
            </tr>
            <tr>
                <td>Ngày xuất hoá đơn: </td>
                <td><input type="date" name="NgayXuatHD" size="50" value="<?php echo $ngayXuatHD; ?>" /></td>
            </tr>
            <tr>
                <td>Nhân viên: </td>
                <td>
                    <select name="NhanVien">
                        <?php
                        $query = "SELECT MaNV, HoNV, TenNV
                                    FROM NhanVien";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) <> 0) {
                            while ($rows = mysqli_fetch_row($result)) {
                                echo "<option value=$rows[0]>$rows[1] $rows[2]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Khách hàng: </td>
                <td>
                    <select name="KhachHang">
                        <?php
                        $query = "SELECT MaKH, HoKH, TenKH
                                    FROM KhachHang";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) <> 0) {
                            while ($rows = mysqli_fetch_row($result)) {
                                echo "<option value=$rows[0]>$rows[1] $rows[2]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Khuyến mãi: </td>
                <td>
                    <select name="KhuyenMai">
                        <?php
                        $query = "SELECT MaKM, TenKM
                                    FROM KhuyenMai";
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
                <td><b>Thêm chi tiết:</b></td>
                <td><button type="button" id="addHD">+</button></td>
            </tr>
            <tr>
                <td>Giày:</td>
                <td>
                    <select name="Giay1" id="Giay1" onchange="getSize(1)">
                        <?php
                        $query = "SELECT MaGiay, TenGiay
                                    FROM Giay";
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
                <td>Size:</td>
                <td>
                    <select name="SizeGiay1" id="SizeGiay1">
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
                <td>Số lượng:</td>
                <td><input type="text" name="SoLuong1"></td>
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
        $maNV = $_POST["NhanVien"];
        $maKH = $_POST["KhachHang"];
        $maKM = $_POST["KhuyenMai"];

        $query = "INSERT INTO HoaDon
                VALUE ('$maHD','$ngayXuatHD','$maNV','$maKH','$maKM', 0)";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // header("Location: bai_2_11_ketqua.php?maSua=$maSua");
            for ($i=1; $i<=10; $i++) {
                if (isset($_POST["Giay$i"]) && isset($_POST["SizeGiay$i"]) && isset($_POST["SoLuong$i"])) {
                    $maGiay = $_POST["Giay$i"];
                    $maSize = $_POST["SizeGiay$i"];
                    $soLuong = trim($_POST["SoLuong$i"]);

                    $sql = "INSERT INTO ChiTietHD
                            VALUE ('$maHD','$maGiay','$maSize','$soLuong', 0)";
                    $result = mysqli_query($conn, $sql);
                }
            }
            echo "Đã thêm hoá đơn $maHD";
        } else
            echo "Cần điền vào các trường trống";
    }
    ?>

    <?php include("../footer.php"); ?>

    <script>
        var dem = 1;
        document.getElementById("addHD").addEventListener("click", function() {
            dem++;

            var table = document.getElementById("table");
            var newRow = table.insertRow(7);
    
            var cell1 = newRow.insertCell(0);
            cell1.innerHTML = "Giày:";
            
            var cell2 = newRow.insertCell(1);
            var select = document.createElement("select");
            select.setAttribute("name", "Giay"+dem);
            select.setAttribute("id", "Giay"+dem);
            select.setAttribute("onchange", "getSize("+ dem + ")");
            <?php
            $sql = "SELECT MaGiay, TenGiay
                    FROM Giay";
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

            var newRow2 = table.insertRow(8);
    
            var cell1 = newRow2.insertCell(0);
            cell1.innerHTML = "Size:";
            
            var cell2 = newRow2.insertCell(1);
            var select = document.createElement("select");
            select.setAttribute("name", "SizeGiay"+dem);
            select.setAttribute("id", "SizeGiay"+dem);
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

            var newRow3 =table.insertRow(9);

            var cell1 = newRow3.insertCell(0);
            cell1.innerHTML = "Số lượng:";

            var cell2 = newRow3.insertCell(1);
            var input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("name", "SoLuong"+dem);
            cell2.appendChild(input);

            if (dem >= 10) {
                this.disabled = true;
            }
        });

        function getSize(dem) {
            var maGiay =document.getElementById('Giay' + dem).value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'getSize.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('SizeGiay' + dem).innerHTML = xhr.responseText;
                }
            };
            xhr.send('MaGiay=' + maGiay);
        }
    </script>
</body>

</html>