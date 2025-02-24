<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ admin</title>
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include ("header_admin.php"); ?>
    <?php require ("connect.php"); ?>

    <h1 class="index-text">Trang chủ admin</h1>
    <div class="container">
        <div class="product">
            <h2>Tổng số giày</h2>
            <?php 
                $sql = "SELECT * FROM Giay";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) <> 0)
                    echo "<h2>".mysqli_num_rows($result)."</h2>";
            ?>
        </div>
        <div class="product">
            <h2>Tổng số nhân viên</h2>
            <?php 
                $sql = "SELECT * FROM NhanVien";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) <> 0)
                    echo "<h2>".mysqli_num_rows($result)."</h2>";
            ?>
        </div>
        <div class="product">
            <h2>Tổng số khách hàng</h2>
            <?php 
                $sql = "SELECT * FROM KhachHang";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) <> 0)
                    echo "<h2>".mysqli_num_rows($result)."</h2>";
            ?>
        </div>
    </div>

    <?php 
        if (isset($_POST["NgayBD"]))
        $ngayBD = $_POST["NgayBD"];
        else $ngayBD = date('Y-m-d');
        if (isset($_POST["NgayKT"]))
        $ngayKT = $_POST["NgayKT"];
        else $ngayKT = date('Y-m-d');
    ?>
    
    <div class="admin-form">
        <form action="" method="post">
            <table align='center' width='400' cellpadding='5' cellspacing='5'>
                <th colspan="2">
                    <font size="5"><i>Chọn ngày thống kê</i></font>
                </th>
                <tr>
                    <td>Từ ngày</td>
                    <td><input type="date" name="NgayBD" value="<?php echo $ngayBD; ?>"></td>
                </tr>
                <tr>
                    <td>Đến ngày</td>
                    <td><input type="date" name="NgayKT" value="<?php echo $ngayKT; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="OK" size="10"
                        value="   OK   " /></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="row">
        <div id="soLuongBan-chart" class="chart"></div>
        <div id="giaBan-chart" class="chart"></div>
    </div>

    <?php 
    
        $sql = "SELECT TenGiay, SoLuongBan, NgayXuatHD, ChiTietHD.Gia
                FROM HoaDon, ChiTietHD, Giay
                WHERE HoaDon.MaHD = ChiTietHD.MaHD AND ChiTietHD.MaGiay = Giay.MaGiay
                    AND NgayXuatHD >= '$ngayBD' AND NgayXuatHD <= '$ngayKT'";
        $result = mysqli_query($conn, $sql);

        $arr = array(); // Mảng chứa số lượng bán theo từng đôi giày
        $arr1 = array(); // Mảng chứa giá bán theo ngày
        $arr_caoNhat = array();
        $arr1_caoNhat = array();

        if (mysqli_num_rows($result) <> 0) {
            while ($rows = mysqli_fetch_row($result)) {
                $tenGiay = $rows[0];
                $soLuongBan = $rows[1];
                $ngayXuatHD = date("d-m-Y", strtotime($rows[2]));
                $gia = $rows[3];

                if (array_key_exists($tenGiay, $arr))
                    $arr[$tenGiay] += $soLuongBan;
                else
                    $arr[$tenGiay] = $soLuongBan;
                
                if (array_key_exists($ngayXuatHD, $arr1))
                    $arr1[$ngayXuatHD] += ($gia * $soLuongBan);
                else
                    $arr1[$ngayXuatHD] = ($gia * $soLuongBan);
            }
        }

        // Sắp xếp mảng kết quả giảm dần
        arsort($arr);
        arsort($arr1);

        // Lấy 10 giá trị cao nhất
        $arr_caoNhat = array_slice($arr, 0, 10);
        $arr1_caoNhat = array_slice($arr1, 0, 10);

    

    if (isset($_POST["OK"])) {
        $sql = "SELECT TenGiay, SoLuongBan, NgayXuatHD, ChiTietHD.Gia
                FROM HoaDon, ChiTietHD, Giay
                WHERE HoaDon.MaHD = ChiTietHD.MaHD AND ChiTietHD.MaGiay = Giay.MaGiay
                    AND NgayXuatHD >= '$ngayBD' AND NgayXuatHD <= '$ngayKT'";
        $result = mysqli_query($conn, $sql);

        $arr = array(); // Mảng chứa số lượng bán theo từng đôi giày
        $arr1 = array(); // Mảng chứa giá bán theo ngày
        if (mysqli_num_rows($result) <> 0) {
            while ($rows = mysqli_fetch_row($result)) {
                $tenGiay = $rows[0];
                $soLuongBan = $rows[1];
                $ngayXuatHD = date("d-m-Y", strtotime($rows[2]));
                $gia = $rows[3];

                if (array_key_exists($tenGiay, $arr))
                    $arr[$tenGiay] += $soLuongBan;
                else
                    $arr[$tenGiay] = $soLuongBan;
                
                if (array_key_exists($ngayXuatHD, $arr1))
                    $arr1[$ngayXuatHD] += ($gia * $soLuongBan);
                else
                    $arr1[$ngayXuatHD] = ($gia * $soLuongBan);
            }
        }

        // Sắp xếp mảng kết quả giảm dần
        arsort($arr);
        arsort($arr1);

        // Lấy 10 giá trị cao nhất
        $arr_caoNhat = array_slice($arr, 0, 10);
        $arr1_caoNhat = array_slice($arr1, 0, 10);

    }
    ?>
    <?php include("footer.php"); ?>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Giày", "Số lượng bán", { role: "style" }],
            <?php 
            if ($arr_caoNhat == null) 
                echo "['Không có giày', 0, 'darkblue'],";
            else {
                foreach ($arr_caoNhat as $giay => $soLuongBan) 
                    echo "['$giay', $soLuongBan, 'darkblue'],";
            }
            ?>
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2]);

        var options = {
            title: "Số lượng giày được bán",
            width: 800,
            height: 600,
            bar: { groupWidth: "95%" },
            legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("soLuongBan-chart"));
        chart.draw(view, options);
    }

    google.charts.setOnLoadCallback(drawChart1);
    function drawChart1() {
        var data1 = google.visualization.arrayToDataTable([
            ["Ngày", "Giá bán", { role: "style" }],
            <?php 
            if ($arr1_caoNhat == null) 
                echo "['Không có bán', 0, 'darkblue'],";
            else {
                foreach ($arr1_caoNhat as $ngay => $giaBan) 
                    echo "['$ngay', $giaBan, 'darkblue'],";
            }
            ?>
        ]);

        var view1 = new google.visualization.DataView(data1);
        view1.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2]);

        var options1 = {
            title: "Lợi nhuận bán được",
            width: 800,
            height: 600,
            bar: { groupWidth: "95%" },
            legend: { position: "none" },
        };
        var chart1 = new google.visualization.ColumnChart(document.getElementById("giaBan-chart"));
        chart1.draw(view1, options1);
    }
</script>

</html>