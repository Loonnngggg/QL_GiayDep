<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c05655c92.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Thông tin nhân viên</title>
</head>
<body>
    <?php include("../header_admin.php");?>
    <div class="table">
    <?php
    require("../connect.php");
    

    $rowsPerPage = 10; //số mẩu tin trên mỗi trang
    if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }
    //vị trí của mẩu tin đầu tiên trên mỗi trang
    $offset = ($_GET['page'] - 1) * $rowsPerPage;
    //lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset
    $sql = "SELECT MaNV, HoNV, TenNV, GioiTinh, DiaChi, SDT, Mail, TenDN, MatKhau, Quyen
            FROM NhanVien
            LIMIT $offset, $rowsPerPage";
    $result = mysqli_query($conn, $sql);

    echo "<h2 align='center'><i>THÔNG TIN NHÂN VIÊN</i></h2>";
    echo "<h4 align='center'><a href='add.php'>Thêm nhân viên mới</a></h4>";
    echo "<table align='center'>";
    echo '<thead>
    <tr>
        <th>STT</th>
        <th>Mã nhân viên</th>
        <th>Họ nhân viên</th>
        <th>Tên nhân viên</th>
        <th>Giới tính</th>
        <th>Địa chỉ</th>
        <th>Số điện thoại</th>
        <th>Mail</th>
        <th>Chi tiết</th>
        <th>Sửa</th>
        <th>Xoá</th>
    </tr></thead>
    <tbody>';

    if (mysqli_num_rows($result) <> 0) {
        $stt = 1;
        while ($rows = mysqli_fetch_row($result)) {
            // $color = $stt % 2 == 0 ? '#e8c69e' : '#FFFFFF';
            // style='background-color: $color'
            echo "<tr> 
                <td>$stt</td>
                <td>$rows[0]</td>
                <td>$rows[1]</td>
                <td>$rows[2]</td>
                <td>";
                    if ($rows[3] == 0)
                        echo "Nam";
                    else
                        echo "Nữ";
                echo "</td>
                <td>$rows[4]</td>
                <td>$rows[5]</td>
                <td>$rows[6]</td>
                <td><a href='detail.php?MaNV=$rows[0]'>Chi tiết</a></td>
                <td><a href='edit.php?MaNV=$rows[0]'>Sửa</a></td>
                <td><a href='delete.php?MaNV=$rows[0]'>Xoá</a></td>
            </tr>";
            $stt += 1;
        } //while 
        echo "</tbody></table>";

        $re = mysqli_query($conn, 'SELECT * FROM NhanVien');
        //tổng số mẩu tin cần hiển thị
        $numRows = mysqli_num_rows($re); //tổng số trang
        if ($numRows % $rowsPerPage == 0)
            $maxPage = $numRows / $rowsPerPage;
        else
            $maxPage = floor($numRows / $rowsPerPage) + 1; //tổng số trang

        echo "<p align='center'>";
        //nút Back
        if ($_GET['page'] > 1) {
            echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=1> << </a> ";
            echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . "> < </a> ";
        }

        //tạo link tương ứng tới các trang
        for ($i = 1; $i <= $maxPage; $i++) {
            if ($i == $_GET['page']) {
                echo '<b>' . $i . '</b> '; //trang hiện tại sẽ được bôi đậm
            } else
                echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $i . ">" . $i . "</a> ";
        }

        //nút Next
        if ($_GET['page'] < $maxPage) {
            echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] + 1) . "> > </a>";
            echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $maxPage . "> >> </a>";
        }
        echo "</p>";
    }
    ?>
    </div>
    <?php include("../footer.php"); ?>
</body>
</html>